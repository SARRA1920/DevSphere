package com.user.demo.controller;

import com.user.demo.model.Exercice;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.stage.FileChooser;
import java.io.File;
import javafx.collections.FXCollections;
import javafx.stage.Stage;
import javafx.event.ActionEvent;

public class ExerciceDialogController {

    @FXML private TextField titreField;
    @FXML private ComboBox<String> niveauCombo;
    @FXML private TextField noteMinimaleField;
    @FXML private TextField tempsEstimeField;
    @FXML private ComboBox<String> typeCombo;
    @FXML private ComboBox<String> typeExerciceCombo;
    @FXML private TextField fichierPdfField;
    @FXML private TextArea solutionArea;
    @FXML private TextArea criteresArea;
    @FXML private TextArea descriptionArea;

    private DialogPane dialogPane;
    private Exercice exercice;
    private boolean okClicked = false;

    @FXML
    public void initialize() {
        // Configuration des ComboBox
        niveauCombo.setItems(FXCollections.observableArrayList(
            "Débutant", "Intermédiaire", "Avancé"
        ));

        typeCombo.setItems(FXCollections.observableArrayList(
            "QCM", "Exercice pratique", "Projet", "Quiz"
        ));

        typeExerciceCombo.setItems(FXCollections.observableArrayList(
            "Programmation", "Analyse", "Conception", "Base de données", "Algorithme"
        ));

        // Validation des champs numériques
        noteMinimaleField.textProperty().addListener((obs, oldValue, newValue) -> {
            if (!newValue.matches("\\d*(\\.\\d*)?")) {
                noteMinimaleField.setText(oldValue);
            }
        });

        tempsEstimeField.textProperty().addListener((obs, oldValue, newValue) -> {
            if (!newValue.matches("\\d*")) {
                tempsEstimeField.setText(oldValue);
            }
        });
    }

    public void setDialogPane(DialogPane dialogPane) {
        this.dialogPane = dialogPane;
        
        // Configuration des boutons du DialogPane
        dialogPane.getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);
        
        // Gestionnaire d'événements pour le bouton OK
        Button okButton = (Button) dialogPane.lookupButton(ButtonType.OK);
        okButton.setText("Ajouter");
        okButton.getStyleClass().add("btn-primary");
        okButton.addEventFilter(ActionEvent.ACTION, event -> {
            if (!validateAndSave()) {
                event.consume();
            }
        });
        
        // Style pour le bouton Annuler
        Button cancelButton = (Button) dialogPane.lookupButton(ButtonType.CANCEL);
        cancelButton.setText("Annuler");
        cancelButton.getStyleClass().add("btn-secondary");
    }

    private boolean validateAndSave() {
        System.out.println("Validation et sauvegarde...");
        if (validateFields()) {
            if (exercice == null) {
                exercice = new Exercice();
                System.out.println("Création d'un nouvel exercice");
            }

            try {
                exercice.setTitre(titreField.getText());
                exercice.setNiveauDifficulte(niveauCombo.getValue());
                exercice.setNoteMinimale(Double.parseDouble(noteMinimaleField.getText()));
                exercice.setTempsEstime(Integer.parseInt(tempsEstimeField.getText()));
                exercice.setType(typeCombo.getValue());
                exercice.setTypeExercice(typeExerciceCombo.getValue());
                exercice.setFichierPdf(fichierPdfField.getText());
                exercice.setSolution(solutionArea.getText());
                exercice.setCriteresEvaluation(criteresArea.getText());
                exercice.setDescription(descriptionArea.getText());

                System.out.println("Données de l'exercice mises à jour avec succès");
                okClicked = true;
                return true;
            } catch (Exception e) {
                System.err.println("Erreur lors de la mise à jour des données: " + e.getMessage());
                e.printStackTrace();
                showError("Erreur lors de la création de l'exercice", e.getMessage());
                return false;
            }
        }
        return false;
    }

    public boolean isOkClicked() {
        return okClicked;
    }

    public Exercice getExercice() {
        return exercice;
    }

    public void setExercice(Exercice exercice) {
        this.exercice = exercice;
        
        if (exercice != null) {
            titreField.setText(exercice.getTitre());
            niveauCombo.setValue(exercice.getNiveauDifficulte());
            noteMinimaleField.setText(String.valueOf(exercice.getNoteMinimale()));
            tempsEstimeField.setText(String.valueOf(exercice.getTempsEstime()));
            typeCombo.setValue(exercice.getType());
            typeExerciceCombo.setValue(exercice.getTypeExercice());
            fichierPdfField.setText(exercice.getFichierPdf());
            solutionArea.setText(exercice.getSolution());
            criteresArea.setText(exercice.getCriteresEvaluation());
            descriptionArea.setText(exercice.getDescription());
            
            // Changer le texte du bouton OK en "Modifier"
            Button okButton = (Button) dialogPane.lookupButton(ButtonType.OK);
            okButton.setText("Modifier");
        }
    }

    @FXML
    private void handleChooseFile() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner un fichier PDF");
        fileChooser.getExtensionFilters().add(
            new FileChooser.ExtensionFilter("PDF Files", "*.pdf")
        );

        File selectedFile = fileChooser.showOpenDialog(dialogPane.getScene().getWindow());
        if (selectedFile != null) {
            fichierPdfField.setText(selectedFile.getAbsolutePath());
        }
    }

    private boolean validateFields() {
        System.out.println("Début de la validation des champs");
        StringBuilder errorMessage = new StringBuilder();

        if (titreField.getText().trim().isEmpty()) {
            errorMessage.append("Le titre est obligatoire.\n");
        }

        if (niveauCombo.getValue() == null) {
            errorMessage.append("Le niveau de difficulté est obligatoire.\n");
        }

        try {
            double noteMinimale = Double.parseDouble(noteMinimaleField.getText());
            if (noteMinimale < 0 || noteMinimale > 20) {
                errorMessage.append("La note minimale doit être comprise entre 0 et 20.\n");
            }
        } catch (NumberFormatException e) {
            errorMessage.append("La note minimale doit être un nombre valide.\n");
        }

        try {
            int tempsEstime = Integer.parseInt(tempsEstimeField.getText());
            if (tempsEstime <= 0) {
                errorMessage.append("Le temps estimé doit être supérieur à 0.\n");
            }
        } catch (NumberFormatException e) {
            errorMessage.append("Le temps estimé doit être un nombre entier valide.\n");
        }

        if (typeCombo.getValue() == null) {
            errorMessage.append("Le type est obligatoire.\n");
        }

        if (typeExerciceCombo.getValue() == null) {
            errorMessage.append("Le type d'exercice est obligatoire.\n");
        }

        if (solutionArea.getText().trim().isEmpty()) {
            errorMessage.append("La solution est obligatoire.\n");
        }

        if (descriptionArea.getText().trim().isEmpty()) {
            errorMessage.append("La description est obligatoire.\n");
        }

        if (errorMessage.length() > 0) {
            showError("Erreur de validation", errorMessage.toString());
            return false;
        }

        System.out.println("Validation des champs réussie");
        return true;
    }

    private void showError(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
} 