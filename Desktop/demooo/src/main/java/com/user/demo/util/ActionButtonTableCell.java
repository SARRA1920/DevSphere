package com.user.demo.util;

import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Button;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.scene.control.Tooltip;
import javafx.scene.layout.HBox;
import javafx.scene.paint.Color;
import javafx.util.Callback;

/**
 * A utility class to create action buttons in table cells
 * @param <T> The type of items in the table
 */
public class ActionButtonTableCell<T> extends TableCell<T, Void> {
    
    private final Button viewButton;
    private final Button editButton;
    private final Button deleteButton;
    private final HBox container;
    private final EventHandler<ActionEvent> viewHandler;
    private final EventHandler<ActionEvent> editHandler;
    private final EventHandler<ActionEvent> deleteHandler;
    
    public ActionButtonTableCell(
            EventHandler<ActionEvent> viewHandler, 
            EventHandler<ActionEvent> editHandler, 
            EventHandler<ActionEvent> deleteHandler) {
        
        this.viewHandler = viewHandler;
        this.editHandler = editHandler;
        this.deleteHandler = deleteHandler;
        
        // Create view button
        viewButton = createButton("EYE", "#3498db", "View details");
        
        // Create edit button
        editButton = createButton("EDIT", "#f39c12", "Edit item");
        
        // Create delete button
        deleteButton = createButton("TRASH", "#e74c3c", "Delete item");
        
        // Create container for buttons
        container = new HBox(5, viewButton, editButton, deleteButton);
        container.setAlignment(Pos.CENTER);
        container.setPadding(new Insets(0));
        
        // Set cell properties
        setGraphic(null);
        setContentDisplay(javafx.scene.control.ContentDisplay.GRAPHIC_ONLY);
    }
    
    private Button createButton(String iconName, String color, String tooltipText) {
        Button button = new Button();
        
        // Create icon
        FontAwesomeIconView icon = new FontAwesomeIconView();
        icon.setGlyphName(iconName);
        icon.setFill(Color.WHITE);
        icon.setGlyphSize(14);
        
        // Set button properties
        button.setGraphic(icon);
        button.setStyle(
                "-fx-background-color: " + color + ";" +
                "-fx-min-width: 35px;" +
                "-fx-min-height: 30px;" +
                "-fx-max-width: 35px;" +
                "-fx-max-height: 30px;" +
                "-fx-padding: 5px;" +
                "-fx-cursor: hand;" +
                "-fx-background-radius: 4px;"
        );
        
        // Set tooltip
        Tooltip tooltip = new Tooltip(tooltipText);
        button.setTooltip(tooltip);
        
        return button;
    }
    
    @Override
    protected void updateItem(Void item, boolean empty) {
        super.updateItem(item, empty);
        
        if (empty) {
            setGraphic(null);
        } else {
            // Set action handlers with the current TableRow item
            T rowItem = getTableRow().getItem();
            viewButton.setOnAction(e -> viewHandler.handle(new ActionEvent(rowItem, e.getTarget())));
            editButton.setOnAction(e -> editHandler.handle(new ActionEvent(rowItem, e.getTarget())));
            deleteButton.setOnAction(e -> deleteHandler.handle(new ActionEvent(rowItem, e.getTarget())));
            
            setGraphic(container);
        }
    }
    
    /**
     * Factory method to create a cell factory for action buttons
     * @param <T> The type of items in the table
     * @param viewHandler Event handler for view button
     * @param editHandler Event handler for edit button
     * @param deleteHandler Event handler for delete button
     * @return A cell factory for creating action buttons
     */
    public static <T> Callback<TableColumn<T, Void>, TableCell<T, Void>> forTableColumn(
            EventHandler<ActionEvent> viewHandler, 
            EventHandler<ActionEvent> editHandler, 
            EventHandler<ActionEvent> deleteHandler) {
        return column -> new ActionButtonTableCell<>(viewHandler, editHandler, deleteHandler);
    }
}