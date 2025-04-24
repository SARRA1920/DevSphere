// Package declaration indicating this class belongs to the 'org.example.service' package
package com.user.demo.service;

// Importing necessary classes for database operations and data handling
import com.user.demo.model.Participation;
import com.user.demo.util.DBconnexion;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

// Class declaration: ParticipationService implements a generic ICrud interface for Participation entities
public class ParticipationService implements ICrud<Participation> {

    // Database connection object
    Connection cnx2;

    // Constructor: initializes the connection using a singleton DBconnexion instance
    public ParticipationService() {
        cnx2 = DBconnexion.getInstance().getCnx();
    }

    // Method to select a single participation record by its ID
    public ResultSet SelectionnerSingle(int id) {
        ResultSet rs = null; // To hold the query result
        try {
            // SQL query to get a participation by ID (note: this is vulnerable to SQL injection)
            String req = "SELECT * FROM `participation` WHERE `id` ="+id;
            // Prepare the SQL statement
            PreparedStatement st = cnx2.prepareStatement(req);
            // Execute the query and get the result set
            rs = st.executeQuery(req);
        } catch (SQLException ex) {
            // Print any SQL exception that occurs
            System.err.println(ex.getMessage());
        }
        // Return the result set
        return rs;
    }

    // Implementation of the ajouterEntite method from ICrud interface to add a new Participation
    @Override
    public void ajouterEntite(Participation p) {
        // SQL insert query with placeholders
        String req1 = "INSERT INTO `participation`( `id_e`, `id_u`) VALUES (?,?)";
        try {
            // Prepare the statement with the query
            PreparedStatement st = cnx2.prepareStatement(req1);
            // Set the first parameter (event ID)
            st.setInt(1, p.getEvent_id());
            // Set the second parameter (user ID)
            st.setInt(2, p.getUser_id());
            // Execute the insert
            st.executeUpdate();
            // Confirmation message
            System.out.println("participation ajouté");
        } catch (SQLException e) {
            // Print any exception message
            System.out.println(e.getMessage());
        }
    }

    // Unimplemented method to list all Participation entities (returns null for now)
    @Override
    public List<Participation> afficherEntite() {
        return null;
    }

    // Unimplemented method to modify a Participation (to be implemented)
    @Override
    public void modifierEntite(Participation p) {

    }

    // Implementation of the supprimerEntite method to delete a Participation by user ID and event ID
    @Override
    public void supprimerEntite(Participation p) {
        // SQL delete statement with conditions on both user and event IDs
        String requet = "DELETE  FROM `participation` WHERE `id_u` = ? AND `id_e` = ?";
        try {
            // Prepare the statement
            PreparedStatement pst = cnx2.prepareStatement(requet);
            // Set user ID
            pst.setInt(1, p.getUser_id());
            // Set event ID
            pst.setInt(2, p.getEvent_id());
            // Execute the deletion and get number of affected rows
            int rowsAffected = pst.executeUpdate();

            // If rows were affected, confirm deletion; else, notify failure
            if (rowsAffected > 0) {
                System.out.println("Suppression réussie");
            } else {
                System.out.println("Aucune suppression effectuée. Vérifiez l'ID.");
            }
        } catch (SQLException e) {
            // Print any SQL error
            System.out.println(e.getMessage());
        }
    }

    // Method to retrieve all participation records from the database
    public ResultSet Getall() {
        ResultSet rs = null;
        try {
            // Query to get all participations
            String req = "SELECT * FROM `participation`";
            // Prepare the statement
            PreparedStatement st = cnx2.prepareStatement(req);
            // Execute and retrieve the result set
            rs = st.executeQuery(req);
        } catch (SQLException ex) {
            // Print error if any
            System.err.println(ex.getMessage());
        }
        return rs;
    }

    // Method to retrieve all participations of a specific user, along with associated event data
    public ResultSet Getallparticipation(int id) {
        ResultSet rs = null;
        try {
            // SQL join query to get event and participation info where user ID matches
            String req = "SELECT * FROM `events` JOIN `participation` ON events.id = participation.id_e  AND participation.id_u ="+id;
            // Prepare the statement
            PreparedStatement st = cnx2.prepareStatement(req);
            // Execute and get results
            rs = st.executeQuery(req);
        } catch (SQLException ex) {
            // Print error if any
            System.err.println(ex.getMessage());
        }
        return rs;
    }
}
