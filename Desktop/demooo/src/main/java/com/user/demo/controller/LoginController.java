package com.user.demo.controller;

import com.user.demo.model.User;
import com.user.demo.service.UserService;
import com.user.demo.util.SessionManager;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.Stage;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;

/**
 * Controller for the login view
 */
public class LoginController implements Initializable {
    
    @FXML
    private TextField emailField;
    
    @FXML
    private PasswordField passwordField;
    
    @FXML
    private Button loginButton;
    
    @FXML
    private Hyperlink signupLink;
    
    @FXML
    private Label errorLabel;
    
    private UserService userService;
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        userService = new UserService();
        
        // Add enter key functionality
        passwordField.setOnKeyPressed(event -> {
            if (event.getCode().toString().equals("ENTER")) {
                handleLogin(new ActionEvent());
            }
        });
    }
    
    /**
     * Handle login button action
     * @param event The action event
     */
    @FXML
    public void handleLogin(ActionEvent event) {
        String email = emailField.getText().trim();
        String password = passwordField.getText();
        
        // Validate inputs
        if (email.isEmpty() || password.isEmpty()) {
            showError("Please enter both email and password");
            return;
        }
        
        // Authenticate user
        User user = userService.authenticate(email, password);
        
        if (user != null) {
            // Login successful
            SessionManager.getInstance().startSession(user);
            
            try {
                // Determine which dashboard to load based on user role
                String dashboardPath = user.getRole().equalsIgnoreCase("admin") ?
                        "/com/user/demo/admin-dashboard-view.fxml" :
                        "/com/user/demo/dashboard-view.fxml";
                
                // Load the appropriate dashboard
                FXMLLoader loader = new FXMLLoader(getClass().getResource(dashboardPath));
                Parent root = loader.load();
                
                // Create a new scene with the dashboard
                Scene scene = new Scene(root);
                
                // Get the current stage
                Stage stage = (Stage) loginButton.getScene().getWindow();
                
                // Set the new scene on the stage
                stage.setScene(scene);
                stage.setTitle(user.getRole().equalsIgnoreCase("admin") ? "Admin Dashboard" : "DevSphere Dashboard");
                stage.setMaximized(true);
                stage.show();
                
            } catch (IOException e) {
                e.printStackTrace();
                showError("Error loading dashboard. Please try again later.");
            }
        } else {
            // Login failed
            showError("Invalid email or password");
            passwordField.clear();
        }
    }
    
    /**
     * Navigate to the signup page
     * @param event The action event
     */
    @FXML
    public void goToSignup(ActionEvent event) {
        try {
            // Load the signup view
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/signup-view.fxml"));
            Parent root = loader.load();
            
            // Create a new scene with the signup form
            Scene scene = new Scene(root);
            
            // Get the current stage
            Stage stage = (Stage) signupLink.getScene().getWindow();
            
            // Set the new scene on the stage
            stage.setScene(scene);
            stage.setTitle("DevSphere - Create Account");
            stage.show();
            
        } catch (IOException e) {
            e.printStackTrace();
            showError("Error loading signup form. Please try again later.");
        }
    }
    
    /**
     * Show error message to the user
     * @param message Error message to display
     */
    private void showError(String message) {
        if (errorLabel != null) {
            errorLabel.setText(message);
            errorLabel.setVisible(true);
            errorLabel.setManaged(true);
        }
    }
}