package com.user.demo.controller;

import com.user.demo.service.DatabaseService;
import com.user.demo.service.ExcelService;
import com.user.demo.service.ExerciceService;
import com.user.demo.model.Tentative;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.stage.FileChooser;
import java.io.File;
import java.util.List;

public class ExportImportController {
    
    @FXML
    private Button exportButton;
    
    @FXML
    private Label statusLabel;
    
    private final ExcelService excelService;
    private final ExerciceService exerciceService;
    
    public ExportImportController() {
        this.excelService = new ExcelService();
        this.exerciceService = new ExerciceService();
    }
    
    @FXML
    public void initialize() {
        exportButton.setOnAction(e -> handleExport());
    }
    
    private void handleExport() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Exporter les réponses des tentatives");
        fileChooser.getExtensionFilters().add(
            new FileChooser.ExtensionFilter("Fichiers Excel", "*.xlsx")
        );
        
        File file = fileChooser.showSaveDialog(null);
        if (file != null) {
            try {
                // Récupérer les tentatives avec leurs réponses
                List<Tentative> tentatives = DatabaseService.getTentativesWithReponses();
                
                // Exporter vers Excel avec la liste des exercices
                excelService.exportTentatives(tentatives, exerciceService.rechercher(), file.getAbsolutePath());
                
                statusLabel.setText("Export réussi !");
            } catch (Exception e) {
                statusLabel.setText("Erreur lors de l'export : " + e.getMessage());
                e.printStackTrace();
            }
        }
    }
} 