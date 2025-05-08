package services;

import org.json.JSONObject;
import org.json.JSONArray;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.io.IOException;
import java.time.Duration;

public class ChatbotService {
    private final String apiKey;
    private final HttpClient httpClient;
    private static final String GEMINI_API_URL = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent";

    public ChatbotService() {
        String apiKey = System.getenv("AI_ML_API_KEY");
        if (apiKey == null || apiKey.isEmpty()) {
            // Essayer de charger depuis la configuration
            try {
                apiKey = new com.user.demo.service.ChatGPTService().getApiKey();
            } catch (Exception e) {
                throw new IllegalStateException("AI_ML_API_KEY environment variable not set and unable to load from config", e);
            }
        }
        if (apiKey == null || apiKey.isEmpty()) {
            throw new IllegalStateException("AI_ML_API_KEY environment variable not set");
        }
        
        this.apiKey = apiKey;
        this.httpClient = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(30))
            .build();
    }
    
    public String getResponse(String userMessage, String context) {
        try {
            // Créer le corps de la requête JSON pour Gemini
            JSONObject requestBody = new JSONObject();
            JSONArray contents = new JSONArray();
            
            // Ajout du message système
            JSONObject systemContent = new JSONObject();
            systemContent.put("role", "system");
            systemContent.put("parts", new JSONArray().put(
                new JSONObject().put("text", "You are a helpful programming tutor assistant. Use the following context about the current exercise: " + context)
            ));
            contents.put(systemContent);
            
            // Ajout du message utilisateur
            JSONObject userContent = new JSONObject();
            userContent.put("role", "user");
            userContent.put("parts", new JSONArray().put(
                new JSONObject().put("text", userMessage)
            ));
            contents.put(userContent);
            
            requestBody.put("contents", contents);
            requestBody.put("generationConfig", new JSONObject()
                .put("temperature", 0.7)
                .put("maxOutputTokens", 800)
                .put("topP", 0.8)
                .put("topK", 40));
            
            // Construire l'URL complète avec la clé API
            String fullUrl = GEMINI_API_URL + "?key=" + this.apiKey;
            
            // Créer et envoyer la requête HTTP
            HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(fullUrl))
                .header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(requestBody.toString()))
                .timeout(Duration.ofSeconds(30))
                .build();

            HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());
            
            if (response.statusCode() == 200) {
                // Analyser la réponse JSON
                JSONObject jsonResponse = new JSONObject(response.body());
                
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
                
                return "Impossible d'extraire la réponse: " + response.body();
            } else {
                return "Erreur API (" + response.statusCode() + "): " + response.body();
            }
            
        } catch (IOException | InterruptedException e) {
            return "Désolé, j'ai rencontré une erreur : " + e.getMessage();
        }
    }
} 