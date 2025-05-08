package com.user.demo.model;

import java.util.Date;

public class Event {
    private int id  ;
    private String titre  ;
    private String type ;
    private int capacity ;
    private Date date ;
    private String location ;

    public Event() {
    }

    public Event(String titre, String type, int capacity, Date date, String location) {
        this.titre = titre;
        this.type = type;
        this.capacity = capacity;
        this.date = date;
        this.location = location;
    }

    public Event(int id, String titre, String type, int capacity, Date date, String location) {
        this.id = id;
        this.titre = titre;
        this.type = type;
        this.capacity = capacity;
        this.date = date;
        this.location = location;
    }

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

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public int getCapacity() {
        return capacity;
    }

    public void setCapacity(int capacity) {
        this.capacity = capacity;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getLocation() {
        return location;
    }

    public void setLocation(String location) {
        this.location = location;
    }

    @Override
    public String toString() {
        return "Event{" +
                "id=" + id +
                ", nom='" + titre + '\'' +
                '}';
    }

}
