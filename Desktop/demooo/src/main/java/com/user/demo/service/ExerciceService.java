package com.user.demo.service;

import com.user.demo.model.Exercice;
import com.user.demo.util.DatabaseConnection;
import java.sql.*;
import java.util.List;
import java.util.ArrayList;
import java.util.Map;
import java.util.HashMap;
import services.DatabaseService;

public class ExerciceService {
    private final DatabaseService databaseService;

    public ExerciceService() {
        this.databaseService = new DatabaseService();
    }

    public Connection getConnection() throws SQLException {
        return DatabaseConnection.getConnection();
    }

    public void ajouter(Exercice exercice) {
        System.out.println("Début de l'ajout d'un exercice dans la base de données");
        String sql = "INSERT INTO exercice (user_id, titre, niveau_difficulte, note_minimale, temps_estime, fichier_pdf, type, type_exercice, solution, criteres_evaluation, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        try (Connection conn = getConnection()) {
            System.out.println("Connexion à la base de données établie");
            try (PreparedStatement pstmt = conn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
                System.out.println("Préparation de la requête SQL");
                
                pstmt.setInt(1, exercice.getUserId());
                pstmt.setString(2, exercice.getTitre());
                pstmt.setString(3, exercice.getNiveauDifficulte());
                pstmt.setDouble(4, exercice.getNoteMinimale());
                pstmt.setInt(5, exercice.getTempsEstime());
                pstmt.setString(6, exercice.getFichierPdf());
                pstmt.setString(7, exercice.getType());
                pstmt.setString(8, exercice.getTypeExercice());
                pstmt.setString(9, exercice.getSolution());
                pstmt.setString(10, exercice.getCriteresEvaluation());
                pstmt.setString(11, exercice.getDescription());
                
                System.out.println("Paramètres de la requête définis");
                System.out.println("Exécution de la requête...");
                
                int affectedRows = pstmt.executeUpdate();
                System.out.println("Nombre de lignes affectées : " + affectedRows);
                
                try (ResultSet generatedKeys = pstmt.getGeneratedKeys()) {
                    if (generatedKeys.next()) {
                        exercice.setId(generatedKeys.getInt(1));
                        System.out.println("ID généré : " + exercice.getId());
                    }
                }
            }
        } catch (SQLException e) {
            System.err.println("Erreur SQL lors de l'ajout de l'exercice : " + e.getMessage());
            System.err.println("État SQL : " + e.getSQLState());
            System.err.println("Code d'erreur : " + e.getErrorCode());
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de l'ajout de l'exercice", e);
        }
        System.out.println("Ajout de l'exercice terminé avec succès");
    }

    public void modifier(Exercice exercice) {
        String sql = "UPDATE exercice SET user_id=?, titre=?, niveau_difficulte=?, note_minimale=?, temps_estime=?, fichier_pdf=?, type=?, type_exercice=?, solution=?, criteres_evaluation=?, description=? WHERE id=?";
        
        try (Connection conn = getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setInt(1, exercice.getUserId());
            pstmt.setString(2, exercice.getTitre());
            pstmt.setString(3, exercice.getNiveauDifficulte());
            pstmt.setDouble(4, exercice.getNoteMinimale());
            pstmt.setInt(5, exercice.getTempsEstime());
            pstmt.setString(6, exercice.getFichierPdf());
            pstmt.setString(7, exercice.getType());
            pstmt.setString(8, exercice.getTypeExercice());
            pstmt.setString(9, exercice.getSolution());
            pstmt.setString(10, exercice.getCriteresEvaluation());
            pstmt.setString(11, exercice.getDescription());
            pstmt.setInt(12, exercice.getId());
            
            pstmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la modification de l'exercice", e);
        }
    }

    public void supprimer(Exercice exercice) {
        // Validate exercise ID
        if (exercice.getId() <= 0) {
            throw new IllegalArgumentException("ID d'exercice invalide : " + exercice.getId());
        }
        
        System.out.println("Suppression de l'exercice avec ID: " + exercice.getId());
        
        try (Connection conn = getConnection()) {
            // Begin transaction
            conn.setAutoCommit(false);
            
            try {
                // First delete related tentatives
                String deleteTentativesQuery = "DELETE FROM tentative WHERE exercice_id=?";
                System.out.println("Exécution de la requête: " + deleteTentativesQuery + " avec ID: " + exercice.getId());
                
                try (PreparedStatement deleteTentativesStmt = conn.prepareStatement(deleteTentativesQuery)) {
                    deleteTentativesStmt.setInt(1, exercice.getId());
                    int tentativesDeleted = deleteTentativesStmt.executeUpdate();
                    System.out.println("Nombre de tentatives supprimées: " + tentativesDeleted);
                }
                
                // Then delete the exercise
                String deleteExerciceQuery = "DELETE FROM exercice WHERE id=?";
                System.out.println("Exécution de la requête: " + deleteExerciceQuery + " avec ID: " + exercice.getId());
                
                try (PreparedStatement deleteExerciceStmt = conn.prepareStatement(deleteExerciceQuery)) {
                    deleteExerciceStmt.setInt(1, exercice.getId());
                    int exercicesDeleted = deleteExerciceStmt.executeUpdate();
                    System.out.println("Nombre d'exercices supprimés: " + exercicesDeleted);
                    
                    if (exercicesDeleted == 0) {
                        throw new SQLException("Aucun exercice trouvé avec l'ID: " + exercice.getId());
                    }
                }
                
                // Commit the transaction
                System.out.println("Validation de la transaction");
                conn.commit();
                System.out.println("Suppression réussie");
            } catch (SQLException e) {
                // Rollback the transaction in case of error
                System.err.println("Erreur lors de la suppression. Annulation de la transaction.");
                System.err.println("Message d'erreur: " + e.getMessage());
                conn.rollback();
                e.printStackTrace();
                throw new RuntimeException("Erreur lors de la suppression de l'exercice: " + e.getMessage(), e);
            } finally {
                // Restore auto-commit
                conn.setAutoCommit(true);
            }
        } catch (SQLException e) {
            System.err.println("Erreur de connexion à la base de données: " + e.getMessage());
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la suppression de l'exercice: " + e.getMessage(), e);
        }
    }

    public List<Exercice> rechercher() {
        List<Exercice> exercices = new ArrayList<>();
        String sql = "SELECT * FROM exercice";
        
        try (Connection conn = getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            
            while (rs.next()) {
                Exercice exercice = new Exercice(
                    rs.getInt("id"),
                    rs.getInt("user_id"),
                    rs.getString("titre"),
                    rs.getString("niveau_difficulte"),
                    rs.getDouble("note_minimale"),
                    rs.getInt("temps_estime"),
                    rs.getString("fichier_pdf"),
                    rs.getString("type"),
                    rs.getString("type_exercice"),
                    rs.getString("solution"),
                    rs.getString("criteres_evaluation"),
                    rs.getString("description")
                );
                exercices.add(exercice);
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la récupération des exercices", e);
        }
        
        return exercices;
    }

    public Exercice getById(int id) {
        String sql = "SELECT * FROM exercice WHERE id = ?";
        
        try (Connection conn = getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setInt(1, id);
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return new Exercice(
                        rs.getInt("id"),
                        rs.getInt("user_id"),
                        rs.getString("titre"),
                        rs.getString("niveau_difficulte"),
                        rs.getDouble("note_minimale"),
                        rs.getInt("temps_estime"),
                        rs.getString("fichier_pdf"),
                        rs.getString("type"),
                        rs.getString("type_exercice"),
                        rs.getString("solution"),
                        rs.getString("criteres_evaluation"),
                        rs.getString("description")
                    );
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la récupération de l'exercice", e);
        }
        return null;
    }

    public List<Exercice> afficher() {
        return rechercher();
    }

    public List<Map<String, Object>> getAllExercices() {
        List<Map<String, Object>> exercices = new ArrayList<>();
        String query = "SELECT * FROM exercice";
        
        try (Connection conn = databaseService.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query);
             ResultSet rs = pstmt.executeQuery()) {
            
            while (rs.next()) {
                Map<String, Object> exercice = new HashMap<>();
                exercice.put("id", rs.getLong("id"));
                exercice.put("user_id", rs.getObject("user_id"));
                exercice.put("titre", rs.getString("titre"));
                exercice.put("niveau_difficulte", rs.getString("niveau_difficulte"));
                exercice.put("note_minimale", rs.getDouble("note_minimale"));
                exercice.put("temps_estime", rs.getInt("temps_estime"));
                exercice.put("fichier_pdf", rs.getString("fichier_pdf"));
                exercice.put("type", rs.getString("type"));
                exercice.put("type_exercice", rs.getString("type_exercice"));
                exercice.put("solution", rs.getString("solution"));
                exercice.put("criteres_evaluation", rs.getString("criteres_evaluation"));
                exercice.put("description", rs.getString("description"));
                exercices.add(exercice);
            }
        } catch (SQLException e) {
            throw new RuntimeException("Erreur lors de la récupération des exercices", e);
        }
        
        return exercices;
    }

    public void saveExercices(List<Map<String, Object>> exercices) {
        String query = "INSERT INTO exercice (id, user_id, titre, niveau_difficulte, note_minimale, " +
                      "temps_estime, fichier_pdf, type, type_exercice, solution, criteres_evaluation, description) " +
                      "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) " +
                      "ON DUPLICATE KEY UPDATE " +
                      "user_id = VALUES(user_id), " +
                      "titre = VALUES(titre), " +
                      "niveau_difficulte = VALUES(niveau_difficulte), " +
                      "note_minimale = VALUES(note_minimale), " +
                      "temps_estime = VALUES(temps_estime), " +
                      "fichier_pdf = VALUES(fichier_pdf), " +
                      "type = VALUES(type), " +
                      "type_exercice = VALUES(type_exercice), " +
                      "solution = VALUES(solution), " +
                      "criteres_evaluation = VALUES(criteres_evaluation), " +
                      "description = VALUES(description)";
        
        try (Connection conn = databaseService.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            for (Map<String, Object> exercice : exercices) {
                pstmt.setObject(1, exercice.get("id"));
                pstmt.setObject(2, exercice.get("user_id"));
                pstmt.setString(3, (String) exercice.get("titre"));
                pstmt.setString(4, (String) exercice.get("niveau_difficulte"));
                pstmt.setDouble(5, (Double) exercice.get("note_minimale"));
                pstmt.setInt(6, (Integer) exercice.get("temps_estime"));
                pstmt.setString(7, (String) exercice.get("fichier_pdf"));
                pstmt.setString(8, (String) exercice.get("type"));
                pstmt.setString(9, (String) exercice.get("type_exercice"));
                pstmt.setString(10, (String) exercice.get("solution"));
                pstmt.setString(11, (String) exercice.get("criteres_evaluation"));
                pstmt.setString(12, (String) exercice.get("description"));
                pstmt.addBatch();
            }
            
            pstmt.executeBatch();
        } catch (SQLException e) {
            throw new RuntimeException("Erreur lors de la sauvegarde des exercices", e);
        }
    }
}

