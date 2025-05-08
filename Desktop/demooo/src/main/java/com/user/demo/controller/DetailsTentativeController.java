package com.user.demo.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.web.WebView;
import javafx.stage.Stage;
import com.user.demo.model.Tentative;
import com.user.demo.model.Exercice;
import com.user.demo.service.ExerciceService;
import java.time.format.DateTimeFormatter;

public class DetailsTentativeController {

    @FXML private Label titreExerciceLabel;
    @FXML private Label etudiantLabel;
    @FXML private Label dateLabel;
    @FXML private Label scoreLabel;
    @FXML private Label noteLabel;
    @FXML private Label statutLabel;
    @FXML private WebView pdfViewer;
    @FXML private TextArea reponseArea;
    
    private ExerciceService exerciceService;
    private static final DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        exerciceService = new ExerciceService();
    }

    public void setTentative(Tentative tentative) {
        if (tentative != null) {
            Exercice exercice = exerciceService.getById(tentative.getExercice_id());
            if (exercice != null) {
                titreExerciceLabel.setText(exercice.getTitre());
                
                // Charger le PDF de l'exercice si disponible
                if (exercice.getFichierPdf() != null && !exercice.getFichierPdf().isEmpty()) {
                    pdfViewer.getEngine().load("file:///" + exercice.getFichierPdf());
                }
            }
            
            etudiantLabel.setText(String.valueOf(tentative.getUser_id()));
            dateLabel.setText(tentative.getDate() != null ? dateFormatter.format(tentative.getDate()) : "");
            scoreLabel.setText(String.valueOf(tentative.getScore()));
            noteLabel.setText(String.format("%.2f", tentative.getNote()));
            statutLabel.setText(tentative.getStatut());
            reponseArea.setText(tentative.getReponse());
        }
    }
    
    @FXML
    private void handleFermer() {
        ((Stage) titreExerciceLabel.getScene().getWindow()).close();
    }
} 