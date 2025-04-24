package com.esprit.models;

import java.time.LocalDateTime;

public class Cours {
    private int id;
    private int categorieCoursId;
    private String titre;
    private String description;
    private String duree;
    private String niveau;
    private String instructeur;
    private String image;
    private String pdfFilename;
    private LocalDateTime updatedAt;

    // Constructeurs
    public Cours() {}

    public Cours(int id, int categorieCoursId, String titre, String description, String duree, String niveau, String instructeur, String image, String pdfFilename, LocalDateTime updatedAt) {
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
    }

    public Cours(int categorieCoursId, String titre, String description, String duree, String niveau, String instructeur, String image, String pdfFilename, LocalDateTime updatedAt) {
        this.categorieCoursId = categorieCoursId;
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.niveau = niveau;
        this.instructeur = instructeur;
        this.image = image;
        this.pdfFilename = pdfFilename;
        this.updatedAt = updatedAt;
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
                '}';
    }
}