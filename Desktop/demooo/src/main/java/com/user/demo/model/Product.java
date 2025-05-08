package com.user.demo.model;

/**
 * Model class for products
 */
public class Product {
    private int id;
    private String titre;
    private String description;
    private double prix;
    private int quantite;

    /**
     * Default constructor
     */
    public Product() {
    }

    /**
     * Constructor for new products (without ID)
     */
    public Product(String titre, String description, double prix, int quantite) {
        this.titre = titre;
        this.description = description;
        this.prix = prix;
        this.quantite = quantite;
    }

    /**
     * Constructor with all fields
     * 
     * @param id Product ID
     * @param titre Product title
     * @param description Product description
     * @param prix Product price
     * @param quantite Product quantity
     */
    public Product(int id, String titre, String description, double prix, int quantite) {
        this.id = id;
        this.titre = titre;
        this.description = description;
        this.prix = prix;
        this.quantite = quantite;
    }

    // Getters and setters

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public double getPrix() {
        return prix;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }

    public int getQuantite() {
        return quantite;
    }

    public void setQuantite(int quantite) {
        this.quantite = quantite;
    }
}