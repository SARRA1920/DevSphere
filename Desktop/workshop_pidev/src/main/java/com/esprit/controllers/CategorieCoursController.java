package com.esprit.controllers;

import com.esprit.models.CategorieCours;
import com.esprit.services.CategorieCoursService;
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
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Modality;
import javafx.stage.Stage;

import java.io.IOException;
import java.net.URL;
import java.util.List;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.function.Predicate;

public class CategorieCoursController implements Initializable {

    private static final Logger LOGGER = Logger.getLogger(CategorieCoursController.class.getName());
    
    @FXML
    private TableView<CategorieCours> categorieTable;
    
    @FXML
    private TableColumn<CategorieCours, Integer> idColumn;
    
    @FXML
    private TableColumn<CategorieCours, String> nomColumn;
    
    @FXML
    private TableColumn<CategorieCours, String> descriptionColumn;
    
    @FXML
    private TableColumn<CategorieCours, String> niveauColumn;
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ToggleButton sortButton;
    
    private CategorieCoursService categorieService;
    private ObservableList<CategorieCours> categoriesList;
    private FilteredList<CategorieCours> filteredCategories;
    private boolean isAscendingSort = true;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        categorieService = new CategorieCoursService();
        
        initializeColumns();
        loadData();
        setupSearch();
        
        // Initialiser le bouton de tri
        updateSortButtonText();
    }
    
    private void initializeColumns() {
        idColumn.setCellValueFactory(new PropertyValueFactory<>("id"));
        nomColumn.setCellValueFactory(new PropertyValueFactory<>("nom"));
        descriptionColumn.setCellValueFactory(new PropertyValueFactory<>("description"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveau"));
    }
    
    private void loadData() {
        categoriesList = FXCollections.observableArrayList(categorieService.afficher());
        filteredCategories = new FilteredList<>(categoriesList, p -> true);
        
        // Créer une SortedList basée sur la FilteredList
        SortedList<CategorieCours> sortedList = new SortedList<>(filteredCategories);
        sortedList.comparatorProperty().bind(categorieTable.comparatorProperty());
        
        categorieTable.setItems(sortedList);
    }
    
    private void setupSearch() {
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredCategories.setPredicate(categorie -> {
                if (newValue == null || newValue.trim().isEmpty()) {
                    return true;
                }
                
                String lowerCaseFilter = newValue.toLowerCase().trim();
                return categorie.getNom().toLowerCase().contains(lowerCaseFilter);
            });
        });
    }
    
    @FXML
    private void handleSort() {
        isAscendingSort = !isAscendingSort;
        updateSortButtonText();
        
        // Clear the current sort order
        categorieTable.getSortOrder().clear();
        
        // Set the sort type on the name column
        nomColumn.setSortType(isAscendingSort ? TableColumn.SortType.ASCENDING : TableColumn.SortType.DESCENDING);
        
        // Add the column to the sort order
        categorieTable.getSortOrder().add(nomColumn);
        
        // Force the sort
        categorieTable.sort();
    }
    
    private void updateSortButtonText() {
        sortButton.setText("Trier par nom " + (isAscendingSort ? "↑" : "↓"));
    }
    
    private void refreshTable() {
        List<CategorieCours> updatedList = categorieService.afficher();
        categoriesList.clear();
        categoriesList.addAll(updatedList);
        
        // Réappliquer le filtre de recherche
        String searchText = searchField.getText();
        if (searchText != null && !searchText.trim().isEmpty()) {
            setupSearch();
        }
        
        // Réappliquer le tri si nécessaire
        if (sortButton.isSelected()) {
            handleSort();
        }
    }
    
    @FXML
    private void handleOpenAjoutForm() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCategorieCours.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter une Catégorie de Cours");
            stage.initModality(Modality.APPLICATION_MODAL); // Bloque les interactions avec les autres fenêtres
            stage.setScene(new Scene(root));
            stage.showAndWait(); // Attend que la fenêtre soit fermée
            
            // Rafraîchir la table quand le formulaire est fermé
            refreshTable();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'ajout", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
        }
    }
    
    @FXML
    private void handleOpenModifierForm() {
        CategorieCours selectedCategorie = categorieTable.getSelectionModel().getSelectedItem();
        
        if (selectedCategorie != null) {
            try {
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCategorieCours.fxml"));
                Parent root = loader.load();
                
                // Accéder au contrôleur du formulaire
                CategorieCoursFormController controller = loader.getController();
                
                // Passer la catégorie sélectionnée au contrôleur
                controller.setCategorieForModification(selectedCategorie);
                
                Stage stage = new Stage();
                stage.setTitle("Modifier une Catégorie de Cours");
                stage.initModality(Modality.APPLICATION_MODAL); // Bloque les interactions avec les autres fenêtres
                stage.setScene(new Scene(root));
                stage.showAndWait(); // Attend que la fenêtre soit fermée
                
                // Rafraîchir la table quand le formulaire est fermé
                refreshTable();
                
            } catch (IOException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire de modification", e);
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner une catégorie à modifier!");
        }
    }
    
    @FXML
    private void handleSupprimer() {
        CategorieCours selectedCategorie = categorieTable.getSelectionModel().getSelectedItem();
        
        if (selectedCategorie != null) {
            Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
            confirmAlert.setTitle("Confirmation");
            confirmAlert.setHeaderText(null);
            confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer cette catégorie? Cette action supprimera également tous les cours associés.");
            
            Optional<ButtonType> result = confirmAlert.showAndWait();
            if (result.isPresent() && result.get() == ButtonType.OK) {
                try {
                    categorieService.supprimer(selectedCategorie);
                    refreshTable();
                    
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "La catégorie a été supprimée avec succès!");
                    
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de la suppression de la catégorie", e);
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression: " + e.getMessage());
                }
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner une catégorie à supprimer!");
        }
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 