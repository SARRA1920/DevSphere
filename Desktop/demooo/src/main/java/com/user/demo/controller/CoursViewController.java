package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.model.CategorieCours;
import com.user.demo.util.DatabaseConnection;
import com.user.demo.util.CoursImageUtils;
import com.user.demo.util.SessionManager;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Node;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.scene.shape.Rectangle;

import java.io.File;
import java.net.URL;
import java.sql.*;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.io.IOException;

public class CoursViewController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(CoursViewController.class.getName());

    @FXML
    private FlowPane coursContainer;

    @FXML
    private TextField searchField;

    @FXML
    private ComboBox<String> categoryFilter;

    @FXML
    private Button addCourseButton;

    private ObservableList<Cours> coursList = FXCollections.observableArrayList();
    private ObservableList<String> categories = FXCollections.observableArrayList();

    // Ajouter un champ pour indiquer si on est en mode admin
    private boolean isAdminMode = true; // Par défaut, activer le mode admin pour ajouter les boutons

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // Configuration du conteneur de cours
            coursContainer.setHgap(20);
            coursContainer.setVgap(20);
            coursContainer.setPadding(new Insets(20));
            
            // Charger les catégories
            loadCategories();
            
            // Configuration des filtres
            categoryFilter.setItems(categories);
            categoryFilter.setValue("Toutes les catégories");
            
            // Style du ComboBox
            categoryFilter.getStyleClass().add("category-filter");
            
            // Configuration du bouton d'ajout
            if (addCourseButton != null) {
                // Appliquer directement des styles au bouton
                addCourseButton.setStyle(
                    "-fx-background-color: #4CAF50;" +
                    "-fx-text-fill: white;" +
                    "-fx-font-size: 14px;" +
                    "-fx-font-weight: bold;" +
                    "-fx-padding: 10px 20px;" +
                    "-fx-border-radius: 5px;" +
                    "-fx-background-radius: 5px;" +
                    "-fx-cursor: hand;"
                );
                
                // Assurer que l'événement soit bien attaché
                addCourseButton.setOnAction(event -> handleAddCourse());
                
                // Assurer que le bouton est visible
                addCourseButton.setVisible(true);
                addCourseButton.setManaged(true);
                addCourseButton.setMinWidth(150);
                addCourseButton.setMinHeight(35);
            } else {
                System.out.println("Le bouton addCourseButton est null !");
            }

            // Ajout des listeners pour les filtres
            searchField.textProperty().addListener((obs, oldVal, newVal) -> filterCours());
            categoryFilter.valueProperty().addListener((obs, oldVal, newVal) -> filterCours());

            // Ajouter un listener pour charger le CSS quand la scène est disponible
            coursContainer.sceneProperty().addListener((obs, oldScene, newScene) -> {
                if (newScene != null) {
                    try {
                        String cssPath = getClass().getResource("/com/user/demo/styles/cours.css").toExternalForm();
                        newScene.getStylesheets().add(cssPath);
                        System.out.println("CSS loaded successfully from: " + cssPath);
                    } catch (Exception e) {
                        System.err.println("Error loading CSS: " + e.getMessage());
                        e.printStackTrace();
                    }
                }
            });

            // Afficher les informations sur la colonne is_live dans la BDD
            checkLiveCoursesInDatabase();

            // Chargement des cours
            loadCours();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'initialisation", e);
            showError("Erreur", "Erreur lors de l'initialisation de la vue");
        }
    }

    private void loadCategories() {
        categories.clear();
        categories.add("Toutes les catégories");
        
        String query = "SELECT DISTINCT cc.nom FROM categorie_cours cc " +
                      "INNER JOIN cours c ON cc.id = c.categorie_cours_id " +
                      "ORDER BY cc.nom";
                      
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                categories.add(rs.getString("nom"));
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des catégories", e);
        }
    }

    private void loadCours() {
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            coursList.clear();
            while (rs.next()) {
                Cours cours = new Cours();
                cours.setId(rs.getInt("id"));
                cours.setTitre(rs.getString("titre"));
                cours.setDescription(rs.getString("description"));
                cours.setDuree(rs.getString("duree"));
                cours.setNiveau(rs.getString("niveau"));
                cours.setInstructeur(rs.getString("instructeur"));
                cours.setImage(rs.getString("image"));
                
                // Récupérer le statut live
                boolean isLive = rs.getBoolean("is_live");
                cours.setLive(isLive);
                
                // Log pour déboguer
                if (isLive) {
                    LOGGER.info("Cours en DIRECT trouvé: ID=" + cours.getId() + ", Titre=" + cours.getTitre());
                }
                
                CategorieCours categorie = new CategorieCours();
                categorie.setNom(rs.getString("categorie_nom"));
                cours.setCategorie(categorie);
                coursList.add(cours);
            }

            filterCours();

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours", e);
            showError("Erreur", "Impossible de charger la liste des cours");
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

    private void handleStartLive(Cours cours) {
        // Vérifier si l'utilisateur est connecté
        if (SessionManager.getInstance().getCurrentUser() == null) {
            showAlert(Alert.AlertType.WARNING, "Attention", "Vous devez être connecté pour démarrer un live.");
            return;
        }

        try {
            LOGGER.info("Starting live session for course: " + cours.getTitre());
            
            // Charger la vue du live
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/live-view.fxml"));
            LOGGER.info("Loading FXML for live view");
            Parent root = loader.load();
            LOGGER.info("FXML loaded successfully");

            // Configurer le contrôleur
            LiveViewController controller = loader.getController();
            if (controller == null) {
                throw new RuntimeException("Failed to get LiveViewController");
            }
            LOGGER.info("Got LiveViewController");
            controller.setCours(cours);
            LOGGER.info("Course set in controller");

            // Créer et configurer la nouvelle fenêtre
            Stage liveStage = new Stage();
            liveStage.setTitle("Live - " + cours.getTitre());
            Scene scene = new Scene(root);
            
            // Add CSS if needed
            scene.getStylesheets().add(getClass().getResource("/com/user/demo/styles/styles.css").toExternalForm());
            
            liveStage.setScene(scene);
            liveStage.setMaximized(true);

            // Afficher la fenêtre
            LOGGER.info("Showing live window");
            liveStage.show();

        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture de la fenêtre de live", e);
            showError("Erreur", "Impossible d'ouvrir la fenêtre de live : " + e.getMessage());
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur inattendue", e);
            showError("Erreur", "Une erreur inattendue s'est produite : " + e.getMessage());
        }
    }

    private VBox createCoursCard(Cours cours) {
        try {
            // Card container
            VBox card = new VBox(0); // Pas d'espacement entre les éléments
            card.getStyleClass().addAll("course-card", "card-hover");
            card.setStyle("-fx-background-color: white; -fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.1), 5, 0, 0, 5); " +
                        "-fx-background-radius: 6px; -fx-border-radius: 6px;");
            card.setPadding(new Insets(0)); // Pas de padding pour la carte
            card.setMaxWidth(300);
            card.setMinWidth(300);
            card.setMinHeight(350);
            
            // Image container - maintenant avec bords arrondis uniquement en haut
            StackPane imageContainer = new StackPane();
            imageContainer.setPrefHeight(180);
            imageContainer.setMinHeight(180);
            imageContainer.setMaxHeight(180);
            imageContainer.setStyle("-fx-background-color: #f0f0f0; -fx-background-radius: 6px 6px 0 0;");
            imageContainer.getStyleClass().add("image-container");
            
            String imagePath = CoursImageUtils.getCourseImagePath(cours.getImage());
            ImageView imageView = new ImageView();
            try {
                Image image = CoursImageUtils.loadCourseImage(cours.getImage());
                imageView.setImage(image);
                imageView.setFitWidth(300);
                imageView.setFitHeight(180);
                imageView.setPreserveRatio(true);
                imageView.setStyle("-fx-background-color: #f0f0f0;");
                
                // Appliquer des coins arrondis à l'image
                Rectangle clip = new Rectangle(imageView.getFitWidth(), imageView.getFitHeight());
                clip.setArcWidth(12);
                clip.setArcHeight(12);
                imageView.setClip(clip);
                
                // Centrer l'image
                StackPane.setAlignment(imageView, Pos.CENTER);
            } catch (Exception e) {
                LOGGER.log(Level.WARNING, "Failed to load image for course: " + cours.getTitre(), e);
                // Fallback to default image
                imageView.setImage(CoursImageUtils.loadCourseImage("default.jpg"));
            }
            
            imageContainer.getChildren().add(imageView);
            
            // Category badge
            Label categoryBadge = new Label(cours.getCategorie().getNom());
            categoryBadge.getStyleClass().add("category-badge");
            categoryBadge.setStyle("-fx-background-color: #3498db; -fx-text-fill: white; -fx-padding: 5 10; " +
                                 "-fx-background-radius: 4px; -fx-font-weight: bold; -fx-font-size: 12px;");
            StackPane.setAlignment(categoryBadge, Pos.TOP_RIGHT);
            StackPane.setMargin(categoryBadge, new Insets(10));
            imageContainer.getChildren().add(categoryBadge);
            
            // Ajout de l'indicateur "EN DIRECT" si le cours est en live
            if (cours.isLive()) {
                Label liveIndicator = new Label("EN DIRECT");
                liveIndicator.getStyleClass().add("live-indicator");
                liveIndicator.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white; -fx-padding: 3 8; " +
                                    "-fx-background-radius: 3; -fx-font-weight: bold; -fx-font-size: 11px;");
                StackPane.setAlignment(liveIndicator, Pos.BOTTOM_RIGHT);
                StackPane.setMargin(liveIndicator, new Insets(10));
                imageContainer.getChildren().add(liveIndicator);
            }
            
            // Conteneur pour le contenu (titre, détails, boutons)
            VBox contentBox = new VBox(10);
            contentBox.setPadding(new Insets(15));
            contentBox.setAlignment(Pos.TOP_LEFT);
            
            // Course title
            Label titleLabel = new Label(cours.getTitre());
            titleLabel.setStyle("-fx-font-weight: bold; -fx-font-size: 16px; -fx-text-fill: #2c3e50;");
            titleLabel.setWrapText(true);
            titleLabel.setMaxWidth(270);
            titleLabel.setMinHeight(40); // Hauteur minimale pour le titre
            
            // Details section
            VBox detailsBox = new VBox(8);
            detailsBox.getStyleClass().add("details-box");
            
            // Course level
            HBox levelBox = new HBox(5);
            levelBox.setAlignment(Pos.CENTER_LEFT);
            Label levelIcon = new Label("⭐");
            Label levelLabel = new Label("Niveau: " + cours.getNiveau());
            levelLabel.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px;");
            levelBox.getChildren().addAll(levelIcon, levelLabel);
            
            // Course duration
            HBox durationBox = new HBox(5);
            durationBox.setAlignment(Pos.CENTER_LEFT);
            Label durationIcon = new Label("⏱");
            Label durationLabel = new Label("Durée: " + cours.getDuree() + " heures");
            durationLabel.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px;");
            durationBox.getChildren().addAll(durationIcon, durationLabel);
            
            // Course instructor
            HBox instructorBox = new HBox(5);
            instructorBox.setAlignment(Pos.CENTER_LEFT);
            Label instructorIcon = new Label("👨‍🏫");
            Label instructorLabel = new Label("Par: " + cours.getInstructeur());
            instructorLabel.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px;");
            instructorBox.getChildren().addAll(instructorIcon, instructorLabel);
            
            detailsBox.getChildren().addAll(levelBox, durationBox, instructorBox);
            
            // Séparateur avant les boutons
            Region spacer = new Region();
            spacer.setMinHeight(10);
            
            // Buttons section
            HBox buttonsBox = new HBox(10);
            buttonsBox.setAlignment(Pos.CENTER);
            
            // Bouton Live
            Button liveButton = createLiveButton();
            liveButton.setOnAction(e -> handleStartLive(cours));
            
            Button inscriptionBtn = new Button("S'inscrire");
            inscriptionBtn.getStyleClass().add("inscription-button");
            inscriptionBtn.setStyle("-fx-background-color: #3498db; -fx-text-fill: white; -fx-min-width: 100px; " +
                                "-fx-cursor: hand; -fx-font-weight: bold;");
            inscriptionBtn.setOnAction(e -> handleInscription(cours));
            
            // En mode admin, ajouter les boutons Modifier et Supprimer
            if (isAdminMode) {
                // Bouton Modifier
                Button modifierBtn = new Button("Modifier");
                modifierBtn.getStyleClass().add("modifier-button");
                modifierBtn.setStyle("-fx-background-color: #2ecc71; -fx-text-fill: white; -fx-min-width: 80px; " +
                                 "-fx-cursor: hand; -fx-font-weight: bold;");
                modifierBtn.setOnAction(e -> handleModifierCours(cours));
                
                // Bouton Supprimer
                Button supprimerBtn = new Button("Supprimer");
                supprimerBtn.getStyleClass().add("supprimer-button");
                supprimerBtn.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white; -fx-min-width: 80px; " +
                                   "-fx-cursor: hand; -fx-font-weight: bold;");
                supprimerBtn.setOnAction(e -> handleSupprimerCours(cours));
                
                buttonsBox.getChildren().addAll(liveButton, modifierBtn, supprimerBtn);
            } else {
                // En mode utilisateur, ajouter le bouton Live et S'inscrire
                buttonsBox.getChildren().addAll(liveButton, inscriptionBtn);
            }
            
            // Ajouter tous les éléments au conteneur de contenu
            contentBox.getChildren().addAll(titleLabel, detailsBox, spacer, buttonsBox);
            
            // Add content to card
            card.getChildren().addAll(imageContainer, contentBox);
            
            // Style for hover effect
            card.setOnMouseEntered(e -> {
                card.setStyle("-fx-background-color: white; -fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.2), 8, 0, 0, 8); " +
                           "-fx-background-radius: 6px; -fx-border-radius: 6px;");
            });
            
            card.setOnMouseExited(e -> {
                card.setStyle("-fx-background-color: white; -fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.1), 5, 0, 0, 5); " +
                           "-fx-background-radius: 6px; -fx-border-radius: 6px;");
            });
            
            return card;
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error creating course card for: " + cours.getTitre(), e);
            return new VBox(); // Return empty box in case of error
        }
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void filterCours() {
        String searchText = searchField.getText().toLowerCase();
        String category = categoryFilter.getValue();
        
        ObservableList<Cours> filteredList = coursList.filtered(cours -> {
            boolean matchesSearch = cours.getTitre().toLowerCase().contains(searchText) ||
                                  cours.getDescription().toLowerCase().contains(searchText) ||
                                  cours.getInstructeur().toLowerCase().contains(searchText);
            
            boolean matchesCategory = category.equals("Toutes les catégories") || 
                                    (cours.getCategorie() != null && 
                                     cours.getCategorie().getNom().equals(category));
            
            return matchesSearch && matchesCategory;
        });
        
        displayCours(filteredList);
    }

    private void displayCours(ObservableList<Cours> cours) {
        coursContainer.getChildren().clear();
        for (Cours c : cours) {
            coursContainer.getChildren().add(createCoursCard(c));
        }
    }

    @FXML
    private void handleClearFilters() {
        searchField.clear();
        categoryFilter.setValue("Toutes les catégories");
    }

    @FXML
    private void handleAddCourse() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/cours-form.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter un cours");
            stage.initModality(Modality.WINDOW_MODAL);
            stage.initOwner(addCourseButton.getScene().getWindow());
            
            Scene scene = new Scene(root);
            stage.setScene(scene);
            
            stage.showAndWait();
            
            // Recharger les cours après l'ajout
            loadCours();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'ajout de cours", e);
            showError("Erreur", "Impossible d'ouvrir le formulaire d'ajout de cours");
        }
    }

    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public void setAdminMode(boolean isAdmin) {
        this.isAdminMode = isAdmin;
        // Si déjà initialisé, rafraîchir l'affichage
        if (coursContainer != null) {
            filterCours();
        }
    }

    private void handleInscription(Cours cours) {
        // Logique d'inscription existante
        try {
            showAlert(Alert.AlertType.INFORMATION, "Inscription", "Inscription réussie au cours: " + cours.getTitre());
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'inscription au cours", e);
            showError("Erreur", "Erreur lors de l'inscription au cours");
        }
    }
    
    private void handleModifierCours(Cours cours) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/cours-form.fxml"));
            Parent root = loader.load();
            
            CoursFormController controller = loader.getController();
            controller.setCoursForModification(cours);
            
            Stage stage = new Stage();
            stage.setTitle("Modifier le cours");
            stage.setScene(new Scene(root));
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.showAndWait();
            
            // Rafraîchir la liste après modification
            loadCours();
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire de modification", e);
            showError("Erreur", "Impossible d'ouvrir le formulaire de modification");
        }
    }
    
    private void handleSupprimerCours(Cours cours) {
        Alert confirmDialog = new Alert(Alert.AlertType.CONFIRMATION);
        confirmDialog.setTitle("Confirmation de suppression");
        confirmDialog.setHeaderText("Êtes-vous sûr de vouloir supprimer ce cours ?");
        confirmDialog.setContentText("Cette action est irréversible.");
        
        if (confirmDialog.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
            try {
                String query = "DELETE FROM cours WHERE id = ?";
                try (Connection conn = DatabaseConnection.getConnection();
                    PreparedStatement stmt = conn.prepareStatement(query)) {
                    
                    stmt.setInt(1, cours.getId());
                    int rowsAffected = stmt.executeUpdate();
                    
                    if (rowsAffected > 0) {
                        showAlert(Alert.AlertType.INFORMATION, "Succès", "Le cours a été supprimé avec succès.");
                        loadCours(); // Rafraîchir la liste
                    } else {
                        showAlert(Alert.AlertType.WARNING, "Avertissement", "Aucun cours n'a été supprimé.");
                    }
                }
            } catch (SQLException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la suppression du cours", e);
                showError("Erreur", "Impossible de supprimer le cours: " + e.getMessage());
            }
        }
    }

    // Méthode pour vérifier les cours en direct dans la base de données
    private void checkLiveCoursesInDatabase() {
        String query = "SELECT id, titre, is_live FROM cours WHERE is_live = TRUE";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            boolean foundLiveCourses = false;
            
            while (rs.next()) {
                foundLiveCourses = true;
                int id = rs.getInt("id");
                String titre = rs.getString("titre");
                boolean isLive = rs.getBoolean("is_live");
                
                LOGGER.info("Base de données - Cours en DIRECT: ID=" + id + ", Titre=" + titre + ", isLive=" + isLive);
            }
            
            if (!foundLiveCourses) {
                LOGGER.warning("Aucun cours en direct trouvé dans la base de données!");
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification des cours en direct dans la BDD", e);
        }
    }
}