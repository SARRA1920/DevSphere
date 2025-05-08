package com.user.demo.model;

import javafx.beans.property.*;

public class User {
    private final IntegerProperty id = new SimpleIntegerProperty();
    private final StringProperty name = new SimpleStringProperty();
    private final StringProperty email = new SimpleStringProperty();
    private final StringProperty password = new SimpleStringProperty();
    private final IntegerProperty phone = new SimpleIntegerProperty();
    private final IntegerProperty cin = new SimpleIntegerProperty();
    private final StringProperty image = new SimpleStringProperty();
    private final StringProperty role = new SimpleStringProperty();
    
    // Constructors
    public User() {
    }
    
    public User(int id, String name, String email, String password, int phone, int cin, String image, String role) {
        setId(id);
        setName(name);
        setEmail(email);
        setPassword(password);
        setPhone(phone);
        setCin(cin);
        setImage(image);
        setRole(role);
    }
    
    // Constructor without ID for creating new users
    public User(String name, String email, String password, int phone, int cin, String image, String role) {
        setName(name);
        setEmail(email);
        setPassword(password);
        setPhone(phone);
        setCin(cin);
        setImage(image);
        setRole(role);
    }
    
    // Property getters
    public StringProperty nameProperty() {
        return name;
    }
    
    public StringProperty emailProperty() {
        return email;
    }
    
    public StringProperty roleProperty() {
        return role;
    }

    // Standard getters and setters
    public int getId() {
        return id.get();
    }
    
    public void setId(int id) {
        this.id.set(id);
    }
    
    public String getName() {
        return name.get();
    }
    
    public void setName(String name) {
        this.name.set(name);
    }
    
    // Username alias methods for compatibility
    public String getUsername() {
        return getName();
    }
    
    public void setUsername(String username) {
        setName(username);
    }
    
    public String getEmail() {
        return email.get();
    }
    
    public void setEmail(String email) {
        this.email.set(email);
    }
    
    public String getPassword() {
        return password.get();
    }
    
    public void setPassword(String password) {
        this.password.set(password);
    }
    
    public int getPhone() {
        return phone.get();
    }
    
    public void setPhone(int phone) {
        this.phone.set(phone);
    }
    
    public int getCin() {
        return cin.get();
    }
    
    public void setCin(int cin) {
        this.cin.set(cin);
    }
    
    public String getImage() {
        return image.get();
    }
    
    public void setImage(String image) {
        this.image.set(image);
    }
    
    public String getRole() {
        return role.get();
    }
    
    public void setRole(String role) {
        this.role.set(role);
    }

    @Override
    public String toString() {
        return "User{" +
                "id=" + getId() +
                ", name='" + getName() + '\'' +
                ", email='" + getEmail() + '\'' +
                ", phone=" + getPhone() +
                ", cin=" + getCin() +
                ", image='" + getImage() + '\'' +
                ", role='" + getRole() + '\'' +
                '}';
    }
}