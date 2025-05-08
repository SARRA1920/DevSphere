package com.user.demo.controller;

import com.user.demo.model.Tentative;
import com.user.demo.model.Exercice;
import com.user.demo.service.TentativeService;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.Node;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.beans.property.SimpleStringProperty;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import java.net.URL;
import java.util.ResourceBundle;
import java.time.format.DateTimeFormatter;
import javafx.scene.paint.Color;
import javafx.scene.text.Text;
import javafx.scene.text.TextFlow;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.TextAlignment;
import java.util.Optional;

public class TentativesController implements Initializable {

    @FXML private FlowPane tentativesCards;
    @FXML private TextField searchField;
    @FXML private ComboBox<String> filterStatusComboBox;
    @FXML private Label totalLabel;
    @FXML private VBox emptyState;
    @FXML private StackPane loadingPane;

    private TentativeService tentativeService;
    private ObservableList<Tentative> tentatives;
    private FilteredList<Tentative> filteredTentatives;
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    private Tentative currentTentative;
    private Exercice currentExercice;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        tentativeService = new TentativeService();
        tentatives = FXCollections.observableArrayList();
        filteredTentatives = new FilteredList<>(tentatives, p -> true);

        setupFilters();
        loadTentatives();
    }

    private void setupFilters() {
        // Configure filter ComboBox
        filterStatusComboBox.getItems().addAll(
            "Tous les statuts",
            "SOUMIS",
            "EN ATTENTE",
            "ÉVALUÉ"
        );
        filterStatusComboBox.setValue("Tous les statuts");
        
        // Add listener for filter changes
        filterStatusComboBox.valueProperty().addListener((observable, oldValue, newValue) -> {
            filterTentatives(searchField.getText());
        });
        
        // Configure search field listener
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filterTentatives(newValue);
        });
    }

    private synchronized void filterTentatives(String searchText) {
        tentativesCards.getChildren().clear();
        
        String selectedStatus = filterStatusComboBox.getValue();
        
        filteredTentatives.setPredicate(tentative -> {
            // Filtre par statut
            if (!"Tous les statuts".equals(selectedStatus)) {
                if (!tentative.getStatue().equalsIgnoreCase(selectedStatus)) {
                    return false;
                }
            }
            
            // Filtre par texte de recherche
            if (searchText != null && !searchText.isEmpty()) {
                String exerciceTitle = tentative.getExercice() != null ? 
                                     tentative.getExercice().getTitre() : 
                                     "Exercice " + tentative.getExercice_id();
                                     
                return exerciceTitle.toLowerCase().contains(searchText.toLowerCase()) ||
                       tentative.getStatue().toLowerCase().contains(searchText.toLowerCase()) ||
                       tentative.getReponse() != null && tentative.getReponse().toLowerCase().contains(searchText.toLowerCase());
            }
            
            return true;
        });
        
        // Create cards for filtered tentatives
        filteredTentatives.forEach(tentative -> {
            tentativesCards.getChildren().add(createTentativeCard(tentative));
        });
            
        // Afficher l'état vide si aucun résultat
        if (tentativesCards.getChildren().isEmpty()) {
            showEmptyState();
        } else {
            emptyState.setVisible(false);
            tentativesCards.setVisible(true);
        }
        
        updateTotalLabel();
    }

    @FXML
    public void handleClearFilters() {
        searchField.clear();
        filterStatusComboBox.setValue("Tous les statuts");
        loadTentatives();
    }

    private Node createTentativeCard(Tentative tentative) {
        VBox card = new VBox(10);
        card.getStyleClass().add("tentative-card");
        card.setPadding(new Insets(15));
        card.setPrefWidth(300);
        
        // Titre de l'exercice
        String exerciceTitle = tentative.getExercice() != null ? 
                             tentative.getExercice().getTitre() : 
                             "Exercice " + tentative.getExercice_id();
        
        Label title = new Label(exerciceTitle);
        title.getStyleClass().add("card-title");
        title.setWrapText(true);
        
        // Date
        HBox dateContainer = new HBox(5);
        dateContainer.setAlignment(Pos.CENTER_LEFT);
        
        FontAwesomeIconView calendarIcon = new FontAwesomeIconView(FontAwesomeIcon.CALENDAR);
        calendarIcon.setGlyphSize(12);
        calendarIcon.setFill(Color.GRAY);
        
        Label dateLabel = new Label(tentative.getDate().format(DATE_FORMATTER));
        dateLabel.getStyleClass().add("card-date");
        
        dateContainer.getChildren().addAll(calendarIcon, dateLabel);
        
        // Note et Statut
        HBox infoContainer = new HBox(15);
        infoContainer.setAlignment(Pos.CENTER_LEFT);
        
        VBox noteBox = new VBox(2);
        noteBox.setAlignment(Pos.CENTER);
        
        Label noteLabel = new Label("Note");
        noteLabel.getStyleClass().add("info-label");
        
        Label noteValue = new Label(String.format("%d/20", tentative.getScore()));
        noteValue.getStyleClass().add("info-value");
        
        noteBox.getChildren().addAll(noteLabel, noteValue);
        
        VBox statusBox = new VBox(2);
        statusBox.setAlignment(Pos.CENTER);
        
        Label statusLabel = new Label("Statut");
        statusLabel.getStyleClass().add("info-label");
        
        Label statusValue = new Label(tentative.getStatue());
        statusValue.getStyleClass().add("info-value");
        
        // Appliquer style selon le statut
        switch (tentative.getStatue().toUpperCase()) {
            case "SOUMIS":
                statusValue.getStyleClass().add("status-submitted");
                break;
            case "ÉVALUÉ":
                statusValue.getStyleClass().add("status-evaluated");
                break;
            case "EN ATTENTE":
                statusValue.getStyleClass().add("status-pending");
                break;
            default:
                break;
        }
        
        statusBox.getChildren().addAll(statusLabel, statusValue);
        
        infoContainer.getChildren().addAll(noteBox, statusBox);
        
        // Boutons d'action
        HBox buttonsContainer = new HBox(10);
        buttonsContainer.setAlignment(Pos.CENTER);
        
        Button viewBtn = new Button("Voir");
        FontAwesomeIconView viewIcon = new FontAwesomeIconView(FontAwesomeIcon.EYE);
        viewIcon.setGlyphSize(12);
        viewIcon.setFill(Color.WHITE);
        viewBtn.setGraphic(viewIcon);
        viewBtn.setGraphicTextGap(5);
        viewBtn.getStyleClass().addAll("button-voir", "button-small");
        viewBtn.setPrefWidth(90);
        viewBtn.setOnAction(e -> afficherDetailsTentative(tentative));
        
        Button updateBtn = new Button("Update");
        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
        editIcon.setGlyphSize(12);
        editIcon.setFill(Color.WHITE);
        updateBtn.setGraphic(editIcon);
        updateBtn.setGraphicTextGap(5);
        updateBtn.getStyleClass().addAll("button-modifier", "button-small");
        updateBtn.setPrefWidth(90);
        updateBtn.setOnAction(e -> modifierTentative(tentative));
        
        Button supprimerBtn = new Button("Supprimer");
        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
        deleteIcon.setGlyphSize(12);
        deleteIcon.setFill(Color.WHITE);
        supprimerBtn.setGraphic(deleteIcon);
        supprimerBtn.setGraphicTextGap(5);
        supprimerBtn.getStyleClass().addAll("button-supprimer", "button-small");
        supprimerBtn.setPrefWidth(90);
        supprimerBtn.setOnAction(e -> supprimerTentative(tentative));
        
        buttonsContainer.getChildren().addAll(viewBtn, updateBtn, supprimerBtn);
        VBox.setMargin(buttonsContainer, new Insets(10, 0, 0, 0));
        
        // Ajouter tous les éléments à la carte
        card.getChildren().addAll(title, dateContainer, infoContainer, buttonsContainer);
        
        return card;
    }

    private synchronized void loadTentatives() {
        // Show loading state
        loadingPane.setVisible(true);
        tentativesCards.setVisible(false);
        emptyState.setVisible(false);
        
        try {
            // Clear existing data
            tentatives.clear();
            tentativesCards.getChildren().clear();
            
            // Load fresh data from database
            tentatives.addAll(tentativeService.afficher());
            
            if (tentatives.isEmpty()) {
                showEmptyState();
            } else {
                for (Tentative tentative : tentatives) {
                    tentativesCards.getChildren().add(createTentativeCard(tentative));
                }
                tentativesCards.setVisible(true);
                emptyState.setVisible(false);
            }
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors du chargement des tentatives: " + e.getMessage());
        } finally {
            loadingPane.setVisible(false);
        }
        
        updateTotalLabel();
    }

    private void showEmptyState() {
        tentativesCards.setVisible(false);
        emptyState.setVisible(true);
    }

    private void afficherDetailsTentative(Tentative tentative) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Détails de la tentative");
        alert.setHeaderText("Tentative pour l'exercice: " + 
            (tentative.getExercice() != null ? tentative.getExercice().getTitre() : "Exercice " + tentative.getExercice_id()));
        
        String details = String.format("""
            Date: %s
            Score: %d/20
            Statut: %s
            Réponse:
            %s""",
            tentative.getDate().format(DATE_FORMATTER),
            tentative.getScore(),
            tentative.getStatue(),
            tentative.getReponse() != null ? tentative.getReponse() : "Aucune réponse"
        );
        
        alert.setContentText(details);
        alert.showAndWait();
    }

    private void supprimerTentative(Tentative tentative) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Supprimer la tentative");
        confirmation.setContentText("Êtes-vous sûr de vouloir supprimer cette tentative ?");

        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                tentativeService.supprimer(tentative);
                loadTentatives();
            }
        });
    }

    private void updateTotalLabel() {
        totalLabel.setText(String.format("Total des tentatives : %d", tentatives.size()));
    }

    public void setTentative(Tentative tentative) {
        this.currentTentative = tentative;
        if (tentative != null) {
            loadTentatives();
        }
    }

    public void setExercice(Exercice exercice) {
        this.currentExercice = exercice;
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void modifierTentative(Tentative tentative) {
        // Create a dialog for editing the tentative
        Dialog<Tentative> dialog = new Dialog<>();
        dialog.setTitle("Modifier la tentative");
        dialog.setHeaderText("Modifier les informations de la tentative");
        
        // Set the button types
        ButtonType saveButtonType = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveButtonType, ButtonType.CANCEL);
        
        // Create the grid pane for form fields
        GridPane grid = new GridPane();
        grid.setHgap(10);
        grid.setVgap(10);
        grid.setPadding(new Insets(20, 150, 10, 10));
        
        // Create form controls
        ComboBox<String> statutCombo = new ComboBox<>();
        statutCombo.getItems().addAll("SOUMIS", "ÉVALUÉ", "EN ATTENTE");
        statutCombo.setValue(tentative.getStatue());
        
        TextField scoreField = new TextField(String.valueOf(tentative.getScore()));
        scoreField.setPromptText("Score (0-20)");
        
        TextArea reponseArea = new TextArea(tentative.getReponse());
        reponseArea.setPromptText("Réponse de l'étudiant");
        reponseArea.setPrefRowCount(5);
        
        // Add form controls to the grid
        grid.add(new Label("Statut:"), 0, 0);
        grid.add(statutCombo, 1, 0);
        grid.add(new Label("Score:"), 0, 1);
        grid.add(scoreField, 1, 1);
        grid.add(new Label("Réponse:"), 0, 2);
        grid.add(reponseArea, 1, 2);
        
        // Set content to the dialog pane
        dialog.getDialogPane().setContent(grid);
        
        // Request focus on the statut field by default
        statutCombo.requestFocus();
        
        // Convert the result when the save button is clicked
        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == saveButtonType) {
                try {
                    int score = Integer.parseInt(scoreField.getText().trim());
                    if (score < 0 || score > 20) {
                        showAlert(Alert.AlertType.ERROR, "Erreur", "Le score doit être entre 0 et 20");
                        return null;
                    }
                    
                    tentative.setStatue(statutCombo.getValue());
                    tentative.setScore(score);
                    tentative.setReponse(reponseArea.getText());
                    return tentative;
                } catch (NumberFormatException e) {
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Le score doit être un nombre entier");
                    return null;
                }
            }
            return null;
        });
        
        // Show the dialog and process the result
        Optional<Tentative> result = dialog.showAndWait();
        
        result.ifPresent(updatedTentative -> {
            try {
                tentativeService.modifier(updatedTentative);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "La tentative a été mise à jour avec succès");
                
                // Save current filter state
                String currentSearchText = searchField.getText();
                String currentFilter = filterStatusComboBox.getValue();
                
                // Reload data but preserve filter state
                loadTentatives();
                
                // Reapply filters if needed
                if ((currentSearchText != null && !currentSearchText.isEmpty()) || 
                    (currentFilter != null && !"Tous les statuts".equals(currentFilter))) {
                    filterTentatives(currentSearchText);
                }
                
            } catch (Exception e) {
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la mise à jour: " + e.getMessage());
            }
        });
    }
} 