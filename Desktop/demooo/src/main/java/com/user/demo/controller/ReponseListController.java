package com.user.demo.controller;

import com.user.demo.model.Reclamation;
import com.user.demo.model.Reponse;
import com.user.demo.service.ReclamationService;
import com.user.demo.service.ReponseService;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;

import java.net.URL;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.function.Predicate;

/**
 * Controller for the reponse list view
 */
public class ReponseListController implements Initializable {

    @FXML
    private FlowPane responsesContainer;
    
    @FXML
    private TextField txtSearch;
    
    @FXML
    private Label lblTotalRecords;
    
    private ReponseService reponseService;
    private ReclamationService reclamationService;
    private ObservableList<Reponse> reponsesData;
    private FilteredList<Reponse> filteredData;
    
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        reponseService = new ReponseService();
        reclamationService = new ReclamationService();
        
        // Add listener for search field
        txtSearch.textProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        
        // Load data
        loadReponses();
    }
    
    /**
     * Load all reponses from the database
     */
    private void loadReponses() {
        List<Reponse> reponses = reponseService.getAllReponses();
        reponsesData = FXCollections.observableArrayList(reponses);
        
        // Create filtered list wrapper
        filteredData = new FilteredList<>(reponsesData, p -> true);
        
        // Display the responses as cards
        displayReponseCards();
        
        // Update total records label
        updateTotalRecordsLabel();
    }
    
    /**
     * Display responses as cards
     */
    private void displayReponseCards() {
        responsesContainer.getChildren().clear();
        
        if (filteredData == null || filteredData.isEmpty()) {
            Label emptyLabel = new Label("No responses found");
            emptyLabel.getStyleClass().add("card-title");
            responsesContainer.getChildren().add(emptyLabel);
            return;
        }
        
        for (Reponse reponse : filteredData) {
            responsesContainer.getChildren().add(createReponseCard(reponse));
        }
    }
    
    /**
     * Create a card for a response
     */
    private VBox createReponseCard(Reponse reponse) {
        VBox card = new VBox();
        card.getStyleClass().addAll("card", "response-card");
        
        // Card header with ID and reclamation info
        HBox header = new HBox();
        header.getStyleClass().add("card-header");
        header.setAlignment(Pos.CENTER_LEFT);
        
        Label idBadge = new Label("#" + reponse.getId());
        idBadge.getStyleClass().add("card-id-badge");
        
        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        
        // Reclamation reference badge if available
        if (reponse.getReclamationId() != null) {
            Label reclamationLabel = new Label("Reclamation #" + reponse.getReclamationId());
            reclamationLabel.getStyleClass().add("card-type");
            HBox.setMargin(reclamationLabel, new Insets(0, 0, 0, 10));
            header.getChildren().addAll(idBadge, reclamationLabel, spacer);
            
            // Try to get more details about the reclamation
            Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
            if (reclamation != null) {
                Label reclamationTypeLabel = new Label(reclamation.getType());
                reclamationTypeLabel.getStyleClass().add("status-badge");
                if (reclamation.getReponseId() != null) {
                    reclamationTypeLabel.getStyleClass().add("status-resolved");
                } else {
                    reclamationTypeLabel.getStyleClass().add("status-pending");
                }
                header.getChildren().add(reclamationTypeLabel);
            }
        } else {
            header.getChildren().addAll(idBadge, spacer);
        }
        
        // Date
        Label dateLabel = new Label("Created: " + DATE_FORMATTER.format(reponse.getDate()));
        dateLabel.getStyleClass().add("card-date");
        
        // Response content
        Label contentLabel = new Label(truncateText(reponse.getReponse(), 100));
        contentLabel.getStyleClass().add("card-description");
        contentLabel.setWrapText(true);
        
        // Card footer with action buttons
        HBox footer = new HBox();
        footer.getStyleClass().add("card-footer");
        footer.setAlignment(Pos.CENTER_RIGHT);
        footer.setSpacing(5);
        
        // View button
        Button viewBtn = createActionButton(FontAwesomeIcon.EYE, "view-button");
        viewBtn.setOnAction(e -> viewReponse(reponse));
        
        // Edit button
        Button editBtn = createActionButton(FontAwesomeIcon.EDIT, "edit-button");
        editBtn.setOnAction(e -> editReponse(reponse));
        
        // Delete button
        Button deleteBtn = createActionButton(FontAwesomeIcon.TRASH, "delete-button");
        deleteBtn.setOnAction(e -> deleteReponse(reponse));
        
        footer.getChildren().addAll(viewBtn, editBtn, deleteBtn);
        
        // Add all components to the card
        card.getChildren().addAll(header, dateLabel, contentLabel, footer);
        VBox.setMargin(dateLabel, new Insets(5, 0, 5, 0));
        VBox.setMargin(contentLabel, new Insets(5, 0, 10, 0));
        
        return card;
    }
    
    /**
     * Create an action button with FontAwesome icon
     */
    private Button createActionButton(FontAwesomeIcon icon, String styleClass) {
        Button button = new Button();
        button.getStyleClass().addAll("card-action-button", styleClass);
        
        FontAwesomeIconView iconView = new FontAwesomeIconView(icon);
        iconView.setGlyphSize(14);
        iconView.setFill(Color.WHITE);
        
        button.setGraphic(iconView);
        return button;
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
    
    /**
     * Apply filters based on the search text
     */
    private void applyFilters() {
        if (filteredData == null) return;
        
        String searchText = txtSearch.getText().toLowerCase();
        
        Predicate<Reponse> searchPredicate = reponse -> 
            searchText.isEmpty() || 
            reponse.getReponse().toLowerCase().contains(searchText) ||
            String.valueOf(reponse.getId()).contains(searchText) ||
            (reponse.getReclamationId() != null && 
                String.valueOf(reponse.getReclamationId()).contains(searchText));
        
        filteredData.setPredicate(searchPredicate);
        
        // Update the display
        displayReponseCards();
        
        // Update total records label
        updateTotalRecordsLabel();
    }
    
    /**
     * Update the total records label with the count of filtered records
     */
    private void updateTotalRecordsLabel() {
        int totalRecords = filteredData != null ? filteredData.size() : 0;
        lblTotalRecords.setText("Total: " + totalRecords + " records");
    }
    
    /**
     * Handle the refresh button click
     */
    @FXML
    private void handleRefresh() {
        loadReponses();
    }
    
    /**
     * Handle the add reponse button click
     */
    @FXML
    private void handleAddReponse() {
        // Create a dialog
        Dialog<Reponse> dialog = new Dialog<>();
        dialog.setTitle("Add Reponse");
        dialog.setHeaderText(null); // Remove default header
        
        // Set the button types
        ButtonType saveButtonType = new ButtonType("Save", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveButtonType, ButtonType.CANCEL);
        
        // Apply CSS to the dialog
        DialogPane dialogPane = dialog.getDialogPane();
        dialogPane.getStylesheets().add(getClass().getResource("/com/user/demo/styles.css").toExternalForm());
        dialogPane.getStyleClass().add("custom-dialog");
        
        // Create the form layout with VBox as main container
        VBox mainContainer = new VBox();
        mainContainer.setSpacing(15);
        mainContainer.setPadding(new Insets(20));
        mainContainer.getStyleClass().add("form-container");
        
        // Title with icon
        HBox titleBox = new HBox();
        titleBox.setAlignment(Pos.CENTER_LEFT);
        titleBox.setSpacing(10);
        
        FontAwesomeIconView responseIcon = new FontAwesomeIconView(FontAwesomeIcon.REPLY);
        responseIcon.setGlyphSize(20);
        responseIcon.setFill(Color.valueOf("#3498db"));
        
        Label titleLabel = new Label("Add New Response");
        titleLabel.getStyleClass().add("form-title");
        
        titleBox.getChildren().addAll(responseIcon, titleLabel);
        
        // Content container
        GridPane grid = new GridPane();
        grid.setHgap(15);
        grid.setVgap(15);
        grid.setPadding(new Insets(20));
        grid.getStyleClass().add("form-grid");
        
        // Get all pending reclamations (those without a response)
        List<Reclamation> pendingReclamations = reclamationService.getAllReclamations().stream()
                .filter(r -> r.getReponseId() == null)
                .toList();
        
        // Create form components with labels
        Label reclamationLabel = new Label("Select Reclamation:");
        reclamationLabel.getStyleClass().add("form-label");
        
        ComboBox<Reclamation> cmbReclamation = new ComboBox<>(FXCollections.observableArrayList(pendingReclamations));
        cmbReclamation.setPromptText("Select a reclamation");
        cmbReclamation.getStyleClass().add("form-field");
        cmbReclamation.setPrefWidth(400);
        cmbReclamation.setCellFactory(lv -> new ListCell<>() {
            @Override
            protected void updateItem(Reclamation item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || item == null) {
                    setText(null);
                } else {
                    setText(String.format("ID: %d - %s", item.getId(), item.getType()));
                }
            }
        });
        cmbReclamation.setButtonCell(new ListCell<>() {
            @Override
            protected void updateItem(Reclamation item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || item == null) {
                    setText(null);
                } else {
                    setText(String.format("ID: %d - %s", item.getId(), item.getType()));
                }
            }
        });
        
        Label responseLabel = new Label("Response:");
        responseLabel.getStyleClass().add("form-label");
        
        TextArea txtReponse = new TextArea();
        txtReponse.setPromptText("Enter your response...");
        txtReponse.setPrefHeight(150);
        txtReponse.setWrapText(true);
        txtReponse.getStyleClass().add("form-field");
        
        // Reclamation details section with title
        VBox detailsContainer = new VBox(5);
        detailsContainer.getStyleClass().add("details-container");
        
        Label detailsHeaderLabel = new Label("Reclamation Details");
        detailsHeaderLabel.getStyleClass().addAll("form-label", "details-header");
        
        TextArea txtReclamationDetails = new TextArea();
        txtReclamationDetails.setEditable(false);
        txtReclamationDetails.setWrapText(true);
        txtReclamationDetails.setPrefHeight(120);
        txtReclamationDetails.getStyleClass().addAll("form-field", "details-area");
        
        detailsContainer.getChildren().addAll(detailsHeaderLabel, txtReclamationDetails);
        detailsContainer.setVisible(false);
        
        // Add components to grid
        grid.add(reclamationLabel, 0, 0);
        grid.add(cmbReclamation, 1, 0);
        grid.add(responseLabel, 0, 1);
        grid.add(txtReponse, 1, 1);
        grid.add(detailsContainer, 0, 2, 2, 1);
        
        // Set column constraints
        ColumnConstraints col1 = new ColumnConstraints();
        col1.setHgrow(Priority.NEVER);
        col1.setMinWidth(120);
        
        ColumnConstraints col2 = new ColumnConstraints();
        col2.setHgrow(Priority.ALWAYS);
        
        grid.getColumnConstraints().addAll(col1, col2);
        
        // Update reclamation details when selection changes
        cmbReclamation.valueProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                txtReclamationDetails.setText(String.format(
                        "ID: %d\nType: %s\nDate: %s\nDescription: %s",
                        newVal.getId(),
                        newVal.getType(),
                        DATE_FORMATTER.format(newVal.getDate()),
                        newVal.getReclamation()
                ));
                detailsContainer.setVisible(true);
            } else {
                txtReclamationDetails.setText("");
                detailsContainer.setVisible(false);
            }
        });
        
        // Configure the buttons at dialog's bottom
        Button saveButton = (Button) dialog.getDialogPane().lookupButton(saveButtonType);
        saveButton.getStyleClass().add("form-button");
        saveButton.setGraphic(new FontAwesomeIconView(FontAwesomeIcon.SAVE));
        
        Button cancelButton = (Button) dialog.getDialogPane().lookupButton(ButtonType.CANCEL);
        cancelButton.getStyleClass().addAll("form-button", "cancel-button");
        cancelButton.setGraphic(new FontAwesomeIconView(FontAwesomeIcon.TIMES));
        
        // Enable/Disable save button depending on whether a reclamation is selected and response text is entered
        saveButton.setDisable(true);
        
        // Validation listener
        txtReponse.textProperty().addListener((obs, oldVal, newVal) -> 
            saveButton.setDisable(cmbReclamation.getValue() == null || newVal.trim().isEmpty()));
        
        cmbReclamation.valueProperty().addListener((obs, oldVal, newVal) -> 
            saveButton.setDisable(newVal == null || txtReponse.getText().trim().isEmpty()));
        
        // Add all to main container
        mainContainer.getChildren().addAll(titleBox, grid);
        
        // Set the dialog content
        dialog.getDialogPane().setContent(mainContainer);
        
        // Convert the result to a Reponse object
        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == saveButtonType) {
                Reponse reponse = new Reponse();
                reponse.setReponse(txtReponse.getText().trim());
                reponse.setDate(LocalDateTime.now());
                reponse.setReclamationId(cmbReclamation.getValue().getId());
                return reponse;
            }
            return null;
        });
        
        // Show the dialog and process the result
        Optional<Reponse> result = dialog.showAndWait();
        
        result.ifPresent(reponse -> {
            // Save the response and link it to the reclamation
            int reponseId = reponseService.createAndLinkReponse(reponse, reponse.getReclamationId());
            
            if (reponseId > 0) {
                // Refresh the list
                loadReponses();
                showAlert(Alert.AlertType.INFORMATION, "Success", "Response added successfully.");
            } else {
                showAlert(Alert.AlertType.ERROR, "Error", "Failed to add response.");
            }
        });
    }
    
    /**
     * Handle the clear search button click
     */
    @FXML
    private void handleClearSearch() {
        txtSearch.clear();
        applyFilters();
    }
    
    /**
     * View a reponse's details
     */
    private void viewReponse(Reponse reponse) {
        // Create a dialog to show response details
        Dialog<Void> dialog = new Dialog<>();
        dialog.setTitle("View Reponse");
        dialog.setHeaderText("Reponse Details");
        
        // Add close button
        dialog.getDialogPane().getButtonTypes().add(ButtonType.CLOSE);
        
        // Create layout
        VBox content = new VBox(10);
        content.setPadding(new Insets(20));
        
        // Add fields
        content.getChildren().add(new Label("Reponse ID: " + reponse.getId()));
        
        if (reponse.getReclamationId() != null) {
            content.getChildren().add(new Label("Reclamation ID: " + reponse.getReclamationId()));
            
            // Get reclamation details if available
            Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
            if (reclamation != null) {
                TextArea txtReclamationDetails = new TextArea();
                txtReclamationDetails.setEditable(false);
                txtReclamationDetails.setWrapText(true);
                txtReclamationDetails.setPrefHeight(80);
                txtReclamationDetails.setText(String.format(
                        "Type: %s\nDate: %s\nDescription: %s",
                        reclamation.getType(),
                        DATE_FORMATTER.format(reclamation.getDate()),
                        reclamation.getReclamation()
                ));
                
                content.getChildren().add(new Label("Reclamation Details:"));
                content.getChildren().add(txtReclamationDetails);
            }
        }
        
        content.getChildren().add(new Label("Date: " + DATE_FORMATTER.format(reponse.getDate())));
        
        TextArea txtReponseContent = new TextArea(reponse.getReponse());
        txtReponseContent.setEditable(false);
        txtReponseContent.setWrapText(true);
        txtReponseContent.setPrefHeight(100);
        
        content.getChildren().add(new Label("Reponse Content:"));
        content.getChildren().add(txtReponseContent);
        
        dialog.getDialogPane().setContent(content);
        
        // Show the dialog
        dialog.showAndWait();
    }
    
    /**
     * Edit a reponse
     */
    private void editReponse(Reponse reponse) {
        // Create a dialog
        Dialog<Reponse> dialog = new Dialog<>();
        dialog.setTitle("Edit Reponse");
        dialog.setHeaderText(null); // Remove default header
        
        // Set the button types
        ButtonType saveButtonType = new ButtonType("Save", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveButtonType, ButtonType.CANCEL);
        
        // Apply CSS to the dialog
        DialogPane dialogPane = dialog.getDialogPane();
        dialogPane.getStylesheets().add(getClass().getResource("/com/user/demo/styles.css").toExternalForm());
        dialogPane.getStyleClass().add("custom-dialog");
        
        // Create the form layout with VBox as main container
        VBox mainContainer = new VBox();
        mainContainer.setSpacing(15);
        mainContainer.setPadding(new Insets(20));
        mainContainer.getStyleClass().add("form-container");
        
        // Title with icon
        HBox titleBox = new HBox();
        titleBox.setAlignment(Pos.CENTER_LEFT);
        titleBox.setSpacing(10);
        
        FontAwesomeIconView responseIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
        responseIcon.setGlyphSize(20);
        responseIcon.setFill(Color.valueOf("#f39c12"));
        
        Label titleLabel = new Label("Edit Response #" + reponse.getId());
        titleLabel.getStyleClass().add("form-title");
        
        titleBox.getChildren().addAll(responseIcon, titleLabel);
        
        // Content container
        GridPane grid = new GridPane();
        grid.setHgap(15);
        grid.setVgap(15);
        grid.setPadding(new Insets(20));
        grid.getStyleClass().add("form-grid");
        
        // Create form components with labels
        Label reclamationLabel = new Label("Reclamation ID:");
        reclamationLabel.getStyleClass().add("form-label");
        
        // Show reclamation ID (not editable)
        TextField txtReclamationId = new TextField();
        txtReclamationId.setEditable(false);
        txtReclamationId.getStyleClass().add("form-field");
        
        if (reponse.getReclamationId() != null) {
            txtReclamationId.setText(reponse.getReclamationId().toString());
        } else {
            txtReclamationId.setText("N/A");
        }
        
        Label responseLabel = new Label("Response:");
        responseLabel.getStyleClass().add("form-label");
        
        TextArea txtReponse = new TextArea(reponse.getReponse());
        txtReponse.setPromptText("Enter your response...");
        txtReponse.setPrefHeight(150);
        txtReponse.setWrapText(true);
        txtReponse.getStyleClass().add("form-field");
        
        // Add components to grid
        grid.add(reclamationLabel, 0, 0);
        grid.add(txtReclamationId, 1, 0);
        grid.add(responseLabel, 0, 1);
        grid.add(txtReponse, 1, 1);
        
        // Set column constraints
        ColumnConstraints col1 = new ColumnConstraints();
        col1.setHgrow(Priority.NEVER);
        col1.setMinWidth(120);
        
        ColumnConstraints col2 = new ColumnConstraints();
        col2.setHgrow(Priority.ALWAYS);
        
        grid.getColumnConstraints().addAll(col1, col2);
        
        // Reclamation details section
        if (reponse.getReclamationId() != null) {
            // Show reclamation details if available
            Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
            if (reclamation != null) {
                VBox detailsContainer = new VBox(5);
                detailsContainer.getStyleClass().add("details-container");
                
                Label detailsHeaderLabel = new Label("Reclamation Details");
                detailsHeaderLabel.getStyleClass().addAll("form-label", "details-header");
                
                TextArea txtReclamationDetails = new TextArea();
                txtReclamationDetails.setEditable(false);
                txtReclamationDetails.setWrapText(true);
                txtReclamationDetails.setPrefHeight(120);
                txtReclamationDetails.getStyleClass().addAll("form-field", "details-area");
                txtReclamationDetails.setText(String.format(
                        "Type: %s\nDate: %s\nDescription: %s",
                        reclamation.getType(),
                        DATE_FORMATTER.format(reclamation.getDate()),
                        reclamation.getReclamation()
                ));
                
                detailsContainer.getChildren().addAll(detailsHeaderLabel, txtReclamationDetails);
                
                grid.add(detailsContainer, 0, 2, 2, 1);
            }
        }
        
        // Configure the buttons at dialog's bottom
        Button saveButton = (Button) dialog.getDialogPane().lookupButton(saveButtonType);
        saveButton.getStyleClass().add("form-button");
        saveButton.setGraphic(new FontAwesomeIconView(FontAwesomeIcon.SAVE));
        
        Button cancelButton = (Button) dialog.getDialogPane().lookupButton(ButtonType.CANCEL);
        cancelButton.getStyleClass().addAll("form-button", "cancel-button");
        cancelButton.setGraphic(new FontAwesomeIconView(FontAwesomeIcon.TIMES));
        
        // Enable/Disable save button depending on whether response text is entered
        saveButton.setDisable(txtReponse.getText().trim().isEmpty());
        
        // Validation listener
        txtReponse.textProperty().addListener((obs, oldVal, newVal) -> 
            saveButton.setDisable(newVal.trim().isEmpty()));
        
        // Add all to main container
        mainContainer.getChildren().addAll(titleBox, grid);
        
        // Set the dialog content
        dialog.getDialogPane().setContent(mainContainer);
        
        // Add current time info
        HBox timeBox = new HBox();
        timeBox.setAlignment(Pos.CENTER_LEFT);
        timeBox.setSpacing(5);
        
        FontAwesomeIconView clockIcon = new FontAwesomeIconView(FontAwesomeIcon.CLOCK_ALT);
        clockIcon.setGlyphSize(14);
        clockIcon.setFill(Color.valueOf("#7f8c8d"));
        
        Label timeLabel = new Label("Original response created: " + DATE_FORMATTER.format(reponse.getDate()));
        timeLabel.getStyleClass().add("card-date");
        
        timeBox.getChildren().addAll(clockIcon, timeLabel);
        mainContainer.getChildren().add(timeBox);
        
        // Convert the result to a Reponse object
        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == saveButtonType) {
                Reponse updatedReponse = new Reponse();
                updatedReponse.setId(reponse.getId());
                updatedReponse.setReponse(txtReponse.getText().trim());
                updatedReponse.setDate(LocalDateTime.now());
                updatedReponse.setReclamationId(reponse.getReclamationId());
                return updatedReponse;
            }
            return null;
        });
        
        // Show the dialog and process the result
        Optional<Reponse> result = dialog.showAndWait();
        
        result.ifPresent(updatedReponse -> {
            // Update the response
            boolean updated = reponseService.updateReponse(updatedReponse);
            
            if (updated) {
                // Refresh the list
                loadReponses();
                showAlert(Alert.AlertType.INFORMATION, "Success", "Response updated successfully.");
            } else {
                showAlert(Alert.AlertType.ERROR, "Error", "Failed to update response.");
            }
        });
    }
    
    /**
     * Delete a reponse
     */
    private void deleteReponse(Reponse reponse) {
        // Implement delete reponse logic
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Delete Reponse");
        confirmation.setHeaderText("Delete Reponse");
        confirmation.setContentText("Are you sure you want to delete this reponse?");
        
        confirmation.showAndWait().ifPresent(buttonType -> {
            if (buttonType == ButtonType.OK) {
                try {
                    // First, check if this response is linked to a reclamation
                    if (reponse.getReclamationId() != null) {
                        // Get the reclamation
                        Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
                        if (reclamation != null && reclamation.getReponseId() != null && 
                            reclamation.getReponseId().equals(reponse.getId())) {
                            // Remove the response reference from the reclamation
                            reclamation.setReponseId(null);
                            // Update the reclamation
                            boolean updated = reclamationService.updateReclamation(reclamation);
                            if (!updated) {
                                showAlert(Alert.AlertType.ERROR, "Error", 
                                    "Failed to update the reclamation reference. Cannot delete the response.");
                                return;
                            }
                        }
                    }
                    
                    // Now we can delete the response
                    boolean deleted = reponseService.deleteReponse(reponse.getId());
                    if (deleted) {
                        loadReponses(); // Refresh the list
                        showAlert(Alert.AlertType.INFORMATION, "Success", "Response deleted successfully.");
                    } else {
                        showAlert(Alert.AlertType.ERROR, "Error", "Failed to delete the reponse.");
                    }
                } catch (Exception e) {
                    showAlert(Alert.AlertType.ERROR, "Error", 
                        "Error deleting response: " + e.getMessage());
                    e.printStackTrace();
                }
            }
        });
    }
    
    /**
     * Show an alert dialog
     */
    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}