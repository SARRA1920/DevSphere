package com.esprit.controllers;

import com.esprit.models.Cours;
import com.esprit.models.Inscription;
import com.esprit.services.CoursService;
import com.esprit.services.InscriptionService;
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
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;

public class InscriptionController implements Initializable {

    private static final Logger LOGGER = Logger.getLogger(InscriptionController.class.getName());
    
    @FXML
    private TableView<Inscription> inscriptionsTable;
    
    @FXML
    private TableColumn<Inscription, Integer> idColumn;
    
    @FXML
    private TableColumn<Inscription, String> nomColumn;
    
    @FXML
    private TableColumn<Inscription, String> emailColumn;
    
    @FXML
    private TableColumn<Inscription, String> telephoneColumn;
    
    @FXML
    private TableColumn<Inscription, String> coursColumn;
    
    @FXML
    private TableColumn<Inscription, LocalDateTime> dateInscriptionColumn;
    
    @FXML
    private TableColumn<Inscription, String> statutColumn;
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ToggleButton sortButton;
    
    private InscriptionService inscriptionService;
    private CoursService coursService;
    private ObservableList<Inscription> inscriptionsList;
    private FilteredList<Inscription> filteredList;
    private boolean isAscendingSort = true;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        inscriptionService = new InscriptionService();
        coursService = new CoursService();
        
        initializeColumns();
        loadData();
        setupSearch();
        
        // Initialiser le bouton de tri
        updateSortButtonText();
    }
    
    private void initializeColumns() {
        idColumn.setCellValueFactory(new PropertyValueFactory<>("id"));
        nomColumn.setCellValueFactory(new PropertyValueFactory<>("nom"));
        emailColumn.setCellValueFactory(new PropertyValueFactory<>("email"));
        telephoneColumn.setCellValueFactory(new PropertyValueFactory<>("telephone"));
        
        coursColumn.setCellValueFactory(cellData -> {
            Cours cours = cellData.getValue().getCours();
            String titre = cours != null ? cours.getTitre() : "N/A";
            return javafx.beans.binding.Bindings.createStringBinding(() -> titre);
        });
        
        dateInscriptionColumn.setCellValueFactory(new PropertyValueFactory<>("dateInscription"));
        dateInscriptionColumn.setCellFactory(column -> new TableCell<Inscription, LocalDateTime>() {
            private final DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
            
            @Override
            protected void updateItem(LocalDateTime date, boolean empty) {
                super.updateItem(date, empty);
                setText(empty || date == null ? null : formatter.format(date));
            }
        });
        
        statutColumn.setCellValueFactory(new PropertyValueFactory<>("statut"));
    }
    
    private void loadData() {
        inscriptionsList = FXCollections.observableArrayList(inscriptionService.afficher());
        filteredList = new FilteredList<>(inscriptionsList, p -> true);
        
        // Créer une SortedList basée sur la FilteredList
        SortedList<Inscription> sortedList = new SortedList<>(filteredList);
        sortedList.comparatorProperty().bind(inscriptionsTable.comparatorProperty());
        
        inscriptionsTable.setItems(sortedList);
    }
    
    private void setupSearch() {
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredList.setPredicate(inscription -> {
                if (newValue == null || newValue.trim().isEmpty()) {
                    return true;
                }
                
                String lowerCaseFilter = newValue.toLowerCase().trim();
                return inscription.getNom().toLowerCase().contains(lowerCaseFilter);
            });
        });
    }
    
    @FXML
    private void handleSort() {
        isAscendingSort = !isAscendingSort;
        updateSortButtonText();
        
        // Clear the current sort order
        inscriptionsTable.getSortOrder().clear();
        
        // Set the sort type on the name column
        nomColumn.setSortType(isAscendingSort ? TableColumn.SortType.ASCENDING : TableColumn.SortType.DESCENDING);
        
        // Add the column to the sort order
        inscriptionsTable.getSortOrder().add(nomColumn);
        
        // Force the sort
        inscriptionsTable.sort();
    }
    
    private void updateSortButtonText() {
        sortButton.setText("Trier par nom " + (isAscendingSort ? "↑" : "↓"));
    }
    
    private void refreshTable() {
        List<Inscription> updatedList = inscriptionService.afficher();
        inscriptionsList.clear();
        inscriptionsList.addAll(updatedList);
        
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
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutInscription.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter une Inscription");
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
        Inscription selectedInscription = inscriptionsTable.getSelectionModel().getSelectedItem();
        
        if (selectedInscription != null) {
            try {
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjoutInscription.fxml"));
                Parent root = loader.load();
                
                InscriptionFormController controller = loader.getController();
                controller.setInscriptionForModification(selectedInscription);
                
                Stage stage = new Stage();
                stage.setTitle("Modifier une Inscription");
                stage.initModality(Modality.APPLICATION_MODAL);
                stage.setScene(new Scene(root));
                stage.showAndWait();
                
                refreshTable();
                
            } catch (IOException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire de modification", e);
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'ouverture du formulaire: " + e.getMessage());
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner une inscription à modifier!");
        }
    }
    
    @FXML
    private void handleSupprimer() {
        Inscription selectedInscription = inscriptionsTable.getSelectionModel().getSelectedItem();
        
        if (selectedInscription != null) {
            Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
            confirmAlert.setTitle("Confirmation");
            confirmAlert.setHeaderText(null);
            confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer cette inscription?");
            
            Optional<ButtonType> result = confirmAlert.showAndWait();
            if (result.isPresent() && result.get() == ButtonType.OK) {
                try {
                    inscriptionService.supprimer(selectedInscription);
                    refreshTable();
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "L'inscription a été supprimée avec succès!");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de la suppression de l'inscription", e);
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la suppression: " + e.getMessage());
                }
            }
        } else {
            showAlert(Alert.AlertType.WARNING, "Aucune sélection", "Veuillez sélectionner une inscription à supprimer!");
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