package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.model.Inscription;
import com.user.demo.model.User;
import com.user.demo.service.CoursService;
import com.user.demo.service.InscriptionService;
import com.user.demo.util.DatabaseConnection;
import javafx.application.Platform;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.stage.Stage;
import javafx.util.StringConverter;
import javafx.concurrent.Task;

import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.ResourceBundle;
import java.util.logging.ConsoleHandler;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Pattern;
import java.io.UnsupportedEncodingException;
import java.util.stream.Collectors;
import java.util.Optional;
import java.util.List;

public class InscriptionFormController implements Initializable {

    private static final Logger LOGGER;
    
    static {
        System.setProperty("file.encoding", "UTF-8");
        LOGGER = Logger.getLogger(InscriptionFormController.class.getName());
        try {
            ConsoleHandler handler = new ConsoleHandler();
            handler.setEncoding("UTF-8");
            LOGGER.addHandler(handler);
        } catch (UnsupportedEncodingException e) {
            System.err.println("Erreur lors de la configuration de l'encodage UTF-8: " + e.getMessage());
        }
    }
    
    // Patterns pour la validation
    private static final Pattern NOM_PATTERN = Pattern.compile("^[\\p{L}\\s.,'-]{3,50}$");
    private static final Pattern EMAIL_PATTERN = Pattern.compile("^[A-Za-z0-9+_.-]+@(.+)$");
    private static final Pattern TELEPHONE_PATTERN = Pattern.compile("^\\d{8}$");

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
    
    @FXML
    private Button voirPdfButton;
    
    private InscriptionService inscriptionService;
    private CoursService coursService;
    
    // Variable pour stocker l'inscription en cas de modification
    private Inscription inscriptionAModifier;
    private boolean isModificationMode = false;
    
    private Stage dialogStage;
    private Cours cours;
    private boolean inscriptionConfirmee = false;
    private User currentUser;
    private User loggedInUser;

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        try {
            inscriptionService = new InscriptionService();
            coursService = new CoursService();

            // Initialiser la date d'inscription à la date actuelle
            if (dateInscriptionPicker != null) {
                dateInscriptionPicker.setValue(LocalDate.now());
            }

            // Configurer le ComboBox de statut
            if (statutComboBox != null) {
                statutComboBox.getItems().addAll("En attente", "Acceptée", "Refusée");
                statutComboBox.setValue("En attente");
                statutComboBox.setDisable(true);
            }

            // Par défaut, cacher le bouton PDF
            if (voirPdfButton != null) {
                voirPdfButton.setVisible(false);
            }

            // Charger les cours de manière asynchrone
            loadCoursAsync();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'initialisation du formulaire", e);
            showAlert(Alert.AlertType.ERROR, "Erreur d'initialisation", 
                "Une erreur est survenue lors de l'initialisation du formulaire.");
        }
    }
    
    private void setupValidationListeners() {
        // Validation du nom
        if (nomField != null) {
            nomField.focusedProperty().addListener((obs, oldVal, newVal) -> {
                if (!newVal) { // Quand le champ perd le focus
                    validateNom();
                }
            });
        }
        
        // Validation de l'email
        if (emailField != null) {
            emailField.focusedProperty().addListener((obs, oldVal, newVal) -> {
                if (!newVal) {
                    validateEmail();
                }
            });
        }
        
        // Validation du téléphone
        if (telephoneField != null) {
            telephoneField.focusedProperty().addListener((obs, oldVal, newVal) -> {
                if (!newVal) {
                    validateTelephone();
                }
            });
        }
        
        // Validation du cours
        if (coursComboBox != null) {
            coursComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
                if (newVal != null) {
                    setNormalStyle(coursComboBox);
                }
            });
        }
        
        // Validation du statut
        if (statutComboBox != null) {
            statutComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
                if (newVal != null) {
                    setNormalStyle(statutComboBox);
                }
            });
        }
        
        // Validation de la date d'inscription
        if (dateInscriptionPicker != null) {
            dateInscriptionPicker.valueProperty().addListener((obs, oldVal, newVal) -> {
                if (newVal != null) {
                    setNormalStyle(dateInscriptionPicker);
                }
            });
        }
    }
    
    private boolean validateNom() {
        if (nomField == null) return false;
        
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
        if (emailField == null) return false;
        
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
        if (telephoneField == null) return false;
        
        String telephone = telephoneField.getText().trim();
        if (telephone.isEmpty()) {
            setErrorStyle(telephoneField, "Le numéro de téléphone est obligatoire");
            return false;
        } else if (!TELEPHONE_PATTERN.matcher(telephone).matches()) {
            setErrorStyle(telephoneField, "Le numéro de téléphone doit contenir exactement 8 chiffres");
            return false;
        } else {
            setNormalStyle(telephoneField);
            return true;
        }
    }
    
    private boolean validateCours() {
        if (coursComboBox == null) return false;
        
        if (coursComboBox.getValue() == null) {
            setErrorStyle(coursComboBox, "Veuillez sélectionner un cours");
            return false;
        } else {
            setNormalStyle(coursComboBox);
            return true;
        }
    }
    
    private boolean validateStatut() {
        if (statutComboBox == null) return false;
        
        if (statutComboBox.getValue() == null) {
            setErrorStyle(statutComboBox, "Veuillez sélectionner un statut");
            return false;
        } else {
            setNormalStyle(statutComboBox);
            return true;
        }
    }
    
    private boolean validateDateInscription() {
        if (dateInscriptionPicker == null) return false;
        
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
        if (control == null) return;
        
        control.setStyle("-fx-border-color: red;");
        Tooltip tooltip = new Tooltip(message);
        Tooltip.install(control, tooltip);
    }
    
    private void setNormalStyle(Control control) {
        if (control == null) return;
        
        control.setStyle("");
        Tooltip.uninstall(control, null);
    }
    
    private void loadCoursAsync() {
        // Créer une tâche en arrière-plan pour charger les cours
        Task<List<Cours>> task = new Task<>() {
            @Override
            protected List<Cours> call() throws Exception {
                return coursService.getAllCours();
            }
        };

        // Gérer le succès du chargement
        task.setOnSucceeded(event -> {
            List<Cours> cours = task.getValue();
            if (coursComboBox != null) {
                coursComboBox.getItems().clear();
                coursComboBox.getItems().addAll(cours);
                
                // Si un cours a été préselectionné
                if (this.cours != null) {
                    coursComboBox.setValue(this.cours);
                    coursComboBox.setDisable(true);
                }
            }
        });

        // Gérer les erreurs
        task.setOnFailed(event -> {
            Throwable exception = task.getException();
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours", exception);
            showAlert(Alert.AlertType.ERROR, "Erreur de chargement", 
                "Impossible de charger la liste des cours. Veuillez réessayer plus tard.");
        });

        // Démarrer la tâche dans un nouveau thread
        new Thread(task).start();
    }
    
    public void setInscriptionForModification(Inscription inscription) {
        if (inscription == null) {
            LOGGER.log(Level.WARNING, "Cannot modify null inscription");
            return;
        }
        
        this.inscriptionAModifier = inscription;
        isModificationMode = true;
        
        if (formTitleLabel != null) {
            formTitleLabel.setText("Modifier une Inscription");
        }
        
        if (actionButton != null) {
            actionButton.setText("Modifier");
        }
        
        // Remplir les champs avec les données de l'inscription
        if (nomField != null) {
            nomField.setText(inscription.getNom());
        }
        
        if (emailField != null) {
            emailField.setText(inscription.getEmail());
        }
        
        if (telephoneField != null) {
            telephoneField.setText(inscription.getTelephone());
        }
        
        if (statutComboBox != null) {
            statutComboBox.setValue(inscription.getStatut());
        }
        
        // Sélectionner le cours correspondant
        if (coursComboBox != null && coursComboBox.getItems() != null) {
            for (Cours cours : coursComboBox.getItems()) {
                if (cours.getId() == inscription.getCoursId()) {
                    coursComboBox.setValue(cours);
                    break;
                }
            }
        }
        
        // Si la date d'inscription est définie, la sélectionner
        if (dateInscriptionPicker != null && inscription.getDateInscription() != null) {
            dateInscriptionPicker.setValue(inscription.getDateInscription().toLocalDate());
        }
    }
    
    @FXML
    private void handleAction() {
        try {
            if (loggedInUser == null) {
                showAlert(Alert.AlertType.ERROR, "Erreur", 
                    "Vous devez être connecté pour vous inscrire à un cours.");
                return;
            }

            // Vérifier si l'utilisateur est déjà inscrit
            if (isDejaInscrit(cours.getId(), loggedInUser.getEmail())) {
                // Désactiver les champs du formulaire
                nomField.setDisable(true);
                emailField.setDisable(true);
                telephoneField.setDisable(true);
                coursComboBox.setDisable(true);
                statutComboBox.setDisable(true);
                dateInscriptionPicker.setDisable(true);
                actionButton.setVisible(false);
                
                // Afficher le bouton PDF
                voirPdfButton.setVisible(true);
                
                // Mettre à jour le titre
                formTitleLabel.setText("Vous êtes déjà inscrit au cours: " + cours.getTitre());
                return;
            }

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
            
            // Vérifier que les composants sont présents
            if (dateInscriptionPicker == null || nomField == null || emailField == null ||
                telephoneField == null || coursComboBox == null || statutComboBox == null) {
                LOGGER.log(Level.SEVERE, "One or more components are null");
                showAlert(Alert.AlertType.ERROR, "Erreur", "Une erreur est survenue: composants manquants");
                return;
            }
            
            // Convertir la date du DatePicker en LocalDateTime
            LocalDateTime dateInscription = LocalDateTime.of(dateInscriptionPicker.getValue(), LocalTime.now());
            
            if (isModificationMode) {
                if (inscriptionAModifier == null) {
                    LOGGER.log(Level.SEVERE, "inscriptionAModifier is null in modification mode");
                    showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur de modification: inscription introuvable");
                    return;
                }
                
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
        if (nomField != null && nomField.getScene() != null && nomField.getScene().getWindow() != null) {
            Stage stage = (Stage) nomField.getScene().getWindow();
            stage.close();
        } else if (dialogStage != null) {
            dialogStage.close();
        } else {
            LOGGER.log(Level.WARNING, "Cannot close form: no valid stage found");
        }
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private boolean isDejaInscrit(int coursId, String email) {
        if (loggedInUser == null) {
            return false;
        }

        String query = "SELECT COUNT(*) FROM inscription_cours WHERE cours_id = ? AND user_id = ?";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, coursId);
            pstmt.setInt(2, loggedInUser.getId());
            
            var rs = pstmt.executeQuery();
            if (rs.next()) {
                return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'inscription", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Une erreur est survenue lors de la vérification de l'inscription.");
        }
        return false;
    }

    public void initData(Cours cours) {
        if (cours == null) {
            LOGGER.log(Level.WARNING, "Cannot initialize with null course");
            return;
        }
        
        this.cours = cours;

        // Sélectionner le cours dans le ComboBox
        if (coursComboBox != null) {
            coursComboBox.setValue(cours);
            coursComboBox.setDisable(true); // Désactiver la sélection du cours
        }

        // Vérifier si l'utilisateur est déjà inscrit
        if (loggedInUser != null) {
            try {
                if (isDejaInscrit(cours.getId(), loggedInUser.getEmail())) {
                    // Désactiver les champs du formulaire
                    nomField.setDisable(true);
                    emailField.setDisable(true);
                    telephoneField.setDisable(true);
                    dateInscriptionPicker.setDisable(true);
                    actionButton.setVisible(false);
                    
                    // Afficher le bouton PDF
                    if (voirPdfButton != null) {
                        voirPdfButton.setVisible(true);
                    }
                    
                    // Mettre à jour le titre
                    if (formTitleLabel != null) {
                        formTitleLabel.setText("Vous êtes déjà inscrit au cours: " + cours.getTitre());
                    }

                    // Pré-remplir les champs avec les informations de l'utilisateur
                    nomField.setText(loggedInUser.getName());
                    emailField.setText(loggedInUser.getEmail());
                    telephoneField.setText(String.valueOf(loggedInUser.getPhone()));
                } else {
                    // Réinitialiser l'interface pour une nouvelle inscription
                    nomField.setDisable(false);
                    emailField.setDisable(false);
                    telephoneField.setDisable(false);
                    dateInscriptionPicker.setDisable(false);
                    actionButton.setVisible(true);
                    
                    if (voirPdfButton != null) {
                        voirPdfButton.setVisible(false);
                    }
                    
                    if (formTitleLabel != null) {
                        formTitleLabel.setText("Inscription au cours: " + cours.getTitre());
                    }

                    // Pré-remplir les champs avec les informations de l'utilisateur
                    nomField.setText(loggedInUser.getName());
                    emailField.setText(loggedInUser.getEmail());
                    telephoneField.setText(String.valueOf(loggedInUser.getPhone()));
                }
            } catch (Exception e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'inscription", e);
            }
        }
    }

    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }

    public void setCours(Cours cours) {
        this.cours = cours;
        if (coursComboBox != null) {
            coursComboBox.setValue(cours);
            coursComboBox.setDisable(true);
        }
        if (statutComboBox != null) {
            statutComboBox.setValue("En attente");
            statutComboBox.setDisable(true);
        }
        
        // Mettre à jour le titre si possible
        if (formTitleLabel != null && cours != null) {
            formTitleLabel.setText("Inscription au cours: " + cours.getTitre());
        }
    }

    public boolean isInscriptionConfirmee() {
        return inscriptionConfirmee;
    }

    @FXML
    private void handleConfirmInscription() {
        if (!validateNom() || !validateEmail() || !validateTelephone()) {
            return;
        }
        
        if (cours == null) {
            LOGGER.log(Level.SEVERE, "cours is null in handleConfirmInscription");
            showError("Erreur d'inscription", "Le cours sélectionné n'est pas valide.");
            return;
        }

        if (loggedInUser == null) {
            LOGGER.log(Level.SEVERE, "Utilisateur non connecté");
            showError("Erreur d'inscription", "Vous devez être connecté pour vous inscrire à un cours.");
            return;
        }

        try {
            String insertQuery = "INSERT INTO inscription_cours (cours_id, user_id, nom, email, telephone, created_at, date_inscription, statut) " +
                               "VALUES (?, ?, ?, ?, ?, NOW(), NOW(), 'En attente')";
            
            try (Connection conn = DatabaseConnection.getConnection();
                 PreparedStatement pstmt = conn.prepareStatement(insertQuery)) {
                
                pstmt.setInt(1, cours.getId());
                pstmt.setInt(2, loggedInUser.getId()); // Utiliser l'ID de l'utilisateur connecté
                pstmt.setString(3, nomField.getText().trim());
                pstmt.setString(4, emailField.getText().trim());
                pstmt.setString(5, telephoneField.getText().trim());
                
                int result = pstmt.executeUpdate();
                
                if (result > 0) {
                    inscriptionConfirmee = true;
                    Alert alert = new Alert(Alert.AlertType.INFORMATION);
                    alert.setTitle("Inscription réussie");
                    alert.setHeaderText(null);
                    alert.setContentText("Vous êtes maintenant inscrit au cours : " + cours.getTitre());
                    alert.showAndWait();
                    
                    if (dialogStage != null) {
                        dialogStage.close();
                    } else {
                        closeForm();
                    }
                } else {
                    showError("Erreur d'inscription", "L'inscription n'a pas pu être enregistrée.");
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'inscription", e);
            showError("Erreur d'inscription", "Une erreur est survenue lors de l'inscription.\nVeuillez réessayer plus tard.");
        }
    }

    private boolean isInputValid() {
        String errorMessage = "";

        if (nomField == null || nomField.getText() == null || nomField.getText().trim().isEmpty()) {
            errorMessage += "Le nom est obligatoire\n";
        }

        if (emailField == null || emailField.getText() == null || emailField.getText().trim().isEmpty()) {
            errorMessage += "L'email est obligatoire\n";
        } else if (!EMAIL_PATTERN.matcher(emailField.getText()).matches()) {
            errorMessage += "L'email n'est pas valide\n";
        }

        if (telephoneField == null || telephoneField.getText() == null || telephoneField.getText().trim().isEmpty()) {
            errorMessage += "Le téléphone est obligatoire\n";
        } else if (!TELEPHONE_PATTERN.matcher(telephoneField.getText()).matches()) {
            errorMessage += "Le numéro de téléphone doit contenir exactement 8 chiffres\n";
        }

        if (errorMessage.isEmpty()) {
            return true;
        } else {
            showError("Erreur de saisie", errorMessage);
            return false;
        }
    }

    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    @FXML
    private void handleVoirPdf() {
        if (cours == null) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Impossible de trouver le cours.");
            return;
        }

        try {
            String pdfFilename = cours.getPdfFilename();
            if (pdfFilename == null || pdfFilename.isEmpty()) {
                showAlert(Alert.AlertType.WARNING, "PDF non disponible", 
                    "Le PDF de ce cours n'est pas encore disponible.");
                return;
            }

            // Construire le chemin complet du fichier PDF
            String pdfPath = System.getProperty("user.dir") + "/src/main/resources/pdfs/" + pdfFilename;
            java.io.File pdfFile = new java.io.File(pdfPath);
            
            if (!pdfFile.exists()) {
                showAlert(Alert.AlertType.ERROR, "Fichier non trouvé", 
                    "Le fichier PDF n'existe pas à l'emplacement spécifié.");
                return;
            }

            // Ouvrir le PDF avec l'application par défaut du système
            java.awt.Desktop.getDesktop().open(pdfFile);
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du PDF", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible d'ouvrir le PDF du cours : " + e.getMessage());
        }
    }

    public void setCurrentUser(User user) {
        this.currentUser = user;
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        
        // Si l'utilisateur est null, on ne fait rien
        if (user == null) {
            LOGGER.warning("L'utilisateur fourni est null");
            return;
        }

        // Vérifier si les champs sont initialisés
        if (nomField == null || emailField == null || telephoneField == null) {
            LOGGER.warning("Les champs du formulaire ne sont pas encore initialisés");
            // On attend que les champs soient initialisés
            Platform.runLater(this::initializeFieldsWithUserData);
            return;
        }

        initializeFieldsWithUserData();
    }

    private void initializeFieldsWithUserData() {
        try {
            if (loggedInUser == null) {
                LOGGER.warning("loggedInUser est null lors de l'initialisation des champs");
                return;
            }

            LOGGER.info("Pré-remplissage des champs avec les informations de l'utilisateur: " + loggedInUser.getName());
            
            if (nomField != null) {
                nomField.setText(loggedInUser.getName());
                LOGGER.info("Nom field set to: " + loggedInUser.getName());
            }
            
            if (emailField != null) {
                emailField.setText(loggedInUser.getEmail());
                LOGGER.info("Email field set to: " + loggedInUser.getEmail());
            }
            
            if (telephoneField != null) {
                telephoneField.setText(String.valueOf(loggedInUser.getPhone()));
                LOGGER.info("Telephone field set to: " + loggedInUser.getPhone());
            }

            // Si le cours est déjà défini, vérifier l'inscription
            if (cours != null) {
                verifierInscriptionExistante();
            }
        } catch (Exception e) {
            LOGGER.severe("Erreur lors du pré-remplissage des champs: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private void verifierInscriptionExistante() {
        if (loggedInUser == null || cours == null) {
            LOGGER.warning("Impossible de vérifier l'inscription: utilisateur ou cours null");
            return;
        }

        try {
            if (isDejaInscrit(cours.getId(), loggedInUser.getEmail())) {
                Platform.runLater(() -> {
                    // Désactiver les champs du formulaire
                    nomField.setDisable(true);
                    emailField.setDisable(true);
                    telephoneField.setDisable(true);
                    coursComboBox.setDisable(true);
                    statutComboBox.setDisable(true);
                    dateInscriptionPicker.setDisable(true);
                    actionButton.setVisible(false);
                    
                    // Afficher le bouton PDF
                    if (voirPdfButton != null) {
                        voirPdfButton.setVisible(true);
                    }
                    
                    // Mettre à jour le titre
                    if (formTitleLabel != null) {
                        formTitleLabel.setText("Vous êtes déjà inscrit au cours: " + cours.getTitre());
                    }
                });
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'inscription", e);
        }
    }
} 