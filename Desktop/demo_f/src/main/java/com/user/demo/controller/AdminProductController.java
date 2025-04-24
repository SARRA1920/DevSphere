package com.user.demo.controller;

import com.user.demo.model.Product;
import com.user.demo.service.ProductService;
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
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.TextAlignment;

import java.net.URL;
import java.text.NumberFormat;
import java.util.Locale;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;

public class AdminProductController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(AdminProductController.class.getName());
    
    @FXML
    private TextField searchField;
    
    @FXML
    private Button searchButton;
    
    @FXML
    private TextField titreField;
    
    @FXML
    private TextArea descriptionField;
    
    @FXML
    private TextField prixField;
    
    @FXML
    private TextField quantiteField;
    
    @FXML
    private Button addButton;
    
    @FXML
    private Button updateButton;
    
    @FXML
    private Button deleteButton;
    
    @FXML
    private Button clearButton;
    
    @FXML
    private Label statusLabel;
    
    @FXML
    private VBox formContainer;
    
    @FXML
    private VBox emptyStateContainer;
    
    @FXML
    private Button emptyStateAddButton;
    
    @FXML
    private FlowPane productsContainer;
    
    @FXML
    private ScrollPane scrollPane;
    
    @FXML
    private Label productCountLabel;
    
    @FXML
    private Button closeFormButton;
    
    @FXML
    private Label formTitle;
    
    @FXML
    private Button saveButton;
    
    private final ProductService productService = new ProductService();
    private ObservableList<Product> productList = FXCollections.observableArrayList();
    private Product selectedProduct = null;
    private final NumberFormat currencyFormatter = NumberFormat.getCurrencyInstance(Locale.FRANCE);
    
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        loadProducts();
        setupEventHandlers();
        
        // Set initial state
        updateButton.setVisible(false);
        deleteButton.setVisible(false);
        saveButton.setVisible(true);
    }
    
    private void loadProducts() {
        productList.clear();
        productList.addAll(productService.getAllProducts());
        updateProductCount();
        displayProducts();
    }
    
    private void updateProductCount() {
        int count = productList.size();
        productCountLabel.setText(count + (count > 1 ? " produits" : " produit"));
        
        // Show/hide empty state
        boolean isEmpty = productList.isEmpty();
        emptyStateContainer.setVisible(isEmpty);
        emptyStateContainer.setManaged(isEmpty);
        scrollPane.setVisible(!isEmpty);
        scrollPane.setManaged(!isEmpty);
    }
    
    private void displayProducts() {
        productsContainer.getChildren().clear();
        
        for (Product product : productList) {
            VBox productCard = createProductCard(product);
            productsContainer.getChildren().add(productCard);
        }
    }
    
    private VBox createProductCard(Product product) {
        // Main card container
        VBox card = new VBox();
        card.getStyleClass().add("card");
        card.setPrefWidth(300);
        card.setMaxWidth(300);
        card.setMinHeight(200);
        card.setSpacing(10);
        card.setPadding(new Insets(15));
        
        // Card header with title and ID badge
        HBox header = new HBox();
        header.getStyleClass().add("card-header");
        header.setAlignment(Pos.CENTER_LEFT);
        header.setSpacing(10);
        header.setPadding(new Insets(0, 0, 10, 0));
        header.setBorder(new Border(new BorderStroke(Color.LIGHTGRAY, 
                                                    BorderStrokeStyle.SOLID, 
                                                    CornerRadii.EMPTY, 
                                                    new BorderWidths(0, 0, 1, 0))));
        
        Label title = new Label(product.getTitre());
        title.getStyleClass().add("card-title");
        title.setWrapText(true);
        title.setMaxWidth(200);
        
        Pane spacer = new Pane();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        
        Label idBadge = new Label("#" + product.getId());
        idBadge.getStyleClass().add("card-id-badge");
        
        header.getChildren().addAll(title, spacer, idBadge);
        
        // Card content - description
        VBox content = new VBox(10);
        content.getStyleClass().add("card-content");
        content.setPadding(new Insets(5, 0, 10, 0));
        
        Label description = new Label(product.getDescription());
        description.getStyleClass().add("card-description");
        description.setWrapText(true);
        description.setMaxHeight(60);
        
        // Price info with background to ensure visibility
        HBox priceBox = new HBox(10);
        priceBox.setAlignment(Pos.CENTER_LEFT);
        priceBox.setPadding(new Insets(5));
        priceBox.setBackground(new Background(new BackgroundFill(Color.rgb(245, 245, 245), new CornerRadii(5), Insets.EMPTY)));
        
        FontAwesomeIconView priceIcon = new FontAwesomeIconView(FontAwesomeIcon.MONEY);
        priceIcon.setFill(Color.web("#2ecc71"));
        priceIcon.setSize("16");
        
        Label priceLabel = new Label("Prix: " + currencyFormatter.format(product.getPrix()));
        priceLabel.getStyleClass().add("card-price-label");
        
        priceBox.getChildren().addAll(priceIcon, priceLabel);
        
        // Quantity info with background to ensure visibility
        HBox quantityBox = new HBox(10);
        quantityBox.setAlignment(Pos.CENTER_LEFT);
        quantityBox.setPadding(new Insets(5));
        quantityBox.setBackground(new Background(new BackgroundFill(Color.rgb(245, 245, 245), new CornerRadii(5), Insets.EMPTY)));
        
        FontAwesomeIconView stockIcon = new FontAwesomeIconView(FontAwesomeIcon.CUBES);
        stockIcon.setFill(Color.web("#3498db"));
        stockIcon.setSize("16");
        
        Label quantityLabel = new Label("Quantité: " + product.getQuantite() + " en stock");
        quantityLabel.getStyleClass().add("card-quantity-label");
        
        quantityBox.getChildren().addAll(stockIcon, quantityLabel);
        
        // Add price and quantity to content
        content.getChildren().addAll(description, priceBox, quantityBox);
        
        // Card footer with action buttons
        HBox footer = new HBox();
        footer.getStyleClass().add("card-footer");
        footer.setAlignment(Pos.CENTER_RIGHT);
        footer.setSpacing(8);
        footer.setPadding(new Insets(10, 0, 0, 0));
        footer.setBorder(new Border(new BorderStroke(Color.LIGHTGRAY, 
                                                    BorderStrokeStyle.SOLID, 
                                                    CornerRadii.EMPTY, 
                                                    new BorderWidths(1, 0, 0, 0))));
        
        // Edit button
        Button editButton = new Button();
        editButton.getStyleClass().addAll("card-action-button", "edit-button");
        editButton.setMinSize(32, 32);
        editButton.setMaxSize(32, 32);
        
        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
        editIcon.setFill(Color.WHITE);
        editIcon.setSize("14");
        editButton.setGraphic(editIcon);
        editButton.setTooltip(new Tooltip("Modifier"));
        
        // Delete button
        Button deleteButton = new Button();
        deleteButton.getStyleClass().addAll("card-action-button", "delete-button");
        deleteButton.setMinSize(32, 32);
        deleteButton.setMaxSize(32, 32);
        
        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
        deleteIcon.setFill(Color.WHITE);
        deleteIcon.setSize("14");
        deleteButton.setGraphic(deleteIcon);
        deleteButton.setTooltip(new Tooltip("Supprimer"));
        
        footer.getChildren().addAll(editButton, deleteButton);
        
        // Add all sections to card
        card.getChildren().addAll(header, content, footer);
        
        // Set up event handlers for card buttons
        editButton.setOnAction(event -> {
            showFormForEdit(product);
        });
        
        deleteButton.setOnAction(event -> {
            promptDeleteProduct(product);
        });
        
        // Add a click handler to the whole card to show details
        card.setOnMouseClicked(event -> {
            if (event.getClickCount() == 2) {
                showFormForEdit(product);
            }
        });
        
        return card;
    }
    
    private void setupEventHandlers() {
        // Add product button
        addButton.setOnAction(event -> showFormForAdd());
        
        // Empty state add button
        emptyStateAddButton.setOnAction(event -> showFormForAdd());
        
        // Close form button
        closeFormButton.setOnAction(event -> hideForm());
        
        // Update product button
        updateButton.setOnAction(event -> updateProduct());
        
        // Save (Add) button
        saveButton.setOnAction(event -> addProduct());
        
        // Delete product button
        deleteButton.setOnAction(event -> {
            if (selectedProduct != null) {
                promptDeleteProduct(selectedProduct);
            }
        });
        
        // Clear form button
        clearButton.setOnAction(event -> {
            searchField.clear();
            loadProducts();
        });
        
        // Search button
        searchButton.setOnAction(event -> searchProducts());
        
        // Also trigger search on Enter key
        searchField.setOnAction(event -> searchProducts());
    }
    
    private void showFormForAdd() {
        formTitle.setText("Ajouter un produit");
        clearForm();
        
        // Show save button, hide update/delete buttons
        saveButton.setVisible(true);
        updateButton.setVisible(false);
        deleteButton.setVisible(false);
        
        showForm();
    }
    
    private void showFormForEdit(Product product) {
        selectedProduct = product;
        formTitle.setText("Modifier le produit");
        populateForm(product);
        
        // Show update/delete buttons, hide save button
        saveButton.setVisible(false);
        updateButton.setVisible(true);
        deleteButton.setVisible(true);
        
        showForm();
    }
    
    private void showForm() {
        formContainer.setVisible(true);
        formContainer.setManaged(true);
        scrollPane.setVisible(false);
        scrollPane.setManaged(false);
        emptyStateContainer.setVisible(false);
        emptyStateContainer.setManaged(false);
    }
    
    private void hideForm() {
        formContainer.setVisible(false);
        formContainer.setManaged(false);
        
        // Determine which view to show based on product list
        boolean isEmpty = productList.isEmpty();
        scrollPane.setVisible(!isEmpty);
        scrollPane.setManaged(!isEmpty);
        emptyStateContainer.setVisible(isEmpty);
        emptyStateContainer.setManaged(isEmpty);
        
        clearForm();
    }
    
    private void addProduct() {
        try {
            if (validateForm()) {
                String titre = titreField.getText().trim();
                String description = descriptionField.getText().trim();
                double prix = Double.parseDouble(prixField.getText().trim());
                int quantite = Integer.parseInt(quantiteField.getText().trim());
                
                Product newProduct = new Product(titre, description, prix, quantite);
                
                if (productService.addProduct(newProduct)) {
                    statusLabel.setText("Produit ajouté avec succès");
                    hideForm();
                    loadProducts();
                } else {
                    statusLabel.setText("Échec de l'ajout du produit");
                }
            }
        } catch (NumberFormatException e) {
            statusLabel.setText("Format de nombre invalide dans le prix ou la quantité");
            LOGGER.log(Level.WARNING, "Invalid number format", e);
        } catch (Exception e) {
            statusLabel.setText("Erreur lors de l'ajout du produit");
            LOGGER.log(Level.SEVERE, "Error adding product", e);
        }
    }
    
    private void updateProduct() {
        try {
            if (selectedProduct != null && validateForm()) {
                String titre = titreField.getText().trim();
                String description = descriptionField.getText().trim();
                double prix = Double.parseDouble(prixField.getText().trim());
                int quantite = Integer.parseInt(quantiteField.getText().trim());
                
                selectedProduct.setTitre(titre);
                selectedProduct.setDescription(description);
                selectedProduct.setPrix(prix);
                selectedProduct.setQuantite(quantite);
                
                if (productService.updateProduct(selectedProduct)) {
                    statusLabel.setText("Produit mis à jour avec succès");
                    hideForm();
                    loadProducts();
                } else {
                    statusLabel.setText("Échec de la mise à jour du produit");
                }
            }
        } catch (NumberFormatException e) {
            statusLabel.setText("Format de nombre invalide dans le prix ou la quantité");
            LOGGER.log(Level.WARNING, "Invalid number format", e);
        } catch (Exception e) {
            statusLabel.setText("Erreur lors de la mise à jour du produit");
            LOGGER.log(Level.SEVERE, "Error updating product", e);
        }
    }
    
    private void promptDeleteProduct(Product product) {
        Alert confirmDialog = new Alert(Alert.AlertType.CONFIRMATION);
        confirmDialog.setTitle("Confirmer la suppression");
        confirmDialog.setHeaderText("Supprimer le produit");
        confirmDialog.setContentText("Êtes-vous sûr de vouloir supprimer ce produit ?");
        
        Optional<ButtonType> result = confirmDialog.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            if (productService.deleteProduct(product.getId())) {
                statusLabel.setText("Produit supprimé avec succès");
                if (formContainer.isVisible()) {
                    hideForm();
                }
                loadProducts();
            } else {
                statusLabel.setText("Échec de la suppression du produit");
            }
        }
    }
    
    private void searchProducts() {
        String searchTerm = searchField.getText().trim();
        
        if (searchTerm.isEmpty()) {
            loadProducts();
        } else {
            productList.clear();
            productList.addAll(productService.searchProducts(searchTerm));
            updateProductCount();
            displayProducts();
            
            int count = productList.size();
            statusLabel.setText("Trouvé " + count + (count > 1 ? " produits" : " produit") + " correspondant à '" + searchTerm + "'");
        }
    }
    
    private void populateForm(Product product) {
        titreField.setText(product.getTitre());
        descriptionField.setText(product.getDescription());
        prixField.setText(String.valueOf(product.getPrix()));
        quantiteField.setText(String.valueOf(product.getQuantite()));
    }
    
    private void clearForm() {
        titreField.clear();
        descriptionField.clear();
        prixField.clear();
        quantiteField.clear();
        selectedProduct = null;
    }
    
    private boolean validateForm() {
        StringBuilder errors = new StringBuilder();
        
        if (titreField.getText().trim().isEmpty()) {
            errors.append("Le titre est requis\n");
        }
        
        if (descriptionField.getText().trim().isEmpty()) {
            errors.append("La description est requise\n");
        }
        
        try {
            double prix = Double.parseDouble(prixField.getText().trim());
            if (prix < 0) {
                errors.append("Le prix doit être un nombre positif\n");
            }
        } catch (NumberFormatException e) {
            errors.append("Le prix doit être un nombre valide\n");
        }
        
        try {
            int quantite = Integer.parseInt(quantiteField.getText().trim());
            if (quantite < 0) {
                errors.append("La quantité doit être un nombre positif\n");
            }
        } catch (NumberFormatException e) {
            errors.append("La quantité doit être un entier valide\n");
        }
        
        if (errors.length() > 0) {
            statusLabel.setText(errors.toString());
            return false;
        }
        
        return true;
    }
}