package com.user.demo.controller;

import com.user.demo.model.Exercice;
import com.user.demo.service.ExerciceService;
import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.scene.control.TextArea;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Alert;
import javafx.stage.Stage;

public class ExerciceFormController {
    @FXML private TextField titreField;
    @FXML private TextArea descriptionArea;
    @FXML private ComboBox<String> typeComboBox;
    @FXML private ComboBox<String> niveauComboBox;
    
    private Exercice exercice;
    private boolean okClicked = false;
    private ExerciceService exerciceService;
    
    @FXML
    public void initialize() {
        exerciceService = new ExerciceService();
        typeComboBox.getItems().addAll("Quiz", "Exercice pratique", "Projet");
        niveauComboBox.getItems().addAll("Débutant", "Intermédiaire", "Avancé");
    }
    
    public void setExercice(Exercice exercice) {
        this.exercice = exercice;
        
        titreField.setText(exercice.getTitre());
        descriptionArea.setText(exercice.getDescription());
        typeComboBox.setValue(exercice.getType());
        niveauComboBox.setValue(exercice.getNiveauDifficulte());
    }
    
    @FXML
    private void handleOk() {
        if (isInputValid()) {
            System.out.println("Mise à jour de l'exercice ID: " + exercice.getId());
            
            // Sauvegarde des valeurs originales
            String originalTitre = exercice.getTitre();
            String originalDescription = exercice.getDescription();
            String originalType = exercice.getType();
            String originalNiveau = exercice.getNiveauDifficulte();
            
            try {
                // Application des modifications
                exercice.setTitre(titreField.getText());
                exercice.setDescription(descriptionArea.getText());
                exercice.setType(typeComboBox.getValue());
                exercice.setNiveauDifficulte(niveauComboBox.getValue());
                
                // Enregistrer dans la base de données
                System.out.println("Enregistrement des modifications dans la base de données...");
                exerciceService.modifier(exercice);
                System.out.println("Modifications enregistrées avec succès.");
                
                okClicked = true;
                ((Stage) titreField.getScene().getWindow()).close();
            } catch (Exception e) {
                e.printStackTrace();
                
                // En cas d'erreur, restaurer les valeurs originales
                exercice.setTitre(originalTitre);
                exercice.setDescription(originalDescription);
                exercice.setType(originalType);
                exercice.setNiveauDifficulte(originalNiveau);
                
                // Afficher l'erreur
                Alert alert = new Alert(Alert.AlertType.ERROR);
                alert.setTitle("Erreur");
                alert.setHeaderText("Erreur lors de la modification");
                alert.setContentText("Impossible de modifier l'exercice : " + e.getMessage());
                alert.showAndWait();
            }
        }
    }
    
    @FXML
    private void handleCancel() {
        ((Stage) titreField.getScene().getWindow()).close();
    }
    
    private boolean isInputValid() {
        String errorMessage = "";
        
        if (titreField.getText() == null || titreField.getText().trim().isEmpty()) {
            errorMessage += "Le titre ne peut pas être vide\n";
        }
        if (descriptionArea.getText() == null || descriptionArea.getText().trim().isEmpty()) {
            errorMessage += "La description ne peut pas être vide\n";
        }
        if (typeComboBox.getValue() == null) {
            errorMessage += "Veuillez sélectionner un type\n";
        }
        if (niveauComboBox.getValue() == null) {
            errorMessage += "Veuillez sélectionner un niveau\n";
        }
        
        if (!errorMessage.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Champs invalides");
            alert.setHeaderText("Veuillez corriger les champs invalides");
            alert.setContentText(errorMessage);
            alert.showAndWait();
            return false;
        }
        
        return true;
    }
    
    public boolean isOkClicked() {
        return okClicked;
    }
    
    public Exercice getExercice() {
        return exercice;
    }
} 