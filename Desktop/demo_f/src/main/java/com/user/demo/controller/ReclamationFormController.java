package com.user.demo.controller;

import com.user.demo.model.Reclamation;
import com.user.demo.service.ReclamationService;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.layout.StackPane;

import java.io.IOException;
import java.net.URL;
import java.time.LocalDateTime;
import java.util.ResourceBundle;

/**
 * Controller for the reclamation form view
 */
public class ReclamationFormController implements Initializable {

    @FXML
    private Label lblTitle;
    
    @FXML
    private ComboBox<String> cmbType;
    
    @FXML
    private TextField txtUserId;
    
    @FXML
    private TextArea txtDescription;
    
    private ReclamationService reclamationService;
    private Reclamation editingReclamation;
    private boolean isEditMode = false;
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        reclamationService = new ReclamationService();
        
        // Initialize type combobox if not already done in FXML
        if (cmbType.getItems().isEmpty()) {
            cmbType.getItems().addAll("Technical Issue", "Billing Problem", "Feature Request", "Bug Report", "Other");
        }
    }
    
    /**
     * Initialize the form for editing an existing reclamation
     */
    public void initForEdit(Reclamation reclamation) {
        isEditMode = true;
        editingReclamation = reclamation;
        
        lblTitle.setText("Edit Reclamation");
        
        // Populate form fields
        cmbType.setValue(reclamation.getType());
        txtUserId.setText(String.valueOf(reclamation.getUserId()));
        txtDescription.setText(reclamation.getReclamation());
    }
    
    /**
     * Handle save button click
     */
    @FXML
    private void handleSave() {
        // Validate inputs
        if (cmbType.getValue() == null || cmbType.getValue().isEmpty()) {
            showAlert("Validation Error", "Type is required");
            return;
        }
        
        if (txtUserId.getText().isEmpty()) {
            showAlert("Validation Error", "User ID is required");
            return;
        }
        
        if (txtDescription.getText().isEmpty()) {
            showAlert("Validation Error", "Description is required");
            return;
        }
        
        try {
            int userId = Integer.parseInt(txtUserId.getText());
            
            if (isEditMode) {
                // Update existing reclamation
                editingReclamation.setType(cmbType.getValue());
                editingReclamation.setUserId(userId);
                editingReclamation.setReclamation(txtDescription.getText());
                
                boolean updated = reclamationService.updateReclamation(editingReclamation);
                if (updated) {
                    showAlert("Success", "Reclamation updated successfully");
                    navigateToReclamationList();
                } else {
                    showAlert("Error", "Failed to update reclamation");
                }
            } else {
                // Create new reclamation
                Reclamation newReclamation = new Reclamation();
                newReclamation.setType(cmbType.getValue());
                newReclamation.setUserId(userId);
                newReclamation.setReclamation(txtDescription.getText());
                // Set the current date and time
                newReclamation.setDate(LocalDateTime.now());
                
                int reclamationId = reclamationService.addReclamation(newReclamation);
                if (reclamationId > 0) {
                    showAlert("Success", "Reclamation created successfully");
                    navigateToReclamationList();
                } else {
                    showAlert("Error", "Failed to create reclamation");
                }
            }
        } catch (NumberFormatException e) {
            showAlert("Validation Error", "User ID must be a number");
        }
    }
    
    /**
     * Handle cancel button click
     */
    @FXML
    private void handleCancel() {
        navigateToReclamationList();
    }
    
    /**
     * Handle back to list button click
     */
    @FXML
    private void handleBackToList() {
        navigateToReclamationList();
    }
    
    /**
     * Navigate back to the reclamation list view
     */
    private void navigateToReclamationList() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/reclamation-list-view.fxml"));
            Parent view = loader.load();
            
            StackPane contentArea = (StackPane) txtDescription.getScene().lookup("#contentArea");
            if (contentArea != null) {
                contentArea.getChildren().clear();
                contentArea.getChildren().add(view);
            }
        } catch (IOException e) {
            e.printStackTrace();
            System.err.println("Error navigating to reclamation list: " + e.getMessage());
        }
    }
    
    /**
     * Show alert dialog
     */
    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}