package com.esprit.controllers;

import com.esprit.models.Cours;
import com.esprit.models.Inscription;
import com.esprit.services.CoursService;
import com.esprit.services.InscriptionService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.stage.Stage;
import javafx.util.StringConverter;

import java.net.URL;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Pattern;

public class InscriptionFormController implements Initializable {

    private static final Logger LOGGER = Logger.getLogger(InscriptionFormController.class.getName());
    
    // Patterns pour la validation
    private static final Pattern NOM_PATTERN = Pattern.compile("^[\\p{L}\\s.,'-]{3,50}$");
    private static final Pattern EMAIL_PATTERN = Pattern.compile("^[A-Za-z0-9+_.-]+@(.+)$");
    private static final Pattern TELEPHONE_PATTERN = Pattern.compile("^\\+?[0-9]{8,14}$");

    @FXML
    private Label formTitleLabel;
    
    @FXML
    private TextField nomField;
    
    @FXML
    private TextField emailField;
    
    @FXML
    private TextField telephoneField;
    
    @FXML
    private ComboBox<Cours> coursComboBox;
    
    @FXML
    private ComboBox<String> statutComboBox;
    
    @FXML
    private DatePicker dateInscriptionPicker;
    
    @FXML
    private Button actionButton;
    
    private InscriptionService inscriptionService;
    private CoursService coursService;
    
    // Variable pour stocker l'inscription en cas de modification
    private Inscription inscriptionAModifier;
    private boolean isModificationMode = false;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        inscriptionService = new InscriptionService();
        coursService = new CoursService();
        
        // Initialiser les ComboBox
        loadCours();
        
        // Par défaut, la date d'inscription est aujourd'hui
        dateInscriptionPicker.setValue(LocalDate.now());
        
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
        
        // Validation de l'email
        emailField.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) {
                validateEmail();
            }
        });
        
        // Validation du téléphone
        telephoneField.focusedProperty().addListener((obs, oldVal, newVal) -> {
            if (!newVal) {
                validateTelephone();
            }
        });
        
        // Validation du cours
        coursComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                setNormalStyle(coursComboBox);
            }
        });
        
        // Validation du statut
        statutComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                setNormalStyle(statutComboBox);
            }
        });
        
        // Validation de la date d'inscription
        dateInscriptionPicker.valueProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                setNormalStyle(dateInscriptionPicker);
            }
        });
    }
    
    private boolean validateNom() {
        String nom = nomField.getText().trim();
        if (nom.isEmpty()) {
            setErrorStyle(nomField, "Le nom est obligatoire");
            return false;
        } else if (!NOM_PATTERN.matcher(nom).matches()) {
            setErrorStyle(nomField, "Le nom doit contenir entre 3 et 50 caractères (lettres, espaces et symboles simples)");
            return false;
        } else {
            setNormalStyle(nomField);
            return true;
        }
    }
    
    private boolean validateEmail() {
        String email = emailField.getText().trim();
        if (email.isEmpty()) {
            setErrorStyle(emailField, "L'email est obligatoire");
            return false;
        } else if (!EMAIL_PATTERN.matcher(email).matches()) {
            setErrorStyle(emailField, "Veuillez saisir une adresse email valide");
            return false;
        } else {
            setNormalStyle(emailField);
            return true;
        }
    }
    
    private boolean validateTelephone() {
        String telephone = telephoneField.getText().trim();
        if (telephone.isEmpty()) {
            setErrorStyle(telephoneField, "Le numéro de téléphone est obligatoire");
            return false;
        } else if (!TELEPHONE_PATTERN.matcher(telephone).matches()) {
            setErrorStyle(telephoneField, "Veuillez saisir un numéro de téléphone valide (8 à 14 chiffres)");
            return false;
        } else {
            setNormalStyle(telephoneField);
            return true;
        }
    }
    
    private boolean validateCours() {
        if (coursComboBox.getValue() == null) {
            setErrorStyle(coursComboBox, "Veuillez sélectionner un cours");
            return false;
        } else {
            setNormalStyle(coursComboBox);
            return true;
        }
    }
    
    private boolean validateStatut() {
        if (statutComboBox.getValue() == null) {
            setErrorStyle(statutComboBox, "Veuillez sélectionner un statut");
            return false;
        } else {
            setNormalStyle(statutComboBox);
            return true;
        }
    }
    
    private boolean validateDateInscription() {
        if (dateInscriptionPicker.getValue() == null) {
            setErrorStyle(dateInscriptionPicker, "Veuillez sélectionner une date d'inscription");
            return false;
        } else if (dateInscriptionPicker.getValue().isAfter(LocalDate.now())) {
            setErrorStyle(dateInscriptionPicker, "La date d'inscription ne peut pas être dans le futur");
            return false;
        } else {
            setNormalStyle(dateInscriptionPicker);
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
    
    private void loadCours() {
        try {
            // Récupérer tous les cours
            ObservableList<Cours> coursList = FXCollections.observableArrayList(coursService.afficher());
            coursComboBox.setItems(coursList);
            
            // Configurer l'affichage des cours dans le ComboBox
            coursComboBox.setConverter(new StringConverter<Cours>() {
                @Override
                public String toString(Cours cours) {
                    return cours != null ? cours.getTitre() : "";
                }

                @Override
                public Cours fromString(String string) {
                    return null; // Non utilisé
                }
            });
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible de charger la liste des cours: " + e.getMessage());
        }
    }
    
    public void setInscriptionForModification(Inscription inscription) {
        this.inscriptionAModifier = inscription;
        isModificationMode = true;
        formTitleLabel.setText("Modifier une Inscription");
        actionButton.setText("Modifier");
        
        // Remplir les champs avec les données de l'inscription
        nomField.setText(inscription.getNom());
        emailField.setText(inscription.getEmail());
        telephoneField.setText(inscription.getTelephone());
        statutComboBox.setValue(inscription.getStatut());
        
        // Sélectionner le cours correspondant
        for (Cours cours : coursComboBox.getItems()) {
            if (cours.getId() == inscription.getCoursId()) {
                coursComboBox.setValue(cours);
                break;
            }
        }
        
        // Si la date d'inscription est définie, la sélectionner
        if (inscription.getDateInscription() != null) {
            dateInscriptionPicker.setValue(inscription.getDateInscription().toLocalDate());
        }
    }
    
    @FXML
    private void handleAction() {
        try {
            // Validation des champs
            boolean isValid = validateNom() 
                           && validateEmail()
                           && validateTelephone()
                           && validateCours()
                           && validateStatut()
                           && validateDateInscription();
            
            if (!isValid) {
                return;
            }
            
            // Convertir la date du DatePicker en LocalDateTime
            LocalDateTime dateInscription = LocalDateTime.of(dateInscriptionPicker.getValue(), LocalTime.now());
            
            if (isModificationMode) {
                // Mise à jour d'une inscription existante
                inscriptionAModifier.setNom(nomField.getText().trim());
                inscriptionAModifier.setEmail(emailField.getText().trim());
                inscriptionAModifier.setTelephone(telephoneField.getText().trim());
                inscriptionAModifier.setCoursId(coursComboBox.getValue().getId());
                inscriptionAModifier.setStatut(statutComboBox.getValue());
                inscriptionAModifier.setDateInscription(dateInscription);
                
                inscriptionService.modifier(inscriptionAModifier);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "L'inscription a été modifiée avec succès!");
            } else {
                // Ajout d'une nouvelle inscription
                Inscription nouvelleInscription = new Inscription(
                    coursComboBox.getValue().getId(),
                    1, // userId (fixe pour l'exemple)
                    nomField.getText().trim(),
                    emailField.getText().trim(),
                    telephoneField.getText().trim(),
                    LocalDateTime.now(), // createdAt
                    dateInscription,
                    statutComboBox.getValue()
                );
                
                // Associer le cours sélectionné
                nouvelleInscription.setCours(coursComboBox.getValue());
                
                inscriptionService.ajouter(nouvelleInscription);
                showAlert(Alert.AlertType.INFORMATION, "Succès", "L'inscription a été ajoutée avec succès!");
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