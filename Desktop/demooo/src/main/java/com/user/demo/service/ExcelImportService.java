package com.user.demo.service;

import com.user.demo.model.Exercice;
import org.apache.poi.ss.usermodel.*;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import java.io.File;
import java.io.FileInputStream;
import java.util.ArrayList;
import java.util.List;

public class ExcelImportService {
    private final ExerciceService exerciceService;

    public ExcelImportService() {
        this.exerciceService = new ExerciceService();
    }

    public List<Exercice> importerExercicesDepuisExcel(String cheminFichier) throws Exception {
        List<Exercice> exercicesImportes = new ArrayList<>();
        
        try (FileInputStream fis = new FileInputStream(new File(cheminFichier));
             Workbook workbook = new XSSFWorkbook(fis)) {
            
            Sheet sheet = workbook.getSheetAt(0);
            
            // Ignorer la première ligne (en-têtes)
            for (int i = 1; i <= sheet.getLastRowNum(); i++) {
                Row row = sheet.getRow(i);
                if (row != null) {
                    // Récupérer le titre et s'assurer qu'il n'est pas vide
                    String titre = getCellValueAsString(row.getCell(0));
                    if (titre.isEmpty()) {
                        continue; // Ignorer les lignes sans titre
                    }

                    // Vérifier si le titre est un nombre et le convertir en format approprié si nécessaire
                    if (titre.matches("\\d+")) {
                        titre = "Exercice " + titre;
                    }

                    Exercice exercice = new Exercice(
                        1, // userId par défaut
                        titre, // titre
                        getCellValueAsString(row.getCell(1)), // niveauDifficulte
                        getCellValueAsDouble(row.getCell(2)), // noteMinimale
                        getCellValueAsInt(row.getCell(3)), // tempsEstime
                        getCellValueAsString(row.getCell(4)), // fichierPdf
                        getCellValueAsString(row.getCell(5)), // type
                        getCellValueAsString(row.getCell(6)), // typeExercice
                        getCellValueAsString(row.getCell(7)), // solution
                        getCellValueAsString(row.getCell(8)), // criteresEvaluation
                        getCellValueAsString(row.getCell(9))  // description
                    );
                    
                    // Ajouter l'exercice à la base de données
                    exerciceService.ajouter(exercice);
                    exercicesImportes.add(exercice);
                }
            }
        }
        
        return exercicesImportes;
    }
    
    private String getCellValueAsString(Cell cell) {
        if (cell == null) return "";
        switch (cell.getCellType()) {
            case STRING:
                return cell.getStringCellValue().trim();
            case NUMERIC:
                if (DateUtil.isCellDateFormatted(cell)) {
                    return cell.getLocalDateTimeCellValue().toString();
                }
                // Pour éviter l'affichage scientifique des nombres
                return String.valueOf((int)cell.getNumericCellValue());
            case BOOLEAN:
                return String.valueOf(cell.getBooleanCellValue());
            case FORMULA:
                try {
                    return cell.getStringCellValue().trim();
                } catch (Exception e) {
                    try {
                        return String.valueOf((int)cell.getNumericCellValue());
                    } catch (Exception ex) {
                        return "";
                    }
                }
            default:
                return "";
        }
    }
    
    private double getCellValueAsDouble(Cell cell) {
        if (cell == null) return 0.0;
        switch (cell.getCellType()) {
            case NUMERIC:
                return cell.getNumericCellValue();
            case STRING:
                try {
                    return Double.parseDouble(cell.getStringCellValue());
                } catch (NumberFormatException e) {
                    return 0.0;
                }
            default:
                return 0.0;
        }
    }
    
    private int getCellValueAsInt(Cell cell) {
        return (int) getCellValueAsDouble(cell);
    }
} 