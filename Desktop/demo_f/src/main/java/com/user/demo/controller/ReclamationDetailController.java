package com.user.demo.controller;

import com.user.demo.model.Reclamation;
import com.user.demo.model.Reponse;
import com.user.demo.service.ReclamationService;
import com.user.demo.service.ReponseService;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.layout.StackPane;

import java.io.IOException;
import java.net.URL;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.ResourceBundle;

/**
 * Controller for the reclamation detail view
 */
public class ReclamationDetailController implements Initializable {

    @FXML
    private Label lblId;
    
    @FXML
    private Label lblType;
    
    @FXML
    private Label lblUserId;
    
    @FXML
    private Label lblStatus;
    
    @FXML
    private Label lblCreationDate;
    
    @FXML
    private TextArea txtDescription;
    
    @FXML
    private ListView<Reponse> listReponses;
    
    private ReclamationService reclamationService;
    private ReponseService reponseService;
    private Reclamation currentReclamation;
    
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        reclamationService = new ReclamationService();
        reponseService = new ReponseService();
        
        // Configure the reponse list view
        listReponses.setCellFactory(lv -> new ListCell<>() {
            @Override
            protected void updateItem(Reponse item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || item == null) {
                    setText(null);
                } else {
                    setText(String.format("[%s] %s",
                            DATE_FORMATTER.format(item.getDate()),
                            item.getReponse()));
                }
            }
        });
    }
    
    /**
     * Initialize the view with reclamation data
     */
    public void initData(Reclamation reclamation) {
        this.currentReclamation = reclamation;
        
        // Populate fields
        lblId.setText(String.valueOf(reclamation.getId()));
        lblType.setText(reclamation.getType());
        lblUserId.setText(String.valueOf(reclamation.getUserId()));
        
        // Set status based on whether there's a reponse or not
        if (reclamation.getReponseId() != null) {
            lblStatus.setText("Resolved");
            lblStatus.getStyleClass().add("status-resolved");
        } else {
            lblStatus.setText("Pending");
            lblStatus.getStyleClass().add("status-pending");
        }
        
        lblCreationDate.setText(DATE_FORMATTER.format(reclamation.getDate()));
        txtDescription.setText(reclamation.getReclamation());
        
        // Load reponses
        loadReponses();
    }
    
    /**
     * Load reponses for this reclamation
     */
    private void loadReponses() {
        // Get only the responses for this specific reclamation
        if (currentReclamation != null) {
            List<Reponse> reponses;
            
            // If the reclamation has a response ID, load that specific response
            if (currentReclamation.getReponseId() != null) {
                Reponse reponse = reponseService.getReponseById(currentReclamation.getReponseId());
                if (reponse != null) {
                    reponses = List.of(reponse);
                } else {
                    reponses = List.of(); // Empty list if response not found
                }
            } else {
                // Otherwise, try to get responses by reclamation ID
                reponses = reponseService.getReponsesByReclamationId(currentReclamation.getId());
            }
            
            listReponses.setItems(FXCollections.observableArrayList(reponses));
        } else {
            // Clear the list if no reclamation is selected
            listReponses.setItems(FXCollections.observableArrayList());
        }
    }
    
    /**
     * Handle back to list button click
     */
    @FXML
    private void handleBackToList() {
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
     * Handle edit button click
     */
    @FXML
    private void handleEdit() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/reclamation-form-view.fxml"));
            Parent view = loader.load();
            
            ReclamationFormController controller = loader.getController();
            controller.initForEdit(currentReclamation);
            
            StackPane contentArea = (StackPane) txtDescription.getScene().lookup("#contentArea");
            if (contentArea != null) {
                contentArea.getChildren().clear();
                contentArea.getChildren().add(view);
            }
        } catch (IOException e) {
            e.printStackTrace();
            System.err.println("Error loading reclamation form for edit: " + e.getMessage());
        }
    }
    
    /**
     * Handle delete button click
     */
    @FXML
    private void handleDelete() {
        Alert confirmDialog = new Alert(Alert.AlertType.CONFIRMATION);
        confirmDialog.setTitle("Confirm Delete");
        confirmDialog.setHeaderText("Delete Reclamation");
        confirmDialog.setContentText("Are you sure you want to delete this reclamation?");
        
        confirmDialog.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                boolean deleted = reclamationService.deleteReclamation(currentReclamation.getId());
                if (deleted) {
                    handleBackToList(); // Navigate back to list
                } else {
                    showAlert("Error", "Failed to delete reclamation");
                }
            }
        });
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