package com.user.demo.service;

import com.user.demo.model.Reclamation;
import com.user.demo.model.Reponse;
import com.user.demo.util.DatabaseConnection;

import java.sql.*;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

/**
 * Service class for handling Reclamation CRUD operations
 */
public class ReclamationService {
    
    /**
     * Add a new reclamation to the database
     * @param reclamation The reclamation to add
     * @return The ID of the new reclamation if successful, -1 otherwise
     */
    public int addReclamation(Reclamation reclamation) {
        String query = "INSERT INTO reclamation (user_id, type, date, reclamation) VALUES (?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS)) {
            
            stmt.setInt(1, reclamation.getUserId());
            stmt.setString(2, reclamation.getType());
            stmt.setTimestamp(3, Timestamp.valueOf(reclamation.getDate()));
            stmt.setString(4, reclamation.getReclamation());
            
            int rowsAffected = stmt.executeUpdate();
            if (rowsAffected > 0) {
                try (ResultSet rs = stmt.getGeneratedKeys()) {
                    if (rs.next()) {
                        return rs.getInt(1);
                    }
                }
            }
            return -1;
        } catch (SQLException e) {
            System.err.println("Error adding reclamation: " + e.getMessage());
            return -1;
        }
    }
    
    /**
     * Get all reclamations with their associated responses
     * @return List of reclamations
     */
    public List<Reclamation> getAllReclamations() {
        String query = "SELECT r.*, rep.id as rep_id, rep.date as rep_date, rep.reponse as rep_content " +
                       "FROM reclamation r " +
                       "LEFT JOIN reponse rep ON r.reponse_id = rep.id " +
                       "ORDER BY r.date DESC";
        
        List<Reclamation> reclamations = new ArrayList<>();
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                Reclamation reclamation = mapResultSetToReclamation(rs);
                
                // Check if there's an associated response
                if (rs.getObject("rep_id") != null) {
                    Reponse reponse = new Reponse();
                    reponse.setId(rs.getInt("rep_id"));
                    reponse.setDate(rs.getTimestamp("rep_date").toLocalDateTime());
                    reponse.setReponse(rs.getString("rep_content"));
                    reclamation.setReponse(reponse);
                }
                
                reclamations.add(reclamation);
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving reclamations: " + e.getMessage());
        }
        
        return reclamations;
    }
    
    /**
     * Get a reclamation by its ID
     * @param id The ID of the reclamation
     * @return The reclamation or null if not found
     */
    public Reclamation getReclamationById(int id) {
        String query = "SELECT r.*, rep.id as rep_id, rep.date as rep_date, rep.reponse as rep_content " +
                       "FROM reclamation r " +
                       "LEFT JOIN reponse rep ON r.reponse_id = rep.id " +
                       "WHERE r.id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, id);
            
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    Reclamation reclamation = mapResultSetToReclamation(rs);
                    
                    // Check if there's an associated response
                    if (rs.getObject("rep_id") != null) {
                        Reponse reponse = new Reponse();
                        reponse.setId(rs.getInt("rep_id"));
                        reponse.setDate(rs.getTimestamp("rep_date").toLocalDateTime());
                        reponse.setReponse(rs.getString("rep_content"));
                        reclamation.setReponse(reponse);
                    }
                    
                    return reclamation;
                }
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving reclamation: " + e.getMessage());
        }
        
        return null;
    }
    
    /**
     * Update an existing reclamation
     * @param reclamation The reclamation to update
     * @return true if successful, false otherwise
     */
    public boolean updateReclamation(Reclamation reclamation) {
        String query = "UPDATE reclamation SET user_id = ?, reponse_id = ?, type = ?, date = ?, reclamation = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, reclamation.getUserId());
            
            if (reclamation.getReponseId() != null) {
                stmt.setInt(2, reclamation.getReponseId());
            } else {
                stmt.setNull(2, Types.INTEGER);
            }
            
            stmt.setString(3, reclamation.getType());
            stmt.setTimestamp(4, Timestamp.valueOf(reclamation.getDate()));
            stmt.setString(5, reclamation.getReclamation());
            stmt.setInt(6, reclamation.getId());
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error updating reclamation: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Delete a reclamation
     * @param id The ID of the reclamation to delete
     * @return true if successful, false otherwise
     */
    public boolean deleteReclamation(int id) {
        String query = "DELETE FROM reclamation WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, id);
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error deleting reclamation: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Link a response to a reclamation
     * @param reclamationId The ID of the reclamation
     * @param reponseId The ID of the response
     * @return true if successful, false otherwise
     */
    public boolean linkReponseToReclamation(int reclamationId, int reponseId) {
        String query = "UPDATE reclamation SET reponse_id = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, reponseId);
            stmt.setInt(2, reclamationId);
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error linking response to reclamation: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Helper method to map a ResultSet to a Reclamation object
     */
    private Reclamation mapResultSetToReclamation(ResultSet rs) throws SQLException {
        Reclamation reclamation = new Reclamation();
        reclamation.setId(rs.getInt("id"));
        reclamation.setUserId(rs.getInt("user_id"));
        
        // Handle nullable reponse_id
        Object reponseId = rs.getObject("reponse_id");
        if (reponseId != null) {
            reclamation.setReponseId((Integer) reponseId);
        }
        
        reclamation.setType(rs.getString("type"));
        reclamation.setDate(rs.getTimestamp("date").toLocalDateTime());
        reclamation.setReclamation(rs.getString("reclamation"));
        reclamation.setDescription(rs.getString("reclamation")); // Use reclamation text as description
        reclamation.setStatus(reponseId != null ? "Resolved" : "Pending"); // Set status based on response
        
        return reclamation;
    }
}