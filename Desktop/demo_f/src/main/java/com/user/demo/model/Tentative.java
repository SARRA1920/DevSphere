package com.user.demo.model;

import java.time.LocalDateTime;

public class Tentative {
    private int id;
    private int user_id;
    private int exercice_id;
    private int score;
    private String reponse;
    private LocalDateTime date;
    private String statut;
    private double note;
    private Exercice exercice;
    
    // Constructeur par défaut
    public Tentative() {
    }
    
    // Constructeur avec paramètres
    public Tentative(int id, int user_id, int exercice_id, int score, String reponse, 
                    LocalDateTime date, String statut, double note) {
        this.id = id;
        this.user_id = user_id;
        this.exercice_id = exercice_id;
        this.score = score;
        this.reponse = reponse;
        this.date = date;
        this.statut = statut;
        this.note = note;
    }
    
    // Getters et Setters
    public int getId() {
        return id;
    }
    
    public void setId(int id) {
        this.id = id;
    }
    
    public int getUser_id() {
        return user_id;
    }
    
    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }
    
    public int getExercice_id() {
        return exercice_id;
    }
    
    public void setExercice_id(int exercice_id) {
        this.exercice_id = exercice_id;
    }
    
    public int getScore() {
        return score;
    }
    
    public void setScore(int score) {
        this.score = score;
    }
    
    public String getReponse() {
        return reponse;
    }
    
    public void setReponse(String reponse) {
        this.reponse = reponse;
    }
    
    public LocalDateTime getDate() {
        return date;
    }
    
    public void setDate(LocalDateTime date) {
        this.date = date;
    }
    
    public String getStatut() {
        return statut;
    }
    
    public void setStatut(String statut) {
        this.statut = statut;
    }
    
    // Pour la compatibilité avec le code existant
    public String getStatue() {
        return getStatut();
    }
    
    public void setStatue(String statue) {
        setStatut(statue);
    }
    
    public double getNote() {
        return note;
    }
    
    public void setNote(double note) {
        this.note = note;
    }
    
    // Méthodes pour gérer la relation avec Exercice
    public Exercice getExercice() {
        return exercice;
    }
    
    public void setExercice(Exercice exercice) {
        this.exercice = exercice;
        if (exercice != null) {
            this.exercice_id = exercice.getId();
        }
    }
    
    @Override
    public String toString() {
        return "Tentative{" +
                "id=" + id +
                ", user_id=" + user_id +
                ", exercice_id=" + exercice_id +
                ", score=" + score +
                ", reponse='" + reponse + '\'' +
                ", date=" + date +
                ", statut='" + statut + '\'' +
                ", note=" + note +
                '}';
    }
}

