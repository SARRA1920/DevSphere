package com.user.demo.controller;

import com.user.demo.model.Product;
import com.user.demo.service.ProductService;
import com.user.demo.service.AchatService;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;

import java.net.URL;
import java.text.NumberFormat;
import java.util.List;
import java.util.Locale;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;

public class UserProductViewController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(UserProductViewController.class.getName());

    @FXML
    private FlowPane productsContainer;
    
    @FXML
    private ScrollPane scrollPane;
    
    @FXML
    private VBox emptyStateContainer;
    
    @FXML
    private Label cartCountLabel;
    
    @FXML
    private Button viewCartButton;

    private final ProductService productService = new ProductService();
    private final AchatService achatService = new AchatService();
    private int userId; // Set this from login
    private final NumberFormat currencyFormatter = NumberFormat.getCurrencyInstance(Locale.FRANCE);

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        loadProducts();
        updateCartCount();
    }

    public void setUserId(int userId) {
        this.userId = userId;
        loadProducts();
        updateCartCount();
    }

    private void loadProducts() {
        List<Product> products = productService.getAllProducts();
        updateDisplay(products);
    }

    private void updateDisplay(List<Product> products) {
        productsContainer.getChildren().clear();
        
        if (products.isEmpty()) {
            showEmptyState(true);
            return;
        }
        
        showEmptyState(false);
        products.forEach(this::createProductCard);
    }

    private void showEmptyState(boolean show) {
        emptyStateContainer.setVisible(show);
        emptyStateContainer.setManaged(show);
        scrollPane.setVisible(!show);
        scrollPane.setManaged(!show);
    }

    private void createProductCard(Product product) {
        VBox card = new VBox(10);
        card.getStyleClass().add("card");
        card.setPrefWidth(300);
        card.setMaxWidth(300);
        card.setMinHeight(200);
        card.setPadding(new Insets(15));

        // Product Title
        Label title = new Label(product.getTitre());
        title.getStyleClass().add("card-title");
        title.setWrapText(true);
        title.setMaxWidth(270);

        // Description
        Label description = new Label(product.getDescription());
        description.getStyleClass().add("card-description");
        description.setWrapText(true);
        description.setMaxHeight(60);

        // Price Box
        HBox priceBox = new HBox(10);
        priceBox.setAlignment(Pos.CENTER_LEFT);
        priceBox.setPadding(new Insets(5));
        priceBox.setBackground(new Background(new BackgroundFill(
            Color.rgb(245, 245, 245), new CornerRadii(5), Insets.EMPTY)));

        FontAwesomeIconView priceIcon = new FontAwesomeIconView(FontAwesomeIcon.MONEY);
        priceIcon.setFill(Color.web("#2ecc71"));
        priceIcon.setSize("16");

        Label priceLabel = new Label("Prix: " + currencyFormatter.format(product.getPrix()));
        priceLabel.getStyleClass().add("card-price-label");
        priceBox.getChildren().addAll(priceIcon, priceLabel);

        // Stock Info
        HBox stockBox = new HBox(10);
        stockBox.setAlignment(Pos.CENTER_LEFT);
        stockBox.setPadding(new Insets(5));
        stockBox.setBackground(new Background(new BackgroundFill(
            Color.rgb(245, 245, 245), new CornerRadii(5), Insets.EMPTY)));

        FontAwesomeIconView stockIcon = new FontAwesomeIconView(FontAwesomeIcon.CUBES);
        stockIcon.setFill(Color.web("#3498db"));
        stockIcon.setSize("16");

        Label stockLabel = new Label("En stock: " + product.getQuantite());
        stockLabel.getStyleClass().add("card-quantity-label");
        stockBox.getChildren().addAll(stockIcon, stockLabel);

        // Purchase Button
        Button purchaseBtn = new Button("Acheter");
        purchaseBtn.getStyleClass().addAll("form-button");
        purchaseBtn.setMaxWidth(Double.MAX_VALUE);
        purchaseBtn.setGraphic(new FontAwesomeIconView(FontAwesomeIcon.SHOPPING_CART));

        // Check if product is already purchased
        if (achatService.hasPurchased(userId, product.getId())) {
            purchaseBtn.setDisable(true);
            purchaseBtn.setText("Déjà acheté");
        } else if (product.getQuantite() <= 0) {
            purchaseBtn.setDisable(true);
            purchaseBtn.setText("Rupture de stock");
        }

        purchaseBtn.setOnAction(e -> handlePurchase(product));

        // Add all elements to card
        card.getChildren().addAll(title, description, priceBox, stockBox, purchaseBtn);
        productsContainer.getChildren().add(card);
    }

    private void handlePurchase(Product product) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmer l'achat");
        confirmation.setHeaderText(null);
        confirmation.setContentText("Voulez-vous acheter " + product.getTitre() + " ?");

        Optional<ButtonType> result = confirmation.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            if (achatService.addAchat(product.getId(), userId)) {
                Alert success = new Alert(Alert.AlertType.INFORMATION);
                success.setTitle("Succès");
                success.setHeaderText(null);
                success.setContentText("Produit ajouté à votre panier avec succès!");
                success.showAndWait();
                
                updateCartCount();
                loadProducts(); // Refresh the view
            } else {
                Alert error = new Alert(Alert.AlertType.ERROR);
                error.setTitle("Erreur");
                error.setHeaderText(null);
                error.setContentText("Une erreur est survenue lors de l'achat.");
                error.showAndWait();
            }
        }
    }

    @FXML
    private void showCart() {
        List<Product> purchases = achatService.getUserPurchases(userId);
        
        Dialog<Void> dialog = new Dialog<>();
        dialog.setTitle("Mon Panier");
        dialog.setHeaderText(null);

        VBox content = new VBox(10);
        content.setPadding(new Insets(20));
        content.setPrefWidth(400);
        
        if (purchases.isEmpty()) {
            Label emptyLabel = new Label("Votre panier est vide");
            emptyLabel.setFont(Font.font(14));
            content.getChildren().add(emptyLabel);
        } else {
            purchases.forEach(product -> {
                HBox item = new HBox(10);
                item.setAlignment(Pos.CENTER_LEFT);
                
                Label title = new Label(product.getTitre());
                title.setMaxWidth(200);
                title.setWrapText(true);
                
                Label price = new Label(currencyFormatter.format(product.getPrix()));
                price.getStyleClass().add("card-price-label");
                
                Region spacer = new Region();
                HBox.setHgrow(spacer, Priority.ALWAYS);
                
                item.getChildren().addAll(title, spacer, price);
                content.getChildren().add(item);
            });
        }

        dialog.getDialogPane().setContent(content);
        dialog.getDialogPane().getButtonTypes().add(ButtonType.CLOSE);
        
        dialog.showAndWait();
    }

    private void updateCartCount() {
        int count = achatService.getUserPurchaseCount(userId);
        cartCountLabel.setText("Panier: " + count + " articles");
    }
}