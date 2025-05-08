package com.user.demo.util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Database connection utility class
 */
public class DatabaseConnection {
    private static final Logger LOGGER = Logger.getLogger(DatabaseConnection.class.getName());
    private static final String URL = "jdbc:mysql://localhost:3306/devsphere";
    private static final String USER = "root";
    private static final String PASSWORD = "";

    /**
     * Get a connection to the database
     * @return Connection object
     */
    public static Connection getConnection() throws SQLException {
        try {
            LOGGER.info("Tentative de connexion à la base de données: " + URL);
            Connection conn = DriverManager.getConnection(URL, USER, PASSWORD);
            LOGGER.info("Connexion à la base de données établie avec succès");
            return conn;
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur de connexion à la base de données: " + e.getMessage(), e);
            LOGGER.log(Level.SEVERE, "État SQL: " + e.getSQLState() + ", Code erreur: " + e.getErrorCode());
            throw e;
        }
    }

    /**
     * Close a database connection safely
     * @param conn The connection to close
     */
    public static void closeConnection(Connection conn) {
        if (conn != null) {
            try {
                if (!conn.isClosed()) {
                    conn.close();
                    LOGGER.info("Connexion à la base de données fermée");
                }
            } catch (SQLException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la fermeture de la connexion: " + e.getMessage(), e);
            }
        }
    }

    /**
     * Execute the SQL script to add the live column to the cours table
     * @return true if successful, false otherwise
     */
    public static boolean updateCoursTableAddLiveColumn() {
        String sql1 = "ALTER TABLE cours ADD COLUMN IF NOT EXISTS is_live BOOLEAN DEFAULT FALSE";
        String sql2 = "UPDATE cours SET is_live = FALSE WHERE is_live IS NULL";
        
        try (Connection conn = getConnection()) {
            try {
                // Désactiver l'auto-commit pour effectuer une transaction
                conn.setAutoCommit(false);
                
                // Exécuter les requêtes SQL
                try (java.sql.Statement stmt = conn.createStatement()) {
                    LOGGER.info("Exécution de la requête: " + sql1);
                    stmt.execute(sql1);
                    
                    LOGGER.info("Exécution de la requête: " + sql2);
                    stmt.execute(sql2);
                }
                
                // Valider la transaction
                conn.commit();
                LOGGER.info("Mise à jour de la table cours réussie");
                return true;
            } catch (SQLException e) {
                // Annuler la transaction en cas d'erreur
                try {
                    conn.rollback();
                } catch (SQLException ex) {
                    LOGGER.log(Level.SEVERE, "Erreur lors du rollback: " + ex.getMessage(), ex);
                }
                
                LOGGER.log(Level.SEVERE, "Erreur lors de la mise à jour de la table cours: " + e.getMessage(), e);
                return false;
            } finally {
                // Rétablir l'auto-commit
                try {
                    conn.setAutoCommit(true);
                } catch (SQLException e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors du rétablissement de l'auto-commit: " + e.getMessage(), e);
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur de connexion à la base de données: " + e.getMessage(), e);
            return false;
        }
    }
}