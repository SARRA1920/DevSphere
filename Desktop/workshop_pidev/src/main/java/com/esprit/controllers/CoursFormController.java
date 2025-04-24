package com.esprit.controllers;

import com.esprit.models.CategorieCours;
import com.esprit.models.Cours;
import com.esprit.services.CategorieCoursService;
import com.esprit.services.CoursService;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javafx.util.StringConverter;

import java.io.File;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.time.LocalDateTime;
import java.util.List;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Pattern;

public class CoursFormController implements Initializable {

    private static final Logger LOGGER = Logger.getLogger(CoursFormController.class.getName());
    
    // Patterns pour la validation
    private static final Pattern TITRE_PATTERN = Pattern.compile("^[\\p{L}\\s\\d.,'-]{3,50}$");
    private static final Pattern DUREE_PATTERN = Pattern.compile("^\\d{1,3}(\\s*h(eures)?)?$");
    private static final Pattern INSTRUCTEUR_PATTERN = Pattern.compile("^[\\p{L}\\s.,'-]{3,50}$");
    
    @FXML
    private Label formTitleLabel;
    
    @FXML
    private TextField titreField;
    
    @FXML
    private TextArea descriptionArea;
    
    @FXML
    private TextField dureeField;
    
    @FXML
    private ComboBox<String> niveauComboBox;
    
    @FXML
    private ComboBox<CategorieCours> categorieComboBox;
    
    @FXML
    private TextField instructeurField;
    
    @FXML
    private TextField imageField;
    
    @FXML
    private TextField pdfField;
    
    @FXML
    private Button actionButton;
    
    private CoursService coursService;
    private CategorieCoursService categorieService;
    
    // Répertoires pour stocker les fichiers
    private final String RESOURCES_DIR = "src/main/resources/";
    private final String IMAGES_DIR = RESOURCES_DIR + "images/";
    private final String PDF_DIR = RESOURCES_DIR + "pdfs/";
    
    // Variable pour stocker le cours en cas de modification
    private Cours coursAModifier;
    private boolean isModificationMode = false;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        coursService = new CoursService();
        categorieService = new CategorieCoursService();
        
        // Créer les répertoires s'ils n'existent pas
        createDirectoryIfNotExists(IMAGES_DIR);
        createDirectoryIfNotExists(PDF_DIR);
        
        // Charger les catégories
        loadCategories();
        
        // Ajouter des écouteurs pour la validation en temps réel
        setupValidationListeners();
    }
    
    private void setupValidationListeners() {
        // Validation du titre
        titreField.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) { // Quand le champ perd le focus
                validateTitre();
            }
        });
        
        // Validation de la durée
        dureeField.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) {
                validateDuree();
            }
        });
        
        // Validation de l'instructeur
        instructeurField.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) {
                validateInstructeur();
            }
        });
        
        // Validation de la description
        descriptionArea.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) {
                validateDescription();
            }
        });
    }
    
    private boolean validateTitre() {
        String titre = titreField.getText().trim();
        if (titre.isEmpty()) {
            setErrorStyle(titreField, "Le titre est obligatoire");
            return false;
        } else if (!TITRE_PATTERN.matcher(titre).matches()) {
            setErrorStyle(titreField, "Le titre doit contenir entre 3 et 50 caractères (lettres, chiffres, espaces et symboles simples)");
            return false;
        } else {
            setNormalStyle(titreField);
            return true;
        }
    }
    
    private boolean validateDescription() {
        String description = descriptionArea.getText().trim();
        if (description.isEmpty()) {
            setErrorStyle(descriptionArea, "La description est obligatoire");
            return false;
        } else if (description.length() < 10) {
            setErrorStyle(descriptionArea, "La description doit contenir au moins 10 caractères");
            return false;
        } else {
            setNormalStyle(descriptionArea);
            return true;
        }
    }
    
    private boolean validateDuree() {
        String duree = dureeField.getText().trim();
        if (duree.isEmpty()) {
            setErrorStyle(dureeField, "La durée est obligatoire");
            return false;
        } else if (!DUREE_PATTERN.matcher(duree).matches()) {
            setErrorStyle(dureeField, "La durée doit être un nombre suivi éventuellement de 'h' ou 'heures'");
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
            setErrorStyle(instructeurField, "Le nom de l'instructeur doit contenir entre 3 et 50 caractères (lettres, espaces et symboles simples)");
            return false;
        } else {
            setNormalStyle(instructeurField);
            return true;
        }
    }
    
    private boolean validateNiveau() {
        if (niveauComboBox.getValue() == null) {
            showAlert(Alert.AlertType.ERROR, "Erreur de saisie", "Veuillez sélectionner un niveau");
            niveauComboBox.setStyle("-fx-border-color: red;");
            return false;
        } else {
            niveauComboBox.setStyle("");
            return true;
        }
    }
    
    private boolean validateCategorie() {
        if (categorieComboBox.getValue() == null) {
            showAlert(Alert.AlertType.ERROR, "Erreur de saisie", "Veuillez sélectionner une catégorie");
            categorieComboBox.setStyle("-fx-border-color: red;");
            return false;
        } else {
            categorieComboBox.setStyle("");
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
    
    public void setCoursForModification(Cours cours) {
        this.coursAModifier = cours;
        isModificationMode = true;
        formTitleLabel.setText("Modifier un Cours");
        actionButton.setText("Modifier");
        
        // Remplir les champs avec les données du cours
        titreField.setText(cours.getTitre());
        descriptionArea.setText(cours.getDescription());
        dureeField.setText(cours.getDuree());
        niveauComboBox.setValue(cours.getNiveau());
        instructeurField.setText(cours.getInstructeur());
        imageField.setText(cours.getImage());
        pdfField.setText(cours.getPdfFilename());
        
        // Sélectionner la catégorie correspondante
        for (CategorieCours categorie : categorieComboBox.getItems()) {
            if (categorie.getId() == cours.getCategorieCoursId()) {
                categorieComboBox.setValue(categorie);
                break;
            }
        }
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
        // Récupérer toutes les catégories
        List<CategorieCours> categories = categorieService.afficher();
        
        // Configurer le ComboBox des catégories
        categorieComboBox.setItems(FXCollections.observableArrayList(categories));
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
    }
    
    @FXML
    private void handleImageBrowse() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner une image");
        fileChooser.getExtensionFilters().addAll(
            new FileChooser.ExtensionFilter("Images", "*.png", "*.jpg", "*.jpeg", "*.gif")
        );
        
        File selectedFile = fileChooser.showOpenDialog(imageField.getScene().getWindow());
        if (selectedFile != null) {
            try {
                String fileName = System.currentTimeMillis() + "_" + selectedFile.getName();
                Path destination = Paths.get(IMAGES_DIR + fileName);
                Files.copy(selectedFile.toPath(), destination, StandardCopyOption.REPLACE_EXISTING);
                imageField.setText(fileName);
                setNormalStyle(imageField);
            } catch (Exception e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la copie du fichier: ", e);
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la copie du fichier: " + e.getMessage());
            }
        }
    }
    
    @FXML
    private void handlePdfBrowse() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner un PDF");
        fileChooser.getExtensionFilters().addAll(
            new FileChooser.ExtensionFilter("PDF", "*.pdf")
        );
        
        File selectedFile = fileChooser.showOpenDialog(pdfField.getScene().getWindow());
        if (selectedFile != null) {
            try {
                String fileName = System.currentTimeMillis() + "_" + selectedFile.getName();
                Path destination = Paths.get(PDF_DIR + fileName);
                Files.copy(selectedFile.toPath(), destination, StandardCopyOption.REPLACE_EXISTING);
                pdfField.setText(fileName);
                setNormalStyle(pdfField);
            } catch (Exception e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la copie du fichier: ", e);
                showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de la copie du fichier: " + e.getMessage());
            }
        }
    }
    
    @FXML
    private void handleAction() {
        try {
            // Validation des champs
            boolean isValid = validateTitre() 
                            && validateDescription()
                            && validateDuree()
                            && validateInstructeur()
                            && validateNiveau()
                            && validateCategorie();
            
            if (!isValid) {
                return;
            }
            
            int categorieId = categorieComboBox.getValue().getId();
            
            if (isModificationMode) {
                // Mise à jour d'un cours existant
                coursAModifier.setTitre(titreField.getText().trim());
                coursAModifier.setDescription(descriptionArea.getText().trim());
                coursAModifier.setDuree(dureeField.getText().trim());
                coursAModifier.setNiveau(niveauComboBox.getValue());
                coursAModifier.setCategorieCoursId(categorieId);
                coursAModifier.setInstructeur(instructeurField.getText().trim());
                
                if (!imageField.getText().isEmpty() && !imageField.getText().equals(coursAModifier.getImage())) {
                    coursAModifier.setImage(imageField.getText());
                }
                
                if (!pdfField.getText().isEmpty() && !pdfField.getText().equals(coursAModifier.getPdfFilename())) {
                    coursAModifier.setPdfFilename(pdfField.getText());
                }
                
                coursAModifier.setUpdatedAt(LocalDateTime.now());
                
                coursService.modifier(coursAModifier);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "Le cours a été modifié avec succès!");
            } else {
                // Ajout d'un nouveau cours
                Cours nouveauCours = new Cours(
                    categorieId,
                    titreField.getText().trim(),
                    descriptionArea.getText().trim(),
                    dureeField.getText().trim(),
                    niveauComboBox.getValue(),
                    instructeurField.getText().trim(),
                    imageField.getText().isEmpty() ? "default.jpg" : imageField.getText(),
                    pdfField.getText().isEmpty() ? "default.pdf" : pdfField.getText(),
                    LocalDateTime.now()
                );
                
                coursService.ajouter(nouveauCours);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "Le cours a été ajouté avec succès!");
            }
            
            // Fermer la fenêtre après l'action
            closeForm();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'opération: ", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'opération: " + e.getMessage());
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