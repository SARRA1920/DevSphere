package com.user.demo.controller;

import com.user.demo.model.User;
import com.user.demo.service.UserService;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;

public class UserManagementController implements Initializable {
    @FXML private FlowPane userCards;
    @FXML private Label totalUsersLabel;
    @FXML private Label itemCountLabel;
    @FXML private Button addUserButton;
    @FXML private TextField searchField;
    @FXML private ComboBox<String> roleFilter;
    @FXML private VBox emptyState;
    @FXML private StackPane loadingPane;

    private final UserService userService = new UserService();
    private ObservableList<User> users;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        initializeFilters();
        loadUsers();
    }

    private void initializeFilters() {
        roleFilter.setItems(FXCollections.observableArrayList("All", "USER", "ADMIN"));
        roleFilter.setValue("All");
    }

    private VBox createUserCard(User user) {
        // Main card container
        VBox card = new VBox();
        card.getStyleClass().addAll("card");
        card.setSpacing(10);
        card.setPrefWidth(300);

        // Header with user ID and role badge
        HBox header = new HBox();
        header.getStyleClass().add("card-header");
        header.setAlignment(Pos.CENTER_LEFT);
        header.setSpacing(10);

        Label idBadge = new Label("#" + user.getId());
        idBadge.getStyleClass().add("card-id-badge");

        Label roleBadge = new Label(user.getRole());
        roleBadge.getStyleClass().addAll("status-badge", 
            "ADMIN".equals(user.getRole()) ? "status-resolved" : "status-pending");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        
        header.getChildren().addAll(idBadge, spacer, roleBadge);

        // Content section
        VBox content = new VBox(8);
        content.getStyleClass().add("card-content");

        // User icon and name
        HBox nameContainer = new HBox(10);
        nameContainer.setAlignment(Pos.CENTER_LEFT);
        
        FontAwesomeIconView userIcon = new FontAwesomeIconView(FontAwesomeIcon.USER);
        userIcon.setGlyphSize(16);
        userIcon.setFill(Color.valueOf("#3498db"));

        Label nameLabel = new Label(user.getName());
        nameLabel.getStyleClass().add("card-title");
        nameContainer.getChildren().addAll(userIcon, nameLabel);

        // Email
        HBox emailContainer = new HBox(10);
        emailContainer.setAlignment(Pos.CENTER_LEFT);
        
        FontAwesomeIconView emailIcon = new FontAwesomeIconView(FontAwesomeIcon.ENVELOPE);
        emailIcon.setGlyphSize(14);
        emailIcon.setFill(Color.valueOf("#7f8c8d"));

        Label emailLabel = new Label(user.getEmail());
        emailLabel.getStyleClass().add("card-description");
        emailContainer.getChildren().addAll(emailIcon, emailLabel);

        // Phone and CIN
        HBox detailsContainer = new HBox(15);
        detailsContainer.setAlignment(Pos.CENTER_LEFT);
        
        // Phone number
        HBox phoneContainer = new HBox(5);
        phoneContainer.setAlignment(Pos.CENTER_LEFT);
        FontAwesomeIconView phoneIcon = new FontAwesomeIconView(FontAwesomeIcon.PHONE);
        phoneIcon.setGlyphSize(14);
        phoneIcon.setFill(Color.valueOf("#7f8c8d"));
        Label phoneLabel = new Label(String.valueOf(user.getPhone()));
        phoneLabel.getStyleClass().add("card-type");
        phoneContainer.getChildren().addAll(phoneIcon, phoneLabel);

        // CIN
        HBox cinContainer = new HBox(5);
        cinContainer.setAlignment(Pos.CENTER_LEFT);
        FontAwesomeIconView cinIcon = new FontAwesomeIconView(FontAwesomeIcon.ID_CARD);
        cinIcon.setGlyphSize(14);
        cinIcon.setFill(Color.valueOf("#7f8c8d"));
        Label cinLabel = new Label(String.valueOf(user.getCin()));
        cinLabel.getStyleClass().add("card-type");
        cinContainer.getChildren().addAll(cinIcon, cinLabel);

        detailsContainer.getChildren().addAll(phoneContainer, cinContainer);

        content.getChildren().addAll(nameContainer, emailContainer, detailsContainer);

        // Action buttons
        HBox actions = new HBox();
        actions.getStyleClass().add("card-footer");
        actions.setSpacing(8);
        actions.setAlignment(Pos.CENTER_RIGHT);

        Button editButton = new Button();
        editButton.getStyleClass().addAll("card-action-button", "edit-button");
        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.PENCIL);
        editIcon.setGlyphSize(14);
        editIcon.setFill(Color.WHITE);
        editButton.setGraphic(editIcon);
        editButton.setTooltip(new Tooltip("Edit user"));
        editButton.setOnAction(e -> showEditUserForm(user));

        Button deleteButton = new Button();
        deleteButton.getStyleClass().addAll("card-action-button", "delete-button");
        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
        deleteIcon.setGlyphSize(14);
        deleteIcon.setFill(Color.WHITE);
        deleteButton.setGraphic(deleteIcon);
        deleteButton.setTooltip(new Tooltip("Delete user"));
        deleteButton.setOnAction(e -> deleteUser(user));

        actions.getChildren().addAll(editButton, deleteButton);

        // Add all sections to card
        card.getChildren().addAll(header, content, actions);
        
        return card;
    }

    private void loadUsers() {
        if (loadingPane != null) {
            loadingPane.setVisible(true);
            loadingPane.setManaged(true);
        }

        List<User> userList = userService.getAllUsers();
        users = FXCollections.observableArrayList(userList);
        updateCards(users);

        if (loadingPane != null) {
            loadingPane.setVisible(false);
            loadingPane.setManaged(false);
        }
    }

    private void updateCards(ObservableList<User> userList) {
        userCards.getChildren().clear();
        for (User user : userList) {
            userCards.getChildren().add(createUserCard(user));
        }
        updateItemCount();
        updateEmptyState();
    }

    @FXML
    private void handleSearch() {
        String searchText = searchField.getText().toLowerCase().trim();
        String role = roleFilter.getValue();

        ObservableList<User> filteredList = users.filtered(user ->
            (searchText.isEmpty() || 
             user.getName().toLowerCase().contains(searchText) ||
             user.getEmail().toLowerCase().contains(searchText)) &&
            (role.equals("All") || user.getRole().equals(role))
        );

        updateCards(filteredList);
    }

    @FXML
    private void handleClearFilters() {
        searchField.clear();
        roleFilter.setValue("All");
        updateCards(users);
    }

    private void updateItemCount() {
        int total = users.size();
        int filtered = userCards.getChildren().size();
        totalUsersLabel.setText(String.format("Total: %d users", total));
        itemCountLabel.setText(String.format("Showing %d of %d users", filtered, total));
    }

    private void updateEmptyState() {
        boolean isEmpty = userCards.getChildren().isEmpty();
        if (emptyState != null) {
            emptyState.setVisible(isEmpty);
            emptyState.setManaged(isEmpty);
        }
    }

    @FXML
    private void showAddUserForm() {
        showUserDialog(new User(), "Add New User");
    }

    private void showEditUserForm(User user) {
        showUserDialog(user, "Edit User");
    }

    private void showUserDialog(User user, String title) {
        Dialog<User> dialog = new Dialog<>();
        dialog.setTitle(title);
        dialog.setHeaderText(null);

        ButtonType saveButtonType = new ButtonType("Save", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveButtonType, ButtonType.CANCEL);

        GridPane grid = new GridPane();
        grid.setHgap(10);
        grid.setVgap(10);

        TextField username = new TextField(user.getName());
        TextField email = new TextField(user.getEmail());
        PasswordField password = new PasswordField();
        TextField phone = new TextField(String.valueOf(user.getPhone()));
        TextField cin = new TextField(String.valueOf(user.getCin()));
        TextField image = new TextField(user.getImage());
        ComboBox<String> role = new ComboBox<>(FXCollections.observableArrayList("USER", "ADMIN"));
        role.setValue(user.getRole());

        grid.add(new Label("Name:"), 0, 0);
        grid.add(username, 1, 0);
        grid.add(new Label("Email:"), 0, 1);
        grid.add(email, 1, 1);
        grid.add(new Label("Password:"), 0, 2);
        grid.add(password, 1, 2);
        grid.add(new Label("Phone:"), 0, 3);
        grid.add(phone, 1, 3);
        grid.add(new Label("CIN:"), 0, 4);
        grid.add(cin, 1, 4);
        grid.add(new Label("Image:"), 0, 5);
        grid.add(image, 1, 5);
        grid.add(new Label("Role:"), 0, 6);
        grid.add(role, 1, 6);

        dialog.getDialogPane().setContent(grid);

        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == saveButtonType) {
                user.setName(username.getText());
                user.setEmail(email.getText());
                if (!password.getText().isEmpty()) {
                    user.setPassword(password.getText());
                }
                try {
                    user.setPhone(Integer.parseInt(phone.getText()));
                    user.setCin(Integer.parseInt(cin.getText()));
                } catch (NumberFormatException e) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Invalid Input");
                    alert.setContentText("Please enter valid numbers for Phone and CIN.");
                    alert.showAndWait();
                    return null;
                }
                user.setImage(image.getText());
                user.setRole(role.getValue());
                return user;
            }
            return null;
        });

        dialog.showAndWait().ifPresent(result -> {
            if (result != null) {
                if (result.getId() == 0) {
                    userService.createUser(result);
                } else {
                    userService.updateUser(result);
                }
                loadUsers();
            }
        });
    }

    private void deleteUser(User user) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Delete User");
        alert.setHeaderText(null);
        alert.setContentText("Are you sure you want to delete user: " + user.getName() + "?");

        alert.showAndWait().ifPresent(result -> {
            if (result == ButtonType.OK) {
                userService.deleteUser(user.getId());
                loadUsers();
            }
        });
    }
}