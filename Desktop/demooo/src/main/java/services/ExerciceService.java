package services;

import models.DetailEvaluation;
import models.ResultatEvaluation;
import models.Tentative;
import com.fasterxml.jackson.databind.ObjectMapper;
import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.ArrayList;
import java.util.List;

public class ExerciceService {
    private static final String BASE_URL = "http://localhost:8080/api";
    private final ObjectMapper objectMapper = new ObjectMapper();
    private final HttpClient client = HttpClient.newHttpClient();

    public ResultatEvaluation evaluerTentative(Tentative tentative) throws IOException {
        try {
            String jsonTentative = objectMapper.writeValueAsString(tentative);
            
            HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(BASE_URL + "/exercices/evaluerTentative"))
                .header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(jsonTentative))
                .build();

            HttpResponse<String> response = client.send(request, 
                HttpResponse.BodyHandlers.ofString());

            if (response.statusCode() == 200) {
                return objectMapper.readValue(response.body(), ResultatEvaluation.class);
            } else {
                // En cas d'erreur, on peut retourner une évaluation locale basique
                return evaluationLocale(tentative);
            }
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
            throw new IOException("Requête interrompue", e);
        } catch (Exception e) {
            // En cas d'erreur de connexion, on fait une évaluation locale
            return evaluationLocale(tentative);
        }
    }

    // Méthode d'évaluation locale (fallback si l'API n'est pas disponible)
    private ResultatEvaluation evaluationLocale(Tentative tentative) {
        // Exemple simple d'évaluation locale
        List<DetailEvaluation> details = new ArrayList<>();
        double score = 0;
        double scoreMax = tentative.getReponses().size();

        for (var reponse : tentative.getReponses()) {
            // Ici, vous pouvez implémenter votre logique d'évaluation locale
            // Par exemple, comparer avec des réponses stockées localement
            boolean estCorrect = evaluerReponseLocalement(reponse);
            score += estCorrect ? 1 : 0;
            
            details.add(new DetailEvaluation(
                reponse.getQuestionId(),
                estCorrect,
                estCorrect ? "Bonne réponse" : "Réponse incorrecte"
            ));
        }

        String feedback = generateFeedback(score, scoreMax);
        return new ResultatEvaluation(score, scoreMax, feedback, details);
    }

    private boolean evaluerReponseLocalement(models.Reponse reponse) {
        // Implémentez votre logique d'évaluation locale ici
        // Par exemple, comparer avec des réponses stockées dans un fichier local
        return true; // À modifier selon vos besoins
    }

    private String generateFeedback(double score, double scoreMax) {
        double percentage = (score / scoreMax) * 100;
        if (percentage >= 80) {
            return "Excellent travail !";
        } else if (percentage >= 60) {
            return "Bon travail, mais il y a place à l'amélioration.";
        } else {
            return "Continuez à pratiquer pour améliorer vos résultats.";
        }
    }
} 