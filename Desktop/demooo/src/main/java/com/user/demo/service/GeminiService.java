package com.user.demo.service;

import org.json.JSONObject;
import org.json.JSONArray;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.io.IOException;
import java.time.Duration;
import java.util.Properties;
import java.io.InputStream;

/**
 * Service pour interagir avec l'API Gemini
 */
public class GeminiService {
    private final String apiUrl;
    private final String apiKey;
    private final HttpClient client;

    public GeminiService() {
        Properties config = loadConfiguration();
        this.apiKey = config.getProperty("ai.ml.api.key");
        this.apiUrl = config.getProperty("ai.ml.api.url");
        
        if (this.apiKey == null || this.apiKey.isEmpty()) {
            throw new IllegalStateException("La clé API AI/ML n'est pas configurée");
        }
        if (this.apiUrl == null || this.apiUrl.isEmpty()) {
            throw new IllegalStateException("L'URL de l'API AI/ML n'est pas configurée");
        }
        
        this.client = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(30))
            .build();
    }

    private Properties loadConfiguration() {
        Properties prop = new Properties();
        
        // Try loading from environment variables first
        String envApiKey = System.getenv("AI_ML_API_KEY");
        String envApiUrl = System.getenv("AI_ML_API_URL");
        
        if (envApiKey != null && !envApiKey.isEmpty()) {
            prop.setProperty("ai.ml.api.key", envApiKey);
        }
        if (envApiUrl != null && !envApiUrl.isEmpty()) {
            prop.setProperty("ai.ml.api.url", envApiUrl);
        }
        
        // If not found in environment, try loading from config file
        try (InputStream input = getClass().getClassLoader().getResourceAsStream("config.properties")) {
            if (input == null) {
                throw new IOException("Le fichier config.properties n'a pas été trouvé");
            }
            prop.load(input);
            
            // Validate configuration
            String apiKey = prop.getProperty("ai.ml.api.key");
            String apiUrl = prop.getProperty("ai.ml.api.url");
            
            if (apiKey == null || apiKey.isEmpty()) {
                throw new IOException("La clé API n'est pas configurée dans config.properties");
            }
            if (apiUrl == null || apiUrl.isEmpty()) {
                throw new IOException("L'URL de l'API n'est pas configurée dans config.properties");
            }
            
            return prop;
        } catch (IOException e) {
            throw new IllegalStateException("Erreur lors du chargement de la configuration: " + e.getMessage());
        }
    }
    
    /**
     * Retourne la clé API utilisée par ce service
     * @return la clé API
     */
    public String getApiKey() {
        return this.apiKey;
    }

    /**
     * Obtient une réponse d'aide de l'IA pour un exercice de programmation
     * @param title titre de l'exercice
     * @param description description de l'exercice
     * @param currentAnswer réponse actuelle de l'étudiant
     * @return réponse d'aide de l'IA
     */
    public String getAIHelp(String title, String description, String currentAnswer) {
        try {
            JSONObject requestBody = new JSONObject();
            
            // Format pour Gemini API
            String prompt = String.format("""
                Role: Programming Tutor Assistant
                Task: Help the student with their programming exercise
                
                Exercise Title: %s
                Exercise Description: %s
                
                Student's Current Answer:
                %s
                
                Please provide:
                1. Constructive feedback on the current answer
                2. Helpful hints to improve the solution
                3. Relevant programming concepts to consider
                
                Note: Do not provide complete solutions.
                """, title, description, currentAnswer);
            
            // Création de la requête JSON pour Gemini
            JSONArray contents = new JSONArray();
            JSONObject content = new JSONObject();
            content.put("role", "user");
            content.put("parts", new JSONArray().put(new JSONObject().put("text", prompt)));
            contents.put(content);
            
            requestBody.put("contents", contents);
            requestBody.put("generationConfig", new JSONObject()
                .put("temperature", 0.7)
                .put("maxOutputTokens", 800)
                .put("topP", 0.8)
                .put("topK", 40));
            
            // Log request for debugging
            System.out.println("Sending request to API: " + apiUrl);
            System.out.println("Request body: " + requestBody.toString());
            
            // Ajouter la clé API dans l'URL
            String fullUrl = apiUrl + "?key=" + apiKey;
            
            // Créer et envoyer la requête HTTP
            HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(fullUrl))
                .header("Content-Type", "application/json")
                .header("User-Agent", "Java-HttpClient")
                .header("Accept", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(requestBody.toString()))
                .timeout(Duration.ofSeconds(30))
                .build();

            HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
            
            // Log response for debugging
            System.out.println("Response status code: " + response.statusCode());
            System.out.println("Response body: " + response.body());
            
            // Gérer la réponse
            String responseBody = response.body();
            
            if (response.statusCode() == 200) {
                try {
                    JSONObject jsonResponse = new JSONObject(responseBody);
                    
                    // Extraction du texte de la réponse Gemini
                    if (jsonResponse.has("candidates") && jsonResponse.getJSONArray("candidates").length() > 0) {
                        JSONObject candidate = jsonResponse.getJSONArray("candidates").getJSONObject(0);
                        if (candidate.has("content") && candidate.getJSONObject("content").has("parts") && 
                            candidate.getJSONObject("content").getJSONArray("parts").length() > 0) {
                            JSONObject part = candidate.getJSONObject("content").getJSONArray("parts").getJSONObject(0);
                            if (part.has("text")) {
                                return part.getString("text");
                            }
                        }
                    }
                    
                    // Si le format de réponse attendu n'est pas trouvé
                    return "Réponse de l'API: " + responseBody;
                    
                } catch (Exception e) {
                    System.err.println("Erreur lors du parsing JSON: " + e.getMessage());
                    return "Erreur lors du traitement de la réponse: " + e.getMessage();
                }
            } else {
                System.err.println("Erreur API " + response.statusCode() + ": " + responseBody);
                return "Erreur API (" + response.statusCode() + "): " + responseBody;
            }
            
        } catch (Exception e) {
            e.printStackTrace();
            String errorMessage = "Une erreur est survenue lors de la communication avec l'API: " + e.getMessage();
            System.err.println(errorMessage);
            return errorMessage;
        }
    }
} 