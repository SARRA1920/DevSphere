package com.user.demo.controller;

import com.user.demo.model.Exercice;
import com.user.demo.model.Tentative;
import com.user.demo.service.TentativeService;
import com.user.demo.service.ChatGPTService;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.Button;
import javafx.scene.control.Alert;
import javafx.stage.Stage;
import java.io.File;
import java.io.IOException;
import java.awt.Desktop;
import javafx.scene.layout.VBox;
import javafx.scene.layout.Priority;
import javafx.scene.control.Dialog;
import javafx.scene.control.ButtonType;
import java.time.LocalDateTime;

public class ExerciceStartController {
    
    @FXML private Label titleLabel;
    @FXML private Label typeLabel;
    @FXML private Label levelLabel;
    @FXML private TextArea descriptionArea;
    @FXML private TextArea reponseArea;
    @FXML private Button commencerButton;
    
    private Exercice exercice;
    private TentativeService tentativeService;
    private ChatGPTService chatGPTService;
    
    @FXML
    public void initialize() {
        tentativeService = new TentativeService();
        chatGPTService = new ChatGPTService();
    }
    
    public void setExercice(Exercice exercice) {
        this.exercice = exercice;
        updateUI();
    }
    
    private void updateUI() {
        if (exercice != null) {
            titleLabel.setText(exercice.getTitre());
            typeLabel.setText("Type : " + exercice.getType());
            levelLabel.setText("Niveau : " + exercice.getNiveauDifficulte());
            descriptionArea.setText(exercice.getDescription());
        }
    }
    
    @FXML
    private void handleCommencer() {
        if (reponseArea.getText().trim().isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Veuillez écrire votre réponse avant de soumettre.");
            return;
        }
        
        try {
            // Créer une nouvelle tentative
            Tentative tentative = new Tentative();
            tentative.setExercice_id(exercice.getId());
            tentative.setUser_id(1); // ID de l'utilisateur connecté
            tentative.setStatue("SOUMIS");
            tentative.setReponse(reponseArea.getText());
            tentative.setDate(LocalDateTime.now());
            
            // Initialiser les champs score et note à zéro
            tentative.setScore(0);
            tentative.setNote(0);
            
            // Ajouter la tentative à la base de données
            tentativeService.ajouter(tentative);
            
            // Évaluer la tentative
            tentative = tentativeService.evaluerTentative(tentative);
            
            // Préparer le contenu pour la boîte de dialogue de résultat
            String titre = "Résultat de l'évaluation";
            String entete = "Votre réponse a été évaluée :";
            
            VBox contentBox = new VBox(10);
            contentBox.setStyle("-fx-padding: 10;");
            
            // Créer un style pour l'en-tête
            Label headerLabel = new Label(entete);
            headerLabel.setStyle("-fx-font-size: 14px; -fx-font-weight: bold;");
            contentBox.getChildren().add(headerLabel);
            
            // Ajouter les détails du score
            Label scoreLabel = new Label(String.format("Score : %d/100", tentative.getScore()));
            Label noteLabel = new Label(String.format("Note : %.1f/20", tentative.getNote()));
            
            // Style pour le statut (vert pour réussi, rouge pour échec)
            String couleurStatut = tentative.getStatut().equals("RÉUSSI") ? "#28a745" : "#dc3545";
            Label statutLabel = new Label(String.format("Statut : %s", tentative.getStatut()));
            statutLabel.setStyle(String.format("-fx-text-fill: %s; -fx-font-weight: bold;", couleurStatut));
            
            contentBox.getChildren().addAll(scoreLabel, noteLabel, statutLabel);
            
            // Ajouter une explication
            String explication;
            if (tentative.getStatut().equals("RÉUSSI")) {
                explication = "Félicitations ! Vous avez réussi cet exercice.";
                if (tentative.getNote() >= 18) {
                    explication += " Votre réponse est excellente !";
                } else {
                    explication += String.format(" La note minimale requise était de %.1f/20.", exercice.getNoteMinimale());
                }
            } else {
                explication = String.format(
                    "Vous n'avez pas atteint la note minimale requise de %.1f/20 pour cet exercice. " +
                    "Vous pouvez revoir la théorie et réessayer.", 
                    exercice.getNoteMinimale());
            }
            
            Label explicLabel = new Label(explication);
            explicLabel.setWrapText(true);
            explicLabel.setStyle("-fx-padding: 10 0 0 0;");
            contentBox.getChildren().add(explicLabel);
            
            // Créer une boîte de dialogue personnalisée
            Dialog<ButtonType> dialog = new Dialog<>();
            dialog.setTitle(titre);
            dialog.setHeaderText(null);
            dialog.getDialogPane().setContent(contentBox);
            dialog.getDialogPane().getButtonTypes().add(ButtonType.OK);
            dialog.getDialogPane().setPrefWidth(400);
            
            // Afficher la boîte de dialogue
            dialog.showAndWait();
            
            // Fermer la fenêtre en utilisant la scène du TextArea
            Stage stage = (Stage) reponseArea.getScene().getWindow();
            stage.close();
            
        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible de soumettre la réponse : " + e.getMessage());
        }
    }
    
    @FXML
    private void handleViewPdf() {
        try {
            String pdfPath = exercice.getFichierPdf();
            if (pdfPath != null && !pdfPath.isEmpty()) {
                System.out.println("Fichier PDF à ouvrir: " + pdfPath);
                
                // Créer une liste des chemins possibles
                java.util.List<String> pathsToCheck = new java.util.ArrayList<>();
                
                // Vérifier d'abord si le chemin contient déjà un chemin complet
                if (pdfPath.contains("\\") || pdfPath.contains("/")) {
                    pathsToCheck.add(pdfPath); // C'est déjà un chemin absolu
                } else {
                    // Chemins à vérifier en priorité (emplacement correct des cours)
                    pathsToCheck.add("C:\\Users\\maram\\demo\\src\\main\\resources\\pdf\\cours\\" + pdfPath);
                    
                    // Autres emplacements potentiels
                    pathsToCheck.add("C:\\Users\\maram\\demo\\src\\main\\resources\\com\\user\\demo\\pdfs\\" + pdfPath);
                    pathsToCheck.add("C:\\Users\\maram\\demo\\uploads\\pdfs\\" + pdfPath);
                    pathsToCheck.add("C:\\Users\\maram\\Downloads\\" + pdfPath);
                    pathsToCheck.add(System.getProperty("user.dir") + "\\src\\main\\resources\\pdf\\cours\\" + pdfPath);
                    pathsToCheck.add(System.getProperty("user.dir") + "\\src\\main\\resources\\com\\user\\demo\\pdfs\\" + pdfPath);
                    
                    // Cas spécial pour INTERFACE.pdf
                    if (pdfPath.equals("INTERFACE.pdf")) {
                        pathsToCheck.add("C:\\Users\\maram\\OneDrive\\Bureau\\INTERFACE.pdf");
                    }
                }
                
                // Parcourir tous les chemins possibles
                File pdfFile = null;
                boolean pdfFound = false;
                
                for (String path : pathsToCheck) {
                    File file = new File(path);
                    System.out.println("Vérification du chemin: " + file.getAbsolutePath() + " - Existe: " + file.exists());
                    
                    if (file.exists()) {
                        pdfFile = file;
                        pdfFound = true;
                        System.out.println("PDF trouvé: " + file.getAbsolutePath());
                        break;
                    }
                }
                
                // Si le PDF n'a pas été trouvé, essayer de le chercher dans les ressources
                if (!pdfFound) {
                    // Essayer différentes ressources
                    String[] resourcePaths = {
                        "/pdf/cours/" + pdfPath,
                        "/com/user/demo/pdfs/" + pdfPath
                    };
                    
                    for (String resourcePath : resourcePaths) {
                        try {
                            java.net.URL url = getClass().getResource(resourcePath);
                            System.out.println("Recherche dans les ressources: " + resourcePath + " - URL: " + url);
                            
                            if (url != null) {
                                pdfFile = new File(url.toURI());
                                if (pdfFile.exists()) {
                                    pdfFound = true;
                                    System.out.println("PDF trouvé dans les ressources: " + pdfFile.getAbsolutePath());
                                    break;
                                }
                            }
                        } catch (Exception e) {
                            System.out.println("Erreur lors de la recherche dans le chemin ressource: " + resourcePath + " - " + e.getMessage());
                        }
                    }
                }
                
                // Si le PDF est toujours introuvable, créer un message d'erreur détaillé
                if (!pdfFound) {
                    StringBuilder message = new StringBuilder("Le fichier PDF \"" + pdfPath + "\" n'a pas été trouvé.");
                    message.append("\nEmplacements vérifiés :");
                    for (String path : pathsToCheck) {
                        message.append("\n- ").append(path);
                    }
                    
                    // Message final avec instructions
                    message.append("\n\nVeuillez placer le fichier dans l'un de ces emplacements.");
                    
                    showAlert(Alert.AlertType.ERROR, "Erreur", message.toString());
                    return;
                }
                
                // Ouvrir le PDF si trouvé
                Desktop.getDesktop().open(pdfFile);
                
            } else {
                showAlert(Alert.AlertType.WARNING, "Attention", 
                    "Aucun fichier PDF n'est associé à cet exercice.");
            }
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible d'ouvrir le fichier PDF : " + e.getMessage());
        }
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    @FXML
    private void handleHelp() {
        if (exercice == null) {
            showAlert(Alert.AlertType.WARNING, "Attention", 
                "Aucun exercice n'est actuellement chargé.");
            return;
        }

        try {
            String aiResponse = chatGPTService.getAIHelp(
                exercice.getTitre(),
                exercice.getDescription(),
                reponseArea.getText()
            );

            // Create a custom dialog for better formatting
            Dialog<Void> dialog = new Dialog<>();
            dialog.setTitle("Aide IA");
            dialog.setHeaderText("Assistant IA - Suggestions");

            // Create a TextArea for the response
            TextArea responseArea = new TextArea(aiResponse);
            responseArea.setWrapText(true);
            responseArea.setEditable(false);
            responseArea.setPrefRowCount(10);
            
            // Create a VBox to hold the TextArea
            VBox content = new VBox(responseArea);
            VBox.setVgrow(responseArea, Priority.ALWAYS);
            dialog.getDialogPane().setContent(content);
            
            // Add OK button
            dialog.getDialogPane().getButtonTypes().add(ButtonType.OK);
            
            // Set minimum width and height
            dialog.getDialogPane().setMinWidth(400);
            dialog.getDialogPane().setMinHeight(300);
            
            dialog.showAndWait();

        } catch (Exception e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible d'obtenir l'aide de l'IA : " + e.getMessage());
        }
    }
} 