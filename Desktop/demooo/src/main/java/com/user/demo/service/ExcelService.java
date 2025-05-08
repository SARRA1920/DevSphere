package com.user.demo.service;

import com.user.demo.model.Exercice;
import com.user.demo.model.Tentative;
import org.apache.poi.ss.usermodel.*;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

import java.io.FileOutputStream;
import java.io.IOException;
import java.util.List;
import java.time.format.DateTimeFormatter;

public class ExcelService {
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    
    public void exportExercices(List<Exercice> exercices, String filePath) throws IOException {
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Exercices");
            
            // Create header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Titre");
            headerRow.createCell(1).setCellValue("Type");
            headerRow.createCell(2).setCellValue("Niveau");
            headerRow.createCell(3).setCellValue("Note Minimale");
            headerRow.createCell(4).setCellValue("Temps Estimé");
            headerRow.createCell(5).setCellValue("Description");
            
            // Create data rows
            int rowNum = 1;
            for (Exercice exercice : exercices) {
                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(exercice.getTitre());
                row.createCell(1).setCellValue(exercice.getType());
                row.createCell(2).setCellValue(exercice.getNiveauDifficulte());
                row.createCell(3).setCellValue(exercice.getNoteMinimale());
                row.createCell(4).setCellValue(exercice.getTempsEstime());
                row.createCell(5).setCellValue(exercice.getDescription());
            }
            
            // Auto-size columns
            for (int i = 0; i < 6; i++) {
                sheet.autoSizeColumn(i);
            }
            
            // Write to file
            try (FileOutputStream fileOut = new FileOutputStream(filePath)) {
                workbook.write(fileOut);
            }
        }
    }
    
    public void exportTentatives(List<Tentative> tentatives, List<Exercice> exercices, String filePath) throws IOException {
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Tentatives");
            
            // Create header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Date");
            headerRow.createCell(1).setCellValue("Exercice");
            headerRow.createCell(2).setCellValue("Étudiant ID");
            headerRow.createCell(3).setCellValue("Note");
            headerRow.createCell(4).setCellValue("Statut");
            headerRow.createCell(5).setCellValue("Réponse");
            
            // Create data rows
            int rowNum = 1;
            for (Tentative tentative : tentatives) {
                Row row = sheet.createRow(rowNum++);
                
                // Date formatée
                row.createCell(0).setCellValue(
                    tentative.getDate() != null ? 
                    tentative.getDate().format(DATE_FORMATTER) : ""
                );
                
                // Trouver l'exercice correspondant
                String titreDeLexercice = exercices.stream()
                    .filter(e -> e.getId() == tentative.getExercice_id())
                    .map(Exercice::getTitre)
                    .findFirst()
                    .orElse("Exercice inconnu");
                
                row.createCell(1).setCellValue(titreDeLexercice);
                row.createCell(2).setCellValue(tentative.getUser_id());
                row.createCell(3).setCellValue(tentative.getNote());
                row.createCell(4).setCellValue(tentative.getStatut());
                row.createCell(5).setCellValue(tentative.getReponse());
            }
            
            // Auto-size columns
            for (int i = 0; i < 6; i++) {
                sheet.autoSizeColumn(i);
            }
            
            // Write to file
            try (FileOutputStream fileOut = new FileOutputStream(filePath)) {
                workbook.write(fileOut);
            }
        }
    }
} 