package com.user.demo.controller;

import com.user.demo.model.User;
import com.user.demo.util.SessionManager;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Controller for the main dashboard view
 */
public class DashboardController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(DashboardController.class.getName());

    @FXML
    private StackPane contentArea;

    @FXML
    private Button btnDashboard;

    @FXML
    private Button btnProducts;

    @FXML
    private Button btnInscription;

    @FXML
    private Button btnReclamations;

    @FXML
    private Button btnProfile;

    @FXML
    private Button btnLogout;

    @FXML
    private Label currentUserLabel;

    private User currentUser;

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        // Check if user is logged in
        currentUser = SessionManager.getInstance().getCurrentUser();
        if (currentUser == null) {
            // Redirect to login if no user is logged in
            redirectToLogin();
            return;
        }

        // Display current user name
        if (currentUserLabel != null) {
            currentUserLabel.setText(currentUser.getName());
        }
    }

    public void setCurrentUser(User user) {
        this.currentUser = user;
        currentUserLabel.setText(user.getName());
    }

    /**
     * Show the dashboard (home) screen
     */
    @FXML
    private void showDashboard() {
        // The dashboard view is already loaded, just clear any content in the center
        if (contentArea != null) {
            contentArea.getChildren().clear();
        }
    }

    /**
     * Show the products view
     */
    @FXML
    private void showProducts() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/user-products-view.fxml"));
            Parent view = loader.load();

            UserProductViewController controller = loader.getController();
            controller.setUserId(currentUser.getId());

            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Error loading products view", e);
            showError("Error loading products view", e.getMessage());
        }
    }

    /**
     * Show the reclamations list view
     */
    @FXML
    private void showReclamations() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/reclamation-list-view.fxml"));
            Parent view = loader.load();

            ReclamationListController controller = loader.getController();
            controller.setCurrentUser(currentUser);

            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Error loading reclamations view", e);
            showError("Error loading reclamations view", e.getMessage());
        }
    }

    /**
     * Show the new reclamation form
     */
    @FXML
    private void showNewReclamation() {
        loadView("reclamation-form-view.fxml");
    }

    /**
     * Show the responses list view
     */
    @FXML
    private void showResponses() {
        loadView("response-list-view.fxml");
    }

    /**
     * Show the user profile view
     */
    @FXML
    private void showProfile() {
        loadView("profile-view.fxml");
    }

    /**
     * Show the inscription view
     */
    @FXML
    private void showInscription() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/inscription-view.fxml"));
            Parent inscriptionView = loader.load();
            contentArea.getChildren().setAll(inscriptionView);
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement de la vue d'inscription", e);
            showError("Erreur", "Impossible de charger la vue d'inscription");
        }
    }

    /**
     * Show the exercices view
     */
    @FXML
    private void showExercices() {
        try {
            // Créer un loader pour le fichier FXML original
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/exercice-view.fxml"));
            Parent exerciceView = loader.load();
            
            // Récupérer le contrôleur
            ExerciceController controller = loader.getController();
            
            // Configurer le contrôleur pour utiliser le modèle de carte utilisateur
            controller.useUserCardTemplate(true);
            
            // Masquer les boutons dans la vue des exercices (boutons administratifs)
            exerciceView.lookupAll(".button").forEach(node -> {
                Button button = (Button) node;
                if (button.getText().contains("Tentatives") || 
                    button.getText().contains("Ajouter") || 
                    button.getText().contains("Nouveau")) {
                    button.setVisible(false);
                    button.setManaged(false);
                }
            });
            
            // Masquer spécifiquement les boutons Update et Supprimer définis dans le FXML
            exerciceView.lookupAll(".button-modifier, .button-supprimer").forEach(node -> {
                node.setVisible(false);
                node.setManaged(false);
            });
            
            contentArea.getChildren().setAll(exerciceView);
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement de la vue des exercices", e);
            showError("Erreur", "Impossible de charger la vue des exercices");
        }
    }

    /**
     * Show the settings screen
     */
    @FXML
    private void showSettings() {
        loadView("settings-view.fxml");
    }

    /**
     * Handle logout button action
     */
    @FXML
    private void handleLogout() {
        // End the user session
        SessionManager.getInstance().endSession();

        // Redirect to login screen
        redirectToLogin();
    }

    /**
     * Helper method to load a view into the content area
     * @param fxmlFile The FXML file to load
     */
    private void loadView(String fxmlFile) {
        try {
            Parent view = FXMLLoader.load(getClass().getResource("/com/user/demo/" + fxmlFile));
            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Error loading view: " + fxmlFile, e);
            showError("Error Loading View", "Failed to load " + fxmlFile + ": " + e.getMessage());
        }
    }

    /**
     * Show an error alert to the user
     */
    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    /**
     * Redirect user to login page
     */
    private void redirectToLogin() {
        try {
            // Load the login view
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/login-view.fxml"));
            Parent root = loader.load();

            // Create a new scene with the login form
            Scene scene = new Scene(root);

            // Get the current stage
            Stage stage = (Stage) contentArea.getScene().getWindow();

            // Set the new scene on the stage
            stage.setScene(scene);
            stage.setTitle("DevSphere - Login");
            stage.show();

        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Error redirecting to login", e);
        }
    }
}