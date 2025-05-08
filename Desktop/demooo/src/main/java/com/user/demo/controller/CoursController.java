package com.user.demo.controller;

import com.user.demo.model.CategorieCours;
import com.user.demo.model.Cours;
import com.user.demo.service.CategorieCoursService;
import com.user.demo.service.CoursService;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.FileChooser;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.util.StringConverter;
import javafx.scene.control.TableCell;
import javafx.scene.layout.*;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;
import javafx.scene.Node;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.time.LocalDateTime;
import java.util.*;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.stream.Collectors;
import javafx.beans.property.SimpleStringProperty;

public class CoursController implements Initializable {
    
    private static final Logger LOGGER = Logger.getLogger(CoursController.class.getName());
    
    @FXML
    private FlowPane coursesContainer;
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ComboBox<String> categoryFilter;
    
    @FXML
    private ComboBox<String> statusFilter;
    
    @FXML
    private ScrollPane scrollPane;
    
    @FXML
    private ToggleButton sortButton;
    
    @FXML
    private TableView<Cours> coursTable;
    
    @FXML
    private TableColumn<Cours, String> titreColumn;
    
    @FXML
    private TableColumn<Cours, String> descriptionColumn;
    
    @FXML
    private TableColumn<Cours, String> dureeColumn;
    
    @FXML
    private TableColumn<Cours, String> niveauColumn;
    
    @FXML
    private TableColumn<Cours, String> categorieColumn;
    
    @FXML
    private TableColumn<Cours, String> instructeurColumn;
    
    @FXML
    private TableColumn<Cours, String> imageColumn;
    
    @FXML
    private TableColumn<Cours, String> pdfColumn;
    
    @FXML
    private TableColumn<Cours, Void> inscriptionColumn;
    
    @FXML
    private TableColumn<Cours, Void> actionsColumn;
    
    private CoursService coursService;
    private CategorieCoursService categorieService;
    private ObservableList<Cours> coursList;
    private FilteredList<Cours> filteredCoursList;
    private Map<Integer, String> categoriesMap;
    private boolean isAscendingSort = true;
    
    // Répertoires pour stocker les fichiers
    private final String RESOURCES_DIR = "src/main/resources/";
    private final String IMAGES_DIR = RESOURCES_DIR + "images/";
    private final String PDF_DIR = RESOURCES_DIR + "pdfs/";
    
    public CoursController() {
        this.coursService = new CoursService();
        this.categorieService = new CategorieCoursService();
        this.categoriesMap = new HashMap<>();
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // Charger le CSS
            Scene scene = coursesContainer.getScene();
            if (scene != null) {
                String cssPath = getClass().getResource("/com/user/demo/styles/styles.css").toExternalForm();
                scene.getStylesheets().add(cssPath);
            }
            
            // Configuration du conteneur de cours
            coursesContainer.setHgap(20);
            coursesContainer.setVgap(20);
            coursesContainer.setPadding(new Insets(20));
            
            // Configuration du scroll pane
            scrollPane.setFitToWidth(true);
            scrollPane.setHbarPolicy(ScrollPane.ScrollBarPolicy.NEVER);
            scrollPane.setVbarPolicy(ScrollPane.ScrollBarPolicy.AS_NEEDED);
            
            // Chargement initial des cours
            loadCourses();
            
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur d'initialisation", 
                     "Une erreur est survenue lors de l'initialisation: " + e.getMessage());
        }
    }
    
    private void loadCourses() {
        List<Cours> courses = coursService.rechercher();
        coursesContainer.getChildren().clear();
        for (Cours cours : courses) {
            createCourseCard(cours);
        }
    }
    
    private void createCourseCard(Cours cours) {
        try {
            // Création de la carte
            VBox card = new VBox(10);
            card.getStyleClass().add("course-card");
            card.setPadding(new Insets(15));
            
            // En-tête de la carte
            Label idLabel = new Label("#" + cours.getId());
            idLabel.getStyleClass().add("card-id");
            
            // Catégorie (tag bleu)
            Label categoryLabel = new Label(cours.getCategorie().getNom());
            categoryLabel.getStyleClass().add("category-tag");
            
            // Titre du cours
            Label titleLabel = new Label(cours.getTitre());
            titleLabel.getStyleClass().add("card-title");
            titleLabel.setWrapText(true);
            
            // Informations du cours
            VBox infoBox = new VBox(5);
            Label niveauLabel = new Label("Niveau: " + cours.getNiveau());
            Label dureeLabel = new Label("Durée: " + cours.getDuree() + " heures");
            Label instructeurLabel = new Label("Par: " + cours.getInstructeur());
            infoBox.getChildren().addAll(niveauLabel, dureeLabel, instructeurLabel);
            infoBox.getStyleClass().add("card-info");
            
            // Conteneur des boutons
            HBox buttonBox = new HBox(10);
            buttonBox.setAlignment(Pos.CENTER);
            
            // Bouton Live
            Button liveButton = new Button();
            liveButton.getStyleClass().add("button-live");
            
            // Contenu du bouton live
            HBox liveContent = new HBox(5);
            liveContent.setAlignment(Pos.CENTER);
            
            FontAwesomeIconView cameraIcon = new FontAwesomeIconView(FontAwesomeIcon.VIDEO_CAMERA);
            cameraIcon.setSize("16");
            cameraIcon.setFill(javafx.scene.paint.Color.WHITE);
            
            Label liveText = new Label("Commencer le live");
            liveText.setTextFill(javafx.scene.paint.Color.WHITE);
            
            liveContent.getChildren().addAll(cameraIcon, liveText);
            liveButton.setGraphic(liveContent);
            liveButton.setOnAction(e -> handleStartLive(cours));
            
            // Boutons Modifier et Supprimer
            Button modifierButton = new Button("Modifier");
            modifierButton.getStyleClass().add("button-modifier");
            modifierButton.setOnAction(e -> handleEditCourse(cours));
            
            Button supprimerButton = new Button("Supprimer");
            supprimerButton.getStyleClass().add("button-danger");
            supprimerButton.setOnAction(e -> handleDeleteCourse(cours));
            
            buttonBox.getChildren().addAll(liveButton, modifierButton, supprimerButton);
            
            // Assemblage de la carte
            card.getChildren().addAll(idLabel, categoryLabel, titleLabel, infoBox, buttonBox);
            
            // Ajout de la carte au conteneur
            coursesContainer.getChildren().add(card);
            
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                     "Erreur lors de la création de la carte du cours: " + e.getMessage());
        }
    }
    
    private void handleEditCourse(Cours cours) {
        // Implement edit functionality
        System.out.println("Edit course: " + cours.getTitre());
    }
    
    private void handleDeleteCourse(Cours cours) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Confirmation de suppression");
        alert.setHeaderText("Supprimer le cours");
        alert.setContentText("Êtes-vous sûr de vouloir supprimer le cours " + cours.getTitre() + " ?");
        
        alert.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                coursService.supprimer(cours);
                loadCourses();
            }
        });
    }
    
    @FXML
    private void handleClearFilters() {
        searchField.clear();
        categoryFilter.setValue("Tous");
        statusFilter.setValue("Tous");
    }
    
    private void initializeColumns() {
        // Configuration des cellules avec wrapping du texte
        titreColumn.setCellFactory(tc -> {
            TableCell<Cours, String> cell = new TableCell<>() {
                private final Label label = new Label();
                {
                    label.setWrapText(true);
                    label.setMaxWidth(240);
                }
                
                @Override
                protected void updateItem(String item, boolean empty) {
                    super.updateItem(item, empty);
                    if (empty || item == null) {
                        setGraphic(null);
                    } else {
                        label.setText(item);
                        setGraphic(label);
                    }
                }
            };
            return cell;
        });
        titreColumn.setCellValueFactory(new PropertyValueFactory<>("titre"));

        categorieColumn.setCellValueFactory(cellData -> {
            int categorieId = cellData.getValue().getCategorieCoursId();
            String categorieName = categoriesMap.getOrDefault(categorieId, "N/A");
            return javafx.beans.binding.Bindings.createStringBinding(() -> categorieName);
        });

        dureeColumn.setCellValueFactory(new PropertyValueFactory<>("duree"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveau"));
        instructeurColumn.setCellValueFactory(new PropertyValueFactory<>("instructeur"));

        // Configuration du bouton d'inscription
        inscriptionColumn.setCellFactory(param -> new TableCell<>() {
            private final Button inscriptionButton = new Button("S'inscrire");
            {
                inscriptionButton.getStyleClass().add("button-primary");
                inscriptionButton.setMaxWidth(Double.MAX_VALUE);
                inscriptionButton.setOnAction(event -> {
                    Cours cours = getTableView().getItems().get(getIndex());
                    handleInscription(cours);
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    setGraphic(inscriptionButton);
                }
            }
        });

        // Ajuster la hauteur des lignes
        coursTable.setFixedCellSize(60);
    }
    
    private void loadCoursData() {
        List<Cours> cours = coursService.rechercher();
        coursList = FXCollections.observableArrayList(cours);
        filteredCoursList = new FilteredList<>(coursList, p -> true);
        
        // Créer une SortedList basée sur la FilteredList
        SortedList<Cours> sortedList = new SortedList<>(filteredCoursList);
        sortedList.comparatorProperty().bind(coursTable.comparatorProperty());
        
        coursTable.setItems(sortedList);
    }
    
    private void setupSearch() {
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredCoursList.setPredicate(cours -> {
                // Si le texte de recherche est vide, afficher tous les cours
                if (newValue == null || newValue.trim().isEmpty()) {
                    return true;
                }
                
                // Convertir le texte de recherche en minuscules
                String lowerCaseFilter = newValue.toLowerCase().trim();
                
                // Vérifier si le titre du cours contient le texte de recherche
                return cours.getTitre().toLowerCase().contains(lowerCaseFilter);
            });
        });
    }
    
    @FXML
    private void handleSort() {
        isAscendingSort = !isAscendingSort;
        updateSortButtonText();
        
        // Clear the current sort order
        coursTable.getSortOrder().clear();
        
        // Set the sort type on the title column
        titreColumn.setSortType(isAscendingSort ? TableColumn.SortType.ASCENDING : TableColumn.SortType.DESCENDING);
        
        // Add the column to the sort order
        coursTable.getSortOrder().add(titreColumn);
        
        // Force the sort
        coursTable.sort();
    }
    
    private void updateSortButtonText() {
        sortButton.setText("Trier par titre " + (isAscendingSort ? "↑" : "↓"));
    }
    
    private void createDirectoryIfNotExists(String dirPath) {
        File directory = new File(dirPath);
        if (!directory.exists()) {
            boolean created = directory.mkdirs();
            if (!created) {
                LOGGER.log(Level.WARNING, "Impossible de créer le répertoire: {0}", dirPath);
            }
        }
    }
    
    private void loadCategories() {
        try {
            List<CategorieCours> categories = categorieService.afficher();
            for (CategorieCours categorie : categories) {
                categoriesMap.put(categorie.getId(), categorie.getNom());
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des catégories", e);
        }
    }
    
    private void refreshTable() {
        List<Cours> updatedCoursList = coursService.rechercher();
        coursList.clear();
        coursList.addAll(updatedCoursList);
        
        // Réappliquer le filtre de recherche
        String searchText = searchField.getText();
        if (searchText != null && !searchText.trim().isEmpty()) {
            setupSearch();
        }
        
        // Réappliquer le tri si nécessaire
        if (sortButton.isSelected()) {
            handleSort();
        }
    }
    
    @FXML
    private void handleOpenAjoutForm() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCours.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter un Cours");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(new Scene(root));
            stage.showAndWait();
            
            refreshTable();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'ajout", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
        }
    }
    
    @FXML
    private void handleOpenModifierForm() {
        Cours selectedCours = coursTable.getSelectionModel().getSelectedItem();
        
        if (selectedCours != null) {
            try {
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCours.fxml"));
                Parent root = loader.load();
                
                CoursFormController controller = loader.getController();
                controller.setCoursForModification(selectedCours);
                
                Stage stage = new Stage();
                stage.setTitle("Modifier un Cours");
                stage.initModality(Modality.APPLICATION_MODAL);
                stage.setScene(new Scene(root));
                stage.showAndWait();
                
                refreshTable();
                
            } catch (IOException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire de modification", e);
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner un cours à modifier!");
        }
    }
    
    @FXML
    private void handleSupprimer() {
        Cours selectedCours = coursTable.getSelectionModel().getSelectedItem();
        
        if (selectedCours != null) {
            Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
            confirmAlert.setTitle("Confirmation");
            confirmAlert.setHeaderText(null);
            confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer ce cours?");
            
            Optional<ButtonType> result = confirmAlert.showAndWait();
            if (result.isPresent() && result.get() == ButtonType.OK) {
                try {
                    coursService.supprimer(selectedCours);
                    refreshTable();
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "Le cours a été supprimé avec succès!");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de la suppression du cours", e);
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression du cours: " + e.getMessage());
                }
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner un cours à supprimer!");
        }
    }
    
    private void handleInscription(Cours cours) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/InscriptionForm.fxml"));
            Parent root = loader.load();
            
            InscriptionFormController controller = loader.getController();
            controller.initData(cours);
            
            Stage stage = new Stage();
            stage.setTitle("Inscription au cours");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(new Scene(root));
            stage.showAndWait();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'inscription", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                     "Impossible d'ouvrir le formulaire d'inscription: " + e.getMessage());
        }
    }
    
    private void handleStartLive(Cours cours) {
        Dialog<ButtonType> configDialog = new Dialog<>();
        configDialog.setTitle("Configuration du live");
        configDialog.setHeaderText("Configurer la session en direct pour : " + cours.getTitre());

        // Création du contenu du dialogue
        VBox content = new VBox(15);
        content.setPadding(new Insets(15));

        // Champs de configuration
        CheckBox recordSessionCheckbox = new CheckBox("Enregistrer la session");
        recordSessionCheckbox.setSelected(true);

        CheckBox enableChatCheckbox = new CheckBox("Activer le chat");
        enableChatCheckbox.setSelected(true);

        TextField maxParticipantsField = new TextField();
        maxParticipantsField.setPromptText("Nombre maximum de participants");
        maxParticipantsField.setText("50");

        content.getChildren().addAll(
            recordSessionCheckbox,
            enableChatCheckbox,
            new Label("Nombre maximum de participants :"),
            maxParticipantsField
        );

        configDialog.getDialogPane().setContent(content);
        configDialog.getDialogPane().getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);

        // Afficher le dialogue et traiter le résultat
        Optional<ButtonType> result = configDialog.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            startLiveSession(cours, 
                           recordSessionCheckbox.isSelected(),
                           enableChatCheckbox.isSelected(),
                           Integer.parseInt(maxParticipantsField.getText()));
        }
    }

    private void startLiveSession(Cours cours, boolean recordSession, boolean enableChat, int maxParticipants) {
        try {
            Stage streamingStage = new Stage();
            streamingStage.setTitle("Live - " + cours.getTitre());

            VBox streamingContent = new VBox(10);
            streamingContent.setPadding(new Insets(20));
            streamingContent.getStyleClass().add("streaming-window");

            // Zone de streaming
            VBox streamingArea = new VBox(10);
            streamingArea.getStyleClass().add("streaming-area");
            Label streamingLabel = new Label("Streaming en cours...");
            streamingLabel.getStyleClass().add("streaming-label");
            streamingArea.getChildren().add(streamingLabel);
            streamingArea.setAlignment(Pos.CENTER);

            // Informations du stream
            Label titleLabel = new Label(cours.getTitre());
            titleLabel.getStyleClass().add("streaming-title");

            Label viewersLabel = new Label("0 spectateurs");
            viewersLabel.getStyleClass().add("viewers-count");

            // Zone de chat
            VBox chatArea = new VBox(10);
            if (enableChat) {
                chatArea.getStyleClass().add("chat-area");
                
                Label chatLabel = new Label("Chat en direct");
                chatLabel.setStyle("-fx-text-fill: white;");
                
                TextArea chatMessages = new TextArea();
                chatMessages.setEditable(false);
                chatMessages.setPrefRowCount(10);
                chatMessages.getStyleClass().add("chat-messages");

                TextField chatInput = new TextField();
                chatInput.setPromptText("Envoyer un message...");
                chatInput.getStyleClass().add("chat-input");
                
                Button sendButton = new Button("Envoyer");
                sendButton.getStyleClass().addAll("button-primary", "button-small");

                HBox chatControls = new HBox(10);
                chatControls.getChildren().addAll(chatInput, sendButton);

                chatArea.getChildren().addAll(chatLabel, chatMessages, chatControls);
            }

            // Boutons de contrôle
            HBox controls = new HBox(10);
            controls.setAlignment(Pos.CENTER);

            Button endStreamButton = new Button("Terminer le stream");
            endStreamButton.getStyleClass().addAll("button-danger", "stream-control-button");
            endStreamButton.setOnAction(e -> {
                streamingStage.close();
                showAlert(Alert.AlertType.INFORMATION, 
                         "Stream terminé", 
                         "Le stream a été terminé avec succès.");
            });

            controls.getChildren().add(endStreamButton);

            // Assemblage de l'interface
            streamingContent.getChildren().addAll(
                titleLabel,
                viewersLabel,
                streamingArea
            );

            if (enableChat) {
                streamingContent.getChildren().add(chatArea);
            }

            streamingContent.getChildren().add(controls);

            Scene streamingScene = new Scene(streamingContent, 800, 600);
            streamingScene.getStylesheets().add(getClass().getResource("/com/user/demo/styles/styles.css").toExternalForm());
            
            streamingStage.setScene(streamingScene);
            streamingStage.show();

            showAlert(Alert.AlertType.INFORMATION, 
                     "Stream démarré", 
                     "Le stream a été démarré avec succès. Les étudiants peuvent maintenant rejoindre.");

        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du démarrage du stream", e);
            showAlert(Alert.AlertType.ERROR, 
                     "Erreur", 
                     "Impossible de démarrer le stream : " + e.getMessage());
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
    private void initialize() {
        try {
            // Configuration de la colonne d'actions
            actionsColumn.setCellFactory(column -> new TableCell<Cours, Void>() {
                private final Button liveButton = createLiveButton();
                private final Button editButton = createEditButton();
                private final Button deleteButton = createDeleteButton();
                private final HBox container = new HBox(5);

                {
                    container.setAlignment(Pos.CENTER);
                    container.getChildren().addAll(liveButton, editButton, deleteButton);
                }

                @Override
                protected void updateItem(Void item, boolean empty) {
                    super.updateItem(item, empty);
                    if (empty) {
                        setGraphic(null);
                    } else {
                        Cours cours = getTableView().getItems().get(getIndex());
                        liveButton.setOnAction(e -> handleStartLive(cours));
                        editButton.setOnAction(e -> handleEditCourse(cours));
                        deleteButton.setOnAction(e -> handleDeleteCourse(cours));
                        setGraphic(container);
                    }
                }
            });

            // Chargement des données
            loadCoursData();

        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur d'initialisation", 
                     "Une erreur est survenue lors de l'initialisation: " + e.getMessage());
        }
    }

    private Button createLiveButton() {
        Button button = new Button();
        button.setStyle("-fx-background-color: #e74c3c; " +
                       "-fx-text-fill: white; " +
                       "-fx-font-weight: bold; " +
                       "-fx-padding: 5 10; " +
                       "-fx-background-radius: 4; " +
                       "-fx-min-width: 100;");

        HBox content = new HBox(5);
        content.setAlignment(Pos.CENTER);

        FontAwesomeIconView cameraIcon = new FontAwesomeIconView(FontAwesomeIcon.VIDEO_CAMERA);
        cameraIcon.setFill(javafx.scene.paint.Color.WHITE);
        cameraIcon.setSize("14");

        Label text = new Label("Live");
        text.setTextFill(javafx.scene.paint.Color.WHITE);

        content.getChildren().addAll(cameraIcon, text);
        button.setGraphic(content);

        // Effet de survol
        button.setOnMouseEntered(e -> 
            button.setStyle("-fx-background-color: #c0392b; " +
                          "-fx-text-fill: white; " +
                          "-fx-font-weight: bold; " +
                          "-fx-padding: 5 10; " +
                          "-fx-background-radius: 4; " +
                          "-fx-min-width: 100;"));

        button.setOnMouseExited(e -> 
            button.setStyle("-fx-background-color: #e74c3c; " +
                          "-fx-text-fill: white; " +
                          "-fx-font-weight: bold; " +
                          "-fx-padding: 5 10; " +
                          "-fx-background-radius: 4; " +
                          "-fx-min-width: 100;"));

        return button;
    }

    private Button createEditButton() {
        Button button = new Button("Modifier");
        button.setStyle("-fx-background-color: #f39c12; " +
                       "-fx-text-fill: white; " +
                       "-fx-padding: 5 10; " +
                       "-fx-background-radius: 4; " +
                       "-fx-min-width: 80;");
        return button;
    }

    private Button createDeleteButton() {
        Button button = new Button("Supprimer");
        button.setStyle("-fx-background-color: #e74c3c; " +
                       "-fx-text-fill: white; " +
                       "-fx-padding: 5 10; " +
                       "-fx-background-radius: 4; " +
                       "-fx-min-width: 80;");
        return button;
    }
} 