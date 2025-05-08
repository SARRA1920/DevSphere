package com.user.demo.model;

import java.util.Date;

public class Achat {
    private int id;
    private int idProduit;
    private int userId;
    private Date dateAchat;

    public Achat(int id, int idProduit, int userId, Date dateAchat) {
        this.id = id;
        this.idProduit = idProduit;
        this.userId = userId;
        this.dateAchat = dateAchat;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getIdProduit() {
        return idProduit;
    }

    public void setIdProduit(int idProduit) {
        this.idProduit = idProduit;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public Date getDateAchat() {
        return dateAchat;
    }

    public void setDateAchat(Date dateAchat) {
        this.dateAchat = dateAchat;
    }
}