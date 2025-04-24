package com.user.demo.controller;

import com.user.demo.model.Exercice;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;

/**
 * Contrôleur pour les cartes d'exercices
 */
public class ExerciceCardController {
    
    @FXML private VBox exerciceCard;
    @FXML private Label titleLabel;
    @FXML private Label typeLabel;
    @FXML private Label difficultyLabel;
    @FXML private HBox buttonsContainer;
    @FXML private Button updateBtn;
    @FXML private Button supprimerBtn;
    @FXML private Button commencerBtn;
    
    private Exercice exercice;
    private ExerciceController parentController;
    
    @FXML
    public void initialize() {
        // Initialiser les écouteurs d'événements
        updateBtn.setOnAction(event -> handleUpdate());
        supprimerBtn.setOnAction(event -> handleSupprimer());
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
    
    /**
     * Définit le mode d'affichage (étudiant ou admin)
     */
    public void setStudentMode(boolean isStudentMode) {
        // Si mode étudiant, afficher le bouton commencer et cacher les boutons admin
        updateBtn.setVisible(!isStudentMode);
        updateBtn.setManaged(!isStudentMode);
        supprimerBtn.setVisible(!isStudentMode);
        supprimerBtn.setManaged(!isStudentMode);
        
        commencerBtn.setVisible(isStudentMode);
        commencerBtn.setManaged(isStudentMode);
    }
    
    private void handleUpdate() {
        if (parentController != null) {
            parentController.handleModifier(exercice);
        }
    }
    
    private void handleSupprimer() {
        if (parentController != null) {
            parentController.handleSupprimer(exercice);
        }
    }
    
    private void handleCommencer() {
        if (parentController != null) {
            parentController.handleCommencerExercice(exercice);
        }
    }
} 