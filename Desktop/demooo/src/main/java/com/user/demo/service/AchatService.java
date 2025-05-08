package com.user.demo.service;

import com.user.demo.model.Product;
import com.user.demo.util.DatabaseConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

public class AchatService {
    private static final Logger LOGGER = Logger.getLogger(AchatService.class.getName());
    private final ProductService productService = new ProductService();

    /**
     * Add a new purchase record and decrease product quantity
     */
    public boolean addAchat(int productId, int userId) {
        Connection conn = null;
        try {
            // Get new connection
            conn = DatabaseConnection.getConnection();
            
            // Start transaction
            conn.setAutoCommit(false);

            // First check if product has stock
            Product product = productService.getProductById(productId);
            if (product == null || product.getQuantite() <= 0) {
                return false;
            }

            // Add purchase record
            String insertSql = "INSERT INTO achat (id_produit, user_id, date_achat) VALUES (?, ?, NOW())";
            try (PreparedStatement stmt = conn.prepareStatement(insertSql)) {
                stmt.setInt(1, productId);
                stmt.setInt(2, userId);
                
                if (stmt.executeUpdate() == 0) {
                    conn.rollback();
                    return false;
                }
            }

            // Update product quantity
            String updateSql = "UPDATE produit SET quantité = quantité - 1 WHERE id = ? AND quantité > 0";
            try (PreparedStatement stmt = conn.prepareStatement(updateSql)) {
                stmt.setInt(1, productId);
                
                if (stmt.executeUpdate() == 0) {
                    conn.rollback();
                    return false;
                }
            }

            // If we got here, everything succeeded, so commit
            conn.commit();
            return true;

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error adding purchase", e);
            if (conn != null) {
                try {
                    conn.rollback();
                } catch (SQLException ex) {
                    LOGGER.log(Level.SEVERE, "Error rolling back transaction", ex);
                }
            }
            return false;
        } finally {
            DatabaseConnection.closeConnection(conn);
        }
    }

    /**
     * Get all products purchased by a user
     */
    public List<Product> getUserPurchases(int userId) {
        List<Product> purchases = new ArrayList<>();
        String sql = "SELECT p.* FROM produit p " +
                    "INNER JOIN achat a ON p.id = a.id_produit " +
                    "WHERE a.user_id = ? " +
                    "ORDER BY a.date_achat DESC";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setInt(1, userId);
            
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Product product = new Product();
                    product.setId(rs.getInt("id"));
                    product.setTitre(rs.getString("titre"));
                    product.setDescription(rs.getString("description"));
                    product.setPrix(rs.getDouble("prix"));
                    product.setQuantite(rs.getInt("quantité"));
                    purchases.add(product);
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error retrieving user purchases", e);
        }
        
        return purchases;
    }

    /**
     * Get the count of products purchased by a user
     */
    public int getUserPurchaseCount(int userId) {
        String sql = "SELECT COUNT(*) FROM achat WHERE user_id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setInt(1, userId);
            
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1);
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error getting user purchase count", e);
        }
        
        return 0;
    }

    /**
     * Check if a user has already purchased a product
     */
    public boolean hasPurchased(int userId, int productId) {
        String sql = "SELECT COUNT(*) FROM achat WHERE user_id = ? AND id_produit = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setInt(1, userId);
            stmt.setInt(2, productId);
            
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1) > 0;
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error checking user purchase", e);
        }
        
        return false;
    }
}