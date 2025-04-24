package com.user.demo.model;

import java.time.LocalDateTime;

/**
 * Model class for the Reclamation entity
 */
public class Reclamation {
    private int id;
    private int userId;
    private Integer reponseId; // Nullable foreign key
    private String type;
    private LocalDateTime date;
    private LocalDateTime createdAt;
    private String reclamation;
    private String description;
    private String status;
    private Reponse reponse; // Associated reponse object

    public Reclamation() {
        // Default constructor
    }

    public Reclamation(int id, int userId, Integer reponseId, String type, LocalDateTime date, String reclamation) {
        this.id = id;
        this.userId = userId;
        this.reponseId = reponseId;
        this.type = type;
        this.date = date;
        this.createdAt = LocalDateTime.now();
        this.reclamation = reclamation;
    }

    // Constructor without ID for new records
    public Reclamation(int userId, String type, LocalDateTime date, String reclamation) {
        this.userId = userId;
        this.type = type;
        this.date = date;
        this.createdAt = LocalDateTime.now();
        this.reclamation = reclamation;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public Integer getReponseId() {
        return reponseId;
    }

    public void setReponseId(Integer reponseId) {
        this.reponseId = reponseId;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public LocalDateTime getDate() {
        return date;
    }

    public void setDate(LocalDateTime date) {
        this.date = date;
    }

    public String getReclamation() {
        return reclamation;
    }

    public void setReclamation(String reclamation) {
        this.reclamation = reclamation;
    }

    public Reponse getReponse() {
        return reponse;
    }

    public void setReponse(Reponse reponse) {
        this.reponse = reponse;
        if (reponse != null) {
            this.reponseId = reponse.getId();
        }
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public LocalDateTime getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(LocalDateTime createdAt) {
        this.createdAt = createdAt;
    }

    @Override
    public String toString() {
        return "Reclamation{" +
                "id=" + id +
                ", type='" + type + '\'' +
                ", date=" + date +
                ", reclamation='" + reclamation + '\'' +
                '}';
    }
}