package com.user.demo.controller;

import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import com.user.demo.model.Exercice;
import com.user.demo.service.ExerciceService;
import javafx.collections.ObservableList;
import java.io.File;

public class ModificationExerciceController {

    @FXML private TextField titreField;
    @FXML private ComboBox<String> niveauCombo;
    @FXML private TextField noteMinimaleField;
    @FXML private TextField tempsEstimeField;
    @FXML private TextField fichierPDFField;
    @FXML private ComboBox<String> typeCombo;
    @FXML private TextArea solutionArea;
    @FXML private TextArea criteresEvaluationArea;
    @FXML private TextArea descriptionArea;

    private Exercice exercice;
    private ObservableList<Exercice> exercicesList;
    private ExerciceService exerciceService;

    @FXML
    public void initialize() {
        exerciceService = new ExerciceService();
        
        // Initialisation des ComboBox
        niveauCombo.getItems().addAll("Débutant", "Intermédiaire", "Avancé");
        typeCombo.getItems().addAll("QCM", "Programmation", "Analyse", "Conception");
    }

    public void setExercice(Exercice exercice) {
        this.exercice = exercice;
        remplirChamps();
    }

    public void setExercicesList(ObservableList<Exercice> exercicesList) {
        this.exercicesList = exercicesList;
    }

    private void remplirChamps() {
        if (exercice != null) {
            titreField.setText(exercice.getTitre());
            niveauCombo.setValue(exercice.getNiveauDifficulte());
            noteMinimaleField.setText(String.valueOf(exercice.getNoteMinimale()));
            tempsEstimeField.setText(String.valueOf(exercice.getTempsEstime()));
            fichierPDFField.setText(exercice.getFichierPdf());
            typeCombo.setValue(exercice.getType());
            solutionArea.setText(exercice.getSolution());
            criteresEvaluationArea.setText(exercice.getCriteresEvaluation());
            descriptionArea.setText(exercice.getDescription());
        }
    }

    @FXML
    private void handleModifier() {
        if (validateFields()) {
            try {
                // Mise à jour des données de l'exercice
                exercice.setTitre(titreField.getText().trim());
                exercice.setNiveauDifficulte(niveauCombo.getValue());
                exercice.setNoteMinimale(Double.parseDouble(noteMinimaleField.getText().trim()));
                exercice.setTempsEstime(Integer.parseInt(tempsEstimeField.getText().trim()));
                exercice.setFichierPdf(fichierPDFField.getText().trim());
                exercice.setType(typeCombo.getValue());
                exercice.setTypeExercice(typeCombo.getValue());
                exercice.setSolution(solutionArea.getText().trim());
                exercice.setCriteresEvaluation(criteresEvaluationArea.getText().trim());
                exercice.setDescription(descriptionArea.getText().trim());

                // Mise à jour dans la base de données
                exerciceService.modifier(exercice);

                showAlert(Alert.AlertType.INFORMATION, "Succès", "Exercice modifié avec succès");
                closeWindow();

            } catch (NumberFormatException e) {
                showAlert(Alert.AlertType.ERROR, "Erreur", "Veuillez entrer des valeurs numériques valides");
            } catch (Exception e) {
                showAlert(Alert.AlertType.ERROR, "Erreur", "Une erreur est survenue lors de la modification : " + e.getMessage());
            }
        }
    }

    @FXML
    private void handleChooseFile() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner un fichier PDF");
        fileChooser.getExtensionFilters().add(
            new FileChooser.ExtensionFilter("PDF Files", "*.pdf")
        );
        
        File selectedFile = fileChooser.showOpenDialog(fichierPDFField.getScene().getWindow());
        if (selectedFile != null) {
            fichierPDFField.setText(selectedFile.getAbsolutePath());
        }
    }

    @FXML
    private void handleAnnuler() {
        closeWindow();
    }

    private boolean validateFields() {
        StringBuilder errorMessage = new StringBuilder();

        // Validation du titre
        if (titreField.getText().trim().isEmpty()) {
            errorMessage.append("- Le titre est obligatoire\n");
        } else if (titreField.getText().length() < 3) {
            errorMessage.append("- Le titre doit contenir au moins 3 caractères\n");
        }

        // Validation du niveau
        if (niveauCombo.getValue() == null) {
            errorMessage.append("- Veuillez sélectionner un niveau\n");
        }

        // Validation de la note minimale
        try {
            if (noteMinimaleField.getText().trim().isEmpty()) {
                errorMessage.append("- La note minimale est obligatoire\n");
            } else {
                double noteMinimale = Double.parseDouble(noteMinimaleField.getText().trim());
                if (noteMinimale < 0 || noteMinimale > 20) {
                    errorMessage.append("- La note minimale doit être comprise entre 0 et 20\n");
                }
            }
        } catch (NumberFormatException e) {
            errorMessage.append("- La note minimale doit être un nombre valide\n");
        }

        // Validation du temps estimé
        try {
            if (tempsEstimeField.getText().trim().isEmpty()) {
                errorMessage.append("- Le temps estimé est obligatoire\n");
            } else {
                int tempsEstime = Integer.parseInt(tempsEstimeField.getText().trim());
                if (tempsEstime <= 0) {
                    errorMessage.append("- Le temps estimé doit être supérieur à 0\n");
                }
            }
        } catch (NumberFormatException e) {
            errorMessage.append("- Le temps estimé doit être un nombre entier valide\n");
        }

        // Validation du fichier PDF
        if (fichierPDFField.getText().trim().isEmpty()) {
            errorMessage.append("- Veuillez sélectionner un fichier PDF\n");
        } else if (!fichierPDFField.getText().toLowerCase().endsWith(".pdf")) {
            errorMessage.append("- Le fichier sélectionné doit être un PDF\n");
        }

        // Validation du type
        if (typeCombo.getValue() == null) {
            errorMessage.append("- Veuillez sélectionner un type d'exercice\n");
        }

        // Validation de la solution
        if (solutionArea.getText().trim().isEmpty()) {
            errorMessage.append("- La solution est obligatoire\n");
        }

        // Validation des critères d'évaluation
        if (criteresEvaluationArea.getText().trim().isEmpty()) {
            errorMessage.append("- Les critères d'évaluation sont obligatoires\n");
        }

        // Validation de la description
        if (descriptionArea.getText().trim().isEmpty()) {
            errorMessage.append("- La description est obligatoire\n");
        } else if (descriptionArea.getText().length() < 10) {
            errorMessage.append("- La description doit contenir au moins 10 caractères\n");
        }

        // S'il y a des erreurs, on les affiche
        if (errorMessage.length() > 0) {
            showAlert(Alert.AlertType.ERROR, "Erreur de validation", errorMessage.toString());
            return false;
        }

        return true;
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void closeWindow() {
        ((Stage) titreField.getScene().getWindow()).close();
    }
} 