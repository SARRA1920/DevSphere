package com.user.demo.controller;

import com.user.demo.model.User;
import com.user.demo.model.Reclamation;
import com.user.demo.service.ReclamationService;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;

import java.io.IOException;
import java.net.URL;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.ResourceBundle;
import java.util.function.Predicate;

/**
 * Controller for the reclamation list view
 */
public class ReclamationListController implements Initializable {

    @FXML
    private FlowPane reclamationsContainer;
    
    @FXML
    private TextField txtSearch;
    
    @FXML
    private ComboBox<String> cmbFilterType;
    
    @FXML
    private ComboBox<String> cmbFilterStatus;
    
    @FXML
    private Pagination pagination;
    
    @FXML
    private Label lblTotalRecords;
    
    private ReclamationService reclamationService;
    private ObservableList<Reclamation> reclamationsData;
    private FilteredList<Reclamation> filteredData;
    
    private static final int ITEMS_PER_PAGE = 9;
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
    
    private User currentUser;

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        reclamationService = new ReclamationService();
        
        // Initialize filter comboboxes
        cmbFilterType.getItems().addAll("All Types", "bug", "feature", "support", "other");
        cmbFilterType.setValue("All Types");
        
        cmbFilterStatus.getItems().addAll("All Statuses", "Pending", "Resolved");
        cmbFilterStatus.setValue("All Statuses");
        
        // Add listeners for filtering
        cmbFilterType.valueProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        cmbFilterStatus.valueProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        txtSearch.textProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        
        // Load data
        loadReclamations();
        
        // Configure pagination
        configurePagination();
    }
    
    /**
     * Load all reclamations from the database
     */
    private void loadReclamations() {
        List<Reclamation> reclamations = reclamationService.getAllReclamations();
        reclamationsData = FXCollections.observableArrayList(reclamations);
        
        // Create filtered list wrapper
        filteredData = new FilteredList<>(reclamationsData, p -> true);
        
        // Configure pagination
        configurePagination();
        
        // Update total records label
        updateTotalRecordsLabel();
    }
    
    /**
     * Create a card for a reclamation with enhanced styling
     */
    private VBox createReclamationCard(Reclamation reclamation) {
        VBox card = new VBox();
        card.getStyleClass().addAll("card", "reclamation-card");
        
        // Card header with type and ID
        HBox header = new HBox();
        header.getStyleClass().add("card-header");
        header.setAlignment(Pos.CENTER_LEFT);
        
        Label idBadge = new Label("#" + reclamation.getId());
        idBadge.getStyleClass().add("card-id-badge");
        
        // Title - use the first few words of the reclamation as the title
        String titleText = extractTitle(reclamation.getReclamation());
        Label titleLabel = new Label(titleText);
        titleLabel.getStyleClass().add("card-title");
        titleLabel.setWrapText(true);
        
        VBox titleBox = new VBox(5);
        titleBox.getChildren().addAll(titleLabel);
        HBox.setHgrow(titleBox, Priority.ALWAYS);
        HBox.setMargin(titleBox, new Insets(0, 0, 0, 10));
        
        // Status badge
        Label statusLabel = new Label();
        statusLabel.getStyleClass().add("status-badge");
        
        if (reclamation.getReponseId() != null) {
            statusLabel.setText("Resolved");
            statusLabel.getStyleClass().add("status-resolved");
        } else {
            statusLabel.setText("Pending");
            statusLabel.getStyleClass().add("status-pending");
        }
        
        header.getChildren().addAll(idBadge, titleBox, statusLabel);
        
        // Create info row with type and date
        HBox infoRow = new HBox(10);
        infoRow.setAlignment(Pos.CENTER_LEFT);
        
        // Type badge
        Label typeLabel = new Label(reclamation.getType());
        typeLabel.getStyleClass().add("card-type");
        
        // Date
        Label dateLabel = new Label("Created: " + DATE_FORMATTER.format(reclamation.getDate()));
        dateLabel.getStyleClass().add("card-date");
        
        Region infoSpacer = new Region();
        HBox.setHgrow(infoSpacer, Priority.ALWAYS);
        
        infoRow.getChildren().addAll(typeLabel, infoSpacer, dateLabel);
        
        // Description
        VBox content = new VBox(8);
        content.getStyleClass().add("card-content");
        
        Label descriptionLabel = new Label(truncateText(reclamation.getReclamation(), 120));
        descriptionLabel.getStyleClass().add("card-description");
        descriptionLabel.setWrapText(true);
        
        content.getChildren().add(descriptionLabel);
        
        // Add user ID instead of user name (since we don't have direct User reference)
        Label userLabel = new Label("Submitted by: User #" + reclamation.getUserId());
        userLabel.getStyleClass().add("reclamation-user");
        content.getChildren().add(userLabel);
        
        // Card footer with action buttons
        HBox footer = new HBox();
        footer.getStyleClass().add("card-footer");
        footer.setAlignment(Pos.CENTER_RIGHT);
        footer.setSpacing(8);
        
        // View button
        Button viewBtn = createActionButton(FontAwesomeIcon.EYE, "view-button");
        viewBtn.setTooltip(new Tooltip("View Details"));
        viewBtn.setOnAction(e -> viewReclamation(reclamation));
        
        // Edit button
        Button editBtn = createActionButton(FontAwesomeIcon.EDIT, "edit-button");
        editBtn.setTooltip(new Tooltip("Edit Reclamation"));
        editBtn.setOnAction(e -> editReclamation(reclamation));
        
        // Delete button
        Button deleteBtn = createActionButton(FontAwesomeIcon.TRASH, "delete-button");
        deleteBtn.setTooltip(new Tooltip("Delete Reclamation"));
        deleteBtn.setOnAction(e -> deleteReclamation(reclamation));
        
        footer.getChildren().addAll(viewBtn, editBtn, deleteBtn);
        
        // Add all components to the card
        card.getChildren().addAll(header, infoRow, content, footer);
        VBox.setMargin(infoRow, new Insets(8, 0, 0, 0));
        
        // Add hover effect to the entire card for better UX
        card.setOnMouseClicked(e -> viewReclamation(reclamation));
        
        return card;
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
     * Create a page for the pagination control
     */
    private void showPage(int pageIndex) {
        reclamationsContainer.getChildren().clear();
        
        int fromIndex = pageIndex * ITEMS_PER_PAGE;
        if (filteredData == null || filteredData.isEmpty() || fromIndex >= filteredData.size()) {
            return;
        }
        
        int toIndex = Math.min(fromIndex + ITEMS_PER_PAGE, filteredData.size());
        
        for (int i = fromIndex; i < toIndex; i++) {
            Reclamation reclamation = filteredData.get(i);
            reclamationsContainer.getChildren().add(createReclamationCard(reclamation));
        }
    }
    
    /**
     * Configure pagination based on the filtered data size
     */
    private void configurePagination() {
        if (filteredData == null || filteredData.isEmpty()) {
            pagination.setPageCount(1);
            pagination.setCurrentPageIndex(0);
            reclamationsContainer.getChildren().clear();
            return;
        }
        
        int pageCount = (int) Math.ceil((double) filteredData.size() / ITEMS_PER_PAGE);
        pagination.setPageCount(Math.max(1, pageCount));
        pagination.setCurrentPageIndex(0);
        
        pagination.currentPageIndexProperty().addListener((obs, oldIndex, newIndex) -> 
            showPage(newIndex.intValue()));
        
        showPage(0);
    }
    
    /**
     * Apply filters based on the search text and combobox selections
     */
    private void applyFilters() {
        if (filteredData == null) return;
        
        String searchText = txtSearch.getText().toLowerCase();
        String typeFilter = cmbFilterType.getValue();
        String statusFilter = cmbFilterStatus.getValue();
        
        Predicate<Reclamation> searchPredicate = reclamation -> 
            searchText.isEmpty() || 
            reclamation.getReclamation().toLowerCase().contains(searchText) ||
            reclamation.getType().toLowerCase().contains(searchText) ||
            String.valueOf(reclamation.getId()).contains(searchText);
        
        Predicate<Reclamation> typePredicate = reclamation ->
            "All Types".equals(typeFilter) || reclamation.getType().equalsIgnoreCase(typeFilter);
        
        Predicate<Reclamation> statusPredicate = reclamation -> {
            if ("All Statuses".equals(statusFilter)) {
                return true;
            } else if ("Resolved".equals(statusFilter)) {
                return reclamation.getReponseId() != null;
            } else {
                return reclamation.getReponseId() == null;
            }
        };
        
        filteredData.setPredicate(searchPredicate.and(typePredicate).and(statusPredicate));
        
        // Update pagination after filtering
        configurePagination();
        
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
        loadReclamations();
    }
    
    /**
     * Handle the clear filters button click
     */
    @FXML
    private void handleClearFilters() {
        txtSearch.clear();
        cmbFilterType.setValue("All Types");
        cmbFilterStatus.setValue("All Statuses");
        applyFilters();
    }
    
    /**
     * Handle the new reclamation button click
     */
    @FXML
    private void handleNewReclamation() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/reclamation-form-view.fxml"));
            Parent view = loader.load();
            
            // Assuming there's a method to access the dashboard content area
            StackPane contentArea = (StackPane) reclamationsContainer.getScene().lookup("#contentArea");
            if (contentArea != null) {
                contentArea.getChildren().clear();
                contentArea.getChildren().add(view);
            }
        } catch (IOException e) {
            e.printStackTrace();
            System.err.println("Error loading new reclamation form: " + e.getMessage());
        }
    }
    
    /**
     * View a reclamation's details
     */
    private void viewReclamation(Reclamation reclamation) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/reclamation-detail-view.fxml"));
            Parent view = loader.load();
            
            ReclamationDetailController controller = loader.getController();
            controller.initData(reclamation);
            
            StackPane contentArea = (StackPane) reclamationsContainer.getScene().lookup("#contentArea");
            if (contentArea != null) {
                contentArea.getChildren().clear();
                contentArea.getChildren().add(view);
            }
        } catch (IOException e) {
            e.printStackTrace();
            System.err.println("Error loading reclamation detail view: " + e.getMessage());
        }
    }
    
    /**
     * Edit a reclamation
     */
    private void editReclamation(Reclamation reclamation) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/reclamation-form-view.fxml"));
            Parent view = loader.load();
            
            ReclamationFormController controller = loader.getController();
            controller.initForEdit(reclamation);
            
            StackPane contentArea = (StackPane) reclamationsContainer.getScene().lookup("#contentArea");
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
     * Delete a reclamation
     */
    private void deleteReclamation(Reclamation reclamation) {
        Alert confirmDialog = new Alert(Alert.AlertType.CONFIRMATION);
        confirmDialog.setTitle("Confirm Delete");
        confirmDialog.setHeaderText("Delete Reclamation");
        confirmDialog.setContentText("Are you sure you want to delete this reclamation?");
        
        confirmDialog.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                boolean deleted = reclamationService.deleteReclamation(reclamation.getId());
                if (deleted) {
                    loadReclamations(); // Refresh the list
                } else {
                    Alert errorAlert = new Alert(Alert.AlertType.ERROR);
                    errorAlert.setTitle("Error");
                    errorAlert.setHeaderText("Delete Failed");
                    errorAlert.setContentText("Failed to delete the reclamation. Please try again.");
                    errorAlert.showAndWait();
                }
            }
        });
    }
    
    public void setCurrentUser(User user) {
        this.currentUser = user;
        // Reload reclamations for this user
        loadReclamations();
    }
}