package com.user.demo.controller;

import com.user.demo.model.CategorieCours;
import com.user.demo.service.CategorieCoursService;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.stage.Stage;

import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Pattern;

public class CategorieCoursFormController implements Initializable {

    private static final Logger LOGGER = Logger.getLogger(CategorieCoursFormController.class.getName());
    
    // Patterns pour la validation
    private static final Pattern NOM_PATTERN = Pattern.compile("^[\\p{L}\\s\\d.,'-]{3,50}$");

    @FXML
    private Label formTitleLabel;
    
    @FXML
    private TextField nomField;
    
    @FXML
    private TextArea descriptionArea;
    
    @FXML
    private Button saveButton;
    
    @FXML
    private Button cancelButton;
    
    private CategorieCoursService categorieService;
    
    // Variable pour stocker la catégorie en cas de modification
    private CategorieCours categorieToModify;
    private boolean isModifying = false;
    
    private Stage dialogStage;
    private CategorieCours categorie;
    private boolean confirmClicked = false;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        categorieService = new CategorieCoursService();
        
        // Apply CSS styles to the scene when it becomes available
        saveButton.sceneProperty().addListener((obs, oldScene, newScene) -> {
            if (newScene != null) {
                try {
                    String cssPath = getClass().getResource("/com/user/demo/styles/admin-styles.css").toExternalForm();
                    newScene.getStylesheets().add(cssPath);
                    System.out.println("Form CSS loaded successfully from: " + cssPath);
                } catch (Exception e) {
                    System.err.println("Error loading CSS for form: " + e.getMessage());
                    e.printStackTrace();
                }
            }
        });
        
        // Ajouter des écouteurs pour la validation en temps réel
        setupValidationListeners();
        setupButtons();
    }
    
    private void setupValidationListeners() {
        // Validation du nom
        nomField.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) { // Quand le champ perd le focus
                validateNom();
            }
        });
        
        // Validation de la description
        descriptionArea.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) {
                validateDescription();
            }
        });
    }
    
    private boolean validateNom() {
        String nom = nomField.getText().trim();
        if (nom.isEmpty()) {
            setErrorStyle(nomField, "Le nom est obligatoire");
            return false;
        } else if (!NOM_PATTERN.matcher(nom).matches()) {
            setErrorStyle(nomField, "Le nom doit contenir entre 3 et 50 caractères (lettres, chiffres, espaces et symboles simples)");
            return false;
        } else {
            setNormalStyle(nomField);
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
    
    private void setErrorStyle(Control control, String message) {
        control.setStyle("-fx-border-color: red;");
        Tooltip tooltip = new Tooltip(message);
        Tooltip.install(control, tooltip);
    }
    
    private void setNormalStyle(Control control) {
        control.setStyle("");
        Tooltip.uninstall(control, null);
    }
    
    public void setCategorieForModification(CategorieCours categorie) {
        this.categorieToModify = categorie;
        this.isModifying = true;
        formTitleLabel.setText("Modifier une Catégorie de Cours");
        saveButton.setText("Modifier");
        
        // Remplir les champs avec les données de la catégorie
        nomField.setText(categorie.getNom());
        descriptionArea.setText(categorie.getDescription());
    }
    
    @FXML
    private void handleSave() {
        try {
            // Validation des champs
            boolean isValid = validateNom() && validateDescription();
            
            if (!isValid) {
                return;
            }
            
            CategorieCours newCategorie = createCategorieFromFields();
            boolean success;
            
            if (isModifying) {
                // Mise à jour d'une catégorie existante
                if (categorieToModify != null) {
                    newCategorie.setId(categorieToModify.getId());
                } else if (categorie != null) {
                    newCategorie.setId(categorie.getId());
                } else {
                    throw new IllegalStateException("Aucune catégorie à modifier n'a été définie");
                }
                
                success = categorieService.modifier(newCategorie);
                if (success) {
                    showAlert(Alert.AlertType.INFORMATION, "Succès", 
                        "La catégorie a été modifiée avec succès.");
                }
            } else {
                // Ajout d'une nouvelle catégorie
                success = categorieService.ajouter(newCategorie);
                if (success) {
                    showAlert(Alert.AlertType.INFORMATION, "Succès", 
                        "La catégorie a été ajoutée avec succès.");
                }
            }
            
            if (success) {
                confirmClicked = true;
                closeWindow();
            } else {
                showAlert(Alert.AlertType.ERROR, "Erreur", 
                    "Une erreur est survenue lors de l'enregistrement de la catégorie.");
            }
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'opération", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'opération: " + e.getMessage());
        }
    }
    
    private CategorieCours createCategorieFromFields() {
        return new CategorieCours(
            nomField.getText().trim(),
            descriptionArea.getText().trim()
        );
    }
    
    @FXML
    private void handleCancel() {
        closeWindow();
    }
    
    private void setupButtons() {
        saveButton.setDefaultButton(true);
        cancelButton.setCancelButton(true);
        
        // Set button styles
        saveButton.getStyleClass().add("button-primary");
        cancelButton.getStyleClass().add("button-secondary");
    }
    
    private void closeWindow() {
        if (dialogStage != null) {
            dialogStage.close();
        } else {
            ((Stage) saveButton.getScene().getWindow()).close();
        }
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    /**
     * Sets the stage of this dialog.
     * 
     * @param dialogStage the dialog stage
     */
    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }
    
    /**
     * Sets the category to be edited in the dialog.
     * 
     * @param categorie the category to edit
     */
    public void setCategorie(CategorieCours categorie) {
        this.categorie = categorie;
        
        // Pre-fill the fields if updating an existing category
        if (categorie != null && categorie.getId() != 0) {
            nomField.setText(categorie.getNom());
            descriptionArea.setText(categorie.getDescription());
            isModifying = true;
            formTitleLabel.setText("Modifier une Catégorie de Cours");
            saveButton.setText("Modifier");
        } else {
            // New category creation
            formTitleLabel.setText("Ajouter une Nouvelle Catégorie");
            saveButton.setText("Ajouter");
            isModifying = false;
        }
    }
    
    /**
     * Returns true if the user clicked Save, false otherwise.
     * 
     * @return confirmClicked status
     */
    public boolean isConfirmClicked() {
        return confirmClicked;
    }
} 