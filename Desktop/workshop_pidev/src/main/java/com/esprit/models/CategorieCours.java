package com.esprit.models;

public class CategorieCours {
    private int id;
    private String nom;
    private String description;
    private String niveau;

    public CategorieCours() {}

    public CategorieCours(int id, String nom, String description, String niveau) {
        this.id = id;
        this.nom = nom;
        this.description = description;
        this.niveau = niveau;
    }

    public CategorieCours(String nom, String description, String niveau) {
        this.nom = nom;
        this.description = description;
        this.niveau = niveau;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getNiveau() {
        return niveau;
    }

    public void setNiveau(String niveau) {
        this.niveau = niveau;
    }

    @Override
    public String toString() {
        return "CategorieCours{" +
                "id=" + id +
                ", nom='" + nom + '\'' +
                ", description='" + description + '\'' +
                ", niveau='" + niveau + '\'' +
                '}';
    }
}