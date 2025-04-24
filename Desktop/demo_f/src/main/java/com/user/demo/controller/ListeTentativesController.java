package com.user.demo.controller;

import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.GridPane;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.beans.property.SimpleStringProperty;
import com.user.demo.model.Tentative;
import com.user.demo.model.Exercice;
import com.user.demo.service.TentativeService;
import com.user.demo.service.ExerciceService;
import java.time.format.DateTimeFormatter;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

public class ListeTentativesController {

    @FXML private TableView<Tentative> tentativeTable;
    @FXML private TableColumn<Tentative, Integer> idColumn;
    @FXML private TableColumn<Tentative, String> exerciceColumn;
    @FXML private TableColumn<Tentative, Integer> etudiantColumn;
    @FXML private TableColumn<Tentative, LocalDateTime> dateColumn;
    @FXML private TableColumn<Tentative, Integer> scoreColumn;
    @FXML private TableColumn<Tentative, Double> noteColumn;
    @FXML private TableColumn<Tentative, String> statutColumn;
    @FXML private TableColumn<Tentative, Void> actionsColumn;
    @FXML private TextField searchField;
    @FXML private Label statusLabel;

    private TentativeService tentativeService;
    private ExerciceService exerciceService;
    private ObservableList<Tentative> tentatives;
    private final DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        System.out.println("Initialisation du contrôleur ListeTentativesController...");
        
        tentativeService = new TentativeService();
        exerciceService = new ExerciceService();
        tentatives = FXCollections.observableArrayList();
        
        // Configuration de la largeur des colonnes
        exerciceColumn.setPrefWidth(200);
        dateColumn.setPrefWidth(150);
        noteColumn.setPrefWidth(100);
        statutColumn.setPrefWidth(120);
        actionsColumn.setPrefWidth(220);
        actionsColumn.setStyle("-fx-alignment: CENTER;");
        
        // Configuration des colonnes
        exerciceColumn.setCellValueFactory(cellData -> {
            try {
                Exercice exercice = exerciceService.getById(cellData.getValue().getExercice_id());
                return new SimpleStringProperty(exercice != null ? exercice.getTitre() : "N/A");
            } catch (Exception e) {
                return new SimpleStringProperty("N/A");
            }
        });
        
        dateColumn.setCellValueFactory(new PropertyValueFactory<>("date"));
        dateColumn.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(LocalDateTime date, boolean empty) {
                super.updateItem(date, empty);
                if (empty || date == null) {
                    setText(null);
                } else {
                    setText(dateFormatter.format(date));
                }
                setAlignment(javafx.geometry.Pos.CENTER);
            }
        });
        
        noteColumn.setCellValueFactory(new PropertyValueFactory<>("note"));
        noteColumn.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Double note, boolean empty) {
                super.updateItem(note, empty);
                if (empty || note == null) {
                    setText(null);
                } else {
                    setText(String.format("%.2f/20", note));
                }
                setAlignment(javafx.geometry.Pos.CENTER);
            }
        });
        
        statutColumn.setCellValueFactory(new PropertyValueFactory<>("statue"));
        statutColumn.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(String statut, boolean empty) {
                super.updateItem(statut, empty);
                if (empty || statut == null) {
                    setText(null);
                } else {
                    setText(statut);
                    switch (statut) {
                        case "TERMINÉ":
                            setStyle("-fx-text-fill: #27ae60; -fx-font-weight: bold;");
                            break;
                        case "EN_COURS":
                            setStyle("-fx-text-fill: #f39c12; -fx-font-weight: bold;");
                            break;
                        case "ABANDONNÉ":
                            setStyle("-fx-text-fill: #c0392b; -fx-font-weight: bold;");
                            break;
                        default:
                            setStyle("-fx-text-fill: #2c3e50;");
                    }
                }
                setAlignment(javafx.geometry.Pos.CENTER);
            }
        });
        
        // Configuration des boutons d'action
        actionsColumn.setCellFactory(col -> new TableCell<>() {
            private final Button voirBtn = new Button("Voir");
            private final Button modifierBtn = new Button("Modifier");
            private final Button supprimerBtn = new Button("Supprimer");
            private final HBox buttons = new HBox(8, voirBtn, modifierBtn, supprimerBtn);

            {
                // Style des boutons
                voirBtn.getStyleClass().addAll("button-voir", "button-small");
                modifierBtn.getStyleClass().addAll("button-modifier", "button-small");
                supprimerBtn.getStyleClass().addAll("button-supprimer", "button-small");
                
                // Configuration du conteneur HBox
                buttons.setAlignment(Pos.CENTER);
                
                // Configuration de la taille des boutons
                voirBtn.setPrefWidth(70);
                modifierBtn.setPrefWidth(90);
                supprimerBtn.setPrefWidth(90);
                
                // Configuration des actions
                voirBtn.setOnAction(event -> handleVoir(getTableView().getItems().get(getIndex())));
                modifierBtn.setOnAction(event -> handleModifier(getTableView().getItems().get(getIndex())));
                supprimerBtn.setOnAction(event -> handleSupprimer(getTableView().getItems().get(getIndex())));
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : buttons);
            }
        });

        // Configuration de la recherche
        FilteredList<Tentative> filteredData = new FilteredList<>(tentatives, p -> true);
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredData.setPredicate(tentative -> {
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }
                String lowerCaseFilter = newValue.toLowerCase();
                Exercice exercice = exerciceService.getById(tentative.getExercice_id());
                return (exercice != null && exercice.getTitre().toLowerCase().contains(lowerCaseFilter)) ||
                       (tentative.getStatue() != null && tentative.getStatue().toLowerCase().contains(lowerCaseFilter));
            });
        });

        tentativeTable.setItems(filteredData);
        
        // Chargement initial des données
        handleRefresh();
    }

    @FXML
    private void handleRefresh() {
        try {
            System.out.println("Début du rafraîchissement des données...");
            tentatives.clear();
            List<Tentative> nouvelleTentatives = tentativeService.afficher();
            System.out.println("Nombre de tentatives récupérées : " + nouvelleTentatives.size());
            tentatives.addAll(nouvelleTentatives);
            statusLabel.setText("Total des tentatives : " + nouvelleTentatives.size());
        } catch (Exception e) {
            System.out.println("Erreur lors du rafraîchissement : ");
            e.printStackTrace();
            statusLabel.setText("Erreur lors de l'actualisation : " + e.getMessage());
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible de charger les tentatives : " + e.getMessage());
        }
    }

    private void handleModifier(Tentative tentative) {
        try {
            Dialog<ButtonType> dialog = new Dialog<>();
            dialog.setTitle("Modifier la tentative");
            dialog.setHeaderText("Modifier les informations de la tentative");

            GridPane grid = new GridPane();
            grid.setHgap(10);
            grid.setVgap(10);
            grid.setPadding(new Insets(20, 150, 10, 10));

            TextField noteField = new TextField(String.valueOf(tentative.getNote()));
            ComboBox<String> statutCombo = new ComboBox<>();
            statutCombo.getItems().addAll("EN_COURS", "TERMINÉ", "ABANDONNÉ");
            statutCombo.setValue(tentative.getStatue());

            grid.add(new Label("Note:"), 0, 0);
            grid.add(noteField, 1, 0);
            grid.add(new Label("Statut:"), 0, 1);
            grid.add(statutCombo, 1, 1);

            dialog.getDialogPane().setContent(grid);
            dialog.getDialogPane().getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);

            Optional<ButtonType> result = dialog.showAndWait();
            if (result.isPresent() && result.get() == ButtonType.OK) {
                try {
                    tentative.setNote(Double.parseDouble(noteField.getText()));
                    tentative.setStatue(statutCombo.getValue());
                    tentativeService.modifier(tentative);
                    handleRefresh();
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "La tentative a été modifiée avec succès.");
                } catch (NumberFormatException e) {
                    showAlert(Alert.AlertType.ERROR, "Erreur", "La note doit être un nombre valide.");
                }
            }
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la modification : " + e.getMessage());
        }
    }

    private void handleSupprimer(Tentative tentative) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Êtes-vous sûr de vouloir supprimer cette tentative ?");
        confirmation.setContentText("Cette action est irréversible.");

        Optional<ButtonType> result = confirmation.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            try {
                tentativeService.supprimer(tentative);
                tentatives.remove(tentative);
                statusLabel.setText("Tentative supprimée avec succès");
                showAlert(Alert.AlertType.INFORMATION, "Succès", "La tentative a été supprimée avec succès.");
            } catch (Exception e) {
                statusLabel.setText("Erreur lors de la suppression");
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression : " + e.getMessage());
            }
        }
    }

    private void handleVoir(Tentative tentative) {
        try {
            Dialog<ButtonType> dialog = new Dialog<>();
            dialog.setTitle("Détails de la tentative");
            dialog.setHeaderText("Informations sur la tentative");

            GridPane grid = new GridPane();
            grid.setHgap(10);
            grid.setVgap(10);
            grid.setPadding(new Insets(20, 150, 10, 10));

            Exercice exercice = exerciceService.getById(tentative.getExercice_id());
            
            grid.add(new Label("Exercice:"), 0, 0);
            grid.add(new Label(exercice != null ? exercice.getTitre() : "N/A"), 1, 0);
            
            grid.add(new Label("Date:"), 0, 1);
            grid.add(new Label(dateFormatter.format(tentative.getDate())), 1, 1);
            
            grid.add(new Label("Note:"), 0, 2);
            grid.add(new Label(String.format("%.2f/20", tentative.getNote())), 1, 2);
            
            grid.add(new Label("Statut:"), 0, 3);
            grid.add(new Label(tentative.getStatue()), 1, 3);

            dialog.getDialogPane().setContent(grid);
            dialog.getDialogPane().getButtonTypes().add(ButtonType.OK);
            dialog.showAndWait();
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible d'afficher les détails : " + e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 