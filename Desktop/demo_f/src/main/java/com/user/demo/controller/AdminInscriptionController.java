package com.user.demo.controller;

import com.user.demo.model.Inscription;
import com.user.demo.model.Cours;
import com.user.demo.service.InscriptionService;
import com.user.demo.service.CoursService;
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
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.HBox;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.util.Callback;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.scene.control.Alert;
import java.sql.SQLException;
import java.net.URL;
import java.util.ResourceBundle;
import java.time.LocalDate;
import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;
import java.io.IOException;

public class AdminInscriptionController implements Initializable {

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
    private TableColumn<Inscription, String> statutColumn;
    
    @FXML
    private TableColumn<Inscription, LocalDate> dateInscriptionColumn;
    
    @FXML
    private TableColumn<Inscription, Void> actionsColumn;

    @FXML
    private TextField searchField;
    
    @FXML
    private ComboBox<String> statusFilter;
    
    @FXML
    private ComboBox<String> coursFilter;
    
    @FXML
    private DatePicker dateFilter;

    @FXML
    private Label statusLabel;
    
    @FXML
    private Label pendingLabel;
    
    @FXML
    private Label confirmedLabel;
    
    @FXML
    private Label cancelledLabel;

    private InscriptionService inscriptionService;
    private CoursService coursService;
    private ObservableList<Inscription> inscriptionsList = FXCollections.observableArrayList();
    private FilteredList<Inscription> filteredList;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        try {
            // Initialize services
            inscriptionService = new InscriptionService();
            coursService = new CoursService();
            
            // Initialize table columns
            idColumn.setCellValueFactory(new PropertyValueFactory<>("id"));
            nomColumn.setCellValueFactory(new PropertyValueFactory<>("nom"));
            emailColumn.setCellValueFactory(new PropertyValueFactory<>("email"));
            telephoneColumn.setCellValueFactory(new PropertyValueFactory<>("telephone"));
            
            // Use custom cell value factories for complex properties
            coursColumn.setCellValueFactory(cellData -> {
                Cours cours = cellData.getValue().getCours();
                return new SimpleStringProperty(cours != null ? cours.getTitre() : "");
            });
            
            statutColumn.setCellValueFactory(new PropertyValueFactory<>("statut"));
            dateInscriptionColumn.setCellValueFactory(new PropertyValueFactory<>("dateInscription"));
            
            // Setup action buttons in table
            setupActionsColumn();
            
            // Initialize filters
            setupFilters();
            
            // Load data
            loadInscriptions();
            
            // Setup search functionality
            setupSearch();
        } catch (Exception e) {
            e.printStackTrace();
            String errorMessage = "Une erreur est survenue lors de l'initialisation: " + e.getMessage();
            if (e instanceof SQLException) {
                SQLException sqlEx = (SQLException) e;
                if (sqlEx.getMessage().contains("Communications link failure")) {
                    errorMessage = "Impossible de se connecter à la base de données. Vérifiez que le serveur est en cours d'exécution.";
                } else if (sqlEx.getMessage().contains("Access denied")) {
                    errorMessage = "Accès refusé à la base de données. Vérifiez vos identifiants.";
                } else if (sqlEx.getMessage().contains("Unknown database")) {
                    errorMessage = "La base de données 'devsphere' n'existe pas.";
                }
            }
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de chargement", errorMessage);
        }
    }
    
    private void setupFilters() {
        // Add empty option
        statusFilter.getItems().add("Tous les statuts");
        coursFilter.getItems().add("Tous les cours");
        
        // Add statuses
        statusFilter.getItems().addAll("En attente", "Confirmée", "Annulée");
        
        // Add courses
        List<Cours> courses = coursService.rechercher();
        coursFilter.getItems().addAll(
            courses.stream()
                .map(Cours::getTitre)
                .collect(Collectors.toList())
        );
        
        // Select default options
        statusFilter.getSelectionModel().selectFirst();
        coursFilter.getSelectionModel().selectFirst();
    }
    
    private void setupActionsColumn() {
        Callback<TableColumn<Inscription, Void>, TableCell<Inscription, Void>> cellFactory = new Callback<>() {
            @Override
            public TableCell<Inscription, Void> call(TableColumn<Inscription, Void> param) {
                return new TableCell<>() {
                    private final Button editBtn = new Button();
                    private final Button deleteBtn = new Button();
                    private final Button confirmBtn = new Button();

                    {
                        // Setup Confirm button with icon
                        FontAwesomeIconView confirmIcon = new FontAwesomeIconView(FontAwesomeIcon.CHECK);
                        confirmIcon.setGlyphSize(14);
                        confirmBtn.setGraphic(confirmIcon);
                        confirmBtn.getStyleClass().add("action-button-success");
                        confirmBtn.setTooltip(new Tooltip("Confirmer"));
                        
                        // Setup Edit button with icon
                        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
                        editIcon.setGlyphSize(14);
                        editBtn.setGraphic(editIcon);
                        editBtn.getStyleClass().add("action-button");
                        editBtn.setTooltip(new Tooltip("Modifier"));

                        // Setup Delete button with icon
                        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TIMES);
                        deleteIcon.setGlyphSize(14);
                        deleteBtn.setGraphic(deleteIcon);
                        deleteBtn.getStyleClass().add("action-button-danger");
                        deleteBtn.setTooltip(new Tooltip("Annuler"));

                        // Set action handlers
                        confirmBtn.setOnAction(event -> {
                            Inscription inscription = getTableView().getItems().get(getIndex());
                            handleConfirmInscription(inscription);
                        });
                        
                        editBtn.setOnAction(event -> {
                            Inscription inscription = getTableView().getItems().get(getIndex());
                            handleEditInscription(inscription);
                        });

                        deleteBtn.setOnAction(event -> {
                            Inscription inscription = getTableView().getItems().get(getIndex());
                            handleCancelInscription(inscription);
                        });
                    }

                    @Override
                    protected void updateItem(Void item, boolean empty) {
                        super.updateItem(item, empty);
                        if (empty) {
                            setGraphic(null);
                        } else {
                            Inscription inscription = getTableView().getItems().get(getIndex());
                            HBox buttonsBox;
                            
                            if ("En attente".equals(inscription.getStatut())) {
                                buttonsBox = new HBox(5, confirmBtn, editBtn, deleteBtn);
                            } else if ("Confirmée".equals(inscription.getStatut())) {
                                buttonsBox = new HBox(5, editBtn, deleteBtn);
                            } else {
                                buttonsBox = new HBox(5, confirmBtn, editBtn);
                            }
                            
                            setGraphic(buttonsBox);
                        }
                    }
                };
            }
        };
        
        actionsColumn.setCellFactory(cellFactory);
    }
    
    private void loadInscriptions() {
        try {
            // Clear the existing list
            inscriptionsList.clear();
            
            // Get all inscriptions from the service
            List<Inscription> inscriptions = inscriptionService.afficher();
            
            // Add them to the observable list
            inscriptionsList.addAll(inscriptions);
            
            // Initialize filteredList if it's null
            if (filteredList == null) {
                filteredList = new FilteredList<>(inscriptionsList, p -> true);
                
                // Set up the filtered list with the tableview
                SortedList<Inscription> sortedList = new SortedList<>(filteredList);
                sortedList.comparatorProperty().bind(inscriptionsTable.comparatorProperty());
                inscriptionsTable.setItems(sortedList);
            }
            
            // Update status labels
            updateStatusLabels();
            
        } catch (Exception e) {
            e.printStackTrace();
            String errorMessage = "Une erreur est survenue lors du chargement des inscriptions: " + e.getMessage();
            if (e instanceof SQLException) {
                SQLException sqlEx = (SQLException) e;
                if (sqlEx.getMessage().contains("Communications link failure")) {
                    errorMessage = "Impossible de se connecter à la base de données. Vérifiez que le serveur est en cours d'exécution.";
                } else if (sqlEx.getMessage().contains("Access denied")) {
                    errorMessage = "Accès refusé à la base de données. Vérifiez vos identifiants.";
                } else if (sqlEx.getMessage().contains("Table") && sqlEx.getMessage().contains("doesn't exist")) {
                    errorMessage = "La table des inscriptions n'existe pas dans la base de données.";
                }
            }
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de chargement des inscriptions", errorMessage);
        }
    }
    
    private void setupSearch() {
        // Set the filter Predicate whenever the search field changes
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            applyFilters();
        });
    }
    
    private void applyFilters() {
        String searchText = searchField.getText().toLowerCase();
        String statut = statusFilter.getValue();
        String coursName = coursFilter.getValue();
        LocalDate selectedDate = dateFilter.getValue();
        
        filteredList.setPredicate(inscription -> {
            boolean matchesSearch = searchText.isEmpty() || 
                                   inscription.getNom().toLowerCase().contains(searchText) ||
                                   inscription.getEmail().toLowerCase().contains(searchText) ||
                                   inscription.getTelephone().toLowerCase().contains(searchText);
            
            boolean matchesStatus = "Tous les statuts".equals(statut) || 
                                    inscription.getStatut().equals(statut);
            
            boolean matchesCours = "Tous les cours".equals(coursName) || 
                                  (inscription.getCours() != null && 
                                   inscription.getCours().getTitre().equals(coursName));
            
            boolean matchesDate = selectedDate == null || 
                                 (inscription.getDateInscription() != null && 
                                  inscription.getDateInscription().equals(selectedDate));
            
            return matchesSearch && matchesStatus && matchesCours && matchesDate;
        });
        
        // Update status labels to reflect filtered results
        updateStatusLabels();
    }
    
    private void updateStatusLabels() {
        int total = filteredList.size();
        statusLabel.setText("Total: " + total + " inscriptions");
        
        long pending = filteredList.stream()
                .filter(i -> "En attente".equals(i.getStatut()))
                .count();
        pendingLabel.setText("En attente: " + pending);
        
        long confirmed = filteredList.stream()
                .filter(i -> "Confirmée".equals(i.getStatut()))
                .count();
        confirmedLabel.setText("Confirmées: " + confirmed);
        
        long cancelled = filteredList.stream()
                .filter(i -> "Annulée".equals(i.getStatut()))
                .count();
        cancelledLabel.setText("Annulées: " + cancelled);
    }
    
    @FXML
    private void handleAddInscription() {
        try {
            // Charger le fichier FXML du formulaire d'inscription
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/inscription-form.fxml"));
            Parent root = loader.load();
            
            // Créer une nouvelle fenêtre
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Ajouter une inscription");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.setResizable(true);
            
            // Définir la scène
            Scene scene = new Scene(root);
            dialogStage.setScene(scene);
            
            // Récupérer le contrôleur et initialiser la fenêtre
            InscriptionFormController controller = loader.getController();
            controller.setDialogStage(dialogStage);
            
            // Afficher la fenêtre et attendre qu'elle soit fermée
            dialogStage.showAndWait();
            
            // Rafraîchir la liste des inscriptions après la fermeture
            loadInscriptions();
            
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'ouverture", 
                    "Impossible d'ouvrir le formulaire d'inscription: " + e.getMessage());
        }
    }
    
    private void handleConfirmInscription(Inscription inscription) {
        try {
            inscription.setStatut("Confirmée");
            inscriptionService.modifier(inscription);
            
            // Refresh the table
            loadInscriptions();
            
            showAlert(Alert.AlertType.INFORMATION, "Succès", "Inscription confirmée", 
                    "L'inscription a été confirmée avec succès.");
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de confirmation", 
                    "Une erreur s'est produite lors de la confirmation de l'inscription: " + e.getMessage());
        }
    }
    
    private void handleEditInscription(Inscription inscription) {
        try {
            // Charger le fichier FXML du formulaire d'inscription
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/inscription-form.fxml"));
            Parent root = loader.load();
            
            // Créer une nouvelle fenêtre
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Modifier l'inscription");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.setResizable(true);
            
            // Définir la scène
            Scene scene = new Scene(root);
            dialogStage.setScene(scene);
            
            // Récupérer le contrôleur et initialiser la fenêtre
            InscriptionFormController controller = loader.getController();
            controller.setDialogStage(dialogStage);
            
            // Passer l'inscription à modifier au contrôleur
            controller.setInscriptionForModification(inscription);
            
            // Afficher la fenêtre et attendre qu'elle soit fermée
            dialogStage.showAndWait();
            
            // Rafraîchir la liste des inscriptions après la fermeture
            loadInscriptions();
            
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'ouverture", 
                    "Impossible d'ouvrir le formulaire de modification: " + e.getMessage());
        }
    }
    
    private void handleCancelInscription(Inscription inscription) {
        // Show confirmation dialog
        Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
        confirmAlert.setTitle("Confirmation d'annulation");
        confirmAlert.setHeaderText("Annuler l'inscription");
        confirmAlert.setContentText("Êtes-vous sûr de vouloir annuler l'inscription de '" + inscription.getNom() + "' ?");
        
        Optional<ButtonType> result = confirmAlert.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            try {
                inscription.setStatut("Annulée");
                inscriptionService.modifier(inscription);
                
                // Refresh the table
                loadInscriptions();
                
                showAlert(Alert.AlertType.INFORMATION, "Succès", "Inscription annulée", 
                        "L'inscription a été annulée avec succès.");
            } catch (Exception e) {
                e.printStackTrace();
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'annulation", 
                        "Une erreur s'est produite lors de l'annulation de l'inscription: " + e.getMessage());
            }
        }
    }
    
    @FXML
    private void handleSearch() {
        applyFilters();
    }
    
    @FXML
    private void handleStatusFilter() {
        applyFilters();
    }
    
    @FXML
    private void handleCoursFilter() {
        applyFilters();
    }
    
    @FXML
    private void handleDateFilter() {
        applyFilters();
    }
    
    @FXML
    private void handleClearFilters() {
        searchField.clear();
        statusFilter.getSelectionModel().selectFirst();
        coursFilter.getSelectionModel().selectFirst();
        dateFilter.setValue(null);
        applyFilters();
    }
    
    private void showAlert(Alert.AlertType alertType, String title, String header, String content) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(header);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 