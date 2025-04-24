package com.user.demo.controller;

import com.user.demo.model.ActivityRecord;
import com.user.demo.model.User;
import com.user.demo.util.SessionManager;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Controller for the admin dashboard view
 */
public class AdminDashboardController implements Initializable {
    
    private static final Logger LOGGER = Logger.getLogger(AdminDashboardController.class.getName());
    
    @FXML
    private StackPane contentArea;
    
    @FXML
    private Label currentUserLabel;
    
    @FXML
    private Label totalUsersLabel;
    
    @FXML
    private Label activeReclamationsLabel;
    
    @FXML
    private Label pendingResponsesLabel;
    
    @FXML
    private TableView<ActivityRecord> recentActivityTable;
    
    @FXML
    private TableColumn<ActivityRecord, String> activityDateColumn;
    
    @FXML
    private TableColumn<ActivityRecord, String> activityTypeColumn;
    
    @FXML
    private TableColumn<ActivityRecord, String> activityDescriptionColumn;
    
    @FXML
    private TableColumn<ActivityRecord, String> activityStatusColumn;
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        // Check if user is logged in and has admin role
        User currentUser = SessionManager.getInstance().getCurrentUser();
        if (currentUser == null || !"admin".equals(currentUser.getRole())) {
            // Redirect to login if no user is logged in or not an admin
            redirectToLogin();
            return;
        }
        
        // Display current user name
        currentUserLabel.setText("Admin: " + currentUser.getName());
        
        // Initialize statistics
        updateStatistics();
        
        // Initialize activity table
        initializeActivityTable();
    }
    
    /**
     * Show the dashboard overview
     */
    @FXML
    private void showDashboard() {
        // Dashboard is the current view, no need to load anything
        updateStatistics();
    }
    
    /**
     * Show the user management view
     */
    @FXML
    private void showUserManagement() {
        loadView("user-management-view.fxml");
    }
    
    /**
     * Show the products management view
     */
    @FXML
    private void showProducts() {
        loadView("admin-product-view.fxml");
    }
    
    /**
     * Show the inscriptions management view
     */
    @FXML
    private void showInscriptions() {
        try {
            URL fxmlUrl = getClass().getResource("/com/user/demo/views/inscription-card-view.fxml");
            if (fxmlUrl == null) {
                throw new IOException("Cannot find FXML file: inscription-card-view.fxml");
            }
            
            FXMLLoader loader = new FXMLLoader(fxmlUrl);
            Parent view = loader.load();
            
            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            e.printStackTrace();
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setHeaderText("Error Loading View");
            alert.setContentText("Could not load the view: inscription-card-view.fxml\nError: " + e.getMessage());
            alert.showAndWait();
        }
    }
    
    /**
     * Show the cours management view
     */
    @FXML
    private void showCours() {
        try {
            URL fxmlUrl = getClass().getResource("/com/user/demo/views/cours-view.fxml");
            if (fxmlUrl == null) {
                throw new IOException("Cannot find FXML file: cours-view.fxml");
            }
            
            FXMLLoader loader = new FXMLLoader(fxmlUrl);
            Parent view = loader.load();
            
            // Obtenir le contrôleur et activer le mode admin
            CoursViewController controller = loader.getController();
            controller.setAdminMode(true);
            
            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            e.printStackTrace();
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setHeaderText("Error Loading View");
            alert.setContentText("Could not load the view: cours-view.fxml\nError: " + e.getMessage());
            alert.showAndWait();
        }
    }
    
    /**
     * Show the categories cours management view
     */
    @FXML
    private void showCategoriesCours() {
        loadView("admin-category-view.fxml");
    }
    
    /**
     * Show the reclamations management view
     */
    @FXML
    private void showReclamations() {
        loadView("admin-reclamation-view.fxml");
    }
    
    /**
     * Show the response management view
     */
    @FXML
    private void showResponses() {
        loadView("admin-response-view.fxml");
    }
    
    /**
     * Show the settings screen
     */
    @FXML
    private void showSettings() {
        loadView("admin-settings-view.fxml");
    }
    
    /**
     * Show the exercices management view
     */
    @FXML
    private void showExercices() {
        loadView("exercice-view.fxml");
    }


    /**
     * Show the exercices management view
     */
    public void showEvent(ActionEvent actionEvent) {
        loadView("admin-events.fxml");
    }


    /**
     * Show the tentatives management view
     */
    @FXML
    private void showTentatives() {
        loadView("tentatives-view.fxml");
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
     * Update dashboard statistics
     */
    private void updateStatistics() {
        // TODO: Implement statistics update from services
        // For now using placeholder values
        totalUsersLabel.setText("150");
        activeReclamationsLabel.setText("25");
        pendingResponsesLabel.setText("10");
    }
    
    /**
     * Initialize the activity table
     */
    private void initializeActivityTable() {
        // TODO: Implement table initialization and data loading
        // Configure table columns
        activityDateColumn.setCellValueFactory(cellData -> cellData.getValue().dateProperty());
        activityTypeColumn.setCellValueFactory(cellData -> cellData.getValue().typeProperty());
        activityDescriptionColumn.setCellValueFactory(cellData -> cellData.getValue().descriptionProperty());
        activityStatusColumn.setCellValueFactory(cellData -> cellData.getValue().statusProperty());
    }
    
    /**
     * Helper method to load a view into the content area
     * @param fxmlFile The FXML file to load
     */
    private void loadView(String fxmlFile) {
        try {
            URL fxmlUrl = getClass().getResource("/com/user/demo/views/" + fxmlFile);
            if (fxmlUrl == null) {
                throw new IOException("Cannot find FXML file: " + fxmlFile);
            }
            FXMLLoader loader = new FXMLLoader(fxmlUrl);
            Parent view = loader.load();
            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            e.printStackTrace();
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setHeaderText("Error Loading View");
            alert.setContentText("Could not load the view: " + fxmlFile + "\nError: " + e.getMessage());
            alert.showAndWait();
        }
    }
    
    /**
     * Redirect to login screen
     */
    private void redirectToLogin() {
        try {
            // Charger la vue de connexion
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/login-view.fxml"));
            Parent loginView = loader.load();
            
            // Obtenir la scène actuelle
            Scene currentScene = contentArea.getScene();
            Stage stage = (Stage) currentScene.getWindow();
            
            // Créer une nouvelle scène avec la vue de connexion
            Scene loginScene = new Scene(loginView);
            loginScene.getStylesheets().add(getClass().getResource("/com/user/demo/styles/login.css").toExternalForm());
            
            // Remplacer la scène actuelle par la scène de connexion
            stage.setScene(loginScene);
            stage.setTitle("Login - DevSphere");
            stage.centerOnScreen();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la redirection vers la page de connexion", e);
            showError("Erreur", "Impossible de charger la page de connexion");
        }
    }
    
    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }


}