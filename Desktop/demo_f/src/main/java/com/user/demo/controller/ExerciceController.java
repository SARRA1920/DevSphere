package com.user.demo.controller;

import com.user.demo.model.Exercice;
import com.user.demo.service.ExerciceService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Node;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import java.io.IOException;
import java.util.Optional;
import javafx.scene.Scene;
import javafx.stage.Stage;
import javafx.scene.Parent;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.control.TableCell;
import javafx.scene.control.Button;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.layout.HBox;
import java.sql.Connection;
import java.sql.Statement;

public class ExerciceController {

    private ExerciceService exerciceService;
    private boolean isStudentMode = false;
    private boolean useUserTemplate = false;

    @FXML private TextField searchField;
    @FXML private Button addButton;
    @FXML private Label statusLabel;
    @FXML private ComboBox<String> filterComboBox;
    @FXML private FlowPane exerciceCards;
    @FXML private VBox emptyState;
    @FXML private StackPane loadingPane;
    @FXML private TableView<Exercice> exerciceTable;
    @FXML private TableColumn<Exercice, String> exerciceColumn;
    @FXML private TableColumn<Exercice, String> typeColumn;
    @FXML private TableColumn<Exercice, String> niveauColumn;
    @FXML private TableColumn<Exercice, Void> actionsColumn;

    private ObservableList<Exercice> exercices = FXCollections.observableArrayList();

    @FXML
    public void initialize() {
        exerciceService = new ExerciceService();
        
        // Ensure student mode is false for admin interface
        isStudentMode = false;
        
        // Load CSS when scene is available
        exerciceCards.sceneProperty().addListener((observable, oldScene, newScene) -> {
            if (newScene != null) {
                String cssPath = getClass().getResource("/com/user/demo/styles/styles.css").toExternalForm();
                newScene.getStylesheets().add(cssPath);
            }
        });

        // Configure filter ComboBox
        filterComboBox.getItems().addAll(
            "Tous les niveaux",
            "Niveau: facile",
            "Niveau: moyen",
            "Niveau: difficile"
        );
        filterComboBox.setValue("Tous les niveaux");
        
        // Add listener for filter changes
        filterComboBox.valueProperty().addListener((observable, oldValue, newValue) -> {
            filterExercices(searchField.getText());
        });
        
        // Load initial exercises
        loadExercices();

        // Configure search field listener
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filterExercices(newValue);
        });

        if (exerciceTable != null) {
            setupTableColumns();
        }
    }

    private void loadExercices() {
        exerciceCards.getChildren().clear();
        exercices.clear();
        
        // Show loading state
        loadingPane.setVisible(true);
        exerciceCards.setVisible(false);
        emptyState.setVisible(false);
        
        try {
            exercices.addAll(exerciceService.rechercher());
            
            if (exercices.isEmpty()) {
                showEmptyState();
            } else {
                for (Exercice exercice : exercices) {
                    exerciceCards.getChildren().add(createExerciceCardFXML(exercice));
                }
                exerciceCards.setVisible(true);
                emptyState.setVisible(false);
            }
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors du chargement des exercices: " + e.getMessage());
        } finally {
            loadingPane.setVisible(false);
        }
        
        updateStatusLabel();
    }

    /**
     * Configure le contrôleur pour utiliser le modèle de carte utilisateur
     */
    public void useUserCardTemplate(boolean useUserTemplate) {
        this.useUserTemplate = useUserTemplate;
        loadExercices();
    }

    /**
     * Crée une carte d'exercice en utilisant le fichier FXML
     */
    private Node createExerciceCardFXML(Exercice exercice) {
        try {
            String templatePath = useUserTemplate ? 
                "/com/user/demo/views/exercice-card-user.fxml" : 
                "/com/user/demo/views/exercice-card.fxml";
                
            FXMLLoader loader = new FXMLLoader(getClass().getResource(templatePath));
            Node card = loader.load();
            
            if (useUserTemplate) {
                ExerciceCardUserController controller = loader.getController();
                controller.setExercice(exercice, this);
            } else {
                ExerciceCardController controller = loader.getController();
                controller.setExercice(exercice, this);
                controller.setStudentMode(isStudentMode);
            }
            
            return card;
        } catch (IOException e) {
            e.printStackTrace();
            // Fallback to the old method if loading fails
            return createExerciceCard(exercice);
        }
    }

    // Exposition des méthodes pour ExerciceCardController
    public void handleModifier(Exercice exercice) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/exercice-form.fxml"));
            Parent root = loader.load();
            
            ExerciceFormController controller = loader.getController();
            controller.setExercice(exercice);
            
            Stage stage = new Stage();
            stage.setTitle("Modifier l'exercice");
            stage.setScene(new Scene(root));
            stage.showAndWait();
            
            // Reload exercises after editing
            loadExercices();
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire de modification");
        }
    }

    public void handleSupprimer(Exercice exercice) {
        Alert confirmDialog = new Alert(Alert.AlertType.CONFIRMATION);
        confirmDialog.setTitle("Confirmation de suppression");
        confirmDialog.setHeaderText("Êtes-vous sûr de vouloir supprimer cet exercice ?");
        confirmDialog.setContentText("Cette action est irréversible.");
        
        Optional<ButtonType> result = confirmDialog.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            try {
                exerciceService.supprimer(exercice);
                loadExercices();
                showAlert(Alert.AlertType.INFORMATION, "Succès", "L'exercice a été supprimé avec succès.");
            } catch (Exception e) {
                e.printStackTrace();
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression de l'exercice : " + e.getMessage());
            }
        }
    }

    public void handleCommencerExercice(Exercice exercice) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/exercice-start-view.fxml"));
            Parent root = loader.load();
            
            ExerciceStartController controller = loader.getController();
            controller.setExercice(exercice);
            
            Stage stage = new Stage();
            stage.setTitle("Exercice: " + exercice.getTitre());
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors du démarrage de l'exercice: " + e.getMessage());
        }
    }

    // Garder l'ancienne méthode pour le fallback
    private Node createExerciceCard(Exercice exercice) {
        VBox card = new VBox(10);
        card.getStyleClass().add("exercice-card");
        card.setPadding(new Insets(15));
        
        Label title = new Label(exercice.getTitre());
        title.getStyleClass().add("card-title");
        
        Label type = new Label(exercice.getType());
        type.getStyleClass().add("card-type");
        
        Label difficulty = new Label("Niveau: " + exercice.getNiveauDifficulte());
        difficulty.getStyleClass().add("card-type");
        
        HBox buttonsContainer = new HBox(10);
        buttonsContainer.setAlignment(Pos.CENTER);
        
        if (isStudentMode) {
            // For student mode, show "Commencer l'exercice" button
            Button commencerBtn = new Button("Commencer l'exercice");
            commencerBtn.getStyleClass().addAll("button-primary", "button-small");
            commencerBtn.setMaxWidth(Double.MAX_VALUE);
            commencerBtn.setOnAction(e -> handleCommencerExercice(exercice));
            
            VBox.setMargin(commencerBtn, new Insets(10, 0, 0, 0));
            card.getChildren().addAll(title, type, difficulty, commencerBtn);
        } else {
            // For admin mode, show "Update" and "Supprimer" buttons
            Button updateBtn = new Button("Update");
            FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
            editIcon.setGlyphSize(12);
            editIcon.setFill(javafx.scene.paint.Color.WHITE);
            updateBtn.setGraphic(editIcon);
            updateBtn.setGraphicTextGap(8);
            updateBtn.getStyleClass().addAll("button-modifier", "button-small");
            updateBtn.setPrefWidth(100);
            updateBtn.setOnAction(e -> handleModifier(exercice));
            
            Button supprimerBtn = new Button("Supprimer");
            FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
            deleteIcon.setGlyphSize(12);
            deleteIcon.setFill(javafx.scene.paint.Color.WHITE);
            supprimerBtn.setGraphic(deleteIcon);
            supprimerBtn.setGraphicTextGap(8);
            supprimerBtn.getStyleClass().addAll("button-supprimer", "button-small");
            supprimerBtn.setPrefWidth(100);
            supprimerBtn.setOnAction(e -> handleSupprimer(exercice));
            
            buttonsContainer.getChildren().addAll(updateBtn, supprimerBtn);
            VBox.setMargin(buttonsContainer, new Insets(10, 0, 0, 0));
            
            card.getChildren().addAll(title, type, difficulty, buttonsContainer);
        }
        
        return card;
    }

    private void showEmptyState() {
        exerciceCards.setVisible(false);
        emptyState.setVisible(true);
    }

    private void filterExercices(String searchText) {
        exerciceCards.getChildren().clear();
        
        String selectedLevel = filterComboBox.getValue();
        
        exercices.stream()
            .filter(exercice -> {
                // Filtre par niveau
                if (!"Tous les niveaux".equals(selectedLevel)) {
                    String levelPrefix = "Niveau: ";
                    String expectedLevel = selectedLevel.substring(levelPrefix.length());
                    if (!exercice.getNiveauDifficulte().equalsIgnoreCase(expectedLevel)) {
                        return false;
                    }
                }
                
                // Filtre par texte de recherche
                if (searchText != null && !searchText.isEmpty()) {
                    return exercice.getTitre().toLowerCase().contains(searchText.toLowerCase()) ||
                           exercice.getDescription().toLowerCase().contains(searchText.toLowerCase()) ||
                           exercice.getType().toLowerCase().contains(searchText.toLowerCase());
                }
                
                return true;
            })
            .forEach(exercice -> exerciceCards.getChildren().add(createExerciceCardFXML(exercice)));
            
        // Afficher l'état vide si aucun résultat
        if (exerciceCards.getChildren().isEmpty()) {
            showEmptyState();
        } else {
            emptyState.setVisible(false);
            exerciceCards.setVisible(true);
        }
        
        updateStatusLabel();
    }

    @FXML
    public void handleClearFilters() {
        searchField.clear();
        if (filterComboBox != null) {
            filterComboBox.getSelectionModel().clearSelection();
        }
        loadExercices();
    }

    private void updateStatusLabel() {
        statusLabel.setText(String.format("Total des exercices: %d", exercices.size()));
    }

    @FXML
    public void showAddDialog() throws IOException {
        try {
            System.out.println("Début de showAddDialog");
            Dialog<Exercice> dialog = createExerciceDialog("Ajouter un exercice", null);
            
            System.out.println("Dialog créé avec succès");
            Optional<Exercice> result = dialog.showAndWait();
            System.out.println("Dialog fermé, résultat présent: " + result.isPresent());
            
            ExerciceDialogController controller = (ExerciceDialogController) dialog.getDialogPane().getUserData();
            if (result.isPresent() && controller.isOkClicked()) {
                System.out.println("OK cliqué, création de l'exercice");
                Exercice newExercice = result.get();
                newExercice.setUserId(1); // TODO: Utiliser l'ID de l'utilisateur connecté
                try {
                    System.out.println("Tentative d'ajout dans la base de données");
                    exerciceService.ajouter(newExercice);
                    System.out.println("Exercice ajouté avec succès");
                    loadExercices(); // Recharger la liste après l'ajout
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "L'exercice a été ajouté avec succès.");
                } catch (Exception e) {
                    System.err.println("Erreur lors de l'ajout dans la base de données: " + e.getMessage());
                    e.printStackTrace();
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ajout de l'exercice : " + e.getMessage());
                }
            } else {
                System.out.println("Dialog annulé ou OK non cliqué");
            }
        } catch (IOException e) {
            System.err.println("Erreur lors de la création du dialog: " + e.getMessage());
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ajout : " + e.getMessage());
        }
    }

    private Dialog<Exercice> createExerciceDialog(String title, Exercice exercice) throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(getClass().getResource("/com/user/demo/views/exercice-dialog.fxml"));
        DialogPane dialogPane = loader.load();

        Dialog<Exercice> dialog = new Dialog<>();
        dialog.setDialogPane(dialogPane);
        dialog.setTitle(title);

        ExerciceDialogController controller = loader.getController();
        controller.setDialogPane(dialogPane);
        
        if (exercice != null) {
            controller.setExercice(exercice);
        }

        // Stocker le controller dans les données utilisateur du DialogPane
        dialogPane.setUserData(controller);

        dialog.setResultConverter(buttonType -> {
            if (buttonType == ButtonType.OK && controller.isOkClicked()) {
                return controller.getExercice();
            }
            return null;
        });

        return dialog;
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showError(String title, String header, String content) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(header);
        alert.setContentText(content);
        alert.showAndWait();
    }

    @FXML
    private void handleAddButton() {
        try {
            showAddDialog();
        } catch (IOException e) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Erreur");
            alert.setHeaderText("Erreur lors de l'ouverture du dialogue");
            alert.setContentText("Une erreur est survenue lors de l'ouverture du dialogue d'ajout d'exercice.");
            alert.showAndWait();
            e.printStackTrace();
        }
    }

    @FXML
    private void handleTentatives() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/tentatives-view.fxml"));
            Scene scene = new Scene(loader.load());
            Stage stage = new Stage();
            stage.setTitle("Liste des Tentatives");
            stage.setScene(scene);
            stage.show();
        } catch (IOException e) {
            showError("Erreur", "Erreur de chargement", "Impossible de charger la liste des tentatives: " + e.getMessage());
        }
    }

    public void setStudentMode(boolean studentMode) {
        this.isStudentMode = studentMode;
        loadExercices();
    }

    private void setupTableColumns() {
        // Configuration des colonnes existantes
        exerciceColumn.setCellValueFactory(new PropertyValueFactory<>("titre"));
        typeColumn.setCellValueFactory(new PropertyValueFactory<>("type"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveau"));

        // Configuration de la colonne d'actions
        actionsColumn.setCellFactory(col -> new TableCell<Exercice, Void>() {
            private final Button commencerBtn = new Button("Commencer l'exercice");

            {
                commencerBtn.getStyleClass().addAll("button-primary", "button-small");
                commencerBtn.setOnAction(event -> {
                    Exercice exercice = getTableView().getItems().get(getIndex());
                    handleCommencerExercice(exercice);
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    if (isStudentMode) {
                        setGraphic(commencerBtn);
                    } else {
                        // Configuration pour le mode admin (boutons modifier/supprimer)
                        HBox actions = createAdminActions(getTableView().getItems().get(getIndex()));
                        setGraphic(actions);
                    }
                }
            }
        });
    }

    private HBox createAdminActions(Exercice exercice) {
        Button modifierBtn = new Button("Update");
        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
        editIcon.setGlyphSize(12);
        editIcon.setFill(javafx.scene.paint.Color.WHITE);
        modifierBtn.setGraphic(editIcon);
        modifierBtn.setGraphicTextGap(8);
        modifierBtn.getStyleClass().addAll("button-modifier", "button-small");
        modifierBtn.setPrefWidth(100);
        
        Button supprimerBtn = new Button("Supprimer");
        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
        deleteIcon.setGlyphSize(12);
        deleteIcon.setFill(javafx.scene.paint.Color.WHITE);
        supprimerBtn.setGraphic(deleteIcon);
        supprimerBtn.setGraphicTextGap(8);
        supprimerBtn.getStyleClass().addAll("button-supprimer", "button-small");
        supprimerBtn.setPrefWidth(100);
        
        modifierBtn.setOnAction(e -> handleModifier(exercice));
        supprimerBtn.setOnAction(e -> handleSupprimer(exercice));
        
        HBox container = new HBox(10);
        container.setAlignment(Pos.CENTER);
        container.getChildren().addAll(modifierBtn, supprimerBtn);
        
        return container;
    }
}
