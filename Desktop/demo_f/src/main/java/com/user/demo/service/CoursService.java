package com.user.demo.service;

import com.user.demo.model.Cours;
import com.user.demo.model.CategorieCours;
import com.user.demo.util.DatabaseConnection;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

public class CoursService {
    private static final Logger LOGGER = Logger.getLogger(CoursService.class.getName());

    public List<Cours> rechercher() {
        List<Cours> coursList = new ArrayList<>();
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            while (rs.next()) {
                Cours cours = new Cours();
                cours.setId(rs.getInt("id"));
                cours.setTitre(rs.getString("titre"));
                cours.setDescription(rs.getString("description"));
                cours.setDuree(rs.getString("duree"));
                cours.setNiveau(rs.getString("niveau"));
                cours.setInstructeur(rs.getString("instructeur"));
                cours.setImage(rs.getString("image"));
                cours.setPdfFilename(rs.getString("pdf_filename"));
                cours.setCategorieCoursId(rs.getInt("categorie_cours_id"));
                
                // Set updated_at if it exists
                try {
                    if (rs.getTimestamp("updated_at") != null) {
                        cours.setUpdatedAt(rs.getTimestamp("updated_at").toLocalDateTime());
                    }
                } catch (SQLException e) {
                    // Column might not exist in the table, ignore
                }
                
                // Set active status if it exists
                try {
                    cours.setActive(rs.getBoolean("active"));
                } catch (SQLException e) {
                    // Column might not exist in the table, ignore
                    cours.setActive(true); // Default to active
                }
                
                // Create and set the categorie
                CategorieCours categorie = new CategorieCours();
                categorie.setId(rs.getInt("categorie_cours_id"));
                categorie.setNom(rs.getString("categorie_nom"));
                cours.setCategorie(categorie);
                
                coursList.add(cours);
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours", e);
        }
        
        return coursList;
    }

    public boolean ajouter(Cours cours) {
        // Vérifier que tous les champs obligatoires sont présents
        if (cours.getTitre() == null || cours.getTitre().isEmpty()) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout du cours: Le titre est obligatoire");
            return false;
        }
        if (cours.getDescription() == null || cours.getDescription().isEmpty()) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout du cours: La description est obligatoire");
            return false;
        }
        if (cours.getDuree() == null || cours.getDuree().isEmpty()) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout du cours: La durée est obligatoire");
            return false;
        }
        if (cours.getNiveau() == null || cours.getNiveau().isEmpty()) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout du cours: Le niveau est obligatoire");
            return false;
        }
        if (cours.getCategorieCoursId() <= 0) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ajout du cours: La catégorie est obligatoire");
            return false;
        }

        LOGGER.info("Début de la procédure d'ajout du cours: " + cours.getTitre());
        
        String query = "INSERT INTO cours (titre, description, duree, niveau, categorie_cours_id, " +
                      "instructeur, image, pdf_filename, updated_at) " +
                      "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        Connection conn = null;
        PreparedStatement pstmt = null;
        ResultSet generatedKeys = null;
        
        try {
            // Obtenir une connexion
            conn = DatabaseConnection.getConnection();
            if (conn == null) {
                LOGGER.severe("Impossible d'établir une connexion à la base de données");
                return false;
            }
            
            // Créer la requête préparée
            pstmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS);
            
            // Définir les paramètres
            pstmt.setString(1, cours.getTitre());
            pstmt.setString(2, cours.getDescription());
            pstmt.setString(3, cours.getDuree());
            pstmt.setString(4, cours.getNiveau());
            pstmt.setInt(5, cours.getCategorieCoursId());
            pstmt.setString(6, cours.getInstructeur() != null ? cours.getInstructeur() : "");
            pstmt.setString(7, cours.getImage() != null ? cours.getImage() : "");
            pstmt.setString(8, cours.getPdfFilename() != null ? cours.getPdfFilename() : "");
            
            if (cours.getUpdatedAt() != null) {
                pstmt.setTimestamp(9, java.sql.Timestamp.valueOf(cours.getUpdatedAt()));
            } else {
                pstmt.setTimestamp(9, java.sql.Timestamp.valueOf(java.time.LocalDateTime.now()));
            }
            
            // Journaliser la requête
            LOGGER.info("Exécution de la requête d'ajout: " + pstmt.toString());
            
            // Exécuter la requête
            int affectedRows = pstmt.executeUpdate();
            LOGGER.info("Nombre de lignes affectées: " + affectedRows);
            
            if (affectedRows > 0) {
                // Récupérer l'ID généré
                generatedKeys = pstmt.getGeneratedKeys();
                if (generatedKeys.next()) {
                    int newId = generatedKeys.getInt(1);
                    cours.setId(newId);
                    LOGGER.info("Cours ajouté avec succès, ID: " + newId);
                    return true;
                } else {
                    LOGGER.warning("Aucun ID généré pour le nouveau cours");
                    return false;
                }
            } else {
                LOGGER.warning("Aucune ligne affectée lors de l'ajout du cours");
                return false;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur SQL lors de l'ajout du cours: " + e.getMessage(), e);
            LOGGER.log(Level.SEVERE, "État SQL: " + e.getSQLState() + ", Code erreur: " + e.getErrorCode());
            return false;
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Exception lors de l'ajout du cours", e);
            return false;
        } finally {
            // Fermer les ressources
            try {
                if (generatedKeys != null) generatedKeys.close();
                if (pstmt != null) pstmt.close();
                if (conn != null) DatabaseConnection.closeConnection(conn);
            } catch (SQLException e) {
                LOGGER.log(Level.WARNING, "Erreur lors de la fermeture des ressources", e);
            }
        }
    }

    public boolean modifier(Cours cours) {
        String query = "UPDATE cours SET titre = ?, description = ?, duree = ?, niveau = ?, " +
                      "categorie_cours_id = ?, instructeur = ?, image = ?, pdf_filename = ?, " +
                      "updated_at = ? WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setString(1, cours.getTitre());
            pstmt.setString(2, cours.getDescription());
            pstmt.setString(3, cours.getDuree());
            pstmt.setString(4, cours.getNiveau());
            pstmt.setInt(5, cours.getCategorieCoursId());
            pstmt.setString(6, cours.getInstructeur());
            pstmt.setString(7, cours.getImage());
            pstmt.setString(8, cours.getPdfFilename());
            pstmt.setTimestamp(9, java.sql.Timestamp.valueOf(java.time.LocalDateTime.now()));
            pstmt.setInt(10, cours.getId());
            
            int affectedRows = pstmt.executeUpdate();
            return affectedRows > 0;
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la modification du cours", e);
        }
        
        return false;
    }

    public boolean supprimer(Cours cours) {
        try {
            // First check if the course has any inscriptions
            String checkQuery = "SELECT COUNT(*) FROM inscription_cours WHERE cours_id = ?";
            try (Connection conn = DatabaseConnection.getConnection();
                 PreparedStatement checkStmt = conn.prepareStatement(checkQuery)) {
                
                checkStmt.setInt(1, cours.getId());
                ResultSet rs = checkStmt.executeQuery();
                
                if (rs.next() && rs.getInt(1) > 0) {
                    // Course has inscriptions - cannot delete
                    LOGGER.log(Level.WARNING, "Impossible de supprimer le cours car il a des inscriptions");
                    return false;
                }
            }
            
            // If no inscriptions, proceed with deletion
            String query = "DELETE FROM cours WHERE id = ?";
            try (Connection conn = DatabaseConnection.getConnection();
                 PreparedStatement pstmt = conn.prepareStatement(query)) {
                
                pstmt.setInt(1, cours.getId());
                
                int affectedRows = pstmt.executeUpdate();
                return affectedRows > 0;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la suppression du cours", e);
            return false;
        }
    }

    public boolean activerCours(Cours cours) {
        try {
            String query = "UPDATE cours SET active = true WHERE id = ?";
            try (Connection conn = DatabaseConnection.getConnection();
                 PreparedStatement pstmt = conn.prepareStatement(query)) {
                
                pstmt.setInt(1, cours.getId());
                
                int affectedRows = pstmt.executeUpdate();
                if (affectedRows > 0) {
                    cours.setActive(true);
                    return true;
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'activation du cours", e);
        }
        
        return false;
    }

    public boolean desactiverCours(Cours cours) {
        try {
            String query = "UPDATE cours SET active = false WHERE id = ?";
            try (Connection conn = DatabaseConnection.getConnection();
                 PreparedStatement pstmt = conn.prepareStatement(query)) {
                
                pstmt.setInt(1, cours.getId());
                
                int affectedRows = pstmt.executeUpdate();
                if (affectedRows > 0) {
                    cours.setActive(false);
                    return true;
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la désactivation du cours", e);
        }
        
        return false;
    }
    
    public List<Cours> rechercherParCategorie(int categorieId) {
        List<Cours> coursList = new ArrayList<>();
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "WHERE c.categorie_cours_id = ? " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, categorieId);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                while (rs.next()) {
                    Cours cours = new Cours();
                    cours.setId(rs.getInt("id"));
                    cours.setTitre(rs.getString("titre"));
                    cours.setDescription(rs.getString("description"));
                    cours.setDuree(rs.getString("duree"));
                    cours.setNiveau(rs.getString("niveau"));
                    cours.setInstructeur(rs.getString("instructeur"));
                    cours.setImage(rs.getString("image"));
                    cours.setPdfFilename(rs.getString("pdf_filename"));
                    cours.setCategorieCoursId(rs.getInt("categorie_cours_id"));
                    
                    // Set updated_at if it exists
                    try {
                        if (rs.getTimestamp("updated_at") != null) {
                            cours.setUpdatedAt(rs.getTimestamp("updated_at").toLocalDateTime());
                        }
                    } catch (SQLException e) {
                        // Column might not exist in the table, ignore
                    }
                    
                    // Set active status if it exists
                    try {
                        cours.setActive(rs.getBoolean("active"));
                    } catch (SQLException e) {
                        // Column might not exist in the table, ignore
                        cours.setActive(true); // Default to active
                    }
                    
                    // Create and set the categorie
                    CategorieCours categorie = new CategorieCours();
                    categorie.setId(rs.getInt("categorie_cours_id"));
                    categorie.setNom(rs.getString("categorie_nom"));
                    cours.setCategorie(categorie);
                    
                    coursList.add(cours);
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours par catégorie", e);
        }
        
        return coursList;
    }
    
    public Cours rechercherParId(int id) {
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "WHERE c.id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, id);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    Cours cours = new Cours();
                    cours.setId(rs.getInt("id"));
                    cours.setTitre(rs.getString("titre"));
                    cours.setDescription(rs.getString("description"));
                    cours.setDuree(rs.getString("duree"));
                    cours.setNiveau(rs.getString("niveau"));
                    cours.setInstructeur(rs.getString("instructeur"));
                    cours.setImage(rs.getString("image"));
                    cours.setPdfFilename(rs.getString("pdf_filename"));
                    cours.setCategorieCoursId(rs.getInt("categorie_cours_id"));
                    
                    // Set updated_at if it exists
                    try {
                        if (rs.getTimestamp("updated_at") != null) {
                            cours.setUpdatedAt(rs.getTimestamp("updated_at").toLocalDateTime());
                        }
                    } catch (SQLException e) {
                        // Column might not exist in the table, ignore
                    }
                    
                    // Set active status if it exists
                    try {
                        cours.setActive(rs.getBoolean("active"));
                    } catch (SQLException e) {
                        // Column might not exist in the table, ignore
                        cours.setActive(true); // Default to active
                    }
                    
                    // Create and set the categorie
                    CategorieCours categorie = new CategorieCours();
                    categorie.setId(rs.getInt("categorie_cours_id"));
                    categorie.setNom(rs.getString("categorie_nom"));
                    cours.setCategorie(categorie);
                    
                    return cours;
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement du cours par id", e);
        }
        
        return null;
    }

    public List<Cours> getAllCours() throws SQLException {
        List<Cours> coursList = new ArrayList<>();
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id " +
                      "ORDER BY c.titre";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                Cours cours = new Cours();
                cours.setId(rs.getInt("id"));
                cours.setTitre(rs.getString("titre"));
                cours.setDescription(rs.getString("description"));
                cours.setDuree(rs.getString("duree"));
                cours.setNiveau(rs.getString("niveau"));
                cours.setInstructeur(rs.getString("instructeur"));
                cours.setImage(rs.getString("image"));
                cours.setPdfFilename(rs.getString("pdf_filename"));
                cours.setCategorieCoursId(rs.getInt("categorie_cours_id"));
                
                // Set updated_at if it exists
                try {
                    if (rs.getTimestamp("updated_at") != null) {
                        cours.setUpdatedAt(rs.getTimestamp("updated_at").toLocalDateTime());
                    }
                } catch (SQLException e) {
                    // Column might not exist in the table, ignore
                }
                
                // Set active status if it exists
                try {
                    cours.setActive(rs.getBoolean("active"));
                } catch (SQLException e) {
                    // Column might not exist in the table, ignore
                    cours.setActive(true); // Default to active
                }
                
                // Create and set the categorie
                CategorieCours categorie = new CategorieCours();
                categorie.setId(rs.getInt("categorie_cours_id"));
                categorie.setNom(rs.getString("categorie_nom"));
                cours.setCategorie(categorie);
                
                coursList.add(cours);
            }
        }
        
        return coursList;
    }

    public boolean ajouterCoursTest() {
        String query = "INSERT INTO cours (titre, description, duree, niveau, categorie_cours_id, instructeur, image, pdf_filename, updated_at) " +
                      "VALUES ('Test Cours', 'Description test', '2h', 'Beginner', 4, 'Test Instructeur', '', '', NOW())";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement()) {
            
            LOGGER.info("Exécution de la requête de test: " + query);
            int affectedRows = stmt.executeUpdate(query);
            
            if (affectedRows > 0) {
                LOGGER.info("Cours de test ajouté avec succès");
                return true;
            } else {
                LOGGER.warning("Aucune ligne affectée lors de l'ajout du cours de test");
                return false;
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur SQL lors de l'ajout du cours de test: " + e.getMessage(), e);
            LOGGER.log(Level.SEVERE, "État SQL: " + e.getSQLState() + ", Code erreur: " + e.getErrorCode());
            return false;
        }
    }
}