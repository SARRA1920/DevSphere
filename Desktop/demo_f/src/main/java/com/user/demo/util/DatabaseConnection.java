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
}