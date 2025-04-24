package com.esprit.services;

import com.esprit.models.Cours;
import com.esprit.models.Inscription;
import com.esprit.utils.DataSource;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class InscriptionService {
    private Connection conn;
    private PreparedStatement pst;
    private final CoursService coursService;

    public InscriptionService() {
        conn = DataSource.getInstance().getConnection();
        coursService = new CoursService();
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
            pst.setTimestamp(6, Timestamp.valueOf(inscription.getCreatedAt()));
            pst.setTimestamp(7, Timestamp.valueOf(inscription.getDateInscription()));
            pst.setString(8, inscription.getStatut());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
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
            pst.setTimestamp(6, Timestamp.valueOf(inscription.getDateInscription()));
            pst.setString(7, inscription.getStatut());
            pst.setInt(8, inscription.getId());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public void supprimer(Inscription inscription) {
        String req = "DELETE FROM inscription_cours WHERE id=?";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, inscription.getId());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public List<Inscription> afficher() {
        List<Inscription> list = new ArrayList<>();
        String req = "SELECT * FROM inscription_cours";
        try {
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(req);
            while (rs.next()) {
                Inscription inscription = new Inscription(
                    rs.getInt("id"),
                    rs.getInt("cours_id"),
                    rs.getInt("user_id"),
                    rs.getString("nom"),
                    rs.getString("email"),
                    rs.getString("telephone"),
                    rs.getTimestamp("created_at").toLocalDateTime(),
                    rs.getTimestamp("date_inscription").toLocalDateTime(),
                    rs.getString("statut")
                );
                // Charger le cours associé
                for (Cours cours : coursService.afficher()) {
                    if (cours.getId() == inscription.getCoursId()) {
                        inscription.setCours(cours);
                        break;
                    }
                }
                list.add(inscription);
            }
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
        return list;
    }
}