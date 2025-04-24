package com.esprit.controllers;

import com.esprit.models.CategorieCours;
import com.esprit.models.Cours;
import com.esprit.services.CategorieCoursService;
import com.esprit.services.CoursService;
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
import javafx.stage.FileChooser;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.util.StringConverter;

import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.time.LocalDateTime;
import java.util.*;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.stream.Collectors;

public class CoursController implements Initializable {
    
    private static final Logger LOGGER = Logger.getLogger(CoursController.class.getName());
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ToggleButton sortButton;
    
    @FXML
    private TableView<Cours> coursTable;
    
    @FXML
    private TableColumn<Cours, String> titreColumn;
    
    @FXML
    private TableColumn<Cours, String> descriptionColumn;
    
    @FXML
    private TableColumn<Cours, String> dureeColumn;
    
    @FXML
    private TableColumn<Cours, String> niveauColumn;
    
    @FXML
    private TableColumn<Cours, String> categorieColumn;
    
    @FXML
    private TableColumn<Cours, String> instructeurColumn;
    
    @FXML
    private TableColumn<Cours, String> imageColumn;
    
    @FXML
    private TableColumn<Cours, String> pdfColumn;
    
    private CoursService coursService;
    private CategorieCoursService categorieService;
    private ObservableList<Cours> coursList;
    private FilteredList<Cours> filteredCoursList;
    private Map<Integer, String> categoriesMap;
    private boolean isAscendingSort = true;
    
    // Répertoires pour stocker les fichiers
    private final String RESOURCES_DIR = "src/main/resources/";
    private final String IMAGES_DIR = RESOURCES_DIR + "images/";
    private final String PDF_DIR = RESOURCES_DIR + "pdfs/";
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        coursService = new CoursService();
        categorieService = new CategorieCoursService();
        categoriesMap = new HashMap<>();
        
        // Créer les répertoires s'ils n'existent pas
        createDirectoryIfNotExists(IMAGES_DIR);
        createDirectoryIfNotExists(PDF_DIR);
        
        // Charger les catégories
        loadCategories();
        
        // Initialiser les colonnes
        initializeColumns();
        
        // Charger les données
        loadCoursData();
        
        // Configurer la recherche
        setupSearch();
        
        // Initialiser le bouton de tri
        updateSortButtonText();
    }
    
    private void initializeColumns() {
        titreColumn.setCellValueFactory(new PropertyValueFactory<>("titre"));
        descriptionColumn.setCellValueFactory(new PropertyValueFactory<>("description"));
        dureeColumn.setCellValueFactory(new PropertyValueFactory<>("duree"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveau"));
        instructeurColumn.setCellValueFactory(new PropertyValueFactory<>("instructeur"));
        imageColumn.setCellValueFactory(new PropertyValueFactory<>("image"));
        pdfColumn.setCellValueFactory(new PropertyValueFactory<>("pdfFilename"));
        
        categorieColumn.setCellValueFactory(cellData -> {
            int categorieId = cellData.getValue().getCategorieCoursId();
            String categorieName = categoriesMap.getOrDefault(categorieId, "N/A");
            return javafx.beans.binding.Bindings.createStringBinding(() -> categorieName);
        });
    }
    
    private void loadCoursData() {
        List<Cours> cours = coursService.rechercher();
        coursList = FXCollections.observableArrayList(cours);
        filteredCoursList = new FilteredList<>(coursList, p -> true);
        
        // Créer une SortedList basée sur la FilteredList
        SortedList<Cours> sortedList = new SortedList<>(filteredCoursList);
        sortedList.comparatorProperty().bind(coursTable.comparatorProperty());
        
        coursTable.setItems(sortedList);
    }
    
    private void setupSearch() {
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredCoursList.setPredicate(cours -> {
                // Si le texte de recherche est vide, afficher tous les cours
                if (newValue == null || newValue.trim().isEmpty()) {
                    return true;
                }
                
                // Convertir le texte de recherche en minuscules
                String lowerCaseFilter = newValue.toLowerCase().trim();
                
                // Vérifier si le titre du cours contient le texte de recherche
                return cours.getTitre().toLowerCase().contains(lowerCaseFilter);
            });
        });
    }
    
    @FXML
    private void handleSort() {
        isAscendingSort = !isAscendingSort;
        updateSortButtonText();
        
        // Clear the current sort order
        coursTable.getSortOrder().clear();
        
        // Set the sort type on the title column
        titreColumn.setSortType(isAscendingSort ? TableColumn.SortType.ASCENDING : TableColumn.SortType.DESCENDING);
        
        // Add the column to the sort order
        coursTable.getSortOrder().add(titreColumn);
        
        // Force the sort
        coursTable.sort();
    }
    
    private void updateSortButtonText() {
        sortButton.setText("Trier par titre " + (isAscendingSort ? "↑" : "↓"));
    }
    
    private void createDirectoryIfNotExists(String dirPath) {
        File directory = new File(dirPath);
        if (!directory.exists()) {
            boolean created = directory.mkdirs();
            if (!created) {
                LOGGER.log(Level.WARNING, "Impossible de créer le répertoire: {0}", dirPath);
            }
        }
    }
    
    private void loadCategories() {
        try {
            List<CategorieCours> categories = categorieService.afficher();
            for (CategorieCours categorie : categories) {
                categoriesMap.put(categorie.getId(), categorie.getNom());
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des catégories", e);
        }
    }
    
    private void refreshTable() {
        List<Cours> updatedCoursList = coursService.rechercher();
        coursList.clear();
        coursList.addAll(updatedCoursList);
        
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
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCours.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter un Cours");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(new Scene(root));
            stage.showAndWait();
            
            refreshTable();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'ajout", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
        }
    }
    
    @FXML
    private void handleOpenModifierForm() {
        Cours selectedCours = coursTable.getSelectionModel().getSelectedItem();
        
        if (selectedCours != null) {
            try {
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutCours.fxml"));
                Parent root = loader.load();
                
                CoursFormController controller = loader.getController();
                controller.setCoursForModification(selectedCours);
                
                Stage stage = new Stage();
                stage.setTitle("Modifier un Cours");
                stage.initModality(Modality.APPLICATION_MODAL);
                stage.setScene(new Scene(root));
                stage.showAndWait();
                
                refreshTable();
                
            } catch (IOException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire de modification", e);
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner un cours à modifier!");
        }
    }
    
    @FXML
    private void handleSupprimer() {
        Cours selectedCours = coursTable.getSelectionModel().getSelectedItem();
        
        if (selectedCours != null) {
            Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
            confirmAlert.setTitle("Confirmation");
            confirmAlert.setHeaderText(null);
            confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer ce cours?");
            
            Optional<ButtonType> result = confirmAlert.showAndWait();
            if (result.isPresent() && result.get() == ButtonType.OK) {
                try {
                    coursService.supprimer(selectedCours);
                    refreshTable();
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "Le cours a été supprimé avec succès!");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de la suppression du cours", e);
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression du cours: " + e.getMessage());
                }
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner un cours à supprimer!");
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