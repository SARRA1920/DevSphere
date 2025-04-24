package com.user.demo.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 * Class representing an activity record for the dashboard
 */
public class ActivityRecord {
    private final StringProperty date;
    private final StringProperty type;
    private final StringProperty description;
    private final StringProperty status;
    
    /**
     * Create a new activity record
     * 
     * @param date The date of the activity
     * @param type The type of activity
     * @param description A description of the activity
     * @param status The status of the activity
     */
    public ActivityRecord(String date, String type, String description, String status) {
        this.date = new SimpleStringProperty(date);
        this.type = new SimpleStringProperty(type);
        this.description = new SimpleStringProperty(description);
        this.status = new SimpleStringProperty(status);
    }
    
    // Date property
    public String getDate() {
        return date.get();
    }
    
    public void setDate(String date) {
        this.date.set(date);
    }
    
    public StringProperty dateProperty() {
        return date;
    }
    
    // Type property
    public String getType() {
        return type.get();
    }
    
    public void setType(String type) {
        this.type.set(type);
    }
    
    public StringProperty typeProperty() {
        return type;
    }
    
    // Description property
    public String getDescription() {
        return description.get();
    }
    
    public void setDescription(String description) {
        this.description.set(description);
    }
    
    public StringProperty descriptionProperty() {
        return description;
    }
    
    // Status property
    public String getStatus() {
        return status.get();
    }
    
    public void setStatus(String status) {
        this.status.set(status);
    }
    
    public StringProperty statusProperty() {
        return status;
    }
    
    @Override
    public String toString() {
        return "ActivityRecord{" +
                "date=" + getDate() +
                ", type=" + getType() +
                ", description=" + getDescription() +
                ", status=" + getStatus() +
                '}';
    }
}