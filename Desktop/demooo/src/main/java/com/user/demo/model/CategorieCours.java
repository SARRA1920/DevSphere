package com.user.demo.model;

/**
 * Classe modèle pour les catégories de cours
 */
public class CategorieCours {
    private int id;
    private String nom;
    private String description;
    private String niveau = "Beginner"; // Valeur par défaut
    private boolean active = true; // Par défaut, une catégorie est active

    /**
     * Constructeur par défaut
     */
    public CategorieCours() {
    }

    /**
     * Constructeur avec nom et description
     * @param nom Le nom de la catégorie
     * @param description La description de la catégorie
     */
    public CategorieCours(String nom, String description) {
        this.nom = nom;
        this.description = description;
    }

    /**
     * Constructeur complet
     * @param id L'identifiant de la catégorie
     * @param nom Le nom de la catégorie
     * @param description La description de la catégorie
     * @param niveau Le niveau de la catégorie
     * @param active Indique si la catégorie est active
     */
    public CategorieCours(int id, String nom, String description, String niveau, boolean active) {
        this.id = id;
        this.nom = nom;
        this.description = description;
        this.niveau = niveau;
        this.active = active;
    }

    /**
     * @return l'identifiant de la catégorie
     */
    public int getId() {
        return id;
    }

    /**
     * @param id l'identifiant à définir
     */
    public void setId(int id) {
        this.id = id;
    }

    /**
     * @return le nom de la catégorie
     */
    public String getNom() {
        return nom;
    }

    /**
     * @param nom le nom à définir
     */
    public void setNom(String nom) {
        this.nom = nom;
    }

    /**
     * @return la description de la catégorie
     */
    public String getDescription() {
        return description;
    }

    /**
     * @param description la description à définir
     */
    public void setDescription(String description) {
        this.description = description;
    }

    /**
     * @return le niveau de la catégorie
     */
    public String getNiveau() {
        return niveau;
    }

    /**
     * @param niveau le niveau à définir
     */
    public void setNiveau(String niveau) {
        this.niveau = niveau;
    }

    /**
     * @return true si la catégorie est active, false sinon
     */
    public boolean isActive() {
        return active;
    }

    /**
     * @param active définit si la catégorie est active
     */
    public void setActive(boolean active) {
        this.active = active;
    }

    @Override
    public String toString() {
        return "CategorieCours{" +
                "id=" + id +
                ", nom='" + nom + '\'' +
                ", description='" + description + '\'' +
                ", niveau='" + niveau + '\'' +
                ", active=" + active +
                '}';
    }
}