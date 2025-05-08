package com.user.demo.service;

import com.user.demo.model.CategorieCours;
import com.user.demo.util.DatabaseConnection;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

public class CategorieCoursService {
    private static final Logger LOGGER = Logger.getLogger(CategorieCoursService.class.getName());

    public List<CategorieCours> afficher() {
        List<CategorieCours> categories = new ArrayList<>();
        String query = "SELECT * FROM categorie_cours ORDER BY nom";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                CategorieCours categorie = new CategorieCours();
                categorie.setId(rs.getInt("id"));
                categorie.setNom(rs.getString("nom"));
                categorie.setDescription(rs.getString("description"));
                
                // Récupérer le niveau
                String niveau = rs.getString("niveau");
                if (niveau != null && !niveau.isEmpty()) {
                    categorie.setNiveau(niveau);
                } else {
                    categorie.setNiveau("Beginner"); // Valeur par défaut
                }
                
                // Récupérer l'état actif si la colonne existe
                try {
                    boolean active = rs.getBoolean("active");
                    categorie.setActive(active);
                } catch (SQLException e) {
                    // La colonne active n'existe pas encore, définir à true par défaut
                    categorie.setActive(true);
                }
                
                categories.add(categorie);
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération des catégories de cours", e);
        }
        
        return categories;
    }

    public boolean ajouter(CategorieCours categorie) {
        // Vérifier si la catégorie existe déjà
        if (categorieExiste(categorie.getNom())) {
            System.out.println("Une catégorie avec ce nom existe déjà!");
            return false;
        }
        
        String query = "INSERT INTO categorie_cours (nom, description, niveau, active) VALUES (?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setString(1, categorie.getNom());
            pstmt.setString(2, categorie.getDescription());
            pstmt.setString(3, categorie.getNiveau());
            pstmt.setBoolean(4, categorie.isActive());
            
            int rowsAffected = pstmt.executeUpdate();
            return rowsAffected > 0;
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout d'une catégorie", e);
            return false;
        }
    }

    public boolean modifier(CategorieCours categorie) {
        String query = "UPDATE categorie_cours SET nom = ?, description = ?, niveau = ?, active = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setString(1, categorie.getNom());
            pstmt.setString(2, categorie.getDescription());
            pstmt.setString(3, categorie.getNiveau());
            pstmt.setBoolean(4, categorie.isActive());
            pstmt.setInt(5, categorie.getId());
            
            int affectedRows = pstmt.executeUpdate();
            return affectedRows > 0;
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la modification d'une catégorie de cours", e);
        }
        
        return false;
    }

    public boolean supprimer(CategorieCours categorie) {
        // Vérifier d'abord si la catégorie est utilisée par des cours
        String checkQuery = "SELECT COUNT(*) FROM cours WHERE categorie_cours_id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement checkStmt = conn.prepareStatement(checkQuery)) {
            
            checkStmt.setInt(1, categorie.getId());
            
            try (ResultSet rs = checkStmt.executeQuery()) {
                if (rs.next() && rs.getInt(1) > 0) {
                    // Des cours utilisent cette catégorie, impossible de supprimer
                    LOGGER.warning("Impossible de supprimer la catégorie car elle est associée à " + rs.getInt(1) + " cours");
                    return false;
                }
            }
            
            // Si aucun cours n'utilise cette catégorie, procéder à la suppression
            String deleteQuery = "DELETE FROM categorie_cours WHERE id = ?";
            try (PreparedStatement deleteStmt = conn.prepareStatement(deleteQuery)) {
                deleteStmt.setInt(1, categorie.getId());
                
                int affectedRows = deleteStmt.executeUpdate();
                return affectedRows > 0;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la suppression d'une catégorie de cours", e);
        }
        
        return false;
    }
    
    public CategorieCours findById(int id) {
        String query = "SELECT * FROM categorie_cours WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, id);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    CategorieCours categorie = new CategorieCours();
                    categorie.setId(rs.getInt("id"));
                    categorie.setNom(rs.getString("nom"));
                    categorie.setDescription(rs.getString("description"));
                    
                    // Récupérer le niveau
                    String niveau = rs.getString("niveau");
                    if (niveau != null && !niveau.isEmpty()) {
                        categorie.setNiveau(niveau);
                    } else {
                        categorie.setNiveau("Beginner"); // Valeur par défaut
                    }
                    
                    // Récupérer la valeur active si la colonne existe
                    try {
                        boolean active = rs.getBoolean("active");
                        categorie.setActive(active);
                    } catch (SQLException e) {
                        // La colonne active n'existe pas encore, définir à true par défaut
                        categorie.setActive(true);
                    }
                    
                    return categorie;
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la recherche d'une catégorie par ID", e);
        }
        
        return null;
    }

    public boolean desactiverCategorie(CategorieCours categorie) {
        // Vérifier si la table categorie_cours a une colonne 'active'
        // Sinon, nous devons d'abord l'ajouter avec une commande ALTER TABLE
        
        try (Connection conn = DatabaseConnection.getConnection()) {
            // Vérifier si la colonne 'active' existe
            boolean activeColumnExists = false;
            try (ResultSet rs = conn.getMetaData().getColumns(null, null, "categorie_cours", "active")) {
                activeColumnExists = rs.next();
            }
            
            // Si la colonne n'existe pas, l'ajouter
            if (!activeColumnExists) {
                try (Statement stmt = conn.createStatement()) {
                    stmt.executeUpdate("ALTER TABLE categorie_cours ADD COLUMN active BOOLEAN DEFAULT TRUE");
                }
            }
            
            // Maintenant, désactiver la catégorie
            String query = "UPDATE categorie_cours SET active = FALSE WHERE id = ?";
            try (PreparedStatement pstmt = conn.prepareStatement(query)) {
                pstmt.setInt(1, categorie.getId());
                
                int affectedRows = pstmt.executeUpdate();
                return affectedRows > 0;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la désactivation d'une catégorie de cours", e);
        }
        
        return false;
    }

    public boolean activerCategorie(CategorieCours categorie) {
        try (Connection conn = DatabaseConnection.getConnection()) {
            // Vérifier si la colonne 'active' existe
            boolean activeColumnExists = false;
            try (ResultSet rs = conn.getMetaData().getColumns(null, null, "categorie_cours", "active")) {
                activeColumnExists = rs.next();
            }
            
            // Si la colonne n'existe pas, l'ajouter
            if (!activeColumnExists) {
                try (Statement stmt = conn.createStatement()) {
                    stmt.executeUpdate("ALTER TABLE categorie_cours ADD COLUMN active BOOLEAN DEFAULT TRUE");
                }
            }
            
            // Activer la catégorie
            String query = "UPDATE categorie_cours SET active = TRUE WHERE id = ?";
            try (PreparedStatement pstmt = conn.prepareStatement(query)) {
                pstmt.setInt(1, categorie.getId());
                
                int affectedRows = pstmt.executeUpdate();
                return affectedRows > 0;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'activation d'une catégorie de cours", e);
        }
        
        return false;
    }

    // Modifier la méthode afficher pour tenir compte de l'état actif
    public List<CategorieCours> afficherTout() {
        List<CategorieCours> categories = new ArrayList<>();
        String query = "SELECT * FROM categorie_cours ORDER BY nom";
        
        LOGGER.info("Chargement de toutes les catégories de cours");
        
        Connection conn = null;
        Statement stmt = null;
        ResultSet rs = null;
        
        try {
            conn = DatabaseConnection.getConnection();
            
            if (conn == null) {
                LOGGER.severe("Impossible d'établir une connexion à la base de données");
                return categories;
            }
            
            stmt = conn.createStatement();
            LOGGER.info("Exécution de la requête: " + query);
            rs = stmt.executeQuery(query);
            
            int count = 0;
            while (rs.next()) {
                count++;
                CategorieCours categorie = new CategorieCours();
                categorie.setId(rs.getInt("id"));
                categorie.setNom(rs.getString("nom"));
                categorie.setDescription(rs.getString("description"));
                
                // Récupérer le niveau
                String niveau = rs.getString("niveau");
                if (niveau != null && !niveau.isEmpty()) {
                    categorie.setNiveau(niveau);
                } else {
                    categorie.setNiveau("Beginner"); // Valeur par défaut
                }
                
                // Récupérer l'état actif si la colonne existe
                try {
                    boolean active = rs.getBoolean("active");
                    categorie.setActive(active);
                } catch (SQLException e) {
                    // La colonne active n'existe pas encore, définir à true par défaut
                    LOGGER.warning("La colonne 'active' n'existe pas: " + e.getMessage());
                    categorie.setActive(true);
                }
                
                categories.add(categorie);
                LOGGER.fine("Catégorie chargée: ID=" + categorie.getId() + ", Nom=" + categorie.getNom());
            }
            
            LOGGER.info("Nombre de catégories chargées: " + count);
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur SQL lors du chargement des catégories: " + e.getMessage(), e);
            LOGGER.log(Level.SEVERE, "État SQL: " + e.getSQLState() + ", Code erreur: " + e.getErrorCode());
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Exception lors du chargement des catégories", e);
        } finally {
            // Fermer proprement les ressources
            try {
                if (rs != null) rs.close();
                if (stmt != null) stmt.close();
                if (conn != null) DatabaseConnection.closeConnection(conn);
            } catch (SQLException e) {
                LOGGER.log(Level.WARNING, "Erreur lors de la fermeture des ressources", e);
            }
        }
        
        return categories;
    }

    public List<CategorieCours> afficherActives() {
        return afficher(true, false); // Retourne seulement les catégories actives
    }

    private List<CategorieCours> afficher(boolean includeActive, boolean includeInactive) {
        List<CategorieCours> categories = new ArrayList<>();
        
        // Construction de la requête en fonction des paramètres
        StringBuilder queryBuilder = new StringBuilder("SELECT * FROM categorie_cours");
        
        try (Connection conn = DatabaseConnection.getConnection()) {
            // Vérifier si la colonne 'active' existe
            boolean activeColumnExists = false;
            try (ResultSet rs = conn.getMetaData().getColumns(null, null, "categorie_cours", "active")) {
                activeColumnExists = rs.next();
            }
            
            // Si la colonne existe, ajouter une condition WHERE pour filtrer
            if (activeColumnExists && !(includeActive && includeInactive)) {
                queryBuilder.append(" WHERE active = ?");
            }
            
            queryBuilder.append(" ORDER BY nom");
            
            try (PreparedStatement stmt = conn.prepareStatement(queryBuilder.toString())) {
                // Si nous filtrons par statut actif/inactif
                if (activeColumnExists && !(includeActive && includeInactive)) {
                    stmt.setBoolean(1, includeActive);
                }
                
                try (ResultSet rs = stmt.executeQuery()) {
                    while (rs.next()) {
                        CategorieCours categorie = new CategorieCours();
                        categorie.setId(rs.getInt("id"));
                        categorie.setNom(rs.getString("nom"));
                        categorie.setDescription(rs.getString("description"));
                        
                        // Si la colonne active existe, récupérer sa valeur
                        if (activeColumnExists) {
                            categorie.setActive(rs.getBoolean("active"));
                        } else {
                            categorie.setActive(true); // Par défaut, toutes les catégories sont actives
                        }
                        
                        categories.add(categorie);
                    }
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération des catégories de cours", e);
        }
        
        return categories;
    }

    /**
     * Vérifie si une catégorie avec le nom donné existe déjà
     * @param nom Nom de la catégorie à vérifier
     * @return true si une catégorie avec ce nom existe, false sinon
     */
    private boolean categorieExiste(String nom) {
        String query = "SELECT COUNT(*) FROM categorie_cours WHERE nom = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setString(1, nom);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1) > 0;
                }
            }
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'existence d'une catégorie", e);
        }
        
        return false;
    }

    /**
     * Récupère toutes les catégories de cours avec des logs détaillés pour debugging
     * @return Liste des catégories de cours
     */
    public List<CategorieCours> getCategories() {
        List<CategorieCours> categories = new ArrayList<>();
        String query = "SELECT * FROM categorie_cours ORDER BY nom";
        
        try (Connection conn = DatabaseConnection.getConnection()) {
            // Vérifier la connexion à la base de données
            if (conn == null) {
                LOGGER.severe("La connexion à la base de données est null!");
                return categories;
            }
            
            LOGGER.info("Connexion à la base de données établie avec succès");
            
            // Vérifier si la table existe
            DatabaseMetaData dbMeta = conn.getMetaData();
            ResultSet tables = dbMeta.getTables(null, null, "categorie_cours", null);
            
            if (!tables.next()) {
                LOGGER.severe("La table categorie_cours n'existe pas!");
                return categories;
            }
            
            LOGGER.info("La table categorie_cours existe");
            
            // Vérifier les colonnes de la table
            ResultSet columns = dbMeta.getColumns(null, null, "categorie_cours", null);
            LOGGER.info("Colonnes dans la table categorie_cours:");
            while (columns.next()) {
                LOGGER.info(" - " + columns.getString("COLUMN_NAME") + " (" + columns.getString("TYPE_NAME") + ")");
            }
            
            // Exécuter la requête
            try (Statement stmt = conn.createStatement();
                 ResultSet rs = stmt.executeQuery(query)) {
                
                LOGGER.info("Requête exécutée avec succès: " + query);
                
                int count = 0;
                while (rs.next()) {
                    count++;
                    CategorieCours categorie = new CategorieCours();
                    categorie.setId(rs.getInt("id"));
                    categorie.setNom(rs.getString("nom"));
                    categorie.setDescription(rs.getString("description"));
                    
                    // Récupérer le niveau
                    try {
                        String niveau = rs.getString("niveau");
                        if (niveau != null && !niveau.isEmpty()) {
                            categorie.setNiveau(niveau);
                        } else {
                            categorie.setNiveau("Beginner"); // Valeur par défaut
                        }
                    } catch (SQLException e) {
                        LOGGER.warning("La colonne 'niveau' n'existe pas: " + e.getMessage());
                        categorie.setNiveau("Beginner"); // Valeur par défaut
                    }
                    
                    // Récupérer l'état actif
                    try {
                        boolean active = rs.getBoolean("active");
                        categorie.setActive(active);
                    } catch (SQLException e) {
                        LOGGER.warning("La colonne 'active' n'existe pas: " + e.getMessage());
                        categorie.setActive(true); // Par défaut
                    }
                    
                    categories.add(categorie);
                    LOGGER.info("Catégorie récupérée: " + categorie);
                }
                
                LOGGER.info("Nombre total de catégories récupérées: " + count);
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la récupération des catégories de cours", e);
        }
        
        return categories;
    }
}