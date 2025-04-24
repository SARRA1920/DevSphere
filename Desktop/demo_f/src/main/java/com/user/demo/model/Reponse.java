package com.user.demo.model;

import java.time.LocalDateTime;

/**
 * Model class for the Reponse entity
 */
public class Reponse {
    private int id;
    private LocalDateTime date;
    private String reponse;
    private Integer reclamationId;
    private String status;
    private Reclamation reclamation;

    public Reponse() {
        // Default constructor
    }

    public Reponse(int id, LocalDateTime date, String reponse, Integer reclamationId, String status) {
        this.id = id;
        this.date = date;
        this.reponse = reponse;
        this.reclamationId = reclamationId;
        this.status = status;
    }

    // Constructor without ID for new records
    public Reponse(LocalDateTime date, String reponse, Integer reclamationId, String status) {
        this.date = date;
        this.reponse = reponse;
        this.reclamationId = reclamationId;
        this.status = status;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public LocalDateTime getDate() {
        return date;
    }

    public void setDate(LocalDateTime date) {
        this.date = date;
    }

    public String getReponse() {
        return reponse;
    }

    public void setReponse(String reponse) {
        this.reponse = reponse;
    }
    
    public Integer getReclamationId() {
        return reclamationId;
    }
    
    public void setReclamationId(Integer reclamationId) {
        this.reclamationId = reclamationId;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public Reclamation getReclamation() {
        return reclamation;
    }

    public void setReclamation(Reclamation reclamation) {
        this.reclamation = reclamation;
        if (reclamation != null) {
            this.reclamationId = reclamation.getId();
        }
    }

    // Alias method for AdminResponseController compatibility
    public String getResponseText() {
        return getReponse();
    }

    @Override
    public String toString() {
        return "Reponse{" +
                "id=" + id +
                ", date=" + date +
                ", reponse='" + reponse + '\'' +
                ", reclamationId=" + reclamationId +
                ", status='" + status + '\'' +
                '}';
    }
}