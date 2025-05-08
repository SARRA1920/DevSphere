package com.user.demo.controller;

import com.user.demo.model.User;
import com.user.demo.service.UserService;
import com.user.demo.util.SessionManager;
import com.user.demo.utils.FileUploadUtils;
import com.user.demo.utils.ImageDisplayUtils;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.stage.FileChooser;
import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.util.ResourceBundle;

/**
 * Controller for the profile view
 */
public class ProfileController implements Initializable {
    
    @FXML
    private ImageView profileImage;
    
    @FXML
    private Label nameLabel;
    
    @FXML
    private Label emailLabel;
    
    @FXML
    private Label phoneLabel;
    
    @FXML
    private Label cinLabel;
    
    @FXML
    private Label roleLabel;
    
    @FXML
    private TextField nameField;
    
    @FXML
    private TextField emailField;
    
    @FXML
    private TextField phoneField;
    
    @FXML
    private TextField cinField;
    
    @FXML
    private PasswordField currentPasswordField;
    
    @FXML
    private PasswordField newPasswordField;
    
    @FXML
    private PasswordField confirmPasswordField;
    
    @FXML
    private Label errorLabel;
    
    @FXML
    private Label passwordErrorLabel;
    
    private UserService userService;
    private User currentUser;
    private File selectedImageFile;
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        userService = new UserService();
        
        // Get current user from session
        currentUser = SessionManager.getInstance().getCurrentUser();
        
        if (currentUser != null) {
            // Set user information in profile view
            nameLabel.setText(currentUser.getName());
            emailLabel.setText(currentUser.getEmail());
            phoneLabel.setText(String.valueOf(currentUser.getPhone()));
            cinLabel.setText(String.valueOf(currentUser.getCin()));
            roleLabel.setText(currentUser.getRole());
            
            // Load profile image using ImageDisplayUtils
            String imagePath = currentUser.getImage();
            ImageDisplayUtils.loadAndSetImage(profileImage, imagePath);
            
            // Set form field values
            nameField.setText(currentUser.getName());
            emailField.setText(currentUser.getEmail());
            phoneField.setText(String.valueOf(currentUser.getPhone()));
            cinField.setText(String.valueOf(currentUser.getCin()));
        }
    }
    
    /**
     * Handle change image button action
     * @param event The action event
     */
    @FXML
    public void handleChangeImage(ActionEvent event) {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Select Profile Image");
        fileChooser.getExtensionFilters().addAll(
                new FileChooser.ExtensionFilter("Image Files", "*.png", "*.jpg", "*.jpeg", "*.gif")
        );
        
        // Show open file dialog
        File file = fileChooser.showOpenDialog(profileImage.getScene().getWindow());
        
        if (file != null) {
            selectedImageFile = file;
            
            // Show preview of selected image
            try {
                Image image = new Image(file.toURI().toString());
                profileImage.setImage(image);
            } catch (Exception e) {
                System.err.println("Error loading selected image: " + e.getMessage());
            }
        }
    }
    
    /**
     * Handle save changes button action
     * @param event The action event
     */
    @FXML
    public void handleSaveChanges(ActionEvent event) {
        // Hide any previous errors
        hideError();
        
        // Validate inputs
        if (!validateProfileInputs()) {
            return;
        }
        
        try {
            // Process image if a new one was selected
            if (selectedImageFile != null) {
                try {
                    // Utiliser notre nouvel utilitaire pour télécharger l'image et obtenir l'URL
                    String fileName = "user_" + System.currentTimeMillis() + "_" + selectedImageFile.getName();
                    String imageUrl = FileUploadUtils.uploadImage(selectedImageFile, fileName);
                    
                    // Update user's image path with URL
                    currentUser.setImage(imageUrl);
                    
                    // Recharger l'image avec la nouvelle méthode pour vérifier qu'elle s'affiche correctement
                    ImageDisplayUtils.loadAndSetImage(profileImage, imageUrl);
                    System.out.println("Image mise à jour et chargée avec succès: " + imageUrl);
                } catch (IOException e) {
                    showError("Error uploading profile image. Please try again.");
                    e.printStackTrace();
                    return;
                }
            } else if (currentUser.getImage() != null && !currentUser.getImage().startsWith("http://") && !currentUser.getImage().startsWith("https://")) {
                // Convertir le chemin existant en URL si ce n'est pas déjà une URL
                String imageUrl = FileUploadUtils.getFileUrl(currentUser.getImage(), true);
                currentUser.setImage(imageUrl);
            }
            
            // Update user information
            currentUser.setName(nameField.getText().trim());
            currentUser.setEmail(emailField.getText().trim());
            currentUser.setPhone(Integer.parseInt(phoneField.getText().trim()));
            currentUser.setCin(Integer.parseInt(cinField.getText().trim()));
            
            // Save changes to database
            boolean success = userService.updateUser(currentUser);
            
            if (success) {
                // Update session with updated user
                SessionManager.getInstance().startSession(currentUser);
                
                // Update UI with new information
                nameLabel.setText(currentUser.getName());
                emailLabel.setText(currentUser.getEmail());
                phoneLabel.setText(String.valueOf(currentUser.getPhone()));
                cinLabel.setText(String.valueOf(currentUser.getCin()));
                
                // Show success message
                showSuccessMessage("Profile updated successfully!");
            } else {
                showError("Failed to save changes. Please try again.");
            }
            
        } catch (NumberFormatException e) {
            showError("Phone and CIN must be numeric values.");
        } catch (Exception e) {
            showError("An error occurred. Please try again.");
            e.printStackTrace();
        }
    }
    
    /**
     * Handle change password button action
     * @param event The action event
     */
    @FXML
    public void handleChangePassword(ActionEvent event) {
        // Hide any previous errors
        hidePasswordError();
        
        // Validate password inputs
        if (!validatePasswordInputs()) {
            return;
        }
        
        // Verify current password
        if (!currentUser.getPassword().equals(currentPasswordField.getText())) {
            showPasswordError("Current password is incorrect.");
            return;
        }
        
        // Change password
        boolean success = userService.changePassword(currentUser.getId(), newPasswordField.getText());
        
        if (success) {
            // Update password in session
            currentUser.setPassword(newPasswordField.getText());
            SessionManager.getInstance().startSession(currentUser);
            
            // Clear password fields
            currentPasswordField.clear();
            newPasswordField.clear();
            confirmPasswordField.clear();
            
            // Show success message
            showSuccessMessage("Password changed successfully!");
        } else {
            showPasswordError("Failed to change password. Please try again.");
        }
    }
    
    /**
     * Validate profile inputs
     * @return true if all inputs are valid, false otherwise
     */
    private boolean validateProfileInputs() {
        // Check for empty fields
        if (nameField.getText().trim().isEmpty() ||
            emailField.getText().trim().isEmpty() ||
            phoneField.getText().trim().isEmpty() ||
            cinField.getText().trim().isEmpty()) {
            
            showError("All fields are required.");
            return false;
        }
        
        // Validate email format
        if (!emailField.getText().trim().matches("^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$")) {
            showError("Please enter a valid email address.");
            return false;
        }
        
        // Validate phone number format
        try {
            Integer.parseInt(phoneField.getText().trim());
        } catch (NumberFormatException e) {
            showError("Phone number must be numeric.");
            return false;
        }
        
        // Validate CIN format
        try {
            Integer.parseInt(cinField.getText().trim());
        } catch (NumberFormatException e) {
            showError("CIN must be numeric.");
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate password inputs
     * @return true if all inputs are valid, false otherwise
     */
    private boolean validatePasswordInputs() {
        // Check for empty fields
        if (currentPasswordField.getText().isEmpty() ||
            newPasswordField.getText().isEmpty() ||
            confirmPasswordField.getText().isEmpty()) {
            
            showPasswordError("All password fields are required.");
            return false;
        }
        
        // Check if new password is long enough
        if (newPasswordField.getText().length() < 6) {
            showPasswordError("New password must be at least 6 characters long.");
            return false;
        }
        
        // Check if passwords match
        if (!newPasswordField.getText().equals(confirmPasswordField.getText())) {
            showPasswordError("New passwords don't match.");
            return false;
        }
        
        return true;
    }
    
    /**
     * Show error message in profile section
     * @param message Error message to display
     */
    private void showError(String message) {
        errorLabel.setText(message);
        errorLabel.setVisible(true);
        errorLabel.setManaged(true);
    }
    
    /**
     * Hide error message in profile section
     */
    private void hideError() {
        errorLabel.setVisible(false);
        errorLabel.setManaged(false);
    }
    
    /**
     * Show error message in password section
     * @param message Error message to display
     */
    private void showPasswordError(String message) {
        passwordErrorLabel.setText(message);
        passwordErrorLabel.setVisible(true);
        passwordErrorLabel.setManaged(true);
    }
    
    /**
     * Hide error message in password section
     */
    private void hidePasswordError() {
        passwordErrorLabel.setVisible(false);
        passwordErrorLabel.setManaged(false);
    }
    
    /**
     * Show success message as an alert
     * @param message Success message to display
     */
    private void showSuccessMessage(String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Success");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}