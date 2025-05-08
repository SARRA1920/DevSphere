package controllers;

import javafx.application.Platform;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import com.jfoenix.controls.JFXButton;
import models.DetailEvaluation;
import models.Reponse;
import models.ResultatEvaluation;
import models.Tentative;
import services.ExerciceService;

import java.util.ArrayList;
import java.util.List;

public class ExerciceController {
    @FXML
    private VBox exerciceContainer;
    
    @FXML
    private ListView<String> questionListView;
    
    @FXML
    private TextField reponseTextField;
    
    @FXML
    private Button soumettreButton;
    
    @FXML
    private Label resultLabel;
    
    @FXML
    private JFXButton helpButton;

    private final ExerciceService exerciceService = new ExerciceService();
    private Long currentExerciceId;
    private Long currentUserId;
    private String exerciceDescription;

    @FXML
    public void initialize() {
        // Configuration initiale
        soumettreButton.setOnAction(event -> evaluerExercice());
        helpButton.setOnAction(event -> ouvrirAssistant());
        
        // Exemple de configuration
        currentExerciceId = 1L; // À remplacer par l'ID réel de l'exercice
        currentUserId = 1L; // À remplacer par l'ID réel de l'utilisateur
    }

    private void ouvrirAssistant() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/chatbot.fxml"));
            Parent root = loader.load();
            
            ChatbotController chatbotController = loader.getController();
            // Fournir le contexte de l'exercice au chatbot
            String context = String.format("Exercice: %s\nRéponse actuelle: %s", 
                exerciceDescription, 
                reponseTextField.getText());
            chatbotController.setExerciseContext(context);
            
            Stage stage = new Stage();
            stage.setTitle("Assistant IA");
            stage.setScene(new Scene(root, 400, 600));
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
            afficherErreur("Erreur lors de l'ouverture de l'assistant: " + e.getMessage());
        }
    }

    private void evaluerExercice() {
        // Collecter les réponses
        List<Reponse> reponses = new ArrayList<>();
        // Exemple : ajouter une réponse
        reponses.add(new Reponse(1L, reponseTextField.getText()));

        Tentative tentative = new Tentative(currentExerciceId, currentUserId, reponses);

        // Désactiver le bouton pendant l'évaluation
        soumettreButton.setDisable(true);

        // Créer une tâche asynchrone pour l'évaluation
        Task<ResultatEvaluation> task = new Task<>() {
            @Override
            protected ResultatEvaluation call() throws Exception {
                return exerciceService.evaluerTentative(tentative);
            }
        };

        task.setOnSucceeded(e -> {
            ResultatEvaluation resultat = task.getValue();
            afficherResultat(resultat);
            soumettreButton.setDisable(false);
        });

        task.setOnFailed(e -> {
            afficherErreur("Erreur lors de l'évaluation: " + task.getException().getMessage());
            soumettreButton.setDisable(false);
        });

        // Démarrer la tâche dans un nouveau thread
        new Thread(task).start();
    }

    private void afficherResultat(ResultatEvaluation resultat) {
        Platform.runLater(() -> {
            // Mettre à jour le label de résultat
            resultLabel.setText(String.format(
                "Score: %.2f/%.2f\nFeedback: %s",
                resultat.getScore(),
                resultat.getScoreMax(),
                resultat.getFeedback()
            ));

            // Afficher les détails pour chaque question
            for (DetailEvaluation detail : resultat.getDetails()) {
                afficherDetailQuestion(detail);
            }
        });
    }

    private void afficherDetailQuestion(DetailEvaluation detail) {
        Platform.runLater(() -> {
            String detailText = String.format(
                "Question %d: %s - %s",
                detail.getQuestionId(),
                detail.isEstCorrect() ? "Correct" : "Incorrect",
                detail.getCommentaire()
            );
            questionListView.getItems().add(detailText);
        });
    }

    private void afficherErreur(String message) {
        Platform.runLater(() -> {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Erreur");
            alert.setHeaderText(null);
            alert.setContentText(message);
            alert.showAndWait();
        });
    }

    // Méthodes utilitaires
    public void setExerciceId(Long exerciceId) {
        this.currentExerciceId = exerciceId;
    }

    public void setUserId(Long userId) {
        this.currentUserId = userId;
    }

    public void setExerciceDescription(String description) {
        this.exerciceDescription = description;
    }
} 