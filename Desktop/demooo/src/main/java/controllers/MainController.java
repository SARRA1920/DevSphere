package controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import com.jfoenix.controls.JFXButton;
import javafx.scene.control.Alert;

public class MainController {
    @FXML
    private JFXButton startExerciseButton;
    
    @FXML
    private JFXButton importButton;
    
    @FXML
    private JFXButton exportButton;

    @FXML
    public void initialize() {
        importButton.setOnAction(event -> handleImport());
        exportButton.setOnAction(event -> handleExport());
    }

    @FXML
    private void startExercise() {
        try {
            // Charger l'interface de l'exercice
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/exercice.fxml"));
            Parent root = loader.load();
            
            // Configurer le contrôleur
            ExerciceController controller = loader.getController();
            controller.setExerciceDescription("Créez une page HTML avec un bouton. Lorsqu'on clique dessus, un script JavaScript génère un nombre aléatoire entre 1 et 100 et l'affiche à l'écran.");
            
            // Créer et afficher la fenêtre
            Stage stage = new Stage();
            stage.setTitle("Exercice JavaScript");
            stage.setScene(new Scene(root));
            stage.show();
            
        } catch (Exception e) {
            e.printStackTrace();
            showError("Erreur lors du chargement de l'exercice", e.getMessage());
        }
    }
    
    private void handleImport() {
        // À implémenter : logique d'importation
    }
    
    private void handleExport() {
        // À implémenter : logique d'exportation
    }
    
    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
} 