// Package declaration for organizing classes
package com.user.demo.service;

// Import necessary classes

import com.user.demo.model.Event;
import com.user.demo.util.DBconnexion;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

// Public class EventService implementing a generic CRUD interface for Event
public class EventService implements ICrud<Event> {

    Connection cnx2; // Connection object to interact with the database

    // Constructor: initializes the database connection
    public EventService() {
        cnx2 = DBconnexion.getInstance().getCnx(); // Get DB connection from singleton class
    }

    // Method to select a single event by its ID and return a ResultSet
    public ResultSet SelectionnerSingle(int id) {
        ResultSet rs = null; // Initialize ResultSet
        try {
            // SQL query to select an event with a specific ID
            String req = "SELECT * FROM `events` WHERE `id` = ?";
            PreparedStatement st = cnx2.prepareStatement(req); // Prepare the statement
            st.setInt(1, id); // Bind the event ID to the placeholder
            rs = st.executeQuery(); // Execute the query and store result in ResultSet
        } catch (SQLException ex) {
            System.err.println(ex.getMessage()); // Print SQL error message
        }
        return rs; // Return the result
    }

    // Method to add a new event to the database
    @Override
    public void ajouterEntite(Event e) {
        // SQL INSERT query with placeholders
        String req = "INSERT INTO `events` (`titre`, `type`, `capacity`, `date`, `location`) VALUES (?, ?, ?, ?, ?)";
        try {
            PreparedStatement st = cnx2.prepareStatement(req); // Prepare the statement
            st.setString(1, e.getTitre()); // Set title
            st.setString(2, e.getType()); // Set type
            st.setInt(3, e.getCapacity()); // Set capacity
            // Convert java.util.Date to java.sql.Timestamp for the DB
            st.setTimestamp(4, new Timestamp(e.getDate().getTime()));
            st.setString(5, e.getLocation()); // Set location
            st.executeUpdate(); // Execute the insert
            System.out.println("Événement ajouté avec succès."); // Confirm insertion
        } catch (SQLException ex) {
            System.err.println(ex.getMessage()); // Print SQL error
        }
    }

    // Method to retrieve and return all events as a list
    @Override
    public List<Event> afficherEntite() {
        List<Event> list = new ArrayList<>(); // Initialize empty list
        String req = "SELECT * FROM `events`"; // SQL SELECT query
        try {
            PreparedStatement st = cnx2.prepareStatement(req); // Prepare statement
            ResultSet rs = st.executeQuery(); // Execute query
            while (rs.next()) { // Loop through all rows
                // Create new Event object from each row
                Event e = new Event(
                        rs.getInt("id"),
                        rs.getString("titre"),
                        rs.getString("type"),
                        rs.getInt("capacity"),
                        rs.getTimestamp("date"),
                        rs.getString("location")
                );
                list.add(e); // Add event to the list
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage()); // Print SQL error
        }
        return list; // Return the list of events
    }

    // Method to update an existing event in the database
    @Override
    public void modifierEntite(Event e) {
        // SQL UPDATE query with placeholders
        String req = "UPDATE `events` SET `titre` = ?, `type` = ?, `capacity` = ?, `date` = ?, `location` = ? WHERE `id` = ?";
        try {
            PreparedStatement st = cnx2.prepareStatement(req); // Prepare statement
            st.setString(1, e.getTitre()); // Set title
            st.setString(2, e.getType()); // Set type
            st.setInt(3, e.getCapacity()); // Set capacity
            st.setTimestamp(4, new Timestamp(e.getDate().getTime())); // Set date
            st.setString(5, e.getLocation()); // Set location
            st.setInt(6, e.getId()); // Set ID for WHERE clause
            int rowsAffected = st.executeUpdate(); // Execute update
            if (rowsAffected > 0) {
                System.out.println("Modification réussie"); // Success message
            } else {
                System.out.println("Aucune modification effectuée. Vérifiez l'ID."); // No update done
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage()); // Print SQL error
        }
    }

    // Method to delete an event from the database
    @Override
    public void supprimerEntite(Event e) {
        // SQL DELETE query with a placeholder for ID
        String req = "DELETE FROM `events` WHERE `id` = ?";
        try {
            PreparedStatement st = cnx2.prepareStatement(req); // Prepare statement
            st.setInt(1, e.getId()); // Bind the ID
            int rowsAffected = st.executeUpdate(); // Execute deletion
            if (rowsAffected > 0) {
                System.out.println("Suppression réussie"); // Deletion successful
            } else {
                System.out.println("Aucune suppression effectuée. Vérifiez l'ID."); // No deletion done
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage()); // Print SQL error
        }
    }

    // Method to return all events as a ResultSet (alternative to List)
    public ResultSet Getall() {
        ResultSet rs = null; // Initialize ResultSet
        try {
            String req = "SELECT * FROM events"; // SQL SELECT query
            PreparedStatement st = cnx2.prepareStatement(req); // Prepare statement
            rs = st.executeQuery(req); // Execute query and store results
        } catch (SQLException ex) {
            System.err.println(ex.getMessage()); // Print SQL error
        }
        return rs; // Return the result
    }

}
