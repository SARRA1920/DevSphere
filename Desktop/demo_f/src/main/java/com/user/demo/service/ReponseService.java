package com.user.demo.service;

import com.user.demo.model.Reponse;
import com.user.demo.util.DatabaseConnection;

import java.sql.*;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

/**
 * Service class for handling Reponse CRUD operations
 */
public class ReponseService {
    
    /**
     * Get all reponses from the database
     * @return List of reponses
     */
    public List<Reponse> getAllReponses() {
        String query = "SELECT * FROM reponse ORDER BY date DESC";
        List<Reponse> reponses = new ArrayList<>();
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                Reponse reponse = mapResultSetToReponse(rs);
                reponses.add(reponse);
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving reponses: " + e.getMessage());
        }
        
        return reponses;
    }
    
    /**
     * Get a reponse by its ID
     * @param id The ID of the reponse
     * @return The reponse or null if not found
     */
    public Reponse getReponseById(int id) {
        String query = "SELECT * FROM reponse WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, id);
            
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    return mapResultSetToReponse(rs);
                }
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving reponse: " + e.getMessage());
        }
        
        return null;
    }
    
    /**
     * Get all reponses for a specific reclamation
     * @param reclamationId The ID of the reclamation
     * @return List of reponses
     */
    public List<Reponse> getReponsesByReclamationId(int reclamationId) {
        String query = "SELECT * FROM reponse WHERE reclamation_id = ? ORDER BY date DESC";
        List<Reponse> reponses = new ArrayList<>();
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, reclamationId);
            
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Reponse reponse = mapResultSetToReponse(rs);
                    reponses.add(reponse);
                }
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving reponses for reclamation: " + e.getMessage());
        }
        
        return reponses;
    }
    
    /**
     * Add a new reponse to the database
     * @param reponse The reponse to add
     * @return The ID of the new reponse if successful, -1 otherwise
     */
    public int addReponse(Reponse reponse) {
        String query = "INSERT INTO reponse (reclamation_id, reponse, date) VALUES (?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS)) {
            
            // Use the reclamationId from the model
            if (reponse.getReclamationId() != null) {
                stmt.setInt(1, reponse.getReclamationId());
            } else {
                stmt.setNull(1, Types.INTEGER);
            }
            stmt.setString(2, reponse.getReponse());
            stmt.setTimestamp(3, Timestamp.valueOf(reponse.getDate()));
            
            int rowsAffected = stmt.executeUpdate();
            if (rowsAffected > 0) {
                try (ResultSet rs = stmt.getGeneratedKeys()) {
                    if (rs.next()) {
                        int reponseId = rs.getInt(1);
                        
                        // Update the reclamation to associate it with this reponse if needed
                        if (reponse.getReclamationId() != null) {
                            updateReclamationReponseId(reponse.getReclamationId(), reponseId);
                        }
                        
                        return reponseId;
                    }
                }
            }
            return -1;
        } catch (SQLException e) {
            System.err.println("Error adding reponse: " + e.getMessage());
            return -1;
        }
    }
    
    /**
     * Update an existing reponse in the database
     * @param reponse The reponse to update
     * @return true if successful, false otherwise
     */
    public boolean updateReponse(Reponse reponse) {
        String query = "UPDATE reponse SET reponse = ?, date = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setString(1, reponse.getReponse());
            stmt.setTimestamp(2, Timestamp.valueOf(reponse.getDate()));
            stmt.setInt(3, reponse.getId());
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
        } catch (SQLException e) {
            System.err.println("Error updating reponse: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Delete a reponse from the database
     * @param id The ID of the reponse to delete
     * @return true if successful, false otherwise
     */
    public boolean deleteReponse(int id) {
        // First, find the reclamation associated with this reponse if needed
        Reponse reponse = getReponseById(id);
        if (reponse == null) {
            return false;
        }
        
        String query = "DELETE FROM reponse WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, id);
            
            int rowsAffected = stmt.executeUpdate();
            if (rowsAffected > 0) {
                // Reset the reponse_id in the reclamation table if needed
                updateReclamationReponseId(0, 0); // Update with actual reclamation ID if available
                return true;
            }
            return false;
        } catch (SQLException e) {
            System.err.println("Error deleting reponse: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Create a new reponse and link it to a reclamation
     * @param reponse The reponse to create
     * @param reclamationId The ID of the reclamation to link it to
     * @return The ID of the new reponse if successful, -1 otherwise
     */
    public int createAndLinkReponse(Reponse reponse, int reclamationId) {
        String query = "INSERT INTO reponse (reclamation_id, reponse, date) VALUES (?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS)) {
            
            stmt.setInt(1, reclamationId);
            stmt.setString(2, reponse.getReponse());
            stmt.setTimestamp(3, Timestamp.valueOf(reponse.getDate()));
            
            int rowsAffected = stmt.executeUpdate();
            if (rowsAffected > 0) {
                try (ResultSet rs = stmt.getGeneratedKeys()) {
                    if (rs.next()) {
                        int reponseId = rs.getInt(1);
                        
                        // Update the reclamation to associate it with this reponse
                        updateReclamationReponseId(reclamationId, reponseId);
                        
                        return reponseId;
                    }
                }
            }
            return -1;
        } catch (SQLException e) {
            System.err.println("Error creating reponse: " + e.getMessage());
            return -1;
        }
    }
    
    /**
     * Update the reponse_id for a reclamation
     * @param reclamationId The ID of the reclamation
     * @param reponseId The ID of the reponse (or 0 to clear)
     * @return true if successful, false otherwise
     */
    private boolean updateReclamationReponseId(int reclamationId, int reponseId) {
        String query = "UPDATE reclamation SET reponse_id = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            if (reponseId == 0) {
                stmt.setNull(1, Types.INTEGER);
            } else {
                stmt.setInt(1, reponseId);
            }
            stmt.setInt(2, reclamationId);
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
        } catch (SQLException e) {
            System.err.println("Error updating reclamation reponse ID: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Map a ResultSet to a Reponse object
     * @param rs The ResultSet containing reponse data
     * @return The mapped Reponse object
     * @throws SQLException If a database error occurs
     */
    private Reponse mapResultSetToReponse(ResultSet rs) throws SQLException {
        Reponse reponse = new Reponse();
        reponse.setId(rs.getInt("id"));
        reponse.setReponse(rs.getString("reponse"));
        reponse.setDate(rs.getTimestamp("date").toLocalDateTime());
        
        // Get the reclamation_id from the result set
        try {
            int reclamationId = rs.getInt("reclamation_id");
            if (!rs.wasNull()) {
                reponse.setReclamationId(reclamationId);
            }
        } catch (SQLException e) {
            // Handle the case where the column doesn't exist
            System.err.println("Warning: reclamation_id column not found: " + e.getMessage());
        }
        
        return reponse;
    }
}