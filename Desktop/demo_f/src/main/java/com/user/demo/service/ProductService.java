package com.user.demo.service;

import com.user.demo.model.Product;
import com.user.demo.util.DatabaseConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Service class for product operations
 */
public class ProductService {
    private static final Logger LOGGER = Logger.getLogger(ProductService.class.getName());
    
    /**
     * Get all products from the database
     * 
     * @return List of all products
     */
    public List<Product> getAllProducts() {
        List<Product> products = new ArrayList<>();
        String query = "SELECT * FROM produit ORDER BY id DESC";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                Product product = mapResultSetToProduct(rs);
                products.add(product);
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error retrieving products", e);
        }
        
        return products;
    }
    
    /**
     * Get a product by ID
     * 
     * @param id Product ID
     * @return Product if found, null otherwise
     */
    public Product getProductById(int id) {
        String query = "SELECT * FROM produit WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, id);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return mapResultSetToProduct(rs);
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error retrieving product with ID: " + id, e);
        }
        
        return null;
    }
    
    /**
     * Add a new product to the database
     * 
     * @param product Product to add
     * @return true if successful, false otherwise
     */
    public boolean addProduct(Product product) {
        String query = "INSERT INTO produit (titre, description, prix, quantité) VALUES (?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS)) {
            
            pstmt.setString(1, product.getTitre());
            pstmt.setString(2, product.getDescription());
            pstmt.setDouble(3, product.getPrix());
            pstmt.setInt(4, product.getQuantite());
            
            int affectedRows = pstmt.executeUpdate();
            
            if (affectedRows > 0) {
                try (ResultSet generatedKeys = pstmt.getGeneratedKeys()) {
                    if (generatedKeys.next()) {
                        product.setId(generatedKeys.getInt(1));
                        return true;
                    }
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error adding product: " + product, e);
        }
        
        return false;
    }
    
    /**
     * Update an existing product
     * 
     * @param product Product to update
     * @return true if successful, false otherwise
     */
    public boolean updateProduct(Product product) {
        String query = "UPDATE produit SET titre = ?, description = ?, prix = ?, quantité = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setString(1, product.getTitre());
            pstmt.setString(2, product.getDescription());
            pstmt.setDouble(3, product.getPrix());
            pstmt.setInt(4, product.getQuantite());
            pstmt.setInt(5, product.getId());
            
            int affectedRows = pstmt.executeUpdate();
            return affectedRows > 0;
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error updating product: " + product, e);
        }
        
        return false;
    }
    
    /**
     * Delete a product by ID
     * 
     * @param id Product ID to delete
     * @return true if successful, false otherwise
     */
    public boolean deleteProduct(int id) {
        String query = "DELETE FROM produit WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, id);
            
            int affectedRows = pstmt.executeUpdate();
            return affectedRows > 0;
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error deleting product with ID: " + id, e);
        }
        
        return false;
    }
    
    /**
     * Search for products by title or description
     * 
     * @param searchTerm Search term
     * @return List of matching products
     */
    public List<Product> searchProducts(String searchTerm) {
        List<Product> products = new ArrayList<>();
        String query = "SELECT * FROM produit WHERE titre LIKE ? OR description LIKE ? ORDER BY id DESC";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            String searchPattern = "%" + searchTerm + "%";
            pstmt.setString(1, searchPattern);
            pstmt.setString(2, searchPattern);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                while (rs.next()) {
                    Product product = mapResultSetToProduct(rs);
                    products.add(product);
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Error searching for products with term: " + searchTerm, e);
        }
        
        return products;
    }
    
    /**
     * Helper method to map ResultSet to Product
     * 
     * @param rs ResultSet containing product data
     * @return Product object
     * @throws SQLException if an error occurs during mapping
     */
    private Product mapResultSetToProduct(ResultSet rs) throws SQLException {
        int id = rs.getInt("id");
        String titre = rs.getString("titre");
        String description = rs.getString("description");
        double prix = rs.getDouble("prix");
        int quantite = rs.getInt("quantité");
        
        return new Product(id, titre, description, prix, quantite);
    }
}