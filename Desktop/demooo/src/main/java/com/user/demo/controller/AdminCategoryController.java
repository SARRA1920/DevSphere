package com.user.demo.controller;

import com.user.demo.model.CategorieCours;
import com.user.demo.service.CategorieCoursService;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.Text;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.util.Callback;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;

import java.io.IOException;
import java.net.URL;
import java.util.List;
import java.util.Optional;
import java.util.ResourceBundle;

public class AdminCategoryController implements Initializable {

    @FXML
    private GridPane categoriesGrid;

    @FXML
    private TextField searchField;

    @FXML
    private Label statusLabel;

    private CategorieCoursService categorieService;
    private ObservableList<CategorieCours> categoriesList = FXCollections.observableArrayList();
    private FilteredList<CategorieCours> filteredList;

    private int currentRow = 0;
    private static final int COLUMNS = 3; // Nombre de cartes par ligne

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        categorieService = new CategorieCoursService();
        
        // Initialiser les données
        loadCategories();
        
        // Configurer la recherche
        setupSearch();
    }
    
    private void loadCategories() {
        try {
            // Effacer la liste existante et le GridPane
            categoriesList.clear();
            categoriesGrid.getChildren().clear();
            currentRow = 0;
            
            // Récupérer toutes les catégories depuis le service
            List<CategorieCours> categories = categorieService.afficherTout();
            
            // Ajouter à la liste observable
            categoriesList.addAll(categories);
            
            // Initialiser la liste filtrée si elle est null
            if (filteredList == null) {
                filteredList = new FilteredList<>(categoriesList, p -> true);
            } else {
                filteredList.setPredicate(p -> true); // Réinitialiser le filtre
            }
            
            // Afficher les cartes
            displayCategoryCards(filteredList);
            
            // Mettre à jour le label de statut
            updateStatusLabel();
            
            System.out.println("Categories loaded: " + categories.size());
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de chargement des catégories", 
                    "Une erreur s'est produite lors du chargement des catégories: " + e.getMessage());
        }
    }
    
    private void displayCategoryCards(List<CategorieCours> categories) {
        categoriesGrid.getChildren().clear();
        currentRow = 0;
        
        int column = 0;
        for (CategorieCours categorie : categories) {
            // Créer une carte pour chaque catégorie
            VBox card = createCategoryCard(categorie);
            
            // Ajouter la carte à la grille
            categoriesGrid.add(card, column, currentRow);
            
            // Incrémenter la colonne et éventuellement passer à la ligne suivante
            column++;
            if (column >= COLUMNS) {
                column = 0;
                currentRow++;
            }
        }
    }
    
    private VBox createCategoryCard(CategorieCours categorie) {
        // Créer la carte
        VBox card = new VBox(10);
        card.setPrefWidth(270);
        card.setPrefHeight(200);
        card.getStyleClass().add("category-card");
        card.setStyle("-fx-background-color: white; -fx-border-color: #e0e0e0; -fx-border-radius: 5; " +
                "-fx-background-radius: 5; -fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.1), 5, 0, 0, 2);");
        
        // Padding
        card.setPadding(new javafx.geometry.Insets(15));
        
        // ID et titre
        HBox header = new HBox(10);
        Label idLabel = new Label("#" + categorie.getId());
        idLabel.setStyle("-fx-text-fill: #777777;");
        
        Label titleLabel = new Label(categorie.getNom());
        titleLabel.setStyle("-fx-font-size: 16px; -fx-font-weight: bold;");
        
        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        
        header.getChildren().addAll(idLabel, titleLabel, spacer);
        
        // Description
        Label descriptionLabel = new Label(categorie.getDescription());
        descriptionLabel.setWrapText(true);
        descriptionLabel.setMaxHeight(80);
        descriptionLabel.setStyle("-fx-text-fill: #555555;");
        
        // Boutons d'action
        HBox actionsBox = new HBox(10);
        actionsBox.setAlignment(javafx.geometry.Pos.CENTER_RIGHT);
        
        Button editButton = new Button();
        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.PENCIL);
        editIcon.setGlyphSize(14);
        editIcon.setFill(Color.WHITE);
        editButton.setGraphic(editIcon);
        editButton.setStyle("-fx-background-color: #2ecc71; -fx-text-fill: white; -fx-background-radius: 4;");
        editButton.setTooltip(new Tooltip("Modifier"));
        
        Button deleteButton = new Button();
        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
        deleteIcon.setGlyphSize(14);
        deleteIcon.setFill(Color.WHITE);
        deleteButton.setGraphic(deleteIcon);
        deleteButton.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white; -fx-background-radius: 4;");
        deleteButton.setTooltip(new Tooltip("Supprimer"));
        
        actionsBox.getChildren().addAll(editButton, deleteButton);
        
        Region spacerBottom = new Region();
        VBox.setVgrow(spacerBottom, Priority.ALWAYS);
        
        // Ajouter tous les éléments à la carte
        card.getChildren().addAll(header, descriptionLabel, spacerBottom, actionsBox);
        
        // Ajouter les gestionnaires d'événements
        editButton.setOnAction(event -> handleEditCategory(categorie));
        deleteButton.setOnAction(event -> handleDeleteCategory(categorie));
        
        return card;
    }
    
    private void setupSearch() {
        // Wrap the ObservableList in a FilteredList
        filteredList = new FilteredList<>(categoriesList, p -> true);
        
        // Set the filter Predicate whenever the search field changes
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredList.setPredicate(categorie -> {
                // If filter text is empty, display all categories
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }
                
                // Compare first name and last name with filter text
                String lowerCaseFilter = newValue.toLowerCase();
                
                // Match against category name and description
                if (categorie.getNom().toLowerCase().contains(lowerCaseFilter)) {
                    return true;
                } else if (categorie.getDescription().toLowerCase().contains(lowerCaseFilter)) {
                    return true;
                }
                
                return false; // No match
            });
            
            // Mettre à jour l'affichage des cartes
            displayCategoryCards(filteredList);
            
            // Update the status label to reflect the filtered results
            updateStatusLabel();
        });
    }
    
    private void updateStatusLabel() {
        statusLabel.setText("Total: " + filteredList.size() + " catégories");
    }
    
    @FXML
    private void handleAddCategory() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/AjoutCategorieCours.fxml"));
            Parent root = loader.load();
            
            // Get the controller and set a new category
            CategorieCoursFormController controller = loader.getController();
            controller.setCategorie(new CategorieCours());
            
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Ajouter une Catégorie");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(categoriesGrid.getScene().getWindow());
            
            // Set the dialog stage in the controller
            controller.setDialogStage(dialogStage);
            
            Scene scene = new Scene(root);
            dialogStage.setScene(scene);
            
            // Show the dialog and wait until the user closes it
            dialogStage.showAndWait();
            
            // Check if confirm was clicked before refreshing
            if (controller.isConfirmClicked()) {
                // Refresh the cards
                loadCategories();
            }
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'ouverture du formulaire", 
                    "Une erreur s'est produite lors de l'ouverture du formulaire: " + e.getMessage());
        }
    }
    
    private void handleEditCategory(CategorieCours categorie) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/AjoutCategorieCours.fxml"));
            Parent root = loader.load();
            
            CategorieCoursFormController controller = loader.getController();
            controller.setCategorie(categorie);
            
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Modifier une Catégorie");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(categoriesGrid.getScene().getWindow());
            
            // Set the dialog stage in the controller
            controller.setDialogStage(dialogStage);
            
            Scene scene = new Scene(root);
            dialogStage.setScene(scene);
            
            // Show the dialog and wait until the user closes it
            dialogStage.showAndWait();
            
            // Check if confirm was clicked before refreshing
            if (controller.isConfirmClicked()) {
                // Refresh the cards
                loadCategories();
            }
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'ouverture du formulaire", 
                    "Une erreur s'est produite lors de l'ouverture du formulaire: " + e.getMessage());
        }
    }
    
    private void handleDeleteCategory(CategorieCours categorie) {
        // Show confirmation dialog
        Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
        confirmAlert.setTitle("Confirmation de suppression");
        confirmAlert.setHeaderText("Supprimer la catégorie");
        confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer la catégorie '" + categorie.getNom() + "' ?");
        
        Optional<ButtonType> result = confirmAlert.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            try {
                boolean success = categorieService.supprimer(categorie);
                
                if (success) {
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "Catégorie supprimée", 
                            "La catégorie a été supprimée avec succès.");
                    
                    // Refresh the cards
                    loadCategories();
                } else {
                    // Vérifions s'il y a des cours associés en appelant une méthode du service
                    showAlert(Alert.AlertType.WARNING, "Impossible de supprimer", "Catégorie utilisée", 
                            "Impossible de supprimer la catégorie car elle est associée à un ou plusieurs cours. " +
                            "Vous devez d'abord supprimer ou modifier les cours qui utilisent cette catégorie.");
                }
            } catch (Exception e) {
                e.printStackTrace();
                if (e.getMessage() != null && e.getMessage().contains("foreign key constraint fails")) {
                    showAlert(Alert.AlertType.WARNING, "Impossible de supprimer", "Catégorie utilisée", 
                            "Impossible de supprimer la catégorie car elle est associée à un ou plusieurs cours. " +
                            "Vous devez d'abord supprimer ou modifier les cours qui utilisent cette catégorie.");
                } else {
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de suppression", 
                            "Une erreur s'est produite lors de la suppression de la catégorie: " + e.getMessage());
                }
            }
        }
    }
    
    @FXML
    private void handleSearch() {
        // La recherche est déjà gérée par la FilteredList
    }
    
    @FXML
    private void handleRefresh() {
        // Effacer le champ de recherche
        searchField.clear();
        
        // Recharger toutes les catégories
        loadCategories();
    }
    
    private void showAlert(Alert.AlertType type, String title, String header, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(header);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 