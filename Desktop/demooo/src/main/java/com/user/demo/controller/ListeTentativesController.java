package com.user.demo.controller;

import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.FileChooser;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.scene.text.Text;
import javafx.scene.text.TextFlow;
import com.user.demo.model.Tentative;
import com.user.demo.model.Exercice;
import com.user.demo.service.TentativeService;
import com.user.demo.service.ExerciceService;
import com.user.demo.service.ExcelService;
import java.time.format.DateTimeFormatter;
import java.time.LocalDateTime;
import java.io.File;
import java.util.List;
import java.util.Optional;

public class ListeTentativesController {

    @FXML private FlowPane cardsContainer;
    @FXML private TextField searchField;
    @FXML private Label statusLabel;
    @FXML private ComboBox<String> filterComboBox;
    @FXML private Button exportButton;
    @FXML private Button exportReponsesButton;

    private TentativeService tentativeService;
    private ExerciceService exerciceService;
    private ExcelService excelService;
    private ObservableList<Tentative> tentatives;
    private final DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        System.out.println("Initialisation du contrôleur ListeTentativesController...");
        
        tentativeService = new TentativeService();
        exerciceService = new ExerciceService();
        excelService = new ExcelService();
        tentatives = FXCollections.observableArrayList();
        
        // Configuration des boutons d'export
        setupExportButtons();
        
        // Configuration de la recherche
        setupSearch();
        
        // Chargement initial des données
        handleRefresh();
    }

    private void setupSearch() {
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            updateCardDisplay();
        });
    }

    private void updateCardDisplay() {
        cardsContainer.getChildren().clear();
        String searchText = searchField.getText().toLowerCase();
        
        tentatives.forEach(tentative -> {
            if (shouldDisplayTentative(tentative, searchText)) {
                cardsContainer.getChildren().add(createTentativeCard(tentative));
            }
        });
    }

    private boolean shouldDisplayTentative(Tentative tentative, String searchText) {
        if (searchText == null || searchText.isEmpty()) {
            return true;
        }
        
        Exercice exercice = exerciceService.getById(tentative.getExercice_id());
        return (exercice != null && exercice.getTitre().toLowerCase().contains(searchText)) ||
               (tentative.getStatue() != null && tentative.getStatue().toLowerCase().contains(searchText));
    }

    private VBox createTentativeCard(Tentative tentative) {
        VBox card = new VBox(10);
        card.getStyleClass().add("tentative-card");
        card.setPadding(new Insets(15));
        card.setPrefWidth(300);
        card.setMaxWidth(300);
        
        // Récupérer l'exercice
        Exercice exercice = exerciceService.getById(tentative.getExercice_id());
        
        // Titre de l'exercice
        Label titreLabel = new Label(exercice != null ? exercice.getTitre() : "N/A");
        titreLabel.getStyleClass().add("card-title");
        
        // Date
        Label dateLabel = new Label(dateFormatter.format(tentative.getDate()));
        dateLabel.getStyleClass().add("card-date");
        
        // Note
        Label noteLabel = new Label(String.format("%.2f/20", tentative.getNote()));
        noteLabel.getStyleClass().add("card-note");
        
        // Statut
        Label statutLabel = new Label(tentative.getStatue());
        statutLabel.getStyleClass().addAll("card-status", "status-" + tentative.getStatue().toLowerCase());
        
        // Boutons d'action
        HBox actions = new HBox(10);
        actions.setAlignment(Pos.CENTER);
        
        Button voirBtn = new Button("Voir");
        Button modifierBtn = new Button("Modifier");
        Button supprimerBtn = new Button("Supprimer");
        
        voirBtn.getStyleClass().addAll("button-voir", "button-small");
        modifierBtn.getStyleClass().addAll("button-modifier", "button-small");
        supprimerBtn.getStyleClass().addAll("button-supprimer", "button-small");
        
        voirBtn.setOnAction(e -> handleVoir(tentative));
        modifierBtn.setOnAction(e -> handleModifier(tentative));
        supprimerBtn.setOnAction(e -> handleSupprimer(tentative));
        
        actions.getChildren().addAll(voirBtn, modifierBtn, supprimerBtn);
        
        // Ajouter tous les éléments à la carte
        card.getChildren().addAll(
            titreLabel,
            dateLabel,
            noteLabel,
            statutLabel,
            new Separator(),
            actions
        );
        
        return card;
    }

    @FXML
    private void handleRefresh() {
        try {
            System.out.println("Début du rafraîchissement des données...");
            tentatives.clear();
            List<Tentative> nouvelleTentatives = tentativeService.afficher();
            System.out.println("Nombre de tentatives récupérées : " + nouvelleTentatives.size());
            tentatives.addAll(nouvelleTentatives);
            updateCardDisplay();
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

    @FXML
    public void handleExport() {
        System.out.println("Début de l'export des tentatives...");
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Exporter les tentatives");
        fileChooser.getExtensionFilters().add(
            new FileChooser.ExtensionFilter("Fichiers Excel", "*.xlsx")
        );
        
        File file = fileChooser.showSaveDialog(cardsContainer.getScene().getWindow());
        if (file != null) {
            try {
                excelService.exportTentatives(tentatives, exerciceService.rechercher(), file.getAbsolutePath());
                showAlert(Alert.AlertType.INFORMATION, "Succès", "Les tentatives ont été exportées avec succès !");
            } catch (Exception e) {
                e.printStackTrace();
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'export : " + e.getMessage());
            }
        }
    }

    @FXML
    public void handleExportReponses() {
        System.out.println("Début de l'export des réponses...");
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Exporter les réponses");
        fileChooser.getExtensionFilters().add(
            new FileChooser.ExtensionFilter("Fichiers Excel", "*.xlsx")
        );
        
        File file = fileChooser.showSaveDialog(cardsContainer.getScene().getWindow());
        if (file != null) {
            try {
                List<Tentative> tentativesAvecReponses = tentatives.filtered(
                    t -> t.getReponse() != null && !t.getReponse().trim().isEmpty()
                );
                
                excelService.exportTentatives(tentativesAvecReponses, exerciceService.rechercher(), file.getAbsolutePath());
                showAlert(Alert.AlertType.INFORMATION, "Succès", "Les réponses ont été exportées avec succès !");
            } catch (Exception e) {
                e.printStackTrace();
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'export : " + e.getMessage());
            }
        }
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    @FXML
    public void handleClearFilters() {
        System.out.println("Clearing filters...");
        if (searchField != null) {
            searchField.clear();
        }
        if (filterComboBox != null) {
            filterComboBox.getSelectionModel().clearSelection();
        }
        handleRefresh();
    }

    private void setupExportButtons() {
        System.out.println("Configuration des boutons d'export...");
        
        if (exportButton == null) {
            System.err.println("ERREUR: exportButton n'est pas injecté!");
            return;
        }
        if (exportReponsesButton == null) {
            System.err.println("ERREUR: exportReponsesButton n'est pas injecté!");
            return;
        }

        exportButton.setOnAction(event -> handleExport());
        exportReponsesButton.setOnAction(event -> handleExportReponses());
        
        // Ajout des styles
        exportButton.getStyleClass().addAll("button-primary");
        exportReponsesButton.getStyleClass().addAll("button-secondary");
    }
} 