package com.user.demo.service;

import netscape.javascript.JSObject;
import java.util.logging.Logger;
import java.util.logging.Level;

public class WebRTCService {
    private static final Logger LOGGER = Logger.getLogger(WebRTCService.class.getName());
    private JSObject window;
    private boolean isInitialized = false;

    public void initialize(JSObject window) {
        if (window == null) {
            LOGGER.severe("Window object is null");
            throw new IllegalArgumentException("Window object cannot be null");
        }

        this.window = window;
        try {
            LOGGER.info("Starting Jitsi Meet initialization...");
            
            // Verify window object has required functions
            verifyJavaScriptFunctions();
            
            // Add error handler to window object
            window.eval("window.onerror = function(message, source, lineno, colno, error) { " +
                       "console.error('JavaScript Error:', message, 'at', source, ':', lineno); " +
                       "if (window.javaController) { " +
                       "    window.javaController.onError('JavaScript Error: ' + message); " +
                       "} " +
                       "return false; " +
                       "};");
            
            LOGGER.info("Jitsi Meet initialization prepared");
        } catch (Exception e) {
            isInitialized = false;
            LOGGER.log(Level.SEVERE, "Failed to initialize Jitsi Meet", e);
            throw new RuntimeException("Jitsi Meet initialization failed: " + e.getMessage(), e);
        }
    }

    private void verifyJavaScriptFunctions() {
        try {
            // Verify each required function exists
            String[] requiredFunctions = {
                "toggleAudio", "toggleVideo", "startScreenSharing",
                "stopScreenSharing", "sendChatMessage", "stopStream"
            };
            
            for (String funcName : requiredFunctions) {
                Object result = window.eval("typeof " + funcName + " === 'function'");
                if (!(result instanceof Boolean) || !((Boolean) result)) {
                    throw new RuntimeException("Required JavaScript function '" + funcName + "' is not defined");
                }
            }
            
            LOGGER.info("All required JavaScript functions are present");
        } catch (Exception e) {
            LOGGER.severe("Failed to verify JavaScript functions: " + e.getMessage());
            throw new RuntimeException("Failed to verify JavaScript functions", e);
        }
    }

    public void setInitialized(boolean initialized) {
        this.isInitialized = initialized;
        LOGGER.info("Jitsi Meet initialization state set to: " + initialized);
    }

    public boolean isInitialized() {
        return isInitialized;
    }

    private void checkInitialization() {
        if (!isInitialized) {
            LOGGER.severe("Jitsi Meet service is not initialized");
            throw new IllegalStateException("Jitsi Meet service is not initialized");
        }
        if (window == null) {
            LOGGER.severe("Window object is null");
            throw new IllegalStateException("Window object is null");
        }
    }

    public void toggleAudio(boolean enabled) {
        checkInitialization();
        try {
            LOGGER.info("Toggling audio: " + enabled);
            window.eval("toggleAudio(" + enabled + ")");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to toggle audio", e);
            throw new RuntimeException("Failed to toggle audio: " + e.getMessage(), e);
        }
    }

    public void toggleVideo(boolean enabled) {
        checkInitialization();
        try {
            LOGGER.info("Toggling video: " + enabled);
            window.eval("toggleVideo(" + enabled + ")");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to toggle video", e);
            throw new RuntimeException("Failed to toggle video: " + e.getMessage(), e);
        }
    }

    public void startScreenSharing() {
        checkInitialization();
        try {
            LOGGER.info("Starting screen sharing");
            window.eval("startScreenSharing()");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to start screen sharing", e);
            throw new RuntimeException("Failed to start screen sharing: " + e.getMessage(), e);
        }
    }

    public void stopScreenSharing() {
        checkInitialization();
        try {
            LOGGER.info("Stopping screen sharing");
            window.eval("stopScreenSharing()");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to stop screen sharing", e);
            throw new RuntimeException("Failed to stop screen sharing: " + e.getMessage(), e);
        }
    }

    public void sendChatMessage(String message) {
        if (!isInitialized) {
            LOGGER.severe("Jitsi Meet service is not initialized - Cannot send chat message");
            throw new IllegalStateException("Jitsi Meet service is not initialized - Waiting for connection to be established");
        }
        
        if (window == null) {
            LOGGER.severe("Window object is null - Cannot send chat message");
            throw new IllegalStateException("Window object is null - WebView may not be properly initialized");
        }
        
        if (message == null || message.trim().isEmpty()) {
            throw new IllegalArgumentException("Message cannot be null or empty");
        }
        
        try {
            LOGGER.info("Sending chat message");
            // Escape single quotes and sanitize the message
            String sanitizedMessage = message.replace("'", "\\'")
                                          .replace("\n", "\\n")
                                          .replace("\r", "\\r");
            
            // Envoyer le message tel quel (la gestion du formatage est faite en JavaScript)
            window.eval("sendChatMessage('" + sanitizedMessage + "')");
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to send chat message", e);
            throw new RuntimeException("Failed to send chat message: " + e.getMessage(), e);
        }
    }

    public void stopStream() {
        if (!isInitialized) {
            LOGGER.warning("Attempting to stop stream when not initialized");
            return;
        }
        
        try {
            LOGGER.info("Stopping stream");
            window.eval("stopStream()");
            isInitialized = false;
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Failed to stop stream", e);
            throw new RuntimeException("Failed to stop stream: " + e.getMessage(), e);
        }
    }
} 