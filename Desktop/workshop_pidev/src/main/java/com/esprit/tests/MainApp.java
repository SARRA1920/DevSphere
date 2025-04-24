package com.esprit.tests;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Tab;
import javafx.scene.control.TabPane;
import javafx.stage.Stage;
import java.util.logging.Level;
import java.util.logging.Logger;

public class MainApp extends Application {
    
    private static final Logger LOGGER = Logger.getLogger(MainApp.class.getName());

    @Override
    public void start(Stage primaryStage) {
        try {
            // Créer un TabPane pour contenir toutes les interfaces
            TabPane tabPane = new TabPane();
            
            // Charger les fichiers FXML en utilisant getClassLoader()
            FXMLLoader coursLoader = new FXMLLoader(getClass().getResource("/Cours.fxml"));
            Tab coursTab = new Tab("Cours", coursLoader.load());
            coursTab.setClosable(false);
            
            FXMLLoader categoriesLoader = new FXMLLoader(getClass().getResource("/CategorieCours.fxml"));
            Tab categoriesTab = new Tab("Catégories", categoriesLoader.load());
            categoriesTab.setClosable(false);
            
            FXMLLoader inscriptionsLoader = new FXMLLoader(getClass().getResource("/Inscription.fxml"));
            Tab inscriptionsTab = new Tab("Inscriptions", inscriptionsLoader.load());
            inscriptionsTab.setClosable(false);
            
            // Ajouter les onglets au TabPane
            tabPane.getTabs().addAll(coursTab, categoriesTab, inscriptionsTab);
            
            // Créer la scène
            Scene scene = new Scene(tabPane, 1000, 700);
            
            primaryStage.setTitle("Gestion des Cours - ESPRIT");
            primaryStage.setScene(scene);
            primaryStage.show();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du démarrage de l'application", e);
            showErrorAlert("Erreur d'initialisation", "Une erreur est survenue lors du démarrage de l'application:\n" + e.getMessage());
            e.printStackTrace(); // Add stack trace for debugging
        }
    }

    private void showErrorAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public static void main(String[] args) {
        launch(args);
    }
} 