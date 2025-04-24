package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.model.CategorieCours;
import com.user.demo.service.CoursService;
import com.user.demo.service.CategorieCoursService;
import com.user.demo.util.CoursImageUtils;
import com.user.demo.util.DatabaseUtil;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javafx.util.StringConverter;

import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.util.List;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Pattern;

public class CoursFormController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(CoursFormController.class.getName());
    
    // Patterns de validation
    private static final Pattern TITRE_PATTERN = Pattern.compile("^[\\p{L}\\s\\d.,;:!?'\"()-]{3,100}$");
    private static final Pattern DUREE_PATTERN = Pattern.compile("^\\d{1,3}h?$");
    private static final Pattern INSTRUCTEUR_PATTERN = Pattern.compile("^[\\p{L}\\s.,'-]{3,50}$");
    
    @FXML
    private TextField titreField;
    
    @FXML
    private TextArea descriptionField;
    
    @FXML
    private ComboBox<CategorieCours> categorieComboBox;
    
    @FXML
    private ComboBox<String> niveauComboBox;
    
    @FXML
    private TextField dureeField;
    
    @FXML
    private TextField instructeurField;
    
    @FXML
    private TextField imageField;
    
    @FXML
    private TextField pdfField;
    
    private CoursService coursService;
    private CategorieCoursService categorieCoursService;
    
    // Variables pour la modification de cours
    private Cours coursExistant;
    private boolean estModification = false;
    private String originalImageName;
    private File selectedImageFile;
    private File selectedPdfFile;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // Initialiser les services
            coursService = new CoursService();
            categorieCoursService = new CategorieCoursService();
            
            // Configurer la base de données pour s'assurer que les colonnes nécessaires existent
            DatabaseUtil.setupDatabase();
            
            // Initialiser les niveaux
            if (niveauComboBox != null) {
                niveauComboBox.getItems().addAll("Beginner", "Intermediate", "Advanced", "Expert");
                LOGGER.info("Niveaux initialisés avec succès");
            } else {
                LOGGER.severe("niveauComboBox est null");
            }
            
            // Charger les catégories
            loadCategories();
            
            // Ajouter des écouteurs pour la validation en temps réel
            setupValidationListeners();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'initialisation", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'initialisation du formulaire: " + e.getMessage());
        }
    }
    
    private void setupValidationListeners() {
        try {
            // Validation du titre
            if (titreField != null) {
                titreField.focusedProperty().addListener((obs, oldVal, newVal) -> {
                    if (!newVal) { // Quand le champ perd le focus
                        validateTitre();
                    }
                });
            }
            
            // Validation de la durée
            if (dureeField != null) {
                dureeField.focusedProperty().addListener((obs, oldVal, newVal) -> {
                    if (!newVal) {
                        validateDuree();
                    }
                });
            }
            
            // Validation de l'instructeur
            if (instructeurField != null) {
                instructeurField.focusedProperty().addListener((obs, oldVal, newVal) -> {
                    if (!newVal) {
                        validateInstructeur();
                    }
                });
            }
            
            // Validation de la catégorie
            if (categorieComboBox != null) {
                categorieComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
                    if (newVal != null) {
                        setNormalStyle(categorieComboBox);
                    }
                });
            }
            
            // Validation du niveau
            if (niveauComboBox != null) {
                niveauComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
                    if (newVal != null) {
                        setNormalStyle(niveauComboBox);
                    }
                });
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la configuration des écouteurs de validation", e);
        }
    }
    
    private boolean validateTitre() {
        String titre = titreField.getText().trim();
        if (titre.isEmpty()) {
            setErrorStyle(titreField, "Le titre est obligatoire");
            return false;
        } else if (!TITRE_PATTERN.matcher(titre).matches()) {
            setErrorStyle(titreField, "Le titre doit contenir entre 3 et 100 caractères");
            return false;
        } else {
            setNormalStyle(titreField);
            return true;
        }
    }
    
    private boolean validateDescription() {
        String description = descriptionField.getText().trim();
        if (description.isEmpty()) {
            setErrorStyle(descriptionField, "La description est obligatoire");
            return false;
        } else if (description.length() < 10) {
            setErrorStyle(descriptionField, "La description doit contenir au moins 10 caractères");
            return false;
        } else {
            setNormalStyle(descriptionField);
            return true;
        }
    }
    
    private boolean validateCategorie() {
        if (categorieComboBox.getValue() == null) {
            setErrorStyle(categorieComboBox, "Veuillez sélectionner une catégorie");
            return false;
        } else {
            setNormalStyle(categorieComboBox);
            return true;
        }
    }
    
    private boolean validateNiveau() {
        if (niveauComboBox.getValue() == null) {
            setErrorStyle(niveauComboBox, "Veuillez sélectionner un niveau");
            return false;
        } else {
            setNormalStyle(niveauComboBox);
            return true;
        }
    }
    
    private boolean validateDuree() {
        String duree = dureeField.getText().trim();
        if (duree.isEmpty()) {
            setErrorStyle(dureeField, "La durée est obligatoire");
            return false;
        } else if (!DUREE_PATTERN.matcher(duree).matches()) {
            setErrorStyle(dureeField, "La durée doit être un nombre (ex: 20 ou 20h)");
            return false;
        } else {
            setNormalStyle(dureeField);
            return true;
        }
    }
    
    private boolean validateInstructeur() {
        String instructeur = instructeurField.getText().trim();
        if (instructeur.isEmpty()) {
            setErrorStyle(instructeurField, "Le nom de l'instructeur est obligatoire");
            return false;
        } else if (!INSTRUCTEUR_PATTERN.matcher(instructeur).matches()) {
            setErrorStyle(instructeurField, "Le nom de l'instructeur doit contenir entre 3 et 50 caractères");
            return false;
        } else {
            setNormalStyle(instructeurField);
            return true;
        }
    }
    
    private void setErrorStyle(Control control, String message) {
        control.setStyle("-fx-border-color: red;");
        Tooltip tooltip = new Tooltip(message);
        Tooltip.install(control, tooltip);
    }
    
    private void setNormalStyle(Control control) {
        control.setStyle("");
        Tooltip.uninstall(control, null);
    }
    
    private void loadCategories() {
        try {
            if (categorieComboBox == null) {
                LOGGER.severe("categorieComboBox est null");
                return;
            }
            
            List<CategorieCours> categoriesList = categorieCoursService.afficherTout();
            LOGGER.info("Nombre de catégories chargées: " + categoriesList.size());
            
            ObservableList<CategorieCours> categories = FXCollections.observableArrayList(categoriesList);
            categorieComboBox.setItems(categories);
            
            // Configurer l'affichage des catégories dans le ComboBox
            categorieComboBox.setConverter(new StringConverter<CategorieCours>() {
                @Override
                public String toString(CategorieCours categorie) {
                    return categorie != null ? categorie.getNom() : "";
                }
                
                @Override
                public CategorieCours fromString(String string) {
                    return null; // Non utilisé
                }
            });
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des catégories", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible de charger la liste des catégories: " + e.getMessage());
        }
    }
    
    public void setCoursForModification(Cours cours) {
        if (cours == null) {
            LOGGER.log(Level.WARNING, "Cannot modify null course");
            return;
        }
        
        this.coursExistant = cours;
        this.estModification = true;
        this.originalImageName = cours.getImage();
        
        // Remplir les champs avec les données du cours
        titreField.setText(cours.getTitre());
        descriptionField.setText(cours.getDescription());
        dureeField.setText(cours.getDuree());
        instructeurField.setText(cours.getInstructeur());
        niveauComboBox.setValue(cours.getNiveau());
        imageField.setText(cours.getImage());
        
        // Sélectionner la catégorie correspondante
        if (cours.getCategorie() != null && categorieComboBox.getItems() != null) {
            for (CategorieCours categorie : categorieComboBox.getItems()) {
                if (categorie.getNom().equals(cours.getCategorie().getNom())) {
                    categorieComboBox.setValue(categorie);
                    break;
                }
            }
        }
    }
    
    @FXML
    private void handleSelectImage() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner une image");
        fileChooser.getExtensionFilters().addAll(
            new FileChooser.ExtensionFilter("Images", "*.png", "*.jpg", "*.jpeg", "*.gif")
        );
        
        // Obtenir la fenêtre actuelle
        Stage stage = (Stage) titreField.getScene().getWindow();
        
        // Afficher le sélecteur de fichiers
        File file = fileChooser.showOpenDialog(stage);
        if (file != null) {
            selectedImageFile = file;
            imageField.setText(file.getName());
        }
    }
    
    @FXML
    private void handleSelectPdf() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner un PDF");
        fileChooser.getExtensionFilters().addAll(
            new FileChooser.ExtensionFilter("Fichiers PDF", "*.pdf")
        );
        
        // Obtenir la fenêtre actuelle
        Stage stage = (Stage) titreField.getScene().getWindow();
        
        // Afficher le sélecteur de fichiers
        File file = fileChooser.showOpenDialog(stage);
        if (file != null) {
            selectedPdfFile = file;
            pdfField.setText(file.getName());
        }
    }
    
    @FXML
    private void handleSave() {
        try {
            LOGGER.info("Tentative d'enregistrement d'un cours");
            
            // Vérifier que les services sont initialisés
            if (coursService == null) {
                LOGGER.severe("coursService est null");
                showAlert(Alert.AlertType.ERROR, "Erreur", "Service d'enregistrement non disponible");
                return;
            }
            
            // Valider tous les champs
            boolean isValid = validateTitre() && 
                           validateDescription() && 
                           validateCategorie() && 
                           validateNiveau() && 
                           validateDuree() && 
                           validateInstructeur();
            
            if (!isValid) {
                LOGGER.warning("Validation des champs du formulaire échouée");
                showAlert(Alert.AlertType.ERROR, "Erreur", "Veuillez corriger les champs en erreur");
                return;
            }
            
            // Créer ou mettre à jour l'objet Cours
            Cours cours;
            if (estModification) {
                cours = coursExistant;
                LOGGER.info("Mode modification du cours ID=" + cours.getId());
            } else {
                cours = new Cours();
                LOGGER.info("Mode création d'un nouveau cours");
            }
            
            // Récupérer les valeurs des champs
            String titre = titreField.getText().trim();
            String description = descriptionField.getText().trim();
            String duree = dureeField.getText().trim();
            String niveau = niveauComboBox.getValue();
            String instructeur = instructeurField.getText().trim();
            
            LOGGER.info("Titre: " + titre);
            LOGGER.info("Description: " + description);
            LOGGER.info("Durée: " + duree);
            LOGGER.info("Niveau: " + niveau);
            LOGGER.info("Instructeur: " + instructeur);
            
            cours.setTitre(titre);
            cours.setDescription(description);
            cours.setDuree(duree);
            cours.setNiveau(niveau);
            cours.setInstructeur(instructeur);
            
            // Gérer la catégorie
            CategorieCours categorie = categorieComboBox.getValue();
            if (categorie == null) {
                LOGGER.warning("Aucune catégorie sélectionnée");
                showAlert(Alert.AlertType.ERROR, "Erreur", "Veuillez sélectionner une catégorie");
                return;
            }
            
            LOGGER.info("Catégorie sélectionnée: " + categorie.getNom() + " (ID: " + categorie.getId() + ")");
            cours.setCategorieCoursId(categorie.getId());
            cours.setCategorie(categorie);
            
            // Gérer l'image
            String imageName = imageField.getText().trim();
            if (selectedImageFile != null) {
                // Copier l'image dans le dossier des images de cours
                try {
                    Path destFolder = Paths.get(System.getProperty("user.dir"), "src", "main", "resources", "images", "cours");
                    if (!Files.exists(destFolder)) {
                        Files.createDirectories(destFolder);
                    }
                    
                    Path destPath = destFolder.resolve(imageName);
                    Files.copy(selectedImageFile.toPath(), destPath, StandardCopyOption.REPLACE_EXISTING);
                    
                    cours.setImage(imageName);
                    LOGGER.info("Image copiée avec succès: " + imageName);
                } catch (IOException e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de la copie de l'image", e);
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible de copier l'image: " + e.getMessage());
                    return;
                }
            } else if (!imageName.isEmpty()) {
                cours.setImage(imageName);
                LOGGER.info("Utilisation du nom d'image existant: " + imageName);
            } else {
                cours.setImage("default.jpg");
                LOGGER.info("Utilisation de l'image par défaut");
            }
            
            // Gérer le PDF
            if (pdfField != null) {
                String pdfName = pdfField.getText().trim();
                if (selectedPdfFile != null) {
                    // Copier le PDF dans le dossier approprié
                    try {
                        Path destFolder = Paths.get(System.getProperty("user.dir"), "src", "main", "resources", "pdf", "cours");
                        if (!Files.exists(destFolder)) {
                            Files.createDirectories(destFolder);
                        }
                        
                        Path destPath = destFolder.resolve(pdfName);
                        Files.copy(selectedPdfFile.toPath(), destPath, StandardCopyOption.REPLACE_EXISTING);
                        
                        // Ajouter le nom du PDF au cours
                        cours.setPdfFilename(pdfName);
                        LOGGER.info("PDF copié avec succès: " + pdfName);
                    } catch (IOException e) {
                        LOGGER.log(Level.SEVERE, "Erreur lors de la copie du PDF", e);
                        showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible de copier le PDF: " + e.getMessage());
                        return;
                    }
                } else if (!pdfName.isEmpty()) {
                    cours.setPdfFilename(pdfName);
                    LOGGER.info("Utilisation du nom de PDF existant: " + pdfName);
                } else {
                    cours.setPdfFilename(null);
                    LOGGER.info("Aucun PDF spécifié");
                }
            }
            
            // Afficher les informations du cours avant enregistrement
            LOGGER.info("Informations du cours à enregistrer: " + 
                       "ID=" + (cours.getId() > 0 ? cours.getId() : "Nouveau") +
                       ", Titre=" + cours.getTitre() + 
                       ", Description=" + cours.getDescription() + 
                       ", Durée=" + cours.getDuree() + 
                       ", Niveau=" + cours.getNiveau() + 
                       ", CategorieID=" + cours.getCategorieCoursId() + 
                       ", Instructeur=" + cours.getInstructeur() +
                       ", Image=" + cours.getImage() +
                       ", PDF=" + cours.getPdfFilename());
            
            // Sauvegarder ou mettre à jour le cours
            boolean success;
            if (estModification) {
                success = coursService.modifier(cours);
                LOGGER.info("Modification du cours ID=" + cours.getId() + ": " + (success ? "Succès" : "Échec"));
            } else {
                LOGGER.info("Tentative d'ajout d'un nouveau cours...");
                success = coursService.ajouter(cours);
                LOGGER.info("Ajout d'un nouveau cours: " + (success ? "Succès, ID=" + cours.getId() : "Échec"));
            }
            
            if (success) {
                showAlert(Alert.AlertType.INFORMATION, "Succès", 
                    estModification ? "Le cours a été modifié avec succès!" : "Le cours a été ajouté avec succès!");
                closeForm();
            } else {
                LOGGER.severe("Échec de l'enregistrement du cours");
                showAlert(Alert.AlertType.ERROR, "Erreur", 
                    "Une erreur est survenue lors de l'enregistrement du cours.");
            }
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Exception lors de l'enregistrement du cours", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'enregistrement du cours: " + e.getMessage());
        }
    }
    
    @FXML
    private void handleCancel() {
        closeForm();
    }
    
    private void closeForm() {
        Stage stage = (Stage) titreField.getScene().getWindow();
        stage.close();
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
}