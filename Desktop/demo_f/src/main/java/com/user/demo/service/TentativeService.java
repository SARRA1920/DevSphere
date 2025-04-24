package com.user.demo.service;

import com.user.demo.model.Tentative;
import com.user.demo.model.Exercice;
import com.user.demo.util.DatabaseConnection;
import java.sql.*;
import java.time.LocalDateTime;
import java.util.List;
import java.util.ArrayList;

public class TentativeService {
    
    public void ajouter(Tentative tentative) {
        String query = "INSERT INTO tentative (user_id, exercice_id, score, reponse, date, statue, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, tentative.getUser_id());
            pstmt.setInt(2, tentative.getExercice_id());
            pstmt.setInt(3, tentative.getScore());
            pstmt.setString(4, tentative.getReponse());
            pstmt.setTimestamp(5, Timestamp.valueOf(LocalDateTime.now()));
            pstmt.setString(6, tentative.getStatue());
            pstmt.setDouble(7, tentative.getNote());
            
            pstmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de l'ajout de la tentative: " + e.getMessage());
        }
    }

    public void modifier(Tentative tentative) {
        String query = "UPDATE tentative SET user_id=?, exercice_id=?, score=?, reponse=?, statue=?, note=? WHERE id=?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, tentative.getUser_id());
            pstmt.setInt(2, tentative.getExercice_id());
            pstmt.setInt(3, tentative.getScore());
            pstmt.setString(4, tentative.getReponse());
            pstmt.setString(5, tentative.getStatue());
            pstmt.setDouble(6, tentative.getNote());
            pstmt.setInt(7, tentative.getId());
            
            pstmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la modification de la tentative: " + e.getMessage());
        }
    }

    public void supprimer(Tentative tentative) {
        String query = "DELETE FROM tentative WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, tentative.getId());
            pstmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la suppression de la tentative: " + e.getMessage());
        }
    }

    public List<Tentative> afficher() {
        List<Tentative> tentatives = new ArrayList<>();
        String query = """
            SELECT t.*, e.titre as exercice_titre 
            FROM tentative t 
            LEFT JOIN exercice e ON t.exercice_id = e.id 
            ORDER BY t.date DESC
            """;
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                Tentative tentative = new Tentative();
                tentative.setId(rs.getInt("id"));
                tentative.setUser_id(rs.getInt("user_id"));
                tentative.setExercice_id(rs.getInt("exercice_id"));
                tentative.setScore(rs.getInt("score"));
                tentative.setReponse(rs.getString("reponse"));
                tentative.setDate(rs.getTimestamp("date").toLocalDateTime());
                tentative.setStatue(rs.getString("statue"));
                tentative.setNote(rs.getDouble("note"));
                
                // Créer un objet Exercice avec le titre
                String exerciceTitre = rs.getString("exercice_titre");
                if (exerciceTitre != null) {
                    Exercice exercice = new Exercice();
                    exercice.setId(rs.getInt("exercice_id"));
                    exercice.setTitre(exerciceTitre);
                    tentative.setExercice(exercice);
                }
                
                tentatives.add(tentative);
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la récupération des tentatives: " + e.getMessage());
        }
        
        return tentatives;
    }
    
    public List<Tentative> getTentativesByExercice(int exerciceId) {
        List<Tentative> tentatives = new ArrayList<>();
        String query = """
            SELECT t.*, e.titre as exercice_titre 
            FROM tentative t 
            LEFT JOIN exercice e ON t.exercice_id = e.id 
            WHERE t.exercice_id = ? 
            ORDER BY t.date DESC
            """;
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, exerciceId);
            ResultSet rs = pstmt.executeQuery();
            
            while (rs.next()) {
                Tentative tentative = new Tentative();
                tentative.setId(rs.getInt("id"));
                tentative.setUser_id(rs.getInt("user_id"));
                tentative.setExercice_id(rs.getInt("exercice_id"));
                tentative.setScore(rs.getInt("score"));
                tentative.setReponse(rs.getString("reponse"));
                tentative.setDate(rs.getTimestamp("date").toLocalDateTime());
                tentative.setStatue(rs.getString("statue"));
                tentative.setNote(rs.getDouble("note"));
                
                // Créer un objet Exercice avec le titre
                String exerciceTitre = rs.getString("exercice_titre");
                if (exerciceTitre != null) {
                    Exercice exercice = new Exercice();
                    exercice.setId(rs.getInt("exercice_id"));
                    exercice.setTitre(exerciceTitre);
                    tentative.setExercice(exercice);
                }
                
                tentatives.add(tentative);
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la récupération des tentatives: " + e.getMessage());
        }
        
        return tentatives;
    }
}
 
