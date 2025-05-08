package com.user.demo.service;

import org.bytedeco.javacv.*;
import org.bytedeco.opencv.opencv_core.*;
import javafx.application.Platform;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.image.WritableImage;
import javafx.embed.swing.SwingFXUtils;

import java.awt.image.BufferedImage;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.logging.Logger;
import java.util.logging.Level;

public class WebcamService {
    private static final Logger LOGGER = Logger.getLogger(WebcamService.class.getName());
    
    private OpenCVFrameGrabber grabber;
    private final AtomicBoolean isRunning;
    private Thread captureThread;
    private ImageView imageView;
    
    public WebcamService() {
        this.isRunning = new AtomicBoolean(false);
    }
    
    public void initialize(ImageView imageView) {
        this.imageView = imageView;
        try {
            LOGGER.info("Initializing webcam...");
            grabber = new OpenCVFrameGrabber(0); // 0 is default camera
            grabber.start();
            LOGGER.info("Webcam initialized successfully");
        } catch (FrameGrabber.Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to initialize webcam", e);
            throw new RuntimeException("Failed to initialize webcam: " + e.getMessage());
        }
    }
    
    public void startCamera() {
        if (isRunning.get()) {
            LOGGER.warning("Camera is already running");
            return;
        }
        
        isRunning.set(true);
        captureThread = new Thread(this::captureLoop);
        captureThread.setDaemon(true);
        captureThread.start();
        LOGGER.info("Camera started");
    }
    
    private void captureLoop() {
        Java2DFrameConverter converter = new Java2DFrameConverter();
        
        while (isRunning.get()) {
            try {
                Frame frame = grabber.grab();
                if (frame == null) {
                    LOGGER.warning("Null frame captured");
                    continue;
                }
                
                BufferedImage bufferedImage = converter.convert(frame);
                if (bufferedImage != null) {
                    Image fxImage = SwingFXUtils.toFXImage(bufferedImage, null);
                    Platform.runLater(() -> imageView.setImage(fxImage));
                }
                
                Thread.sleep(33); // ~30 FPS
            } catch (Exception e) {
                LOGGER.log(Level.SEVERE, "Error in capture loop", e);
                break;
            }
        }
    }
    
    public void stopCamera() {
        isRunning.set(false);
        if (captureThread != null) {
            try {
                captureThread.join(1000);
            } catch (InterruptedException e) {
                LOGGER.log(Level.WARNING, "Interrupted while stopping camera", e);
                Thread.currentThread().interrupt();
            }
        }
        
        try {
            if (grabber != null) {
                grabber.stop();
                grabber.release();
            }
            LOGGER.info("Camera stopped");
        } catch (FrameGrabber.Exception e) {
            LOGGER.log(Level.SEVERE, "Error stopping camera", e);
        }
    }
    
    public boolean isRunning() {
        return isRunning.get();
    }
} 