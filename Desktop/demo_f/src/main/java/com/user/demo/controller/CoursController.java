package com.user.demo.controller;

import com.user.demo.model.CategorieCours;
import com.user.demo.model.Cours;
import com.user.demo.service.CategorieCoursService;
import com.user.demo.service.CoursService;
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
import javafx.scene.control.TableCell;
import javafx.scene.layout.*;
import javafx.geometry.Insets;
import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;
import javafx.scene.Node;

import java.io.File;
import java.io.IOException;
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
    private FlowPane coursesContainer;
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ComboBox<String> categoryFilter;
    
    @FXML
    private ComboBox<String> statusFilter;
    
    @FXML
    private ScrollPane scrollPane;
    
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
    
    @FXML
    private TableColumn<Cours, Void> inscriptionColumn;
    
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
    
    public CoursController() {
        this.coursService = new CoursService();
        this.categorieService = new CategorieCoursService();
        this.categoriesMap = new HashMap<>();
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        setupUI();
        loadCourses();
        
        // Setup search listener
        searchField.textProperty().addListener((observable, oldValue, newValue) -> {
            filterCourses();
        });
        
        // Setup filter listeners
        categoryFilter.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            filterCourses();
        });
        
        statusFilter.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            filterCourses();
        });
        
        coursService = new CoursService();
        categorieService = new CategorieCoursService();
        
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
    
    private void setupUI() {
        // Configure FlowPane
        coursesContainer.setHgap(20);
        coursesContainer.setVgap(20);
        coursesContainer.setPadding(new Insets(20));
        
        // Configure ScrollPane
        scrollPane.setFitToWidth(true);
        scrollPane.getStyleClass().add("edge-to-edge");
        
        // Setup filter ComboBoxes
        categoryFilter.getItems().addAll("Tous", "Programmation", "Design", "Business");
        categoryFilter.setValue("Tous");
        
        statusFilter.getItems().addAll("Tous", "Actif", "Inactif");
        statusFilter.setValue("Tous");
    }
    
    private void loadCourses() {
        List<Cours> courses = coursService.rechercher();
        displayCourses(courses);
    }
    
    private void filterCourses() {
        String searchText = searchField.getText().toLowerCase();
        String category = categoryFilter.getValue();
        String status = statusFilter.getValue();
        
        List<Cours> allCourses = coursService.rechercher();
        coursesContainer.getChildren().clear();
        
        for (Cours cours : allCourses) {
            boolean matchesSearch = cours.getTitre().toLowerCase().contains(searchText) ||
                                  cours.getDescription().toLowerCase().contains(searchText);
            boolean matchesCategory = category.equals("Tous") || 
                                    (cours.getCategorie() != null && 
                                     cours.getCategorie().getNom().equals(category));
            boolean matchesStatus = status.equals("Tous") || 
                                  (status.equals("Actif") && cours.isActive()) ||
                                  (status.equals("Inactif") && !cours.isActive());
            
            if (matchesSearch && matchesCategory && matchesStatus) {
                createCourseCard(cours);
            }
        }
    }
    
    private void displayCourses(List<Cours> courses) {
        coursesContainer.getChildren().clear();
        courses.forEach(this::createCourseCard);
    }
    
    private void createCourseCard(Cours cours) {
        VBox card = new VBox(10);
        card.getStyleClass().add("course-card");
        
        Label title = new Label(cours.getTitre());
        title.getStyleClass().add("title");
        title.setWrapText(true);
        
        Label category = new Label(cours.getCategorie().getNom());
        category.getStyleClass().add("category");
        
        VBox details = new VBox(5);
        details.getStyleClass().add("details");
        
        Label description = new Label(cours.getDescription());
        description.setWrapText(true);
        
        Label duration = new Label("Durée: " + cours.getDuree() + " heures");
        Label level = new Label("Niveau: " + cours.getNiveau());
        
        Label status = new Label(cours.isActive() ? "Actif" : "Inactif");
        status.getStyleClass().addAll("status", 
            cours.isActive() ? "status-resolved" : "status-pending");
        
        HBox buttons = new HBox(10);
        Button editButton = new Button("Modifier");
        editButton.getStyleClass().add("button-primary");
        editButton.setOnAction(e -> handleEditCourse(cours));
        
        Button deleteButton = new Button("Supprimer");
        deleteButton.getStyleClass().add("button-secondary");
        deleteButton.setOnAction(e -> handleDeleteCourse(cours));
        
        buttons.getChildren().addAll(editButton, deleteButton);
        
        details.getChildren().addAll(description, duration, level, status);
        card.getChildren().addAll(title, category, details, buttons);
        
        coursesContainer.getChildren().add(card);
    }
    
    private void handleEditCourse(Cours cours) {
        // Implement edit functionality
        System.out.println("Edit course: " + cours.getTitre());
    }
    
    private void handleDeleteCourse(Cours cours) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Confirmation de suppression");
        alert.setHeaderText("Supprimer le cours");
        alert.setContentText("Êtes-vous sûr de vouloir supprimer le cours " + cours.getTitre() + " ?");
        
        alert.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                coursService.supprimer(cours);
                loadCourses();
            }
        });
    }
    
    @FXML
    private void handleClearFilters() {
        searchField.clear();
        categoryFilter.setValue("Tous");
        statusFilter.setValue("Tous");
    }
    
    private void initializeColumns() {
        // Configuration des cellules avec wrapping du texte
        titreColumn.setCellFactory(tc -> {
            TableCell<Cours, String> cell = new TableCell<>() {
                private final Label label = new Label();
                {
                    label.setWrapText(true);
                    label.setMaxWidth(240);
                }
                
                @Override
                protected void updateItem(String item, boolean empty) {
                    super.updateItem(item, empty);
                    if (empty || item == null) {
                        setGraphic(null);
                    } else {
                        label.setText(item);
                        setGraphic(label);
                    }
                }
            };
            return cell;
        });
        titreColumn.setCellValueFactory(new PropertyValueFactory<>("titre"));

        categorieColumn.setCellValueFactory(cellData -> {
            int categorieId = cellData.getValue().getCategorieCoursId();
            String categorieName = categoriesMap.getOrDefault(categorieId, "N/A");
            return javafx.beans.binding.Bindings.createStringBinding(() -> categorieName);
        });

        dureeColumn.setCellValueFactory(new PropertyValueFactory<>("duree"));
        niveauColumn.setCellValueFactory(new PropertyValueFactory<>("niveau"));
        instructeurColumn.setCellValueFactory(new PropertyValueFactory<>("instructeur"));

        // Configuration du bouton d'inscription
        inscriptionColumn.setCellFactory(param -> new TableCell<>() {
            private final Button inscriptionButton = new Button("S'inscrire");
            {
                inscriptionButton.getStyleClass().add("button-primary");
                inscriptionButton.setMaxWidth(Double.MAX_VALUE);
                inscriptionButton.setOnAction(event -> {
                    Cours cours = getTableView().getItems().get(getIndex());
                    handleInscription(cours);
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    setGraphic(inscriptionButton);
                }
            }
        });

        // Ajuster la hauteur des lignes
        coursTable.setFixedCellSize(60);
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
    
    private void handleInscription(Cours cours) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/InscriptionForm.fxml"));
            Parent root = loader.load();
            
            InscriptionFormController controller = loader.getController();
            controller.initData(cours);
            
            Stage stage = new Stage();
            stage.setTitle("Inscription au cours");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(new Scene(root));
            stage.showAndWait();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'inscription", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                     "Impossible d'ouvrir le formulaire d'inscription: " + e.getMessage());
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