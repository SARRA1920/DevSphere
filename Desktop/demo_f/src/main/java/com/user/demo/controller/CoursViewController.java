package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.model.CategorieCours;
import com.user.demo.util.DatabaseConnection;
import com.user.demo.util.CoursImageUtils;
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

    private VBox createCoursCard(Cours cours) {
        try {
            // Card container
            VBox card = new VBox();
            card.getStyleClass().addAll("course-card", "card-hover");
            card.setSpacing(10);
            card.setPadding(new Insets(15));
            card.setMaxWidth(300);
            card.setMinHeight(350);
            
            // Image container
            StackPane imageContainer = new StackPane();
            imageContainer.setPrefHeight(180);
            imageContainer.getStyleClass().add("image-container");
            
            String imagePath = CoursImageUtils.getCourseImagePath(cours.getImage());
            ImageView imageView = new ImageView();
            try {
                Image image = CoursImageUtils.loadCourseImage(cours.getImage());
                imageView.setImage(image);
                imageView.setFitWidth(300);
                imageView.setFitHeight(180);
                imageView.setPreserveRatio(true);
                imageView.getStyleClass().add("course-image");
            } catch (Exception e) {
                LOGGER.log(Level.WARNING, "Failed to load image for course: " + cours.getTitre(), e);
                // Fallback to default image
                imageView.setImage(CoursImageUtils.loadCourseImage("default.jpg"));
            }
            
            imageContainer.getChildren().add(imageView);
            
            // Number badge
            Label numLabel = new Label("#" + cours.getId());
            numLabel.getStyleClass().add("course-number");
            StackPane.setAlignment(numLabel, Pos.TOP_LEFT);
            StackPane.setMargin(numLabel, new Insets(10));
            imageContainer.getChildren().add(numLabel);
            
            // Category badge
            Label categoryBadge = new Label(cours.getCategorie().getNom());
            categoryBadge.getStyleClass().add("category-badge");
            StackPane.setAlignment(categoryBadge, Pos.TOP_RIGHT);
            StackPane.setMargin(categoryBadge, new Insets(10));
            imageContainer.getChildren().add(categoryBadge);
            
            card.getChildren().add(imageContainer);
            
            // Course title
            Label titleLabel = new Label(cours.getTitre());
            titleLabel.getStyleClass().add("course-title");
            titleLabel.setWrapText(true);
            
            // Details section
            VBox detailsBox = new VBox(5);
            detailsBox.getStyleClass().add("details-box");
            detailsBox.setPadding(new Insets(10, 0, 10, 0));
            
            // Course level
            HBox levelBox = new HBox(5);
            Label levelIcon = new Label("⭐");
            Label levelLabel = new Label("Niveau: " + cours.getNiveau());
            levelBox.getChildren().addAll(levelIcon, levelLabel);
            
            // Course duration
            HBox durationBox = new HBox(5);
            Label durationIcon = new Label("⏱");
            Label durationLabel = new Label("Durée: " + cours.getDuree() + " heures");
            durationBox.getChildren().addAll(durationIcon, durationLabel);
            
            // Course instructor
            HBox instructorBox = new HBox(5);
            Label instructorIcon = new Label("👨‍🏫");
            Label instructorLabel = new Label("Par: " + cours.getInstructeur());
            instructorBox.getChildren().addAll(instructorIcon, instructorLabel);
            
            detailsBox.getChildren().addAll(levelBox, durationBox, instructorBox);
            
            // Buttons section
            HBox buttonsBox = new HBox(10);
            buttonsBox.setAlignment(Pos.CENTER);
            
            Button inscriptionBtn = new Button("S'inscrire");
            inscriptionBtn.getStyleClass().add("inscription-button");
            inscriptionBtn.setStyle("-fx-background-color: #3498db; -fx-text-fill: white; -fx-min-width: 100px;");
            inscriptionBtn.setOnAction(e -> handleInscription(cours));
            
            // En mode admin, ajouter les boutons Modifier et Supprimer
            if (isAdminMode) {
                // Bouton Modifier
                Button modifierBtn = new Button("Modifier");
                modifierBtn.getStyleClass().add("modifier-button");
                modifierBtn.setStyle("-fx-background-color: #2ecc71; -fx-text-fill: white; -fx-min-width: 80px;");
                modifierBtn.setOnAction(e -> handleModifierCours(cours));
                
                // Bouton Supprimer
                Button supprimerBtn = new Button("Supprimer");
                supprimerBtn.getStyleClass().add("supprimer-button");
                supprimerBtn.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white; -fx-min-width: 80px;");
                supprimerBtn.setOnAction(e -> handleSupprimerCours(cours));
                
                buttonsBox.getChildren().addAll(modifierBtn, supprimerBtn);
            } else {
                // En mode utilisateur, seulement le bouton S'inscrire
                buttonsBox.getChildren().add(inscriptionBtn);
            }
            
            // Add all to the card
            card.getChildren().addAll(titleLabel, detailsBox, buttonsBox);
            
            // Style for hover effect
            card.setOnMouseEntered(e -> {
                card.getStyleClass().add("card-hover-active");
            });
            
            card.setOnMouseExited(e -> {
                card.getStyleClass().remove("card-hover-active");
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
} 