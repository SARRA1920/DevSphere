package com.user.demo.controller;

import com.user.demo.model.Reclamation;
import com.user.demo.model.Reponse;
import com.user.demo.service.ReclamationService;
import com.user.demo.service.ReponseService;
import com.user.demo.util.SessionManager;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import javafx.scene.text.Text;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class AdminReclamationController {
    @FXML
    private TextField searchField;
    @FXML
    private ComboBox<String> statusFilter;
    @FXML
    private ComboBox<String> typeFilter;
    @FXML
    private FlowPane reclamationCards;
    @FXML
    private Label totalRecordsLabel;
    @FXML
    private Pagination pagination;
    @FXML
    private VBox emptyState;

    private ReclamationService reclamationService;
    private ObservableList<Reclamation> reclamations;

    @FXML
    public void initialize() {
        reclamationService = new ReclamationService();
        initializeFilters();
        loadReclamations();
    }

    private void initializeFilters() {
        statusFilter.setItems(FXCollections.observableArrayList(
            "All", "Pending", "In Progress", "Resolved", "Closed"
        ));
        statusFilter.setValue("All");

        typeFilter.setItems(FXCollections.observableArrayList(
            "All", "Technical", "Billing", "Service", "Other"
        ));
        typeFilter.setValue("All");
    }

    private void initializeCards() {
        reclamationCards.getChildren().clear();
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd MMM yyyy");

        for (Reclamation reclamation : reclamations) {
            // Main card container
            VBox card = new VBox();
            card.getStyleClass().addAll("card", "reclamation-card");
            card.setSpacing(10);

            // Card Header with modern styling
            HBox header = new HBox();
            header.getStyleClass().add("card-header");
            header.setAlignment(Pos.CENTER_LEFT);
            header.setSpacing(10);

            // ID Badge
            Label idBadge = new Label("#" + reclamation.getId());
            idBadge.getStyleClass().add("card-id-badge");

            // Title - extract from reclamation text
            String titleText = extractTitle(reclamation.getReclamation());
            Label titleLabel = new Label(titleText);
            titleLabel.getStyleClass().add("card-title");
            titleLabel.setWrapText(true);
            
            VBox titleBox = new VBox(5);
            titleBox.getChildren().addAll(titleLabel);
            HBox.setHgrow(titleBox, Priority.ALWAYS);
            HBox.setMargin(titleBox, new Insets(0, 0, 0, 10));

            // Type Badge
            Label typeLabel = new Label(reclamation.getType());
            typeLabel.getStyleClass().add("card-type");

            // Status badge
            String status = reclamation.getReponseId() != null ? "Resolved" : "Pending";
            Label statusLabel = new Label(status);
            statusLabel.getStyleClass().add("status-badge");
            
            if ("Resolved".equals(status)) {
                statusLabel.getStyleClass().add("status-resolved");
            } else {
                statusLabel.getStyleClass().add("status-pending");
            }

            Region spacer = new Region();
            HBox.setHgrow(spacer, Priority.ALWAYS);

            header.getChildren().addAll(idBadge, titleBox, spacer, statusLabel);

            // Info row with type and date
            HBox infoRow = new HBox(10);
            infoRow.setAlignment(Pos.CENTER_LEFT);
            
            // Date formatted nicely
            String formattedDate = reclamation.getDate() != null ? 
                formatter.format(reclamation.getDate()) : "No date";
            Label dateLabel = new Label("Created: " + formattedDate);
            dateLabel.getStyleClass().add("card-date");
            
            Region infoSpacer = new Region();
            HBox.setHgrow(infoSpacer, Priority.ALWAYS);
            
            infoRow.getChildren().addAll(typeLabel, infoSpacer, dateLabel);

            // Description with proper wrapping
            VBox content = new VBox(8);
            content.getStyleClass().add("card-content");

            Label descriptionLabel = new Label(truncateText(reclamation.getReclamation(), 150));
            descriptionLabel.getStyleClass().add("card-description");
            descriptionLabel.setWrapText(true);

            content.getChildren().add(descriptionLabel);
            
            // Add user ID info
            Label userLabel = new Label("From User #" + reclamation.getUserId());
            userLabel.getStyleClass().add("reclamation-user");
            content.getChildren().add(userLabel);

            // Footer with action buttons
            HBox footer = new HBox();
            footer.getStyleClass().add("card-footer");
            footer.setAlignment(Pos.CENTER_RIGHT);
            footer.setSpacing(8);

            // Create a respond button with icon
            Button respondButton = new Button("Respond");
            respondButton.getStyleClass().addAll("card-action-button", "view-button");

            FontAwesomeIconView replyIcon = new FontAwesomeIconView();
            replyIcon.setGlyphName("REPLY");
            replyIcon.setGlyphSize(14);
            replyIcon.setFill(Color.WHITE);
            respondButton.setGraphic(replyIcon);
            respondButton.setTooltip(new Tooltip("Respond to reclamation"));

            respondButton.setOnAction(e -> handleRespondReclamation(reclamation));

            footer.getChildren().add(respondButton);

            // Add all components to card
            card.getChildren().addAll(header, infoRow, content, footer);
            VBox.setMargin(infoRow, new Insets(8, 0, 0, 0));

            // Add to reclamations container
            reclamationCards.getChildren().add(card);
        }
        
        // Show empty state if no reclamations
        if (reclamations.isEmpty()) {
            if (emptyState != null) {
                emptyState.setVisible(true);
                emptyState.setManaged(true);
            }
        } else {
            if (emptyState != null) {
                emptyState.setVisible(false);
                emptyState.setManaged(false);
            }
        }
    }

    /**
     * Extract a short title from the reclamation text
     */
    private String extractTitle(String text) {
        if (text == null || text.isEmpty()) {
            return "Untitled Reclamation";
        }
        
        // Get first sentence or first 40 characters
        int endIndex = Math.min(text.length(), 40);
        String title = text.substring(0, endIndex);
        
        // Find first sentence end if it exists
        int sentenceEnd = title.indexOf('.');
        if (sentenceEnd > 0) {
            title = title.substring(0, sentenceEnd + 1);
        } else if (text.length() > 40) {
            title += "...";
        }
        
        return title;
    }
    
    /**
     * Truncate text to a certain length and add ellipsis if needed
     */
    private String truncateText(String text, int maxLength) {
        if (text == null || text.length() <= maxLength) {
            return text;
        }
        return text.substring(0, maxLength - 3) + "...";
    }

    private void loadReclamations() {
        List<Reclamation> reclamationList = reclamationService.getAllReclamations();
        reclamations = FXCollections.observableArrayList(reclamationList);
        initializeCards();
        updateTotalRecords();
    }

    @FXML
    private void handleSearch() {
        String searchText = searchField.getText().toLowerCase();
        String status = statusFilter.getValue();
        String type = typeFilter.getValue();

        ObservableList<Reclamation> filteredList = reclamations.filtered(reclamation ->
            (searchText.isEmpty() || reclamation.getReclamation().toLowerCase().contains(searchText)) &&
            (status.equals("All") || (reclamation.getReponseId() != null ? "Resolved" : "Pending").equals(status)) &&
            (type.equals("All") || reclamation.getType().equals(type))
        );

        reclamations = filteredList;
        initializeCards();
        updateTotalRecords();
    }

    @FXML
    private void handleClearFilters() {
        searchField.clear();
        statusFilter.setValue("All");
        typeFilter.setValue("All");
        
        // Reload all reclamations
        loadReclamations();
    }

    private void handleRespondReclamation(Reclamation reclamation) {
        if (reclamation != null) {
            // Create a dialog
            Stage dialog = new Stage();
            dialog.initModality(Modality.APPLICATION_MODAL);
            dialog.initStyle(StageStyle.UNDECORATED);
            dialog.setTitle("Respond to Reclamation #" + reclamation.getId());
            
            // Create dialog content
            VBox dialogContent = new VBox(15);
            dialogContent.getStyleClass().add("content-container");
            dialogContent.setMaxWidth(600);
            dialogContent.setPadding(new Insets(25));
            
            // Header with close button
            HBox header = new HBox();
            header.setAlignment(Pos.CENTER_LEFT);
            
            Label title = new Label("Respond to Reclamation #" + reclamation.getId());
            title.getStyleClass().add("form-title");
            
            Region spacer = new Region();
            HBox.setHgrow(spacer, Priority.ALWAYS);
            
            Button closeButton = new Button();
            closeButton.getStyleClass().add("close-button");
            FontAwesomeIconView closeIcon = new FontAwesomeIconView();
            closeIcon.setGlyphName("TIMES");
            closeIcon.setFill(Color.WHITE);
            closeButton.setGraphic(closeIcon);
            closeButton.setOnAction(e -> dialog.close());
            
            header.getChildren().addAll(title, spacer, closeButton);
            
            // Reclamation details section
            VBox reclamationDetails = new VBox(10);
            reclamationDetails.getStyleClass().add("details-container");
            reclamationDetails.setPadding(new Insets(15));
            
            Label typeLabel = new Label("Type: " + reclamation.getType());
            typeLabel.getStyleClass().add("details-header");
            
            Label dateLabel = new Label("Date: " + 
                (reclamation.getDate() != null ? 
                    reclamation.getDate().format(DateTimeFormatter.ofPattern("dd MMM yyyy HH:mm")) : 
                    "Not specified"));
            dateLabel.getStyleClass().add("details-header");
            
            TextArea reclamationText = new TextArea(reclamation.getReclamation());
            reclamationText.getStyleClass().add("details-area");
            reclamationText.setEditable(false);
            reclamationText.setWrapText(true);
            reclamationText.setPrefHeight(100);
            
            reclamationDetails.getChildren().addAll(typeLabel, dateLabel, reclamationText);
            
            // Response form
            VBox responseForm = new VBox(10);
            
            Label responseLabel = new Label("Your Response:");
            responseLabel.getStyleClass().add("form-label");
            
            TextArea responseText = new TextArea();
            responseText.getStyleClass().add("form-field");
            responseText.setWrapText(true);
            responseText.setPrefHeight(150);
            
            ComboBox<String> statusCombo = new ComboBox<>();
            statusCombo.getStyleClass().add("form-field");
            statusCombo.setItems(FXCollections.observableArrayList("Resolved", "In Progress", "Need More Info"));
            statusCombo.setValue("Resolved");
            statusCombo.setPromptText("Select Status");
            
            responseForm.getChildren().addAll(responseLabel, responseText, new Label("Status:"), statusCombo);
            
            // Buttons
            HBox buttonBar = new HBox(10);
            buttonBar.setAlignment(Pos.CENTER_RIGHT);
            
            Button cancelBtn = new Button("Cancel");
            cancelBtn.getStyleClass().addAll("form-button", "cancel-button");
            cancelBtn.setOnAction(e -> dialog.close());
            
            Button submitBtn = new Button("Submit Response");
            submitBtn.getStyleClass().add("form-button");
            submitBtn.setOnAction(e -> {
                if (validateAndSubmitResponse(reclamation, responseText.getText(), statusCombo.getValue(), dialog)) {
                    dialog.close();
                    // Refresh the reclamation cards
                    loadReclamations();
                }
            });
            
            buttonBar.getChildren().addAll(cancelBtn, submitBtn);
            
            // Add all components to dialog
            dialogContent.getChildren().addAll(header, reclamationDetails, responseForm, buttonBar);
            
            // Set up scene
            Scene scene = new Scene(dialogContent);
            scene.getStylesheets().add(getClass().getResource("/com/user/demo/styles.css").toExternalForm());
            
            dialog.setScene(scene);
            dialog.showAndWait();
        }
    }
    
    /**
     * Validate response data and submit to database
     */
    private boolean validateAndSubmitResponse(Reclamation reclamation, String responseText, String status, Stage dialog) {
        // Validate input
        if (responseText == null || responseText.trim().isEmpty()) {
            showAlert(Alert.AlertType.ERROR, "Error", "Response text cannot be empty");
            return false;
        }
        
        try {
            // Create response object
            Reponse reponse = new Reponse();
            reponse.setReponse(responseText);
            reponse.setDate(LocalDateTime.now());
            reponse.setReclamationId(reclamation.getId());
            
            // Save response using service
            ReponseService reponseService = new ReponseService();
            boolean success = reponseService.addReponse(reponse) > 0; // Convert int to boolean
            
            if (success) {
                // Update reclamation status if needed
                ReclamationService reclamationService = new ReclamationService();
                reclamation.setReponseId(reponse.getId());
                reclamationService.updateReclamation(reclamation);
                
                showAlert(Alert.AlertType.INFORMATION, "Success", "Response submitted successfully");
                return true;
            } else {
                showAlert(Alert.AlertType.ERROR, "Error", "Failed to submit response");
                return false;
            }
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Error", "An error occurred: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Display an alert dialog
     */
    private void showAlert(Alert.AlertType type, String title, String message) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    private void updateTotalRecords() {
        int total = reclamations.size();
        totalRecordsLabel.setText(String.format("Total: %d records", total));
    }

    private void showError(String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle("Error");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}