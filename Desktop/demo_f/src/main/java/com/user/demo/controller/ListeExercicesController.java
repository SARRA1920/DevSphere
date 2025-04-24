package com.user.demo.controller;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.stage.Stage;
import javafx.scene.control.cell.PropertyValueFactory;
import com.user.demo.model.Exercice;
import com.user.demo.model.Tentative;
import com.user.demo.service.ExerciceService;
import com.user.demo.service.TentativeService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import java.time.LocalDateTime;
import java.sql.SQLException;
import java.io.IOException;
import javafx.event.ActionEvent;

public class ListeExercicesController {

    @FXML
    private TableView<Exercice> exerciceTable;
    @FXML
    private TableColumn<Exercice, Integer> idColumn;
    @FXML
    private TableColumn<Exercice, String> titreColumn;
    @FXML
    private TableColumn<Exercice, String> niveauColumn;
    @FXML
    private TableColumn<Exercice, Double> noteColumn;
    @FXML
    private TableColumn<Exercice, Integer> tempsColumn;
    @FXML
    private TableColumn<Exercice, String> typeColumn;
    @FXML
    private TableColumn<Exercice, HBox> actionsColumn;

    private ObservableList<Exercice> exercices = FXCollections.observableArrayList();
    private ExerciceService exerciceService;
    private TentativeService tentativeService;

    @FXML
    public void initialize() {
        exerciceService = new ExerciceService();
        tentativeService = new TentativeService();

        // Configuration des colonnes
        idColumn.setCellValueFactory(new PropertyValueFactory<>("id"));
        titreColumn.setCellValueFactory(new PropertyValueFactory<>("titre"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveauDifficulte"));
        noteColumn.setCellValueFactory(new PropertyValueFactory<>("noteMinimale"));
        tempsColumn.setCellValueFactory(new PropertyValueFactory<>("tempsEstime"));
        typeColumn.setCellValueFactory(new PropertyValueFactory<>("type"));
        
        // Configuration de la colonne d'actions
        actionsColumn.setCellFactory(col -> new TableCell<Exercice, HBox>() {
            private final Button editButton = new Button("Modifier");
            private final Button deleteButton = new Button("Supprimer");
            private final Button startButton = new Button("Commencer");
            private final HBox buttons = new HBox(5, editButton, deleteButton, startButton);
            
            {
                // Style du bouton Commencer
                startButton.setStyle("-fx-background-color: #2196F3; -fx-text-fill: white;");
                
                editButton.setOnAction(event -> {
                    Exercice exercice = getTableView().getItems().get(getIndex());
                    handleModifier(exercice);
                });
                
                deleteButton.setOnAction(event -> {
                    Exercice exercice = getTableView().getItems().get(getIndex());
                    handleSupprimer(exercice);
                });

                startButton.setOnAction(event -> {
                    Exercice exercice = getTableView().getItems().get(getIndex());
                    handleCommencer(event);
                });
            }
            
            @Override
            protected void updateItem(HBox item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : buttons);
            }
        });

        // Chargement des exercices
        chargerExercices();
    }

    @FXML
    private void handleAjouterExercice() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AjoutExercice.fxml"));
            Parent root = loader.load();
            
            AjoutExerciceController controller = loader.getController();
            controller.setExercicesList(exercices);
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter un exercice");
            stage.setScene(new Scene(root));
            stage.show();
            
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible d'ouvrir la fenêtre d'ajout");
        }
    }

    private void handleModifier(Exercice exercice) {
        if (exercice == null) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Veuillez sélectionner un exercice à modifier.");
            return;
        }

        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/ModificationExercice.fxml"));
            Parent root = loader.load();
            
            ModificationExerciceController controller = loader.getController();
            controller.setExercice(exercice);
            controller.setExercicesList(exercices);
            
            Stage stage = new Stage();
            stage.setTitle("Modifier l'exercice");
            stage.setScene(new Scene(root));
            stage.show();
            
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible d'ouvrir la fenêtre de modification : " + e.getMessage());
        }
    }

    private void handleSupprimer(Exercice exercice) {
        try {
            exerciceService.supprimer(exercice);
            exercices.remove(exercice);
            showAlert(Alert.AlertType.INFORMATION, "Information", "Exercice supprimé avec succès.");
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Une erreur est survenue lors de la suppression : " + e.getMessage());
        }
    }

    @FXML
    private void handleCommencer(ActionEvent event) {
        Exercice exercice = exerciceTable.getSelectionModel().getSelectedItem();
        if (exercice != null) {
            try {
                // Créer une nouvelle tentative
                Tentative tentative = new Tentative();
                tentative.setExercice_id(exercice.getId());
                tentative.setUser_id(1); // ID utilisateur temporaire
                tentative.setDate(LocalDateTime.now());
                tentative.setStatue("EN_COURS");
                tentative.setScore(0);
                tentative.setNote(0.0);
                
                // Sauvegarder la tentative
                tentativeService.ajouter(tentative);
                
                // Ouvrir la fenêtre de tentative
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/tentatives-view.fxml"));
                Parent root = loader.load();
                
                TentativesController controller = loader.getController();
                controller.setTentative(tentative);
                controller.setExercice(exercice);
                
                Stage stage = new Stage();
                stage.setTitle("Tentative d'exercice");
                stage.setScene(new Scene(root));
                stage.show();
                
            } catch (Exception e) {
                showAlert(Alert.AlertType.ERROR, "Erreur", 
                    "Impossible de démarrer l'exercice : " + e.getMessage());
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Veuillez sélectionner un exercice.");
        }
    }

    private void chargerExercices() {
        try {
            exercices.clear();
            exercices.addAll(exerciceService.rechercher());
            exerciceTable.setItems(exercices);
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible de charger les exercices : " + e.getMessage());
        }
    }

    @FXML
    private void handleVoirTentatives() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/ListeTentatives.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Liste des Tentatives");
            stage.setScene(new Scene(root));
            stage.show();
            
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible d'ouvrir la fenêtre des tentatives : " + e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 