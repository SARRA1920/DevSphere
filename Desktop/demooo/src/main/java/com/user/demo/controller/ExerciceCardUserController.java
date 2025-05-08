package com.user.demo.controller;

import com.user.demo.model.Exercice;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;

/**
 * Contrôleur pour les cartes d'exercices dans l'interface utilisateur
 */
public class ExerciceCardUserController {
    
    @FXML private VBox exerciceCard;
    @FXML private Label titleLabel;
    @FXML private Label typeLabel;
    @FXML private Label difficultyLabel;
    @FXML private HBox buttonsContainer;
    @FXML private Button commencerBtn;
    
    private Exercice exercice;
    private ExerciceController parentController;
    
    @FXML
    public void initialize() {
        // Initialiser les écouteurs d'événements
        commencerBtn.setOnAction(event -> handleCommencer());
    }
    
    /**
     * Configure la carte avec les données de l'exercice
     */
    public void setExercice(Exercice exercice, ExerciceController parentController) {
        this.exercice = exercice;
        this.parentController = parentController;
        
        // Mettre à jour l'UI avec les données de l'exercice
        titleLabel.setText(exercice.getTitre());
        typeLabel.setText(exercice.getType());
        difficultyLabel.setText("Niveau: " + exercice.getNiveauDifficulte());
    }
    
    private void handleCommencer() {
        if (parentController != null) {
            parentController.handleCommencerExercice(exercice);
        }
    }
} 