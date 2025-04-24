package com.esprit.models;

import java.time.LocalDateTime;

public class Inscription {
    private int id;
    private int coursId;
    private int userId;
    private String nom;
    private String email;
    private String telephone;
    private LocalDateTime createdAt;
    private LocalDateTime dateInscription;
    private String statut;
    private Cours cours;

    public Inscription() {}

    public Inscription(int id, int coursId, int userId, String nom, String email, String telephone, LocalDateTime createdAt, LocalDateTime dateInscription, String statut) {
        this.id = id;
        this.coursId = coursId;
        this.userId = userId;
        this.nom = nom;
        this.email = email;
        this.telephone = telephone;
        this.createdAt = createdAt;
        this.dateInscription = dateInscription;
        this.statut = statut;
    }

    public Inscription(int coursId, int userId, String nom, String email, String telephone, LocalDateTime createdAt, LocalDateTime dateInscription, String statut) {
        this.coursId = coursId;
        this.userId = userId;
        this.nom = nom;
        this.email = email;
        this.telephone = telephone;
        this.createdAt = createdAt;
        this.dateInscription = dateInscription;
        this.statut = statut;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getCoursId() {
        return coursId;
    }

    public void setCoursId(int coursId) {
        this.coursId = coursId;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public LocalDateTime getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(LocalDateTime createdAt) {
        this.createdAt = createdAt;
    }

    public LocalDateTime getDateInscription() {
        return dateInscription;
    }

    public void setDateInscription(LocalDateTime dateInscription) {
        this.dateInscription = dateInscription;
    }

    public String getStatut() {
        return statut;
    }

    public void setStatut(String statut) {
        this.statut = statut;
    }

    public Cours getCours() {
        return cours;
    }

    public void setCours(Cours cours) {
        this.cours = cours;
        if (cours != null) {
            this.coursId = cours.getId();
        }
    }

    @Override
    public String toString() {
        return "InscriptionCours{" +
                "id=" + id +
                ", coursId=" + coursId +
                ", userId=" + userId +
                ", nom='" + nom + '\'' +
                ", email='" + email + '\'' +
                ", telephone='" + telephone + '\'' +
                ", createdAt=" + createdAt +
                ", dateInscription=" + dateInscription +
                ", statut='" + statut + '\'' +
                ", cours=" + cours +
                '}';
    }
}