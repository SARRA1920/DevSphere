package com.user.demo.model;

import java.time.LocalDateTime;
import java.time.LocalDate;
import com.user.demo.model.CategorieCours;

public class Cours {
    private int id;
    private String titre;
    private String description;
    private String duree;
    private String niveau;
    private int categorieCoursId;
    private String instructeur;
    private String image;
    private String pdfFilename;
    private LocalDateTime updatedAt;
    private CategorieCours categorie;
    private boolean active;

    // Constructeurs
    public Cours() {
        this.active = true; // New courses are active by default
    }

    public Cours(int id, String titre, String description, String duree, String niveau, 
                int categorieCoursId, String instructeur, String image, String pdfFilename) {
        this.id = id;
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.niveau = niveau;
        this.categorieCoursId = categorieCoursId;
        this.instructeur = instructeur;
        this.image = image;
        this.pdfFilename = pdfFilename;
    }

    public Cours(int id, int categorieCoursId, String titre, String description, String duree, String niveau, String instructeur, String image, String pdfFilename, LocalDateTime updatedAt, CategorieCours categorie) {
        this.id = id;
        this.categorieCoursId = categorieCoursId;
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.niveau = niveau;
        this.instructeur = instructeur;
        this.image = image;
        this.pdfFilename = pdfFilename;
        this.updatedAt = updatedAt;
        this.categorie = categorie;
    }

    public Cours(int categorieCoursId, String titre, String description, String duree, String niveau, String instructeur, String image, String pdfFilename, LocalDateTime updatedAt, CategorieCours categorie) {
        this.categorieCoursId = categorieCoursId;
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.niveau = niveau;
        this.instructeur = instructeur;
        this.image = image;
        this.pdfFilename = pdfFilename;
        this.updatedAt = updatedAt;
        this.categorie = categorie;
    }

    // Constructor with categorie
    public Cours(String titre, String description, String duree, String niveau,
                int categorieCoursId, String instructeur, String image, String pdfFilename,
                LocalDateTime updatedAt, CategorieCours categorie) {
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.niveau = niveau;
        this.categorieCoursId = categorieCoursId;
        this.instructeur = instructeur;
        this.image = image;
        this.pdfFilename = pdfFilename;
        this.updatedAt = updatedAt;
        this.categorie = categorie;
    }

    // Getters et Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getCategorieCoursId() { return categorieCoursId; }
    public void setCategorieCoursId(int categorieCoursId) { this.categorieCoursId = categorieCoursId; }

    public String getTitre() { return titre; }
    public void setTitre(String titre) { this.titre = titre; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getDuree() { return duree; }
    public void setDuree(String duree) { this.duree = duree; }

    public String getNiveau() { return niveau; }
    public void setNiveau(String niveau) { this.niveau = niveau; }

    public String getInstructeur() { return instructeur; }
    public void setInstructeur(String instructeur) { this.instructeur = instructeur; }

    public String getImage() { return image; }
    public void setImage(String image) { this.image = image; }

    public String getPdfFilename() { return pdfFilename; }
    public void setPdfFilename(String pdfFilename) { this.pdfFilename = pdfFilename; }

    public LocalDateTime getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(LocalDateTime updatedAt) { this.updatedAt = updatedAt; }

    public CategorieCours getCategorie() { return categorie; }
    public void setCategorie(CategorieCours categorie) { this.categorie = categorie; }

    public boolean isActive() {
        return active;
    }

    public void setActive(boolean active) {
        this.active = active;
    }

    @Override
    public String toString() {
        return "Cours{" +
                "id=" + id +
                ", categorieCoursId=" + categorieCoursId +
                ", titre='" + titre + '\'' +
                ", description='" + description + '\'' +
                ", duree='" + duree + '\'' +
                ", niveau='" + niveau + '\'' +
                ", instructeur='" + instructeur + '\'' +
                ", image='" + image + '\'' +
                ", pdfFilename='" + pdfFilename + '\'' +
                ", updatedAt=" + updatedAt +
                ", categorie='" + categorie + '\'' +
                ", active=" + active +
                '}';
    }
}