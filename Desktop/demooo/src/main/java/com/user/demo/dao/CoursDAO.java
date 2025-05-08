package com.user.demo.dao;

import com.user.demo.model.Cours;
import com.user.demo.model.CategorieCours;
import com.user.demo.util.DatabaseConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Data Access Object for Cours entities
 */
public class CoursDAO {
    private static final Logger LOGGER = Logger.getLogger(CoursDAO.class.getName());

    /**
     * Constructeur par défaut
     */
    public CoursDAO() {
        // S'assurer que la colonne is_live existe
        DatabaseConnection.updateCoursTableAddLiveColumn();
    }

    /**
     * Récupérer tous les cours
     */
    public List<Cours> getAllCours() {
        List<Cours> coursList = new ArrayList<>();
        
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            while (rs.next()) {
                Cours cours = mapResultSetToCours(rs);
                coursList.add(cours);
            }

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération des cours", e);
        }
        
        return coursList;
    }
    
    /**
     * Récupérer un cours par son ID
     */
    public Cours getCoursById(int id) {
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "WHERE c.id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, id);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return mapResultSetToCours(rs);
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération du cours avec l'ID: " + id, e);
        }
        
        return null;
    }
    
    /**
     * Activer/désactiver le statut live d'un cours
     */
    public boolean updateCoursLiveStatus(int coursId, boolean isLive) {
        String query = "UPDATE cours SET is_live = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setBoolean(1, isLive);
            pstmt.setInt(2, coursId);
            
            int rowsAffected = pstmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la mise à jour du statut live pour le cours ID: " + coursId, e);
            return false;
        }
    }
    
    /**
     * Récupérer tous les cours actuellement en live
     */
    public List<Cours> getLiveCours() {
        List<Cours> liveCoursList = new ArrayList<>();
        
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "WHERE c.is_live = TRUE " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            while (rs.next()) {
                Cours cours = mapResultSetToCours(rs);
                liveCoursList.add(cours);
            }

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération des cours en live", e);
        }
        
        return liveCoursList;
    }
    
    /**
     * Vérifier si un utilisateur est inscrit à un cours spécifique
     */
    public boolean isUserEnrolledInCourse(int userId, int coursId) {
        String query = "SELECT COUNT(*) FROM inscription WHERE utilisateur_id = ? AND cours_id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, userId);
            pstmt.setInt(2, coursId);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1) > 0;
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'inscription de l'utilisateur", e);
        }
        
        return false;
    }
    
    /**
     * Récupérer les cours en live auxquels un utilisateur est inscrit
     */
    public List<Cours> getLiveCoursForUser(int userId) {
        List<Cours> userLiveCoursList = new ArrayList<>();
        
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "INNER JOIN inscription i ON c.id = i.cours_id " +
                      "WHERE c.is_live = TRUE AND i.utilisateur_id = ? " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, userId);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                while (rs.next()) {
                    Cours cours = mapResultSetToCours(rs);
                    userLiveCoursList.add(cours);
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération des cours en live pour l'utilisateur: " + userId, e);
        }
        
        return userLiveCoursList;
    }
    
    /**
     * Mapper un ResultSet à un objet Cours
     */
    private Cours mapResultSetToCours(ResultSet rs) throws SQLException {
        Cours cours = new Cours();
        cours.setId(rs.getInt("id"));
        cours.setTitre(rs.getString("titre"));
        cours.setDescription(rs.getString("description"));
        cours.setDuree(rs.getString("duree"));
        cours.setNiveau(rs.getString("niveau"));
        cours.setInstructeur(rs.getString("instructeur"));
        cours.setImage(rs.getString("image"));
        
        // Récupérer le statut live
        cours.setLive(rs.getBoolean("is_live"));
        
        // Récupérer la catégorie si elle existe
        String categorieNom = rs.getString("categorie_nom");
        if (categorieNom != null) {
            CategorieCours categorie = new CategorieCours();
            categorie.setNom(categorieNom);
            cours.setCategorie(categorie);
        }
        
        return cours;
    }
} 