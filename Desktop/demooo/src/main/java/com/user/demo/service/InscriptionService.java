package com.user.demo.service;

import com.user.demo.model.Cours;
import com.user.demo.model.Inscription;
import com.user.demo.util.DataSource;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class InscriptionService {
    private Connection conn;
    private PreparedStatement pst;
    private final CoursService coursService = new CoursService();

    public InscriptionService() {
        try {
            conn = DataSource.getInstance().getConnection();
        } catch (SQLException e) {
            System.err.println("Erreur de connexion à la base de données: " + e.getMessage());
        }
    }

    public void ajouter(Inscription inscription) {
        String req = "INSERT INTO inscription_cours (cours_id, user_id, nom, email, telephone, created_at, date_inscription, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, inscription.getCoursId());
            pst.setInt(2, inscription.getUserId());
            pst.setString(3, inscription.getNom());
            pst.setString(4, inscription.getEmail());
            pst.setString(5, inscription.getTelephone());
            
            if (inscription.getCreatedAt() != null) {
                pst.setTimestamp(6, Timestamp.valueOf(inscription.getCreatedAt()));
            } else {
                pst.setNull(6, Types.TIMESTAMP);
            }
            
            if (inscription.getDateInscription() != null) {
                pst.setTimestamp(7, Timestamp.valueOf(inscription.getDateInscription()));
            } else {
                pst.setNull(7, Types.TIMESTAMP);
            }
            
            pst.setString(8, inscription.getStatut());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.err.println("Erreur lors de l'ajout de l'inscription: " + e.getMessage());
        }
    }

    public void modifier(Inscription inscription) {
        String req = "UPDATE inscription_cours SET cours_id=?, user_id=?, nom=?, email=?, telephone=?, date_inscription=?, statut=? WHERE id=?";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, inscription.getCoursId());
            pst.setInt(2, inscription.getUserId());
            pst.setString(3, inscription.getNom());
            pst.setString(4, inscription.getEmail());
            pst.setString(5, inscription.getTelephone());
            
            if (inscription.getDateInscription() != null) {
                pst.setTimestamp(6, Timestamp.valueOf(inscription.getDateInscription()));
            } else {
                pst.setNull(6, Types.TIMESTAMP);
            }
            
            pst.setString(7, inscription.getStatut());
            pst.setInt(8, inscription.getId());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.err.println("Erreur lors de la modification de l'inscription: " + e.getMessage());
        }
    }

    public void supprimer(Inscription inscription) {
        String req = "DELETE FROM inscription_cours WHERE id=?";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, inscription.getId());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.err.println("Erreur lors de la suppression de l'inscription: " + e.getMessage());
        }
    }

    public List<Inscription> afficher() {
        List<Inscription> list = new ArrayList<>();
        String req = "SELECT id, cours_id, user_id, nom, email, telephone, " +
                    "NULLIF(created_at, '0000-00-00 00:00:00') as created_at, " +
                    "NULLIF(date_inscription, '0000-00-00 00:00:00') as date_inscription, " +
                    "statut FROM inscription_cours";
        try {
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(req);
            
            while (rs.next()) {
                try {
                    Timestamp createdAt = rs.getTimestamp("created_at");
                    Timestamp dateInscription = rs.getTimestamp("date_inscription");
                    
                    Inscription inscription = new Inscription(
                        rs.getInt("id"),
                        rs.getInt("cours_id"),
                        rs.getInt("user_id"),
                        rs.getString("nom"),
                        rs.getString("email"),
                        rs.getString("telephone"),
                        createdAt != null ? createdAt.toLocalDateTime() : null,
                        dateInscription != null ? dateInscription.toLocalDateTime() : null,
                        rs.getString("statut")
                    );
                    
                    // Charger le cours associé
                    for (Cours cours : coursService.rechercher()) {
                        if (cours.getId() == inscription.getCoursId()) {
                            inscription.setCours(cours);
                            break;
                        }
                    }
                    
                    list.add(inscription);
                } catch (SQLException e) {
                    System.err.println("Erreur lors de la lecture d'une inscription: " + e.getMessage());
                    // Continue to next record
                    continue;
                }
            }
        } catch (SQLException e) {
            System.err.println("Erreur lors de la récupération des inscriptions: " + e.getMessage());
        }
        return list;
    }
}