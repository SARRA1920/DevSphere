package com.esprit.services;

import com.esprit.models.CategorieCours;
import com.esprit.utils.DataSource;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CategorieCoursService implements IService<CategorieCours> {

    Connection connection = DataSource.getInstance().getConnection();

    @Override
    public void ajouter(CategorieCours categorie) {
        String req = "INSERT INTO categorie_cours (nom, description, niveau) VALUES (?, ?, ?)";
        try {
            PreparedStatement ps = connection.prepareStatement(req);
            ps.setString(1, categorie.getNom());
            ps.setString(2, categorie.getDescription());
            ps.setString(3, categorie.getNiveau());
            ps.executeUpdate();
            System.out.println("Catégorie ajoutée avec succès !");
        } catch (SQLException e) {
            System.out.println("Erreur d'ajout catégorie : " + e.getMessage());
        }
    }

    @Override
    public void modifier(CategorieCours categorie) {
        String req = "UPDATE categorie_cours SET nom=?, description=?, niveau=? WHERE id=?";
        try {
            PreparedStatement ps = connection.prepareStatement(req);
            ps.setString(1, categorie.getNom());
            ps.setString(2, categorie.getDescription());
            ps.setString(3, categorie.getNiveau());
            ps.setInt(4, categorie.getId());
            ps.executeUpdate();
            System.out.println("Catégorie modifiée avec succès !");
        } catch (SQLException e) {
            System.out.println("Erreur de modification : " + e.getMessage());
        }
    }

    @Override
    public void supprimer(CategorieCours categorie) {
        String req = "DELETE FROM categorie_cours WHERE id=?";
        try {
            PreparedStatement ps = connection.prepareStatement(req);
            ps.setInt(1, categorie.getId());
            ps.executeUpdate();
            System.out.println("Catégorie supprimée !");
        } catch (SQLException e) {
            System.out.println("Erreur de suppression : " + e.getMessage());
        }
    }

    @Override
    public List<CategorieCours> rechercher() {
        List<CategorieCours> list = new ArrayList<>();
        String req = "SELECT * FROM categorie_cours";
        try {
            Statement st = connection.createStatement();
            ResultSet rs = st.executeQuery(req);

            while (rs.next()) {
                CategorieCours categorie = new CategorieCours(
                        rs.getInt("id"),
                        rs.getString("nom"),
                        rs.getString("description"),
                        rs.getString("niveau")
                );
                list.add(categorie);
            }
        } catch (SQLException e) {
            System.out.println("Erreur récupération : " + e.getMessage());
        }
        return list;
    }

    public List<CategorieCours> afficher() {
        return rechercher();
    }
}