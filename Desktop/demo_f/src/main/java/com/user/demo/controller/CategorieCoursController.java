package com.user.demo.controller;

import com.user.demo.model.CategorieCours;
import com.user.demo.service.CategorieCoursService;
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

public class CategorieCoursController implements Initializable {
    
    private static final Logger LOGGER = Logger.getLogger(CategorieCoursController.class.getName());
    
    @FXML private TextField searchField;
    @FXML private TableView<CategorieCours> categorieTable;
    @FXML private TableColumn<CategorieCours, String> nomColumn;
    @FXML private TableColumn<CategorieCours, String> descriptionColumn;
    
    private CategorieCoursService categorieService;
    private ObservableList<CategorieCours> categoriesList;
    private FilteredList<CategorieCours> filteredList;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        categorieService = new CategorieCoursService();
        
        // Apply CSS styles to the scene
        categorieTable.sceneProperty().addListener((obs, oldScene, newScene) -> {
            if (newScene != null) {
                try {
                    String cssPath = getClass().getResource("/com/user/demo/views/admin-styles.css").toExternalForm();
                    newScene.getStylesheets().add(cssPath);
                    System.out.println("CSS loaded successfully from: " + cssPath);
                } catch (Exception e) {
                    System.err.println("Error loading CSS: " + e.getMessage());
                    e.printStackTrace();
                }
            }
        });
        
        // Initialiser les colonnes
        initializeColumns();
        
        // Charger les données
        loadData();
        
        // Configurer la recherche
        setupSearch();
    }
    
    private void initializeColumns() {
        nomColumn.setCellValueFactory(new PropertyValueFactory<>("nom"));
        descriptionColumn.setCellValueFactory(new PropertyValueFactory<>("description"));
    }
    
    private void loadData() {
        List<CategorieCours> categories = categorieService.afficher();
        categoriesList = FXCollections.observableArrayList(categories);
        filteredList = new FilteredList<>(categoriesList, p -> true);
        
        SortedList<CategorieCours> sortedList = new SortedList<>(filteredList);
        sortedList.comparatorProperty().bind(categorieTable.comparatorProperty());
        
        categorieTable.setItems(sortedList);
    }
    
    private void setupSearch() {
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredList.setPredicate(categorie -> {
                if (newValue == null || newValue.trim().isEmpty()) {
                    return true;
                }
                
                String lowerCaseFilter = newValue.toLowerCase().trim();
                return categorie.getNom().toLowerCase().contains(lowerCaseFilter) ||
                       categorie.getDescription().toLowerCase().contains(lowerCaseFilter);
            });
        });
    }
    
    @FXML
    private void handleOpenAjoutForm() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCategorieCours.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter une Catégorie");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(new Scene(root));
            stage.showAndWait();
            
            loadData();
            
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
                
                CategorieCoursFormController controller = loader.getController();
                controller.setCategorieForModification(selectedCategorie);
                
                Stage stage = new Stage();
                stage.setTitle("Modifier une Catégorie");
                stage.initModality(Modality.APPLICATION_MODAL);
                stage.setScene(new Scene(root));
                stage.showAndWait();
                
                loadData();
                
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
            confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer cette catégorie?");
            
            Optional<ButtonType> result = confirmAlert.showAndWait();
            if (result.isPresent() && result.get() == ButtonType.OK) {
                try {
                    categorieService.supprimer(selectedCategorie);
                    loadData();
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "La catégorie a été supprimée avec succès!");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de la suppression de la catégorie", e);
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression de la catégorie: " + e.getMessage());
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