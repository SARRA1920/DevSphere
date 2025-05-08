// Package declaration, indicating the location of this class within the project structure
package com.user.demo.controller;

// Import statements for necessary JavaFX and other class dependencies
import com.user.demo.model.Event;
import com.user.demo.model.Participation;
import com.user.demo.service.EventService;
import com.user.demo.service.ParticipationService;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;


import java.time.LocalDate;
import java.time.ZoneId;
import java.util.Date;
import java.util.Objects;

// Controller class for managing event interactions in the user interface
public class EventC {

    // Creating instances of EventService and ParticipationService to handle event and participation actions
    EventService es = new EventService();
    ParticipationService ps = new ParticipationService();

    // Event object to store the current event being managed
    private Event event;

    // Integer variable to store the event's id
    int id;

    // Declaring FXML variables for the various UI components in the Event view
    @FXML
    private Label capacity;
    @FXML
    private Label date;
    @FXML
    private Button delete;
    @FXML
    private Button deletep;
    @FXML
    private Label locationLabel;
    @FXML
    private Button participate;
    @FXML
    private TextField tf_capacity;
    @FXML
    private DatePicker tf_date;
    @FXML
    private TextField tf_location;
    @FXML
    private TextField tf_titre;
    @FXML
    private TextField tf_type;
    @FXML
    private Label titre;
    @FXML
    private Label type;
    @FXML
    private Button update;

    // Method to handle event deletion when the "delete" button is clicked
    @FXML
    void delete(ActionEvent event) {
        es.supprimerEntite(this.event);  // Calls the delete method of EventService to remove the event
    }

    // Method to handle participation deletion when the "delete participation" button is clicked
    @FXML
    void dparticipate(ActionEvent event) {
        Participation p = new Participation(this.event.getId(), 1); // Creating a Participation object
        ps.supprimerEntite(p);  // Deletes the participation from the ParticipationService
    }

    // Method to handle participation when the "participate" button is clicked
    @FXML
    void participate(ActionEvent event) {
        Participation p = new Participation(this.event.getId(), 1); // Creating a Participation object
        ps.ajouterEntite(p);  // Adds the participation using the ParticipationService
    }

    // Method to handle event update when the "update" button is clicked
    @FXML
    void update(ActionEvent event) {
        if (Objects.equals(update.getText(), "Update")) {  // If the button text is "Update"
            // Hides event details and shows input fields to edit the event information
            locationLabel.setVisible(false);
            capacity.setVisible(false);
            date.setVisible(false);
            titre.setVisible(false);
            type.setVisible(false);
            tf_location.setVisible(true);  // Shows the location TextField
            tf_location.setText(this.event.getLocation());  // Sets the current location in the TextField
            tf_capacity.setVisible(true);  // Shows the capacity TextField
            tf_capacity.setText(String.valueOf(this.event.getCapacity()));  // Sets the current capacity in the TextField
            tf_date.setVisible(true);  // Shows the date DatePicker
            tf_titre.setVisible(true);  // Shows the title TextField
            tf_titre.setText(this.event.getTitre());  // Sets the current title in the TextField
            tf_type.setVisible(true);  // Shows the type TextField
            tf_type.setText(this.event.getType());  // Sets the current type in the TextField
            update.setText("Submit");  // Changes the button text to "Submit"
        } else {
            // Handles submitting the updated event details
            LocalDate currentDate = LocalDate.now();  // Gets the current date
            // Validates that all fields are filled out and that the date is not in the past
            if (tf_location.getText().isEmpty() || tf_titre.getText().isEmpty() || tf_type.getText().isEmpty() || tf_capacity.getText().isEmpty() || tf_date.getValue().isBefore(currentDate) || tf_date.getValue() == null) {
                // Displays a warning alert if any fields are empty or invalid
                Alert alert = new Alert(Alert.AlertType.WARNING);
                alert.setTitle("Champs manquants");
                alert.setHeaderText(null);
                alert.setContentText("Veuillez remplir tous les champs !");
                alert.showAndWait();
                return;
            }
            // Retrieves and converts the input data from the fields
            String titre1 = tf_titre.getText();
            String location1 = tf_location.getText();
            LocalDate localDate = tf_date.getValue();  // Gets the date from the DatePicker
            Date date1 = Date.from(localDate.atStartOfDay(ZoneId.systemDefault()).toInstant());  // Converts LocalDate to Date
            String type1 = tf_type.getText();
            int capacity1 = Integer.parseInt(tf_capacity.getText());  // Parses the capacity as an integer
            // Updates the event object with the new data
            this.event = new Event(this.event.getId(), titre1, type1, capacity1, date1, location1);
            es.modifierEntite(this.event);  // Calls the modify method of EventService to update the event
            // Makes event details visible again and hides the input fields
            locationLabel.setVisible(true);
            capacity.setVisible(true);
            date.setVisible(true);
            titre.setVisible(true);
            type.setVisible(true);
            setData(this.event);  // Updates the displayed event data
            update.setText("Update");  // Resets the button text to "Update"
        }
    }

    // Method to display the event data when the event is selected or updated
    public void setData(Event q) {
        this.event = q;  // Sets the event object
        id = q.getId();  // Sets the event's id
        titre.setText("Event title = " + q.getTitre());  // Displays the event title
        date.setText("Event Date = " + q.getDate());  // Displays the event date
        locationLabel.setText("Event location = " + q.getLocation());  // Displays the event location
        capacity.setText("Event capacity = " + String.valueOf(q.getCapacity()));  // Displays the event capacity
        type.setText("Event type = " + q.getType());  // Displays the event type
        participate.setVisible(false);  // Hides the "participate" button
        deletep.setVisible(false);  // Hides the "delete participation" button
        delete.setVisible(true);  // Shows the "delete" button
        update.setVisible(true);  // Shows the "update" button
        // Hides the input fields for editing
        tf_capacity.setVisible(false);
        tf_date.setVisible(false);
        tf_location.setVisible(false);
        tf_titre.setVisible(false);
        tf_type.setVisible(false);
    }

    // Method to display event data when viewing a finalized event (without editing options)
    public void setDataF(Event q) {
        this.event = q;
        id = q.getId();
        titre.setText("Event title = " + q.getTitre());
        date.setText("Event Date = " + q.getDate());
        locationLabel.setText("Event location = " + q.getLocation());
        capacity.setText("Event capacity = " + String.valueOf(q.getCapacity()));
        type.setText("Event type = " + q.getType());
        update.setVisible(false);  // Hides the "update" button
        delete.setVisible(false);  // Hides the "delete" button
        deletep.setVisible(false);  // Hides the "delete participation" button
        // Hides the input fields for editing
        tf_capacity.setVisible(false);
        tf_date.setVisible(false);
        tf_location.setVisible(false);
        tf_titre.setVisible(false);
        tf_type.setVisible(false);
    }

    // Method to display event data when viewing an event without participation options
    public void setDataFP(Event q) {
        this.event = q;
        id = q.getId();
        titre.setText("Event title = " + q.getTitre());
        date.setText("Event Date = " + q.getDate());
        locationLabel.setText("Event location = " + q.getLocation());
        capacity.setText("Event capacity = " + String.valueOf(q.getCapacity()));
        type.setText("Event type = " + q.getType());
        update.setVisible(false);  // Hides the "update" button
        delete.setVisible(false);  // Hides the "delete" button
        participate.setVisible(false);  // Hides the "participate" button
        // Hides the input fields for editing
        tf_capacity.setVisible(false);
        tf_date.setVisible(false);
        tf_location.setVisible(false);
        tf_titre.setVisible(false);
        tf_type.setVisible(false);
    }
}
