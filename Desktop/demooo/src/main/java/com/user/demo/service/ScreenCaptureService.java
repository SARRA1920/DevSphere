package com.user.demo.service;

import java.awt.Rectangle;
import java.awt.Toolkit;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.logging.Level;
import java.util.logging.Logger;

import javafx.animation.AnimationTimer;
import javafx.application.Platform;
import javafx.embed.swing.SwingFXUtils;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.image.WritableImage;
import javafx.scene.robot.Robot;

public class ScreenCaptureService {
    private static final Logger LOGGER = Logger.getLogger(ScreenCaptureService.class.getName());
    
    private final Robot robot;
    private final AtomicBoolean isCapturing = new AtomicBoolean(false);
    private AnimationTimer captureTimer;
    private ImageView targetImageView;
    private double frameRate = 10; // Images par seconde
    private long lastCaptureTime = 0;
    private final long frameInterval;
    
    public ScreenCaptureService() {
        robot = new Robot();
        frameInterval = (long) (1000 / frameRate); // Convertir en millisecondes
        LOGGER.info("ScreenCaptureService initialized with frame interval: " + frameInterval + "ms");
    }
    
    public void setTargetView(ImageView imageView) {
        this.targetImageView = imageView;
        LOGGER.info("Target ImageView set");
    }
    
    public void setFrameRate(double framesPerSecond) {
        this.frameRate = framesPerSecond;
        LOGGER.info("Frame rate set to: " + frameRate + " fps");
    }
    
    public boolean isCapturing() {
        return isCapturing.get();
    }
    
    public void startCapture() {
        if (isCapturing.get()) {
            LOGGER.warning("Screen capture is already running");
            return;
        }
        
        if (targetImageView == null) {
            throw new IllegalStateException("Target ImageView must be set before starting capture");
        }
        
        LOGGER.info("Starting screen capture");
        isCapturing.set(true);
        
        captureTimer = new AnimationTimer() {
            @Override
            public void handle(long now) {
                long currentTime = System.currentTimeMillis();
                
                // Contrôle du frame rate
                if (currentTime - lastCaptureTime < frameInterval) {
                    return;
                }
                
                try {
                    captureScreenToImageView();
                    lastCaptureTime = currentTime;
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Error capturing screen", e);
                    stop(); // Arrêter l'animation en cas d'erreur
                    isCapturing.set(false);
                }
            }
        };
        
        captureTimer.start();
    }
    
    public void stopCapture() {
        if (!isCapturing.get()) {
            LOGGER.warning("Screen capture is not running");
            return;
        }
        
        LOGGER.info("Stopping screen capture");
        if (captureTimer != null) {
            captureTimer.stop();
        }
        
        isCapturing.set(false);
    }
    
    private void captureScreenToImageView() {
        try {
            // Obtenir les dimensions de l'écran
            Rectangle screenRect = new Rectangle(Toolkit.getDefaultToolkit().getScreenSize());
            
            // Capturer l'écran
            java.awt.image.BufferedImage bufferedImage = new java.awt.Robot().createScreenCapture(screenRect);
            
            // Convertir en Image JavaFX
            WritableImage fxImage = SwingFXUtils.toFXImage(bufferedImage, null);
            
            // Mettre à jour l'ImageView sur le thread JavaFX
            Platform.runLater(() -> targetImageView.setImage(fxImage));
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error capturing screen", e);
            throw new RuntimeException("Failed to capture screen: " + e.getMessage(), e);
        }
    }
    
    // Méthode de prise d'une capture unique
    public Image captureScreenshot() {
        try {
            // Obtenir les dimensions de l'écran
            Rectangle screenRect = new Rectangle(Toolkit.getDefaultToolkit().getScreenSize());
            
            // Capturer l'écran
            java.awt.image.BufferedImage bufferedImage = new java.awt.Robot().createScreenCapture(screenRect);
            
            // Convertir en Image JavaFX
            return SwingFXUtils.toFXImage(bufferedImage, null);
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error capturing screenshot", e);
            throw new RuntimeException("Failed to capture screenshot: " + e.getMessage(), e);
        }
    }
} 