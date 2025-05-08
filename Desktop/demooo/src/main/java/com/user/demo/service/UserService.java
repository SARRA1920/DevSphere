package com.user.demo.service;

import com.user.demo.model.User;
import com.user.demo.util.DatabaseConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Service class for user-related database operations
 */
public class UserService {
    
    /**
     * Authenticate a user with email and password
     * @param email User's email
     * @param password User's password
     * @return User object if authentication is successful, null otherwise
     */
    public User authenticate(String email, String password) {
        String query = "SELECT * FROM user WHERE email = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setString(1, email);
            ResultSet rs = stmt.executeQuery();
            
            if (rs.next()) {
                String storedPassword = rs.getString("password");
                
                // Check if password matches (for simplicity, direct comparison - in real app, use BCrypt)
                if (storedPassword.equals(password)) {
                    return extractUserFromResultSet(rs);
                }
            }
        } catch (SQLException e) {
            System.err.println("Error authenticating user: " + e.getMessage());
            e.printStackTrace();
        }
        
        return null;
    }
    
    /**
     * Register a new user
     * @param user User object with registration details
     * @return true if registration was successful, false otherwise
     */
    public boolean registerUser(User user) {
        String query = "INSERT INTO user (name, email, password, phone, cin, image, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setString(1, user.getName());
            stmt.setString(2, user.getEmail());
            stmt.setString(3, user.getPassword());
            stmt.setInt(4, user.getPhone());
            stmt.setInt(5, user.getCin());
            stmt.setString(6, user.getImage());
            stmt.setString(7, user.getRole());
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error registering user: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Get user by ID
     * @param id User ID
     * @return User object if found, null otherwise
     */
    public User getUserById(int id) {
        String query = "SELECT * FROM user WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, id);
            ResultSet rs = stmt.executeQuery();
            
            if (rs.next()) {
                return extractUserFromResultSet(rs);
            }
        } catch (SQLException e) {
            System.err.println("Error getting user by ID: " + e.getMessage());
            e.printStackTrace();
        }
        
        return null;
    }
    
    /**
     * Update user information
     * @param user User object with updated information
     * @return true if update was successful, false otherwise
     */
    public boolean updateUser(User user) {
        String query = "UPDATE user SET name=?, email=?, password=?, phone=?, cin=?, image=?, role=? WHERE id=?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setString(1, user.getName());
            stmt.setString(2, user.getEmail());
            stmt.setString(3, user.getPassword());
            stmt.setInt(4, user.getPhone());
            stmt.setInt(5, user.getCin());
            stmt.setString(6, user.getImage());
            stmt.setString(7, user.getRole());
            stmt.setInt(8, user.getId());
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error updating user: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Change user password
     * @param userId User ID
     * @param newPassword New password
     * @return true if password change was successful, false otherwise
     */
    public boolean changePassword(int userId, String newPassword) {
        String query = "UPDATE user SET password = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setString(1, newPassword);
            stmt.setInt(2, userId);
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error changing password: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Check if email already exists
     * @param email Email to check
     * @return true if email exists, false otherwise
     */
    public boolean emailExists(String email) {
        String query = "SELECT id FROM user WHERE email = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setString(1, email);
            ResultSet rs = stmt.executeQuery();
            
            return rs.next();
            
        } catch (SQLException e) {
            System.err.println("Error checking email existence: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Get all users from the database
     * @return List of all users
     */
    public List<User> getAllUsers() {
        String query = "SELECT * FROM user ORDER BY id";
        List<User> users = new ArrayList<>();
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                users.add(extractUserFromResultSet(rs));
            }
        } catch (SQLException e) {
            System.err.println("Error getting all users: " + e.getMessage());
            e.printStackTrace();
        }
        
        return users;
    }
    
    /**
     * Add a new user to the database
     * @param user User object to add
     * @return true if addition was successful, false otherwise
     */
    public boolean addUser(User user) {
        // This is functionally the same as registerUser, but kept separate
        // to maintain clear semantics between registration and admin-added users
        String query = "INSERT INTO user (name, email, password, phone, cin, image, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS)) {
            
            stmt.setString(1, user.getName());
            stmt.setString(2, user.getEmail());
            stmt.setString(3, user.getPassword());
            stmt.setInt(4, user.getPhone());
            stmt.setInt(5, user.getCin());
            stmt.setString(6, user.getImage());
            stmt.setString(7, user.getRole());
            
            int rowsAffected = stmt.executeUpdate();
            
            // Get the generated ID and set it in the user object
            if (rowsAffected > 0) {
                try (ResultSet generatedKeys = stmt.getGeneratedKeys()) {
                    if (generatedKeys.next()) {
                        user.setId(generatedKeys.getInt(1));
                    }
                }
                return true;
            }
            
            return false;
            
        } catch (SQLException e) {
            System.err.println("Error adding user: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Create a new user (alias for addUser)
     * @param user User object to create
     * @return true if creation was successful, false otherwise
     */
    public boolean createUser(User user) {
        return addUser(user);
    }
    
    /**
     * Delete a user from the database
     * @param userId ID of the user to delete
     * @return true if deletion was successful, false otherwise
     */
    public boolean deleteUser(int userId) {
        String query = "DELETE FROM user WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, userId);
            
            int rowsAffected = stmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            System.err.println("Error deleting user: " + e.getMessage());
            e.printStackTrace();
            return false;
        }
    }
    
    /**
     * Count total number of users
     * @return The total count of users
     */
    public int getUserCount() {
        String query = "SELECT COUNT(*) FROM user";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("Error getting user count: " + e.getMessage());
            e.printStackTrace();
        }
        
        return 0;
    }
    
    /**
     * Search for users by name, email, or role
     * @param searchTerm Term to search for
     * @param role Role to filter by (or null for all roles)
     * @return List of matching users
     */
    public List<User> searchUsers(String searchTerm, String role) {
        String query = "SELECT * FROM user WHERE (name LIKE ? OR email LIKE ?)";
        
        if (role != null && !role.equals("All")) {
            query += " AND role = ?";
        }
        
        List<User> users = new ArrayList<>();
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            String searchPattern = "%" + searchTerm + "%";
            stmt.setString(1, searchPattern);
            stmt.setString(2, searchPattern);
            
            if (role != null && !role.equals("All")) {
                stmt.setString(3, role);
            }
            
            ResultSet rs = stmt.executeQuery();
            
            while (rs.next()) {
                users.add(extractUserFromResultSet(rs));
            }
        } catch (SQLException e) {
            System.err.println("Error searching users: " + e.getMessage());
            e.printStackTrace();
        }
        
        return users;
    }
    
    /**
     * Helper method to extract user from result set
     * @param rs Result set containing user data
     * @return User object
     * @throws SQLException If a database error occurs
     */
    private User extractUserFromResultSet(ResultSet rs) throws SQLException {
        return new User(
            rs.getInt("id"),
            rs.getString("name"),
            rs.getString("email"),
            rs.getString("password"),
            rs.getInt("phone"),
            rs.getInt("cin"),
            rs.getString("image"),
            rs.getString("role")
        );
    }
}