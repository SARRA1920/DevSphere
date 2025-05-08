package com.user.demo.service;

import java.io.File;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.sound.sampled.AudioFormat;
import javax.sound.sampled.AudioSystem;
import javax.sound.sampled.DataLine;
import javax.sound.sampled.LineUnavailableException;
import javax.sound.sampled.TargetDataLine;
import javax.sound.sampled.AudioInputStream;
import javax.sound.sampled.AudioFileFormat;

public class MicrophoneService {
    private static final Logger LOGGER = Logger.getLogger(MicrophoneService.class.getName());
    
    private TargetDataLine microphone;
    private final AtomicBoolean isRecording = new AtomicBoolean(false);
    private File audioFile;
    private Thread recordingThread;
    
    public MicrophoneService() {
        // Créer un fichier temporaire pour l'enregistrement audio
        try {
            audioFile = File.createTempFile("microphone-test", ".wav");
            audioFile.deleteOnExit(); // Le fichier sera supprimé à la fermeture de l'application
            LOGGER.info("Created temporary audio file: " + audioFile.getAbsolutePath());
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to create temporary audio file", e);
        }
    }
    
    public boolean isMicrophoneAvailable() {
        try {
            AudioFormat format = getAudioFormat();
            DataLine.Info info = new DataLine.Info(TargetDataLine.class, format);
            
            if (!AudioSystem.isLineSupported(info)) {
                LOGGER.warning("No microphone detected");
                return false;
            }
            
            // Test opening the microphone
            try (TargetDataLine line = AudioSystem.getTargetDataLine(format)) {
                line.open(format);
                LOGGER.info("Microphone is available");
                return true;
            }
        } catch (LineUnavailableException e) {
            LOGGER.log(Level.WARNING, "Microphone is unavailable: " + e.getMessage(), e);
            return false;
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error checking microphone availability", e);
            return false;
        }
    }
    
    public void initialize() {
        try {
            LOGGER.info("Initializing microphone service");
            
            AudioFormat format = getAudioFormat();
            DataLine.Info info = new DataLine.Info(TargetDataLine.class, format);
            
            if (!AudioSystem.isLineSupported(info)) {
                throw new RuntimeException("Microphone not supported");
            }
            
            microphone = AudioSystem.getTargetDataLine(format);
            microphone.open(format);
            
            LOGGER.info("Microphone initialized successfully");
        } catch (LineUnavailableException e) {
            LOGGER.log(Level.SEVERE, "Failed to initialize microphone", e);
            throw new RuntimeException("Failed to initialize microphone: " + e.getMessage(), e);
        }
    }
    
    private AudioFormat getAudioFormat() {
        float sampleRate = 44100.0F;  // 44.1 kHz
        int sampleSizeInBits = 16;    // 16 bits
        int channels = 1;             // Mono
        boolean signed = true;
        boolean bigEndian = false;
        
        return new AudioFormat(sampleRate, sampleSizeInBits, channels, signed, bigEndian);
    }
    
    public void startMicrophone() {
        if (isRecording.get()) {
            LOGGER.warning("Microphone is already recording");
            return;
        }
        
        try {
            if (microphone == null) {
                initialize();
            }
            
            microphone.start();
            isRecording.set(true);
            
            // Démarrer l'enregistrement dans un thread séparé
            recordingThread = new Thread(this::captureAudio);
            recordingThread.setDaemon(true);
            recordingThread.start();
            
            LOGGER.info("Microphone recording started");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to start microphone recording", e);
            throw new RuntimeException("Failed to start microphone: " + e.getMessage(), e);
        }
    }
    
    private void captureAudio() {
        try {
            AudioInputStream audioStream = new AudioInputStream(microphone);
            AudioSystem.write(audioStream, AudioFileFormat.Type.WAVE, audioFile);
        } catch (IOException e) {
            if (isRecording.get()) {  // N'afficher l'erreur que si on n'a pas délibérément arrêté
                LOGGER.log(Level.SEVERE, "Error capturing audio", e);
            }
        }
    }
    
    public void stopMicrophone() {
        if (!isRecording.get()) {
            LOGGER.warning("Microphone is not recording");
            return;
        }
        
        try {
            isRecording.set(false);
            
            if (microphone != null) {
                microphone.stop();
                microphone.close();
            }
            
            if (recordingThread != null) {
                recordingThread.interrupt();
                try {
                    recordingThread.join(1000);  // Attendre que le thread se termine
                } catch (InterruptedException e) {
                    Thread.currentThread().interrupt();
                }
            }
            
            LOGGER.info("Microphone recording stopped");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to stop microphone recording", e);
            throw new RuntimeException("Failed to stop microphone: " + e.getMessage(), e);
        }
    }
    
    public boolean isRecording() {
        return isRecording.get();
    }
    
    public void cleanup() {
        try {
            if (isRecording.get()) {
                stopMicrophone();
            }
            
            if (audioFile != null && audioFile.exists()) {
                audioFile.delete();
            }
            
            LOGGER.info("Microphone service cleaned up");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Error during microphone service cleanup", e);
        }
    }
} 