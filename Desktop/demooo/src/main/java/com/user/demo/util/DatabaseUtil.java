package com.user.demo.util;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Classe utilitaire pour les opérations sur la base de données
 */
public class DatabaseUtil {
    
    private static final Logger LOGGER = Logger.getLogger(DatabaseUtil.class.getName());
    
    /**
     * Vérifie si une colonne existe dans une table
     * @param conn Connection à la base de données
     * @param tableName Nom de la table
     * @param columnName Nom de la colonne
     * @return true si la colonne existe, false sinon
     */
    public static boolean columnExists(Connection conn, String tableName, String columnName) {
        try {
            ResultSet rs = conn.getMetaData().getColumns("devsphere", null, tableName, columnName);
            boolean exists = rs.next();
            rs.close();
            return exists;
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'existence de la colonne " + columnName, e);
            return false;
        }
    }
    
    /**
     * Ajoute une colonne à une table si elle n'existe pas déjà
     * @param conn Connection à la base de données
     * @param tableName Nom de la table
     * @param columnName Nom de la colonne
     * @param columnDefinition Définition de la colonne (type, contraintes, etc.)
     * @return true si la colonne a été ajoutée avec succès, false sinon
     */
    public static boolean addColumnIfNotExists(Connection conn, String tableName, String columnName, String columnDefinition) {
        try {
            if (!columnExists(conn, tableName, columnName)) {
                LOGGER.info("La colonne " + columnName + " n'existe pas dans la table " + tableName + ". Ajout en cours...");
                
                try (Statement stmt = conn.createStatement()) {
                    String query = "ALTER TABLE " + tableName + " ADD COLUMN " + columnName + " " + columnDefinition;
                    LOGGER.info("Exécution de la requête: " + query);
                    stmt.executeUpdate(query);
                    LOGGER.info("Colonne " + columnName + " ajoutée avec succès à la table " + tableName);
                    return true;
                }
            } else {
                LOGGER.info("La colonne " + columnName + " existe déjà dans la table " + tableName);
                return true;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout de la colonne " + columnName + " à la table " + tableName, e);
            return false;
        }
    }
    
    /**
     * Vérifie et ajoute la colonne niveau à la table categorie_cours si nécessaire
     */
    public static void ensureNiveauColumnExists() {
        try (Connection conn = DatabaseConnection.getConnection()) {
            addColumnIfNotExists(conn, "categorie_cours", "niveau", "VARCHAR(50) DEFAULT 'Beginner'");
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification ou de l'ajout de la colonne niveau", e);
        }
    }
    
    /**
     * Vérifie et ajoute la colonne active à la table categorie_cours si nécessaire
     */
    public static void ensureActiveColumnExists() {
        try (Connection conn = DatabaseConnection.getConnection()) {
            addColumnIfNotExists(conn, "categorie_cours", "active", "BOOLEAN DEFAULT TRUE");
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification ou de l'ajout de la colonne active", e);
        }
    }
    
    /**
     * Configure la base de données en s'assurant que toutes les colonnes nécessaires existent
     */
    public static void setupDatabase() {
        try {
            Connection conn = DatabaseConnection.getConnection();
            if (conn != null) {
                LOGGER.info("Connexion à la base de données devsphere établie avec succès pour la configuration");
                DatabaseConnection.closeConnection(conn);
            }
            
            ensureNiveauColumnExists();
            ensureActiveColumnExists();
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la configuration de la base de données", e);
        }
    }
} 