package com.user.demo.controller;

import com.user.demo.model.Reclamation;
import com.user.demo.model.Reponse;
import com.user.demo.service.ReponseService;
import com.user.demo.service.ReclamationService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Node;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class AdminResponseController {
    @FXML private FlowPane responseCards;
    @FXML private TextField searchField;
    @FXML private ComboBox<String> statusFilter;
    @FXML private Label totalItemsLabel;
    @FXML private VBox emptyState;
    @FXML private StackPane loadingPane;

    private ReponseService reponseService;
    private ReclamationService reclamationService;
    private ObservableList<Reponse> reponses;
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");

    @FXML
    public void initialize() {
        reponseService = new ReponseService();
        reclamationService = new ReclamationService();
        
        // Initialize status filter
        statusFilter.getItems().addAll("All", "Pending", "Resolved", "In Progress");
        statusFilter.setValue("All");
        
        // Load data
        refreshData();
    }

    @FXML
    public void refreshData() {
        if (loadingPane != null) {
            loadingPane.setVisible(true);
            loadingPane.setManaged(true);
        }
        
        List<Reponse> reponseList = reponseService.getAllReponses();
        reponses = FXCollections.observableArrayList(reponseList);
        updateCards(reponses);
        
        if (loadingPane != null) {
            loadingPane.setVisible(false);
            loadingPane.setManaged(false);
        }
    }

    private void updateCards(ObservableList<Reponse> reponseList) {
        responseCards.getChildren().clear();
        
        if (reponseList.isEmpty()) {
            emptyState.setVisible(true);
            emptyState.setManaged(true);
        } else {
            emptyState.setVisible(false);
            emptyState.setManaged(false);
            
            for (Reponse reponse : reponseList) {
                responseCards.getChildren().add(createResponseCard(reponse));
            }
        }
        
        updateItemCount();
    }

    private VBox createResponseCard(Reponse reponse) {
        VBox card = new VBox();
        card.getStyleClass().addAll("card");
        card.setSpacing(10);
        card.setPrefWidth(330);

        // Header with response ID and reclamation info
        HBox header = new HBox();
        header.getStyleClass().add("card-header");
        header.setAlignment(Pos.CENTER_LEFT);
        header.setSpacing(10);

        Label idBadge = new Label("#" + reponse.getId());
        idBadge.getStyleClass().add("card-id-badge");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        // Status badge if available
        Label statusBadge = new Label(reponse.getStatus() != null ? reponse.getStatus() : "Pending");
        statusBadge.getStyleClass().addAll("status-badge", 
            getStatusStyleClass(reponse.getStatus()));

        header.getChildren().addAll(idBadge, spacer, statusBadge);

        // Content section
        VBox content = new VBox(8);
        content.getStyleClass().add("card-content");

        // Reclamation reference with icon
        if (reponse.getReclamationId() != null) {
            HBox reclamationBox = new HBox(10);
            reclamationBox.setAlignment(Pos.CENTER_LEFT);
            
            FontAwesomeIconView reclamationIcon = new FontAwesomeIconView(FontAwesomeIcon.EXCLAMATION_CIRCLE);
            reclamationIcon.setGlyphSize(14);
            reclamationIcon.setFill(Color.valueOf("#7f8c8d"));

            Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
            String reclamationText = reclamation != null ? 
                String.format("Reclamation #%d - %s", reclamation.getId(), reclamation.getType()) :
                "Reclamation #" + reponse.getReclamationId();

            Label reclamationLabel = new Label(reclamationText);
            reclamationLabel.getStyleClass().add("card-type");
            
            reclamationBox.getChildren().addAll(reclamationIcon, reclamationLabel);
            content.getChildren().add(reclamationBox);
        }

        // Response text
        Label responseLabel = new Label(truncateText(reponse.getReponse(), 150));
        responseLabel.getStyleClass().add("card-description");
        responseLabel.setWrapText(true);
        content.getChildren().add(responseLabel);

        // Date with icon
        HBox dateBox = new HBox(10);
        dateBox.setAlignment(Pos.CENTER_LEFT);
        
        FontAwesomeIconView clockIcon = new FontAwesomeIconView(FontAwesomeIcon.CLOCK_ALT);
        clockIcon.setGlyphSize(14);
        clockIcon.setFill(Color.valueOf("#7f8c8d"));

        Label dateLabel = new Label(DATE_FORMATTER.format(reponse.getDate()));
        dateLabel.getStyleClass().add("card-date");

        dateBox.getChildren().addAll(clockIcon, dateLabel);
        content.getChildren().add(dateBox);

        // Action buttons
        HBox actions = new HBox();
        actions.getStyleClass().add("card-footer");
        actions.setAlignment(Pos.CENTER_RIGHT);
        actions.setSpacing(8);

        Button viewBtn = createActionButton(FontAwesomeIcon.EYE, "view-button");
        viewBtn.setTooltip(new Tooltip("View Response"));
        viewBtn.setOnAction(event -> handleViewResponse(reponse));

        Button editBtn = createActionButton(FontAwesomeIcon.EDIT, "edit-button");
        editBtn.setTooltip(new Tooltip("Edit Response"));
        editBtn.setOnAction(event -> handleEditResponse(reponse));

        Button deleteBtn = createActionButton(FontAwesomeIcon.TRASH, "delete-button");
        deleteBtn.setTooltip(new Tooltip("Delete Response"));
        deleteBtn.setOnAction(event -> handleDeleteResponse(reponse));

        actions.getChildren().addAll(viewBtn, editBtn, deleteBtn);

        // Add all sections to card
        card.getChildren().addAll(header, content, actions);
        
        return card;
    }

    private Button createActionButton(FontAwesomeIcon icon, String styleClass) {
        Button button = new Button();
        button.getStyleClass().addAll("card-action-button", styleClass);
        
        FontAwesomeIconView iconView = new FontAwesomeIconView(icon);
        iconView.setGlyphSize(14);
        iconView.setFill(Color.WHITE);
        
        button.setGraphic(iconView);
        return button;
    }

    private String getStatusStyleClass(String status) {
        if (status == null) return "status-pending";
        switch (status.toLowerCase()) {
            case "resolved":
                return "status-resolved";
            case "in progress":
                return "status-processing";
            default:
                return "status-pending";
        }
    }

    private String truncateText(String text, int maxLength) {
        if (text == null || text.length() <= maxLength) {
            return text;
        }
        return text.substring(0, maxLength - 3) + "...";
    }

    @FXML
    public void handleSearch() {
        String searchText = searchField.getText().trim().toLowerCase();
        String status = statusFilter.getValue();
        
        ObservableList<Reponse> filteredList = reponses.filtered(reponse -> 
            (searchText.isEmpty() || 
             (reponse.getReponse() != null && reponse.getReponse().toLowerCase().contains(searchText)) ||
             String.valueOf(reponse.getId()).contains(searchText) ||
             (reponse.getReclamationId() != null && 
              String.valueOf(reponse.getReclamationId()).contains(searchText))) &&
            (status.equals("All") || (reponse.getStatus() != null && reponse.getStatus().equals(status)))
        );
        
        updateCards(filteredList);
    }

    @FXML
    public void handleClearFilters() {
        searchField.clear();
        statusFilter.setValue("All");
        refreshData();
    }

    private void handleViewResponse(Reponse reponse) {
        Dialog<Void> dialog = new Dialog<>();
        dialog.setTitle("Response Details");
        dialog.setHeaderText(null);
        dialog.getDialogPane().getButtonTypes().add(ButtonType.CLOSE);
        
        VBox content = new VBox(15);
        content.setPadding(new Insets(20));
        content.getStyleClass().add("content-container");
        
        // Response ID and date
        content.getChildren().addAll(
            new Label("Response ID: " + reponse.getId()),
            new Label("Date: " + DATE_FORMATTER.format(reponse.getDate()))
        );
        
        // Reclamation details if available
        if (reponse.getReclamationId() != null) {
            Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
            if (reclamation != null) {
                TextArea reclamationDetails = new TextArea(String.format(
                    "Type: %s\nDescription: %s",
                    reclamation.getType(),
                    reclamation.getReclamation()
                ));
                reclamationDetails.setEditable(false);
                reclamationDetails.setWrapText(true);
                reclamationDetails.setPrefRowCount(3);
                
                content.getChildren().addAll(
                    new Label("Reclamation Details:"),
                    reclamationDetails
                );
            }
        }
        
        // Response text
        Label responseLabel = new Label("Response:");
        TextArea responseText = new TextArea(reponse.getReponse());
        responseText.setEditable(false);
        responseText.setWrapText(true);
        responseText.setPrefRowCount(4);
        
        content.getChildren().addAll(responseLabel, responseText);
        
        // Status
        if (reponse.getStatus() != null) {
            Label statusLabel = new Label("Status: " + reponse.getStatus());
            statusLabel.getStyleClass().add(getStatusStyleClass(reponse.getStatus()));
            content.getChildren().add(statusLabel);
        }
        
        dialog.getDialogPane().setContent(content);
        dialog.getDialogPane().getStylesheets().add(getClass().getResource("/com/user/demo/styles.css").toExternalForm());
        
        dialog.showAndWait();
    }

    private void handleEditResponse(Reponse reponse) {
        Dialog<Reponse> dialog = new Dialog<>();
        dialog.setTitle("Edit Response");
        dialog.setHeaderText(null);

        ButtonType saveButtonType = new ButtonType("Save", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveButtonType, ButtonType.CANCEL);

        VBox content = new VBox(15);
        content.setPadding(new Insets(20));
        content.getStyleClass().add("form-container");

        // Response text field
        Label responseLabel = new Label("Response:");
        TextArea responseText = new TextArea(reponse.getReponse());
        responseText.setWrapText(true);
        responseText.setPrefRowCount(4);

        // Status combobox
        Label statusLabel = new Label("Status:");
        ComboBox<String> statusCombo = new ComboBox<>();
        statusCombo.getItems().addAll("Pending", "In Progress", "Resolved");
        statusCombo.setValue(reponse.getStatus() != null ? reponse.getStatus() : "Pending");

        content.getChildren().addAll(responseLabel, responseText, statusLabel, statusCombo);

        // Show reclamation details if available
        if (reponse.getReclamationId() != null) {
            Reclamation reclamation = reclamationService.getReclamationById(reponse.getReclamationId());
            if (reclamation != null) {
                TextArea reclamationDetails = new TextArea(String.format(
                    "Type: %s\nDescription: %s",
                    reclamation.getType(),
                    reclamation.getReclamation()
                ));
                reclamationDetails.setEditable(false);
                reclamationDetails.setWrapText(true);
                reclamationDetails.setPrefRowCount(3);
                
                content.getChildren().addAll(
                    new Label("Reclamation Details:"),
                    reclamationDetails
                );
            }
        }

        dialog.getDialogPane().setContent(content);
        dialog.getDialogPane().getStylesheets().add(getClass().getResource("/com/user/demo/styles.css").toExternalForm());

        // Enable/Disable save button depending on whether response text is empty
        Node saveButton = dialog.getDialogPane().lookupButton(saveButtonType);
        saveButton.getStyleClass().add("form-button");
        saveButton.setDisable(responseText.getText().trim().isEmpty());

        responseText.textProperty().addListener((observable, oldValue, newValue) -> 
            saveButton.setDisable(newValue.trim().isEmpty()));

        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == saveButtonType) {
                Reponse updatedReponse = new Reponse();
                updatedReponse.setId(reponse.getId());
                updatedReponse.setReponse(responseText.getText().trim());
                updatedReponse.setReclamationId(reponse.getReclamationId());
                updatedReponse.setDate(reponse.getDate());
                updatedReponse.setStatus(statusCombo.getValue());
                return updatedReponse;
            }
            return null;
        });

        dialog.showAndWait().ifPresent(updatedReponse -> {
            if (reponseService.updateReponse(updatedReponse)) {
                refreshData();
                showAlert(Alert.AlertType.INFORMATION, "Success", "Response updated successfully");
            } else {
                showAlert(Alert.AlertType.ERROR, "Error", "Failed to update response");
            }
        });
    }

    private void handleDeleteResponse(Reponse reponse) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Delete Response");
        confirmation.setHeaderText("Delete Response #" + reponse.getId());
        confirmation.setContentText("Are you sure you want to delete this response?");

        confirmation.showAndWait().ifPresent(result -> {
            if (result == ButtonType.OK) {
                if (reponseService.deleteReponse(reponse.getId())) {
                    refreshData();
                    showAlert(Alert.AlertType.INFORMATION, "Success", "Response deleted successfully");
                } else {
                    showAlert(Alert.AlertType.ERROR, "Error", "Failed to delete response");
                }
            }
        });
    }

    private void updateItemCount() {
        int total = reponses.size();
        int filtered = responseCards.getChildren().size();
        totalItemsLabel.setText(String.format("Showing %d of %d responses", filtered, total));
    }

    private void showAlert(Alert.AlertType type, String title, String message) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}