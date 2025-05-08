package com.user.demo.service;

import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import javax.net.ssl.SSLContext;
import javax.net.ssl.TrustManager;
import javax.net.ssl.X509TrustManager;
import javax.net.ssl.SSLParameters;
import java.security.KeyManagementException;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.security.cert.X509Certificate;
import java.time.Duration;
import org.json.JSONObject;
import org.json.JSONException;
import org.json.JSONArray;
import java.util.Properties;
import java.io.InputStream;

/**
 * Service pour interagir avec l'API AI/ML
 * Note: Ce service utilise maintenant GeminiService en interne, mais garde l'interface identique
 * pour assurer la compatibilité avec le code existant.
 */
public class ChatGPTService {
    private final GeminiService geminiService;

    public ChatGPTService() {
        this.geminiService = new GeminiService();
    }
    
    /**
     * Retourne la clé API utilisée par ce service
     * @return la clé API
     */
    public String getApiKey() {
        return geminiService.getApiKey();
    }

    /**
     * Obtient une réponse d'aide de l'IA pour un exercice de programmation
     * @param title titre de l'exercice
     * @param description description de l'exercice
     * @param currentAnswer réponse actuelle de l'étudiant
     * @return réponse d'aide de l'IA
     */
    public String getAIHelp(String title, String description, String currentAnswer) {
        return geminiService.getAIHelp(title, description, currentAnswer);
    }
} 