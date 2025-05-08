package com.user.demo.controller;

import com.user.demo.model.Exercice;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;

public class ExerciceDetailsController {
    @FXML private Label titleLabel;
    @FXML private Label typeLabel;
    @FXML private Label levelLabel;
    @FXML private TextArea descriptionArea;
    
    private Exercice exercice;
    
    public void setExercice(Exercice exercice) {
        this.exercice = exercice;
        updateUI();
    }
    
    private void updateUI() {
        if (exercice != null) {
            titleLabel.setText(exercice.getTitre());
            typeLabel.setText("Type: " + exercice.getType());
            levelLabel.setText("Niveau: " + exercice.getNiveauDifficulte());
            descriptionArea.setText(exercice.getDescription());
        }
    }
} 