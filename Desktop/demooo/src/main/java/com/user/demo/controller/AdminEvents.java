// Package declaration - defines the package location of this class
package com.user.demo.controller;

// Import JavaFX and Java standard library classes used in the controller
import com.user.demo.model.Event;
import com.user.demo.service.EventService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Insets;
import javafx.scene.control.Alert;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.Pane;
import javafx.scene.layout.Region;
import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;

// Controller class for the backend event management interface
public class AdminEvents {

    // FXML-injected UI elements (defined in the .fxml file)
    @FXML private GridPane gridE;              // Grid to display events
    @FXML private GridPane gridP;              // Grid for participations (not used in this code)
    @FXML private Pane pn_addEvent;            // Pane for "Add Event" view
    @FXML private Pane pn_events;              // Pane for listing events
    @FXML private Pane pn_participations;      // Pane for viewing participations
    @FXML private Pane pn_updateEvent;         // Pane for updating an event (not used here)

    // Text fields for event inputs
    @FXML private TextField tf_capacity;
    @FXML private TextField tf_capacity1;      // Not used here, possibly for update form
    @FXML private DatePicker tf_date;
    @FXML private DatePicker tf_date1;         // Not used here
    @FXML private TextField tf_location;
    @FXML private TextField tf_location1;      // Not used here
    @FXML private TextField tf_titre;
    @FXML private TextField tf_titre1;         // Not used here
    @FXML private TextField tf_type;
    @FXML private TextField tf_type1;          // Not used here

    // Event service instance to interact with the database
    EventService es = new EventService();

    // Called when the "Add" button is clicked
    @FXML
    void add(ActionEvent event) {
        // Get current date
        LocalDate currentDate = LocalDate.now();

        // Validate form: all fields must be filled and the date must be in the future
        if (tf_location.getText().isEmpty() || tf_titre.getText().isEmpty() ||
                tf_type.getText().isEmpty() || tf_capacity.getText().isEmpty() ||
                tf_date.getValue() == null || tf_date.getValue().isBefore(currentDate)) {

            // Show warning alert if validation fails
            Alert alert = new Alert(Alert.AlertType.WARNING);
            alert.setTitle("Champs manquants"); // "Missing fields"
            alert.setHeaderText(null);
            alert.setContentText("Veuillez remplir tous les champs !"); // "Please fill all fields!"
            alert.showAndWait();
            return;
        }

        // Extract values from input fields
        String titre = tf_titre.getText();
        String location = tf_location.getText();
        LocalDate localDate = tf_date.getValue(); // Date from DatePicker
        Date date = Date.from(localDate.atStartOfDay(ZoneId.systemDefault()).toInstant()); // Convert to java.util.Date
        String type = tf_type.getText();
        int capacity = Integer.parseInt(tf_capacity.getText());

        // Create new Event object
        Event p = new Event(titre, type, capacity, date, location);

        // Add event to the database
        es.ajouterEntite(p);

        // Clear the input fields
        tf_titre.clear();
        tf_location.clear();
        tf_type.clear();
        tf_capacity.clear();

        // Show confirmation alert
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Valider"); // "Confirm"
        alert.setHeaderText(null);
        alert.setContentText("Evenement ajouter !"); // "Event added!"
        alert.showAndWait();

        // Bring the event list pane to front and refresh it
        pn_events.toFront();
        displayg();
    }

    // Switch to "Add Event" view
    @FXML
    void toAddEvent(ActionEvent event) {
        pn_addEvent.toFront();
    }

    // Switch to "Events" view and refresh the event grid
    @FXML
    void toEvents(ActionEvent event) {
        pn_events.toFront();
        gridE.getChildren().clear();
        displayg();
    }

    // Refresh button handler - clears and reloads the event grid
    @FXML
    void refresh(ActionEvent event) {
        gridE.getChildren().clear();
        displayg();
    }

    // Switch to "Participations" view
    @FXML
    void toParticipations(ActionEvent event) {
        pn_participations.toFront();
    }

    // Helper method to load and display all events from the database into gridE
    private void displayg() {
        // Observable list to store events
        ObservableList<Event> eventList = FXCollections.observableArrayList();

        // Retrieve all events from the database
        ResultSet resultSet = es.Getall();

        int column = 0; // Current column in the grid
        int row = 1;    // Current row in the grid (starts at 1)

        try {
            // Loop through each event in the result set
            while (resultSet.next()) {
                // Load the Event.fxml UI layout
                FXMLLoader fxmlLoader = new FXMLLoader();
                fxmlLoader.setLocation(getClass().getResource("/com/user/demo/views/Event.fxml"));

                AnchorPane anchorPane = fxmlLoader.load(); // Load UI into anchor pane
                EventC itemController = fxmlLoader.getController(); // Get controller for setting event data

                // Extract event details from the current result set row
                int id = resultSet.getInt("id");
                String titre = resultSet.getString("titre");
                String type = resultSet.getString("type");
                int capacity = resultSet.getInt("capacity");
                Date date = resultSet.getDate("date");
                String location = resultSet.getString("location");

                // Create Event object and add it to the list
                Event event = new Event(id, titre, type, capacity, date, location);
                eventList.add(event);

                // Pass data to the item controller for UI rendering
                itemController.setData(event);

                // If one column is filled, move to next row
                if (column == 1) {
                    column = 0;
                    row++;
                }

                // Add the anchor pane (event card) to the grid at (column, row)
                gridE.add(anchorPane, column++, row);

                // Set grid size constraints
                gridE.setMinWidth(Region.USE_COMPUTED_SIZE);
                gridE.setPrefWidth(Region.USE_COMPUTED_SIZE);
                gridE.setMaxWidth(Region.USE_PREF_SIZE);

                gridE.setMinHeight(Region.USE_COMPUTED_SIZE);
                gridE.setPrefHeight(Region.USE_COMPUTED_SIZE);
                gridE.setMaxHeight(Region.USE_PREF_SIZE);

                // Add spacing around the event card
                GridPane.setMargin(anchorPane, new Insets(10));
            }
        } catch (SQLException | IOException ex) {
            // Log any SQL or IO exceptions that occur
            Logger.getLogger(AdminEvents.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
