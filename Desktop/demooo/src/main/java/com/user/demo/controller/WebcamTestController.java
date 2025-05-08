package com.user.demo.controller;

import com.user.demo.service.WebcamService;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.image.ImageView;
import javafx.scene.control.Alert;

import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Logger;
import java.util.logging.Level;

public class WebcamTestController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(WebcamTestController.class.getName());

    @FXML private ImageView webcamView;
    @FXML private Button startButton;
    @FXML private Button stopButton;

    private WebcamService webcamService;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        webcamService = new WebcamService();
        stopButton.setDisable(true);
        
        try {
            webcamService.initialize(webcamView);
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to initialize webcam", e);
            showError("Erreur de la caméra", "Impossible d'initialiser la webcam: " + e.getMessage());
        }
    }

    @FXML
    private void handleStartCamera() {
        try {
            webcamService.startCamera();
            startButton.setDisable(true);
            stopButton.setDisable(false);
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to start camera", e);
            showError("Erreur de la caméra", "Impossible de démarrer la webcam: " + e.getMessage());
        }
    }

    @FXML
    private void handleStopCamera() {
        try {
            webcamService.stopCamera();
            startButton.setDisable(false);
            stopButton.setDisable(true);
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to stop camera", e);
            showError("Erreur de la caméra", "Impossible d'arrêter la webcam: " + e.getMessage());
        }
    }

    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
} 