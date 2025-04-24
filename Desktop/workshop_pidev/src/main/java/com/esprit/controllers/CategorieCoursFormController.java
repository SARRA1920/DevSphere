package com.esprit.controllers;

import com.esprit.models.CategorieCours;
import com.esprit.services.CategorieCoursService;
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
    private ComboBox<String> niveauComboBox;
    
    @FXML
    private Button actionButton;
    
    private CategorieCoursService categorieService;
    
    // Variable pour stocker la catégorie en cas de modification
    private CategorieCours categorieAModifier;
    private boolean isModificationMode = false;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        categorieService = new CategorieCoursService();
        
        // Ajouter des écouteurs pour la validation en temps réel
        setupValidationListeners();
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
        
        // Validation du niveau
        niveauComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                setNormalStyle(niveauComboBox);
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
    
    private boolean validateNiveau() {
        if (niveauComboBox.getValue() == null) {
            setErrorStyle(niveauComboBox, "Veuillez sélectionner un niveau");
            return false;
        } else {
            setNormalStyle(niveauComboBox);
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
        this.categorieAModifier = categorie;
        isModificationMode = true;
        formTitleLabel.setText("Modifier une Catégorie de Cours");
        actionButton.setText("Modifier");
        
        // Remplir les champs avec les données de la catégorie
        nomField.setText(categorie.getNom());
        descriptionArea.setText(categorie.getDescription());
        niveauComboBox.setValue(categorie.getNiveau());
    }
    
    @FXML
    private void handleAction() {
        try {
            // Validation des champs
            boolean isValid = validateNom() && validateDescription() && validateNiveau();
            
            if (!isValid) {
                return;
            }
            
            if (isModificationMode) {
                // Mise à jour d'une catégorie existante
                categorieAModifier.setNom(nomField.getText().trim());
                categorieAModifier.setDescription(descriptionArea.getText().trim());
                categorieAModifier.setNiveau(niveauComboBox.getValue());
                
                categorieService.modifier(categorieAModifier);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "La catégorie a été modifiée avec succès!");
            } else {
                // Ajout d'une nouvelle catégorie
                CategorieCours nouvelleCategorie = new CategorieCours(
                    nomField.getText().trim(),
                    descriptionArea.getText().trim(),
                    niveauComboBox.getValue()
                );
                
                categorieService.ajouter(nouvelleCategorie);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "La catégorie a été ajoutée avec succès!");
            }
            
            // Fermer la fenêtre après l'action
            closeForm();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'opération", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur lors de l'opération: " + e.getMessage());
        }
    }
    
    @FXML
    private void handleCancel() {
        closeForm();
    }
    
    private void closeForm() {
        Stage stage = (Stage) nomField.getScene().getWindow();
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