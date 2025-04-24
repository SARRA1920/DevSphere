package com.esprit.services;

import com.esprit.models.Cours;
import com.esprit.utils.DataSource;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CoursService {
    private Connection conn;
    private PreparedStatement pst;

    public CoursService() {
        conn = DataSource.getInstance().getConnection();
    }

    public void ajouter(Cours cours) {
        String req = "INSERT INTO cours (categorie_cours_id, titre, description, duree, niveau, instructeur, image, pdf_filename, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, cours.getCategorieCoursId());
            pst.setString(2, cours.getTitre());
            pst.setString(3, cours.getDescription());
            pst.setString(4, cours.getDuree());
            pst.setString(5, cours.getNiveau());
            pst.setString(6, cours.getInstructeur());
            pst.setString(7, cours.getImage());
            pst.setString(8, cours.getPdfFilename());
            pst.setTimestamp(9, Timestamp.valueOf(cours.getUpdatedAt()));
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public void modifier(Cours cours) {
        String req = "UPDATE cours SET categorie_cours_id=?, titre=?, description=?, duree=?, niveau=?, instructeur=?, image=?, pdf_filename=?, updated_at=? WHERE id=?";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, cours.getCategorieCoursId());
            pst.setString(2, cours.getTitre());
            pst.setString(3, cours.getDescription());
            pst.setString(4, cours.getDuree());
            pst.setString(5, cours.getNiveau());
            pst.setString(6, cours.getInstructeur());
            pst.setString(7, cours.getImage());
            pst.setString(8, cours.getPdfFilename());
            pst.setTimestamp(9, Timestamp.valueOf(cours.getUpdatedAt()));
            pst.setInt(10, cours.getId());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public void supprimer(Cours cours) {
        String req = "DELETE FROM cours WHERE id=?";
        try {
            pst = conn.prepareStatement(req);
            pst.setInt(1, cours.getId());
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public List<Cours> afficher() {
        List<Cours> list = new ArrayList<>();
        String req = "SELECT * FROM cours";
        try {
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(req);
            while (rs.next()) {
                list.add(new Cours(
                    rs.getInt("id"),
                    rs.getInt("categorie_cours_id"),
                    rs.getString("titre"),
                    rs.getString("description"),
                    rs.getString("duree"),
                    rs.getString("niveau"),
                    rs.getString("instructeur"),
                    rs.getString("image"),
                    rs.getString("pdf_filename"),
                    rs.getTimestamp("updated_at").toLocalDateTime()
                ));
            }
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
        return list;
    }

    public List<Cours> rechercher() {
        List<Cours> list = new ArrayList<>();
        String req = "SELECT * FROM cours";
        try {
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(req);
            while (rs.next()) {
                list.add(new Cours(
                    rs.getInt("id"),
                    rs.getInt("categorie_cours_id"),
                    rs.getString("titre"),
                    rs.getString("description"),
                    rs.getString("duree"),
                    rs.getString("niveau"),
                    rs.getString("instructeur"),
                    rs.getString("image"),
                    rs.getString("pdf_filename"),
                    rs.getTimestamp("updated_at").toLocalDateTime()
                ));
            }
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
        return list;
    }
}