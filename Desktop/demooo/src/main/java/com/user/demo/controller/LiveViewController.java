package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.service.WebRTCService;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.scene.web.WebView;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.stage.Stage;
import javafx.concurrent.Worker.State;
import netscape.javascript.JSObject;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Modality;
import java.io.IOException;

import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Logger;
import java.util.logging.Level;
import javafx.scene.image.ImageView;
import com.user.demo.service.WebcamService;
import javafx.application.Platform;
import com.user.demo.service.MicrophoneService;
import javafx.scene.layout.VBox;
import com.user.demo.service.ScreenCaptureService;
import com.user.demo.dao.CoursDAO;

public class LiveViewController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(LiveViewController.class.getName());

    @FXML private Label courseTitleLabel;
    @FXML private Label viewersCountLabel;
    @FXML private WebView streamView;
    @FXML private Button toggleMicButton;
    @FXML private Button toggleCameraButton;
    @FXML private Button shareScreenButton;
    @FXML private Button endLiveButton;
    @FXML private ListView<String> chatListView;
    @FXML private TextField messageField;
    @FXML private Button sendButton;

    private Cours currentCours;
    private boolean isMicOn = false;
    private boolean isCameraOn = false;
    private ObservableList<String> chatMessages = FXCollections.observableArrayList();
    private int viewersCount = 0;
    private WebRTCService webRTCService;
    private WebcamService webcamService;
    private MicrophoneService microphoneService;
    private ImageView cameraPreview;
    private boolean isScreenSharing = false;
    private ScreenCaptureService screenCaptureService;
    private ImageView screenShareView;
    private CoursDAO coursDAO;
    private boolean isParticipantMode = false; // Par défaut, mode présentateur (admin)

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        webRTCService = new WebRTCService();
        webcamService = new WebcamService();
        microphoneService = new MicrophoneService();
        screenCaptureService = new ScreenCaptureService();
        coursDAO = new CoursDAO();
        chatListView.setItems(chatMessages);
        
        // Désactiver les contrôles de chat jusqu'à ce que Jitsi soit initialisé
        messageField.setDisable(true);
        messageField.setPromptText("Chargement du chat...");
        sendButton.setDisable(true);
        
        // Ajouter un message initial
        chatMessages.add("Système: Initialisation du chat...");
        
        // Configurer le TextField pour réagir à la touche Entrée
        messageField.setOnKeyPressed(event -> {
            if (event.getCode() == javafx.scene.input.KeyCode.ENTER) {
                handleSendMessage();
            }
        });
        
        // Configurer la cellFactory pour personnaliser l'affichage des messages de chat
        chatListView.setCellFactory(lv -> new ListCell<String>() {
            @Override
            protected void updateItem(String item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || item == null) {
                    setText(null);
                    setStyle("");
                } else {
                    setText(item);
                    
                    if (item.startsWith("Admin:")) {
                        // Style pour les messages de l'administrateur
                        setStyle("-fx-text-fill: #2ecc71; -fx-font-weight: bold;");
                    } else if (item.startsWith("Participant:")) {
                        // Style pour les messages des participants
                        setStyle("-fx-text-fill: #3498db;");
                    } else {
                        // Style pour les autres messages
                        setStyle("-fx-text-fill: #ecf0f1;");
                    }
                }
            }
        });
        
        updateViewersCount();
        
        // Créer un ImageView invisible pour la prévisualisation de la caméra
        cameraPreview = new ImageView();
        cameraPreview.setFitWidth(320);
        cameraPreview.setFitHeight(240);
        cameraPreview.setVisible(false);
        cameraPreview.setStyle("-fx-border-color: #1abc9c; -fx-border-width: 2;");
        cameraPreview.setPreserveRatio(true);
        
        // Créer un ImageView pour le partage d'écran
        screenShareView = new ImageView();
        screenShareView.setFitWidth(640);
        screenShareView.setFitHeight(480);
        screenShareView.setVisible(false);
        screenShareView.setStyle("-fx-border-color: #e74c3c; -fx-border-width: 2;");
        screenShareView.setPreserveRatio(true);
        
        // Configurer le service de capture d'écran
        screenCaptureService.setTargetView(screenShareView);
        screenCaptureService.setFrameRate(15); // 15 FPS
        
        try {
            LOGGER.info("Initializing WebView...");
            
            // Enable JavaScript
            streamView.getEngine().setJavaScriptEnabled(true);
            
            // Enable WebView debugging
            System.setProperty("javafx.web.debug", "true");
            
            // Enable JavaScript console logging
            streamView.getEngine().setOnAlert(event -> LOGGER.info("JavaScript Alert: " + event));
            streamView.getEngine().setOnError(event -> LOGGER.severe("JavaScript Error: " + event.getMessage()));
            
            // Disable context menu
            streamView.setContextMenuEnabled(false);
            
            // Load the WebRTC page
            String webrtcUrl = getClass().getResource("/com/user/demo/views/webrtc.html").toExternalForm();
            LOGGER.info("Loading Jitsi Meet page from: " + webrtcUrl);
            streamView.getEngine().load(webrtcUrl);
            
            // Wait for page load and initialize WebRTC
            streamView.getEngine().getLoadWorker().stateProperty().addListener((obs, oldState, newState) -> {
                if (newState == State.SUCCEEDED) {
                    LOGGER.info("WebView page loaded successfully");
                    try {
                        JSObject window = (JSObject) streamView.getEngine().executeScript("window");
                        LOGGER.info("Got window object: " + (window != null));
                        window.setMember("javaController", this);
                        LOGGER.info("Java controller registered with JavaScript");
                        
                        // Passer l'information du mode participant à JavaScript
                        window.eval("window.isParticipantMode = " + isParticipantMode + ";");
                        
                        webRTCService.initialize(window);
                        LOGGER.info("WebRTC service initialized");
                    } catch (Exception e) {
                        LOGGER.log(Level.SEVERE, "Failed to initialize Jitsi Meet", e);
                        showError("Failed to initialize streaming", e.getMessage());
                    }
                } else if (newState == State.FAILED) {
                    LOGGER.severe("WebView page failed to load");
                    showError("Failed to load streaming interface", "The streaming page could not be loaded");
                }
            });
            
            // Initialiser la webcam service
            try {
                webcamService.initialize(cameraPreview);
            } catch (Exception e) {
                LOGGER.log(Level.SEVERE, "Failed to initialize webcam", e);
                // Ne pas afficher d'erreur pour ne pas interrompre l'expérience utilisateur
            }
            
            // Vérifier la disponibilité du microphone
            boolean micAvailable = microphoneService.isMicrophoneAvailable();
            if (!micAvailable) {
                LOGGER.warning("Microphone not available");
                Platform.runLater(() -> {
                    toggleMicButton.setDisable(true);
                    toggleMicButton.setStyle("-fx-background-color: #95a5a6;"); // gris
                    toggleMicButton.setText("Micro non disponible");
                });
            } else {
                LOGGER.info("Microphone available");
                isMicOn = false; // Initialmente désactivé
                Platform.runLater(() -> {
                    toggleMicButton.setDisable(false);
                    toggleMicButton.setStyle("-fx-background-color: #e74c3c;"); // rouge pour désactivé
                });
            }
            
            // Si en mode participant, adapter certains contrôles initialement
            if (isParticipantMode) {
                Platform.runLater(() -> {
                    // Ne pas cacher le bouton de partage d'écran pour les participants
                    // Ils peuvent aussi partager leur écran
                    
                    // Changer le texte du bouton de fin
                    if (endLiveButton != null) {
                        endLiveButton.setText("Quitter");
                    }
                    
                    // Adapter le libellé des autres boutons
                    if (toggleMicButton != null) {
                        toggleMicButton.setText("Micro");
                    }
                    if (toggleCameraButton != null) {
                        toggleCameraButton.setText("Caméra");
                    }
                    if (shareScreenButton != null) {
                        shareScreenButton.setText("Partager écran");
                    }
                });
            }
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error during initialization", e);
            showError("Initialization Error", e.getMessage());
        }
    }

    // Called from JavaScript when Jitsi Meet is fully initialized
    public void onJitsiInitialized() {
        LOGGER.info("Jitsi Meet fully initialized");
        webRTCService.setInitialized(true);
        
        // Activer les contrôles de chat quand Jitsi est initialisé
        Platform.runLater(() -> {
            messageField.setDisable(false);
            messageField.setPromptText("Écrivez un message...");
            sendButton.setDisable(false);
            
            // Ajouter un message de bienvenue dans le chat
            String welcomeMessage = "Système: Chat est maintenant disponible";
            chatMessages.add(welcomeMessage);
            chatListView.scrollTo(chatMessages.size() - 1);
        });
    }

    private void showError(String title, String message) {
        javafx.application.Platform.runLater(() -> {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle(title);
            alert.setHeaderText(null);
            alert.setContentText(message);
            alert.showAndWait();
        });
    }

    public void setCours(Cours cours) {
        this.currentCours = cours;
        courseTitleLabel.setText("Live : " + cours.getTitre());
        
        // Informer le JavaScript sur le cours pour créer un nom de salle cohérent
        if (streamView != null && streamView.getEngine() != null) {
            try {
                JSObject window = (JSObject) streamView.getEngine().executeScript("window");
                if (window != null) {
                    // Appeler la fonction JavaScript setCourseInfo avec l'ID et le titre du cours
                    window.eval("if (typeof setCourseInfo === 'function') { setCourseInfo(" + 
                               cours.getId() + ", '" + cours.getTitre().replace("'", "\\'") + "'); }");
                    LOGGER.info("Course info sent to JavaScript: ID=" + cours.getId() + ", Title=" + cours.getTitre());
                }
            } catch (Exception e) {
                LOGGER.log(Level.WARNING, "Failed to send course info to JavaScript", e);
            }
        }
        
        // Mettre à jour le statut live du cours dans la BDD
        // seulement si on est en mode présentateur/admin
        if (!isParticipantMode) {
            coursDAO.updateCoursLiveStatus(cours.getId(), true);
            cours.setLive(true);
        }
    }

    @FXML
    private void handleToggleMic() {
        try {
            isMicOn = !isMicOn;
            toggleMicButton.setStyle(isMicOn ? 
                "-fx-background-color: #2ecc71;" : // vert pour activé
                "-fx-background-color: #e74c3c;"); // rouge pour désactivé
            
            // Contrôler le microphone physique
            if (isMicOn) {
                try {
                    microphoneService.startMicrophone();
                    LOGGER.info("Physical microphone started");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Error starting physical microphone", e);
                    // Continue même en cas d'erreur avec le microphone physique
                }
            } else {
                try {
                    microphoneService.stopMicrophone();
                    LOGGER.info("Physical microphone stopped");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Error stopping physical microphone", e);
                    // Continue même en cas d'erreur avec le microphone physique
                }
            }
            
            // Contrôler le microphone WebRTC
            if (webRTCService.isInitialized()) {
                webRTCService.toggleAudio(isMicOn);
                LOGGER.info("WebRTC microphone " + (isMicOn ? "enabled" : "disabled"));
            } else {
                LOGGER.warning("WebRTC not initialized, microphone toggle might not work");
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error controlling microphone", e);
            showError("Microphone Error", "Failed to control microphone: " + e.getMessage());
            // Reset the state and UI to reflect the failure
            isMicOn = !isMicOn; // Revert the state
            toggleMicButton.setStyle(isMicOn ? 
                "-fx-background-color: #2ecc71;" : 
                "-fx-background-color: #e74c3c;");
        }
    }

    // Méthode appelée depuis JavaScript quand l'état du micro change
    public void onAudioStateChanged(boolean enabled) {
        LOGGER.info("Audio state changed from JavaScript: " + (enabled ? "enabled" : "disabled"));
        javafx.application.Platform.runLater(() -> {
            isMicOn = enabled;
            toggleMicButton.setStyle(isMicOn ? 
                "-fx-background-color: #2ecc71;" : 
                "-fx-background-color: #e74c3c;");
        });
    }

    @FXML
    private void handleToggleCamera() {
        try {
            isCameraOn = !isCameraOn;
            toggleCameraButton.setStyle(isCameraOn ? 
                "-fx-background-color: #2ecc71;" : // vert pour activé
                "-fx-background-color: #3498db;"); // bleu pour désactivé
            
            // Contrôler la caméra physique via webcamService
            if (isCameraOn) {
                try {
                    // Ajouter cameraPreview à la scène s'il n'y est pas déjà
                    if (!((VBox) streamView.getParent()).getChildren().contains(cameraPreview)) {
                        ((VBox) streamView.getParent()).getChildren().add(0, cameraPreview);
                        cameraPreview.setVisible(true);
                    }
                    webcamService.startCamera();
                    LOGGER.info("Camera started");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Error starting camera", e);
                    showError("Camera Error", "Failed to start camera: " + e.getMessage());
                    isCameraOn = false;
                    toggleCameraButton.setStyle("-fx-background-color: #3498db;");
                    return;
                }
            } else {
                try {
                    webcamService.stopCamera();
                    cameraPreview.setVisible(false);
                    // Optionnellement, supprimer cameraPreview de la scène
                    if (((VBox) streamView.getParent()).getChildren().contains(cameraPreview)) {
                        ((VBox) streamView.getParent()).getChildren().remove(cameraPreview);
                    }
                    LOGGER.info("Camera stopped");
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Error stopping camera", e);
                    showError("Camera Error", "Failed to stop camera: " + e.getMessage());
                }
            }
            
            // Toujours contrôler la caméra virtuelle via WebRTC aussi
            if (webRTCService.isInitialized()) {
                webRTCService.toggleVideo(isCameraOn);
                LOGGER.info("WebRTC camera " + (isCameraOn ? "enabled" : "disabled"));
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error controlling camera", e);
            showError("Camera Error", "Failed to control camera: " + e.getMessage());
        }
    }

    @FXML
    private void handleShareScreen() {
        try {
            // Inverser l'état du partage d'écran
            isScreenSharing = !isScreenSharing;
            
            if (isScreenSharing) {
                // Ajouter screenShareView à la scène s'il n'y est pas déjà
                VBox streamContainer = (VBox) streamView.getParent();
                if (!streamContainer.getChildren().contains(screenShareView)) {
                    // Ajouter au-dessus du WebView mais en-dessous de la caméra si présente
                    int insertIndex = 0;
                    if (streamContainer.getChildren().contains(cameraPreview)) {
                        insertIndex = 1; // Insérer après la caméra
                    }
                    streamContainer.getChildren().add(insertIndex, screenShareView);
                }
                screenShareView.setVisible(true);
                
                // Démarrer la capture d'écran avec Robot
                screenCaptureService.startCapture();
                
                // Si WebRTC est initialisé, essayer aussi le partage d'écran via WebRTC
                if (webRTCService.isInitialized()) {
                    try {
                        webRTCService.startScreenSharing();
                    } catch (Exception e) {
                        LOGGER.log(Level.WARNING, "WebRTC screen sharing failed, continuing with local capture", e);
                    }
                }
                
                LOGGER.info("Screen sharing started");
                
                // Mettre à jour l'apparence du bouton
                shareScreenButton.setStyle("-fx-background-color: #2ecc71;"); // vert quand actif
                shareScreenButton.setText("Arrêter le partage");
            } else {
                // Arrêter la capture d'écran
                screenCaptureService.stopCapture();
                
                // Masquer la vue
                screenShareView.setVisible(false);
                
                // Supprimer de la scène
                VBox streamContainer = (VBox) streamView.getParent();
                if (streamContainer.getChildren().contains(screenShareView)) {
                    streamContainer.getChildren().remove(screenShareView);
                }
                
                // Si WebRTC est initialisé, arrêter aussi le partage d'écran WebRTC
                if (webRTCService.isInitialized()) {
                    try {
                        webRTCService.stopScreenSharing();
                    } catch (Exception e) {
                        LOGGER.log(Level.WARNING, "Failed to stop WebRTC screen sharing", e);
                    }
                }
                
                LOGGER.info("Screen sharing stopped");
                
                // Mettre à jour l'apparence du bouton
                shareScreenButton.setStyle("-fx-background-color: #3498db;"); // bleu quand inactif
                shareScreenButton.setText("Partager l'écran");
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error " + (isScreenSharing ? "starting" : "stopping") + " screen share", e);
            showError("Screen Sharing Error", "Failed to " + (isScreenSharing ? "start" : "stop") + " screen sharing: " + e.getMessage());
            
            // Réinitialiser l'état en cas d'erreur
            isScreenSharing = !isScreenSharing;
        }
    }

    @FXML
    private void handleSendMessage() {
        try {
            LOGGER.info("Début de handleSendMessage");
            
            // Vérifier d'abord si le service WebRTC est initialisé
            if (!webRTCService.isInitialized()) {
                LOGGER.warning("Tentative d'envoi de message alors que le service WebRTC n'est pas initialisé");
                
                // Proposer de réinitialiser le service
                Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
                alert.setTitle("Chat non disponible");
                alert.setHeaderText("Le service de chat n'est pas encore initialisé");
                alert.setContentText("Voulez-vous tenter de reconnecter le service de chat ?");
                
                if (alert.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
                    reinitializeWebRTC();
                }
                return;
            }
            
            String message = messageField.getText().trim();
            LOGGER.info("Message à envoyer: " + message);
            
            if (!message.isEmpty()) {
                String sender = isParticipantMode ? "Participant" : "Admin";
                String formattedMessage = sender + ": " + message;
                LOGGER.info("Message formaté: " + formattedMessage);
                
                // Ajouter directement à la liste locale pour plus de réactivité
                chatMessages.add(formattedMessage);
                
                // Envoyer via WebRTC pour que tout le monde le reçoive
                webRTCService.sendChatMessage(formattedMessage);
                messageField.clear();
                
                // Défiler vers le bas
                chatListView.scrollTo(chatMessages.size() - 1);
                
                LOGGER.info("Message envoyé avec succès");
            } else {
                LOGGER.info("Message vide, rien à envoyer");
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'envoi du message", e);
            
            // Si l'erreur est liée à l'initialisation, proposer de réessayer
            if (e instanceof IllegalStateException && e.getMessage().contains("not initialized")) {
                Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
                alert.setTitle("Erreur de communication");
                alert.setHeaderText("Service de chat non initialisé");
                alert.setContentText("Le service de chat n'est pas correctement initialisé. Voulez-vous tenter de reconnecter ?");
                
                if (alert.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
                    reinitializeWebRTC();
                }
            } else {
                showError("Erreur de Chat", "Impossible d'envoyer le message: " + e.getMessage());
            }
        }
    }

    @FXML
    private void handleEndLive() {
        // En mode participant, simplement fermer la fenêtre
        if (isParticipantMode) {
            // Nettoyer les ressources
            cleanupResources();
            Stage stage = (Stage) endLiveButton.getScene().getWindow();
            stage.close();
            return;
        }
        
        // En mode présentateur, demander confirmation
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Confirmation");
        alert.setHeaderText("Terminer le live");
        alert.setContentText("Êtes-vous sûr de vouloir terminer le live ?");

        if (alert.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
            // Nettoyer les ressources
            cleanupResources();
            
            // Désactiver le statut live du cours dans la BDD
            if (currentCours != null) {
                coursDAO.updateCoursLiveStatus(currentCours.getId(), false);
                currentCours.setLive(false);
                LOGGER.info("Statut live désactivé pour le cours: " + currentCours.getTitre());
            }
            
            webRTCService.stopStream();
            LOGGER.info("Live terminé pour le cours : " + currentCours.getTitre());
            Stage stage = (Stage) endLiveButton.getScene().getWindow();
            stage.close();
        }
    }

    private void updateViewersCount() {
        viewersCountLabel.setText(viewersCount + " spectateurs");
    }

    // Méthode appelée depuis JavaScript quand un nouveau spectateur rejoint
    public void onViewerJoined() {
        viewersCount++;
        updateViewersCount();
    }

    // Méthode appelée depuis JavaScript quand un spectateur quitte
    public void onViewerLeft() {
        if (viewersCount > 0) {
            viewersCount--;
            updateViewersCount();
        }
    }

    // Méthode appelée depuis JavaScript pour les messages du chat
    public void onChatMessageReceived(String message) {
        LOGGER.info("Message reçu de JavaScript: " + message);
        
        try {
            final String formattedMessage;
            // Vérifier si le message contient déjà un préfixe (Admin: ou Participant:)
            if (!message.contains("Admin:") && !message.contains("Participant:")) {
                // Si le message n'a pas de préfixe, ajouter un préfixe générique
                formattedMessage = "Utilisateur: " + message;
                LOGGER.info("Message formaté avec préfixe générique: " + formattedMessage);
            } else {
                formattedMessage = message;
                LOGGER.info("Message déjà formaté, conservé tel quel: " + formattedMessage);
            }
            
            Platform.runLater(() -> {
                try {
                    LOGGER.info("Ajout du message à la liste des messages du chat");
                    chatMessages.add(formattedMessage);
                    // Défiler automatiquement vers le dernier message
                    chatListView.scrollTo(chatMessages.size() - 1);
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout du message à l'UI", e);
                }
            });
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du traitement du message reçu", e);
        }
    }

    // Méthode appelée depuis JavaScript en cas d'erreur
    public void onError(String errorMessage) {
        LOGGER.severe("Error from Jitsi Meet: " + errorMessage);
        showError("Streaming Error", errorMessage);
    }

    // Méthode appelée depuis JavaScript quand le stream est terminé
    public void onStreamEnded() {
        LOGGER.info("Stream ended");
        Stage stage = (Stage) endLiveButton.getScene().getWindow();
        stage.close();
    }

    // Méthode appelée depuis JavaScript quand le micro est disponible
    public void onMicrophoneAvailable(boolean available) {
        LOGGER.info("Microphone availability from JavaScript: " + (available ? "available" : "not available"));
        
        // Mettre à jour l'interface utilisateur en fonction de la disponibilité du micro
        Platform.runLater(() -> {
            if (!available) {
                toggleMicButton.setDisable(true);
                toggleMicButton.setStyle("-fx-background-color: #95a5a6;"); // gris
                toggleMicButton.setText("Micro non disponible");
                showError("Microphone Error", "Le microphone n'est pas disponible ou l'accès est refusé.");
            } else {
                toggleMicButton.setDisable(false);
                toggleMicButton.setStyle("-fx-background-color: #2ecc71;"); // vert
                isMicOn = true; // Assume microphone is initially enabled
            }
        });
    }

    // Méthode appelée depuis JavaScript quand l'état du partage d'écran change
    public void onScreenSharingStateChanged(boolean sharing) {
        LOGGER.info("Screen sharing state changed from JavaScript: " + (sharing ? "started" : "stopped"));
        Platform.runLater(() -> {
            // Mettre à jour l'apparence du bouton en fonction de l'état
            shareScreenButton.setStyle(sharing ? 
                "-fx-background-color: #2ecc71;" :  // vert quand actif
                "-fx-background-color: #3498db;");  // bleu quand inactif
            shareScreenButton.setText(sharing ? "Arrêter le partage" : "Partager l'écran");
        });
    }

    /**
     * Configure le mode de participation (true = participant, false = présentateur/admin)
     */
    public void setParticipantMode(boolean isParticipant) {
        this.isParticipantMode = isParticipant;
        LOGGER.info("Mode participant défini sur: " + isParticipant);
        
        // Si en mode participant, adapter l'interface
        if (isParticipant) {
            Platform.runLater(() -> {
                // Ne pas cacher le bouton de partage d'écran pour les participants
                // Les participants peuvent maintenant partager leur écran aussi
                
                // Changer le texte du bouton de fin
                if (endLiveButton != null) {
                    endLiveButton.setText("Quitter");
                }
                
                // Adapter le libellé des boutons pour plus de clarté
                if (toggleMicButton != null) {
                    toggleMicButton.setText("Micro");
                    toggleMicButton.setStyle("-fx-background-color: #3498db;"); // bleu par défaut
                }
                if (toggleCameraButton != null) {
                    toggleCameraButton.setText("Caméra");
                    toggleCameraButton.setStyle("-fx-background-color: #3498db;"); // bleu par défaut
                }
                if (shareScreenButton != null) {
                    shareScreenButton.setText("Partager écran");
                    shareScreenButton.setStyle("-fx-background-color: #3498db;"); // bleu par défaut
                }
                
                // Mettre à jour le titre avec le mode participant
                if (courseTitleLabel != null) {
                    String currentTitle = courseTitleLabel.getText();
                    courseTitleLabel.setText(currentTitle + " (Participant)");
                }
            });
        }
    }

    /**
     * Vérifie si on est en mode participant
     */
    public boolean isParticipantMode() {
        return isParticipantMode;
    }

    // Méthode auxiliaire pour nettoyer les ressources
    private void cleanupResources() {
        if (microphoneService != null) {
            try {
                microphoneService.cleanup();
            } catch (Exception e) {
                LOGGER.log(Level.WARNING, "Error cleaning up microphone service", e);
            }
        }
        
        if (webcamService != null && webcamService.isRunning()) {
            try {
                webcamService.stopCamera();
            } catch (Exception e) {
                LOGGER.log(Level.WARNING, "Error stopping webcam", e);
            }
        }
        
        if (screenCaptureService != null && screenCaptureService.isCapturing()) {
            try {
                screenCaptureService.stopCapture();
            } catch (Exception e) {
                LOGGER.log(Level.WARNING, "Error stopping screen capture", e);
            }
        }
    }

    // Méthode pour réinitialiser le service WebRTC en cas de problème
    private void reinitializeWebRTC() {
        LOGGER.info("Tentative de réinitialisation du service WebRTC");
        
        Platform.runLater(() -> {
            // Informer l'utilisateur
            chatMessages.add("Système: Reconnexion au service de chat...");
            
            try {
                // Récupérer la fenêtre JavaScript
                JSObject window = (JSObject) streamView.getEngine().executeScript("window");
                
                if (window != null) {
                    // Réinitialiser le service
                    window.setMember("javaController", this);
                    webRTCService.initialize(window);
                    LOGGER.info("WebRTC service réinitialisé");
                    
                    // Forcer une réinitialisation côté JavaScript
                    window.eval("if (typeof initializeJitsi === 'function') { initializeJitsi(); }");
                    
                    // Activer les contrôles
                    messageField.setDisable(false);
                    messageField.setPromptText("Écrivez un message...");
                    sendButton.setDisable(false);
                } else {
                    LOGGER.severe("Impossible de récupérer l'objet window pour la réinitialisation");
                    chatMessages.add("Système: Échec de la reconnexion, veuillez rafraîchir la page");
                }
            } catch (Exception e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la réinitialisation du service WebRTC", e);
                chatMessages.add("Système: Erreur de reconnexion au chat");
            }
        });
    }
} 