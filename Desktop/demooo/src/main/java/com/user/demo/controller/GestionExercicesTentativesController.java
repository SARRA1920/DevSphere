package com.user.demo.controller;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;
import com.user.demo.model.Exercice;
import com.user.demo.model.Tentative;
import com.user.demo.service.ExerciceService;
import com.user.demo.service.TentativeService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.value.ObservableValue;
import java.util.List;

public class GestionExercicesTentativesController {

    @FXML private TextField rechercheExercice;
    @FXML private TextField rechercheTentative;
    
    @FXML private TableView<Exercice> tableExercices;
    @FXML private TableColumn<Exercice, Integer> idExerciceCol;
    @FXML private TableColumn<Exercice, String> titreExerciceCol;
    @FXML private TableColumn<Exercice, String> typeExerciceCol;
    @FXML private TableColumn<Exercice, String> niveauExerciceCol;
    @FXML private TableColumn<Exercice, Integer> tempsEstimeCol;
    @FXML private TableColumn<Exercice, Double> noteMinimaleCol;
    
    @FXML private TableView<Tentative> tableTentatives;
    @FXML private TableColumn<Tentative, Integer> idTentativeCol;
    @FXML private TableColumn<Tentative, String> exerciceTentativeCol;
    @FXML private TableColumn<Tentative, Integer> etudiantTentativeCol;
    @FXML private TableColumn<Tentative, String> dateTentativeCol;
    @FXML private TableColumn<Tentative, Integer> scoreTentativeCol;
    @FXML private TableColumn<Tentative, Double> noteTentativeCol;
    @FXML private TableColumn<Tentative, String> statutTentativeCol;
    
    private ExerciceService exerciceService;
    private TentativeService tentativeService;
    private ObservableList<Exercice> exercices;
    private ObservableList<Tentative> tentatives;
    private static final DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        exerciceService = new ExerciceService();
        tentativeService = new TentativeService();
        
        setupColumns();
        setupSearch();
        loadTentatives();
    }

    private void setupColumns() {
        // Configuration des colonnes des exercices
        idExerciceCol.setCellValueFactory(new PropertyValueFactory<>("id"));
        titreExerciceCol.setCellValueFactory(new PropertyValueFactory<>("titre"));
        typeExerciceCol.setCellValueFactory(new PropertyValueFactory<>("type"));
        niveauExerciceCol.setCellValueFactory(new PropertyValueFactory<>("niveauDifficulte"));
        tempsEstimeCol.setCellValueFactory(new PropertyValueFactory<>("tempsEstime"));
        noteMinimaleCol.setCellValueFactory(new PropertyValueFactory<>("noteMinimale"));
        
        // Configuration des colonnes des tentatives
        idTentativeCol.setCellValueFactory(new PropertyValueFactory<>("id"));
        
        exerciceTentativeCol.setCellValueFactory(cellData -> {
            Exercice exercice = exerciceService.getById(cellData.getValue().getExercice_id());
            return new SimpleStringProperty(exercice != null ? exercice.getTitre() : "");
        });
        
        etudiantTentativeCol.setCellValueFactory(new PropertyValueFactory<>("user_id"));
        
        dateTentativeCol.setCellValueFactory(cellData -> 
            new SimpleStringProperty(cellData.getValue().getDate() != null ? 
                dateFormatter.format(cellData.getValue().getDate()) : ""));
                
        scoreTentativeCol.setCellValueFactory(new PropertyValueFactory<>("score"));
        noteTentativeCol.setCellValueFactory(new PropertyValueFactory<>("note"));
        statutTentativeCol.setCellValueFactory(new PropertyValueFactory<>("statut"));
    }

    private void setupSearch() {
        // Configuration de la recherche pour les exercices
        FilteredList<Exercice> exercicesFiltres = new FilteredList<>(exercices, p -> true);
        rechercheExercice.textProperty().addListener((observable, oldValue, newValue) -> {
            exercicesFiltres.setPredicate(exercice -> {
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }
                String lowerCaseFilter = newValue.toLowerCase();
                return exercice.getTitre().toLowerCase().contains(lowerCaseFilter) ||
                       exercice.getType().toLowerCase().contains(lowerCaseFilter) ||
                       exercice.getNiveauDifficulte().toLowerCase().contains(lowerCaseFilter);
            });
        });
        tableExercices.setItems(exercicesFiltres);
        
        // Configuration de la recherche pour les tentatives
        FilteredList<Tentative> tentativesFiltrees = new FilteredList<>(tentatives, p -> true);
        rechercheTentative.textProperty().addListener((observable, oldValue, newValue) -> {
            tentativesFiltrees.setPredicate(tentative -> {
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }
                String lowerCaseFilter = newValue.toLowerCase();
                
                Exercice exercice = exerciceService.getById(tentative.getExercice_id());
                if (exercice != null && exercice.getTitre().toLowerCase().contains(lowerCaseFilter)) {
                    return true;
                }
                
                if (String.valueOf(tentative.getUser_id()).contains(lowerCaseFilter)) {
                    return true;
                }
                
                if (tentative.getStatut() != null && tentative.getStatut().toLowerCase().contains(lowerCaseFilter)) {
                    return true;
                }
                
                return false;
            });
        });
        tableTentatives.setItems(tentativesFiltrees);
    }

    private void loadTentatives() {
        try {
            exercices = FXCollections.observableArrayList(exerciceService.afficher());
            tentatives = FXCollections.observableArrayList(tentativeService.afficher());
            tableExercices.setItems(exercices);
            tableTentatives.setItems(tentatives);
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible de charger les données : " + e.getMessage());
        }
    }
    
    @FXML
    private void ajouterExercice() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AjoutExercice.fxml"));
            Scene scene = new Scene(loader.load());
            Stage stage = new Stage();
            stage.setTitle("Ajouter un exercice");
            stage.setScene(scene);
            stage.showAndWait();
            loadTentatives();
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Erreur lors de l'ouverture du formulaire d'ajout : " + e.getMessage());
        }
    }
    
    @FXML
    private void modifierExercice() {
        Exercice exercice = tableExercices.getSelectionModel().getSelectedItem();
        if (exercice == null) {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Veuillez sélectionner un exercice à modifier.");
            return;
        }
        
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/ModificationExercice.fxml"));
            Scene scene = new Scene(loader.load());
            ModificationExerciceController controller = loader.getController();
            controller.setExercice(exercice);
            
            Stage stage = new Stage();
            stage.setTitle("Modifier l'exercice");
            stage.setScene(scene);
            stage.showAndWait();
            loadTentatives();
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Erreur lors de l'ouverture du formulaire de modification : " + e.getMessage());
        }
    }
    
    @FXML
    private void supprimerExercice() {
        Exercice exercice = tableExercices.getSelectionModel().getSelectedItem();
        if (exercice == null) {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Veuillez sélectionner un exercice à supprimer.");
            return;
        }
        
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Êtes-vous sûr de vouloir supprimer cet exercice ?");
        confirmation.setContentText("Cette action est irréversible.");
        
        if (confirmation.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
            try {
                exerciceService.supprimer(exercice);
                loadTentatives();
                showAlert(Alert.AlertType.INFORMATION, "Succès", 
                    "L'exercice a été supprimé avec succès.");
            } catch (Exception e) {
                showAlert(Alert.AlertType.ERROR, "Erreur", 
                    "Erreur lors de la suppression : " + e.getMessage());
            }
        }
    }
    
    @FXML
    private void voirDetailsTentative() {
        Tentative tentative = tableTentatives.getSelectionModel().getSelectedItem();
        if (tentative == null) {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Veuillez sélectionner une tentative à consulter.");
            return;
        }
        
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/DetailsTentative.fxml"));
            Scene scene = new Scene(loader.load());
            DetailsTentativeController controller = loader.getController();
            controller.setTentative(tentative);
            
            Stage stage = new Stage();
            stage.setTitle("Détails de la tentative");
            stage.setScene(scene);
            stage.show();
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Erreur lors de l'ouverture des détails : " + e.getMessage());
        }
    }
    
    @FXML
    private void supprimerTentative() {
        Tentative tentative = tableTentatives.getSelectionModel().getSelectedItem();
        if (tentative == null) {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Veuillez sélectionner une tentative à supprimer.");
            return;
        }
        
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Êtes-vous sûr de vouloir supprimer cette tentative ?");
        confirmation.setContentText("Cette action est irréversible.");
        
        if (confirmation.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
            try {
                tentativeService.supprimer(tentative);
                loadTentatives();
                showAlert(Alert.AlertType.INFORMATION, "Succès", 
                    "La tentative a été supprimée avec succès.");
            } catch (Exception e) {
                showAlert(Alert.AlertType.ERROR, "Erreur", 
                    "Erreur lors de la suppression : " + e.getMessage());
            }
        }
    }
    
    // Méthodes de tri
    @FXML private void trierExercicesParTitre() {
        exercices.sort((e1, e2) -> e1.getTitre().compareToIgnoreCase(e2.getTitre()));
    }
    
    @FXML private void trierExercicesParType() {
        exercices.sort((e1, e2) -> e1.getType().compareToIgnoreCase(e2.getType()));
    }
    
    @FXML private void trierExercicesParNiveau() {
        exercices.sort((e1, e2) -> e1.getNiveauDifficulte().compareToIgnoreCase(e2.getNiveauDifficulte()));
    }
    
    @FXML private void trierTentativesParDate() {
        tentatives.sort((t1, t2) -> t2.getDate().compareTo(t1.getDate())); // Plus récent d'abord
    }
    
    @FXML private void trierTentativesParNote() {
        tentatives.sort((t1, t2) -> Double.compare(t2.getNote(), t1.getNote())); // Notes décroissantes
    }
    
    @FXML private void trierTentativesParStatut() {
        tentatives.sort((t1, t2) -> t1.getStatut().compareToIgnoreCase(t2.getStatut()));
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 