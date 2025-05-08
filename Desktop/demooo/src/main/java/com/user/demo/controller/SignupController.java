package com.user.demo.controller;

import com.user.demo.model.User;
import com.user.demo.service.UserService;
import com.user.demo.utils.FileUploadUtils;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.util.ResourceBundle;

/**
 * Controller for the signup view
 */
public class SignupController implements Initializable {
    
    @FXML
    private TextField nameField;
    
    @FXML
    private TextField emailField;
    
    @FXML
    private PasswordField passwordField;
    
    @FXML
    private PasswordField confirmPasswordField;
    
    @FXML
    private TextField phoneField;
    
    @FXML
    private TextField cinField;
    
    @FXML
    private TextField imagePathField;
    
    @FXML
    private Button browseButton;
    
    @FXML
    private Button signupButton;
    
    @FXML
    private Hyperlink loginLink;
    
    @FXML
    private Label errorLabel;
    
    private UserService userService;
    private File selectedImageFile;
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        userService = new UserService();
    }
    
    /**
     * Handle browse button action to select profile image
     * @param event The action event
     */
    @FXML
    public void handleBrowseImage(ActionEvent event) {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Select Profile Image");
        fileChooser.getExtensionFilters().addAll(
                new FileChooser.ExtensionFilter("Image Files", "*.png", "*.jpg", "*.jpeg", "*.gif")
        );
        
        // Show open file dialog
        File file = fileChooser.showOpenDialog(browseButton.getScene().getWindow());
        
        if (file != null) {
            selectedImageFile = file;
            imagePathField.setText(file.getPath());
        }
    }
    
    /**
     * Handle signup button action
     * @param event The action event
     */
    @FXML
    public void handleSignup(ActionEvent event) {
        // Clear previous error
        hideError();
        
        // Validate inputs
        if (!validateInputs()) {
            return;
        }
        
        try {
            // Check if email already exists
            if (userService.emailExists(emailField.getText().trim())) {
                showError("Email already exists. Please use a different email.");
                return;
            }
            
            // Process the image
            String imageUrl = FileUploadUtils.getFileUrl("default.jpg", true); // URL de l'image par défaut
            
            if (selectedImageFile != null) {
                try {
                    // Utiliser notre nouvel utilitaire pour télécharger l'image et obtenir l'URL
                    String fileName = "user_" + System.currentTimeMillis() + "_" + selectedImageFile.getName();
                    imageUrl = FileUploadUtils.uploadImage(selectedImageFile, fileName);
                } catch (IOException e) {
                    showError("Error uploading profile image. Please try again.");
                    e.printStackTrace();
                    return;
                }
            }
            
            // Create user object with the image URL
            User user = new User(
                nameField.getText().trim(),
                emailField.getText().trim(),
                passwordField.getText(),
                Integer.parseInt(phoneField.getText().trim()),
                Integer.parseInt(cinField.getText().trim()),
                imageUrl,
                "user" // Default role for new users
            );
            
            // Register the user
            boolean success = userService.registerUser(user);
            
            if (success) {
                // Show success alert
                Alert alert = new Alert(Alert.AlertType.INFORMATION);
                alert.setTitle("Registration Successful");
                alert.setHeaderText(null);
                alert.setContentText("Your account has been created successfully. You can now log in.");
                alert.showAndWait();
                
                // Redirect to login
                goToLogin(new ActionEvent());
            } else {
                showError("Failed to register. Please try again later.");
            }
            
        } catch (NumberFormatException e) {
            showError("Phone and CIN must be numbers.");
        } catch (Exception e) {
            showError("An error occurred. Please try again later.");
            e.printStackTrace();
        }
    }
    
    /**
     * Navigate to the login page
     * @param event The action event
     */
    @FXML
    public void goToLogin(ActionEvent event) {
        try {
            // Load the login view
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/login-view.fxml"));
            Parent root = loader.load();
            
            // Create a new scene with the login form
            Scene scene = new Scene(root);
            
            // Get the current stage
            Stage stage = (Stage) loginLink.getScene().getWindow();
            
            // Set the new scene on the stage
            stage.setScene(scene);
            stage.setTitle("DevSphere - Login");
            stage.show();
            
        } catch (IOException e) {
            e.printStackTrace();
            showError("Error loading login form. Please try again later.");
        }
    }
    
    /**
     * Validate all input fields
     * @return true if all inputs are valid, false otherwise
     */
    private boolean validateInputs() {
        // Check required fields
        if (nameField.getText().trim().isEmpty() ||
            emailField.getText().trim().isEmpty() ||
            passwordField.getText().isEmpty() ||
            confirmPasswordField.getText().isEmpty() ||
            phoneField.getText().trim().isEmpty() ||
            cinField.getText().trim().isEmpty()) {
            
            showError("Please fill all required fields.");
            return false;
        }
        
        // Validate email format
        if (!emailField.getText().trim().matches("^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$")) {
            showError("Please enter a valid email address.");
            return false;
        }
        
        // Validate password length
        if (passwordField.getText().length() < 6) {
            showError("Password must be at least 6 characters long.");
            return false;
        }
        
        // Validate password confirmation
        if (!passwordField.getText().equals(confirmPasswordField.getText())) {
            showError("Passwords don't match.");
            return false;
        }
        
        // Validate phone number
        try {
            Integer.parseInt(phoneField.getText().trim());
        } catch (NumberFormatException e) {
            showError("Phone number must be numeric.");
            return false;
        }
        
        // Validate CIN
        try {
            Integer.parseInt(cinField.getText().trim());
        } catch (NumberFormatException e) {
            showError("CIN must be numeric.");
            return false;
        }
        
        return true;
    }
    
    /**
     * Show error message
     * @param message The error message to display
     */
    private void showError(String message) {
        errorLabel.setText(message);
        errorLabel.setVisible(true);
        errorLabel.setManaged(true);
    }
    
    /**
     * Hide error message
     */
    private void hideError() {
        errorLabel.setVisible(false);
        errorLabel.setManaged(false);
    }
}