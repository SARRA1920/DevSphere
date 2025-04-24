package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.model.CategorieCours;
import com.user.demo.service.CoursService;
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
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.HBox;
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
import java.util.stream.Collectors;

public class AdminCoursController implements Initializable {

    @FXML
    private TableView<Cours> coursTable;

    @FXML
    private TableColumn<Cours, Integer> idColumn;

    @FXML
    private TableColumn<Cours, String> titreColumn;
    
    @FXML
    private TableColumn<Cours, String> categorieColumn;
    
    @FXML
    private TableColumn<Cours, String> instructeurColumn;
    
    @FXML
    private TableColumn<Cours, String> niveauColumn;
    
    @FXML
    private TableColumn<Cours, Integer> dureeColumn;
    
    @FXML
    private TableColumn<Cours, Void> actionsColumn;

    @FXML
    private TextField searchField;
    
    @FXML
    private ComboBox<String> categoryFilter;
    
    @FXML
    private ComboBox<String> niveauFilter;

    @FXML
    private Label statusLabel;

    private CoursService coursService;
    private CategorieCoursService categorieService;
    private ObservableList<Cours> coursList = FXCollections.observableArrayList();
    private FilteredList<Cours> filteredList;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Initialize services
        coursService = new CoursService();
        categorieService = new CategorieCoursService();
        
        // Initialize table columns
        idColumn.setCellValueFactory(new PropertyValueFactory<>("id"));
        titreColumn.setCellValueFactory(new PropertyValueFactory<>("titre"));
        
        // Use custom cell value factories for more complex properties
        categorieColumn.setCellValueFactory(cellData -> {
            CategorieCours categorie = cellData.getValue().getCategorie();
            return new SimpleStringProperty(categorie != null ? categorie.getNom() : "");
        });
        
        instructeurColumn.setCellValueFactory(new PropertyValueFactory<>("instructeur"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveau"));
        dureeColumn.setCellValueFactory(new PropertyValueFactory<>("duree"));
        
        // Setup action buttons in table
        setupActionsColumn();
        
        // Initialize filters
        setupFilters();
        
        // Load data
        loadCours();
        
        // Setup search functionality
        setupSearch();
    }
    
    private void setupFilters() {
        // Add empty option
        categoryFilter.getItems().add("Toutes les catégories");
        niveauFilter.getItems().add("Tous les niveaux");
        
        // Add categories
        List<CategorieCours> categories = categorieService.afficher();
        categoryFilter.getItems().addAll(
            categories.stream()
                .map(CategorieCours::getNom)
                .collect(Collectors.toList())
        );
        
        // Add standard levels
        niveauFilter.getItems().addAll("Débutant", "Intermédiaire", "Avancé");
        
        // Select default options
        categoryFilter.getSelectionModel().selectFirst();
        niveauFilter.getSelectionModel().selectFirst();
    }
    
    private void setupActionsColumn() {
        Callback<TableColumn<Cours, Void>, TableCell<Cours, Void>> cellFactory = new Callback<>() {
            @Override
            public TableCell<Cours, Void> call(TableColumn<Cours, Void> param) {
                return new TableCell<>() {
                    private final Button editBtn = new Button();
                    private final Button deleteBtn = new Button();
                    private final Button viewBtn = new Button();
                    private final Button modifierBtn = new Button();

                    {
                        // Setup View button with icon
                        FontAwesomeIconView viewIcon = new FontAwesomeIconView(FontAwesomeIcon.EYE);
                        viewIcon.setGlyphSize(14);
                        viewBtn.setGraphic(viewIcon);
                        viewBtn.getStyleClass().add("action-button");
                        viewBtn.setTooltip(new Tooltip("Voir"));
                        
                        // Setup Edit button with icon
                        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
                        editIcon.setGlyphSize(14);
                        editBtn.setGraphic(editIcon);
                        editBtn.getStyleClass().add("action-button");
                        editBtn.setTooltip(new Tooltip("Modifier"));

                        // Setup Modifier button with icon (with green color)
                        FontAwesomeIconView modifierIcon = new FontAwesomeIconView(FontAwesomeIcon.PENCIL);
                        modifierIcon.setGlyphSize(14);
                        modifierIcon.setFill(javafx.scene.paint.Color.WHITE);
                        modifierBtn.setGraphic(modifierIcon);
                        modifierBtn.getStyleClass().add("action-button-success");
                        modifierBtn.setTooltip(new Tooltip("Modifier"));
                        modifierBtn.setStyle(
                            "-fx-background-color: #2ecc71;" + // Green color
                            "-fx-text-fill: white;" +
                            "-fx-font-weight: bold;" +
                            "-fx-background-radius: 4px;" +
                            "-fx-min-width: 32px;" +
                            "-fx-min-height: 32px;" +
                            "-fx-cursor: hand;"
                        );

                        // Setup Delete button with icon
                        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
                        deleteIcon.setGlyphSize(14);
                        deleteBtn.setGraphic(deleteIcon);
                        deleteBtn.getStyleClass().add("action-button-danger");
                        deleteBtn.setTooltip(new Tooltip("Supprimer"));

                        // Set action handlers
                        viewBtn.setOnAction(event -> {
                            Cours cours = getTableView().getItems().get(getIndex());
                            handleViewCours(cours);
                        });
                        
                        editBtn.setOnAction(event -> {
                            Cours cours = getTableView().getItems().get(getIndex());
                            handleEditCours(cours);
                        });
                        
                        modifierBtn.setOnAction(event -> {
                            Cours cours = getTableView().getItems().get(getIndex());
                            handleEditCours(cours);
                        });

                        deleteBtn.setOnAction(event -> {
                            Cours cours = getTableView().getItems().get(getIndex());
                            handleDeleteCours(cours);
                        });
                    }

                    @Override
                    protected void updateItem(Void item, boolean empty) {
                        super.updateItem(item, empty);
                        if (empty) {
                            setGraphic(null);
                        } else {
                            HBox buttonsBox = new HBox(5, viewBtn, modifierBtn, deleteBtn);
                            setGraphic(buttonsBox);
                        }
                    }
                };
            }
        };
        
        actionsColumn.setCellFactory(cellFactory);
    }
    
    private void loadCours() {
        try {
            // Clear the existing list
            coursList.clear();
            
            // Get all courses from the service
            List<Cours> courses = coursService.rechercher();
            
            // Add them to the observable list
            coursList.addAll(courses);
            
            // Initialize filteredList if it's null
            if (filteredList == null) {
                filteredList = new FilteredList<>(coursList, p -> true);
                
                // Set up the filtered list with the tableview
                SortedList<Cours> sortedList = new SortedList<>(filteredList);
                sortedList.comparatorProperty().bind(coursTable.comparatorProperty());
                coursTable.setItems(sortedList);
            }
            
            // Update status label
            updateStatusLabel();
            
            System.out.println("Courses loaded: " + courses.size());
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de chargement des cours", 
                    "Une erreur s'est produite lors du chargement des cours: " + e.getMessage());
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
        String categoryName = categoryFilter.getValue();
        String niveau = niveauFilter.getValue();
        
        filteredList.setPredicate(cours -> {
            boolean matchesSearch = searchText.isEmpty() || 
                                   cours.getTitre().toLowerCase().contains(searchText) ||
                                   cours.getDescription().toLowerCase().contains(searchText) ||
                                   cours.getInstructeur().toLowerCase().contains(searchText);
            
            boolean matchesCategory = "Toutes les catégories".equals(categoryName) || 
                                     (cours.getCategorie() != null && 
                                      cours.getCategorie().getNom().equals(categoryName));
            
            boolean matchesNiveau = "Tous les niveaux".equals(niveau) || 
                                   cours.getNiveau().equals(niveau);
            
            return matchesSearch && matchesCategory && matchesNiveau;
        });
        
        // Update status label to reflect filtered results
        updateStatusLabel();
    }
    
    @FXML
    private void handleCategoryFilter() {
        applyFilters();
    }
    
    @FXML
    private void handleNiveauFilter() {
        applyFilters();
    }
    
    @FXML
    private void handleClearFilters() {
        searchField.clear();
        categoryFilter.getSelectionModel().selectFirst();
        niveauFilter.getSelectionModel().selectFirst();
        applyFilters();
    }
    
    private void updateStatusLabel() {
        statusLabel.setText("Total: " + filteredList.size() + " cours");
    }
    
    @FXML
    private void handleAddCours() {
        try {
            System.out.println("Méthode handleAddCours appelée");
            
            // Utiliser directement le fichier à la racine
            String fxmlPath = "/AjoutCours.fxml";
            
            System.out.println("Chargement du formulaire: " + fxmlPath);
            URL url = getClass().getResource(fxmlPath);
            
            if (url == null) {
                throw new IOException("Impossible de trouver le fichier FXML: " + fxmlPath);
            }
            
            FXMLLoader loader = new FXMLLoader(url);
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter un cours");
            stage.setScene(new Scene(root));
            stage.initModality(Modality.WINDOW_MODAL);
            stage.initOwner(coursTable.getScene().getWindow());
            stage.setResizable(false);
            
            // When the form is closed, refresh the course table
            stage.setOnHidden(e -> loadCours());
            
            stage.showAndWait();
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'ouverture du formulaire", 
                    "Impossible d'ouvrir le formulaire d'ajout: " + e.getMessage());
        }
    }
    
    private void handleViewCours(Cours cours) {
        // TODO: Implement course view
        showAlert(Alert.AlertType.INFORMATION, "Information", "Détails du cours", 
                "Titre: " + cours.getTitre() + "\n" +
                "Description: " + cours.getDescription() + "\n" +
                "Instructeur: " + cours.getInstructeur() + "\n" +
                "Durée: " + cours.getDuree() + " heures");
    }
    
    private void handleEditCours(Cours cours) {
        try {
            // Utiliser directement le fichier à la racine
            String fxmlPath = "/AjoutCours.fxml";
            
            URL url = getClass().getResource(fxmlPath);
            
            if (url == null) {
                throw new IOException("Impossible de trouver le fichier FXML: " + fxmlPath);
            }
            
            FXMLLoader loader = new FXMLLoader(url);
            Parent root = loader.load();
            
            CoursFormController controller = loader.getController();
            controller.setCoursForModification(cours);
            
            Stage stage = new Stage();
            stage.setTitle("Modifier un cours");
            stage.setScene(new Scene(root));
            stage.initModality(Modality.WINDOW_MODAL);
            stage.initOwner(coursTable.getScene().getWindow());
            stage.setResizable(false);
            
            // When the form is closed, refresh the course table
            stage.setOnHidden(e -> loadCours());
            
            stage.showAndWait();
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur d'ouverture du formulaire", 
                    "Impossible d'ouvrir le formulaire de modification: " + e.getMessage());
        }
    }
    
    private void handleDeleteCours(Cours cours) {
        // Show confirmation dialog
        Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
        confirmAlert.setTitle("Confirmation de suppression");
        confirmAlert.setHeaderText("Supprimer le cours");
        confirmAlert.setContentText("Êtes-vous sûr de vouloir supprimer le cours '" + cours.getTitre() + "' ?");
        
        Optional<ButtonType> result = confirmAlert.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            try {
                boolean success = coursService.supprimer(cours);
                
                if (success) {
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "Cours supprimé", 
                            "Le cours a été supprimé avec succès.");
                    
                    // Refresh the table
                    loadCours();
                } else {
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de suppression", 
                            "Impossible de supprimer le cours car il a des inscriptions d'étudiants. "
                            + "Vous devez d'abord supprimer les inscriptions associées à ce cours.");
                }
            } catch (Exception e) {
                e.printStackTrace();
                if (e.getMessage() != null && e.getMessage().contains("foreign key constraint")) {
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Contrainte d'intégrité", 
                            "Impossible de supprimer le cours car il est référencé par des inscriptions d'étudiants. "
                            + "Vous devez d'abord supprimer les inscriptions associées à ce cours.");
                } else {
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de suppression", 
                            "Une erreur s'est produite lors de la suppression du cours: " + e.getMessage());
                }
            }
        }
    }
    
    @FXML
    private void handleSearch() {
        applyFilters();
    }
    
    private void showAlert(Alert.AlertType type, String title, String header, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(header);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 