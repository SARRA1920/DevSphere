package controllers;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextArea;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.scene.text.TextFlow;
import com.jfoenix.controls.JFXButton;
import javafx.geometry.Insets;
import javafx.geometry.Pos;

public class ChatbotController {
    @FXML
    private ScrollPane chatScrollPane;
    
    @FXML
    private VBox chatBox;
    
    @FXML
    private TextArea messageInput;
    
    @FXML
    private JFXButton sendButton;

    private String exerciseContext;

    @FXML
    public void initialize() {
        // Configure chat display
        chatBox.setSpacing(10);
        chatBox.setPadding(new Insets(10));
        
        // Make chat scroll to bottom automatically
        chatBox.heightProperty().addListener((observable, oldValue, newValue) -> 
            chatScrollPane.setVvalue(1.0));
        
        // Configure send button
        sendButton.setOnAction(event -> sendMessage());
        
        // Allow sending with Enter key
        messageInput.setOnKeyPressed(event -> {
            if (event.getCode().toString().equals("ENTER") && !event.isShiftDown()) {
                event.consume();
                sendMessage();
            }
        });
    }

    private void sendMessage() {
        String message = messageInput.getText().trim();
        if (message.isEmpty()) return;

        // Add user message to chat
        addMessageToChat(message, true);
        messageInput.clear();

        // Get AI response in background
        new Thread(() -> {
            // Simuler une réponse de l'IA (à remplacer par l'appel réel à l'API)
            String response = "Je suis là pour vous aider avec cet exercice. " +
                            "Que souhaitez-vous savoir ?";
            
            Platform.runLater(() -> addMessageToChat(response, false));
        }).start();
    }

    private void addMessageToChat(String message, boolean isUser) {
        TextFlow messageFlow = new TextFlow();
        Text text = new Text(message);
        messageFlow.getChildren().add(text);
        messageFlow.setMaxWidth(chatScrollPane.getWidth() * 0.75);
        
        // Style the message
        if (isUser) {
            messageFlow.setStyle("-fx-background-color: #DCF8C6; -fx-background-radius: 10;");
            messageFlow.setPadding(new Insets(10));
            chatBox.setAlignment(Pos.CENTER_RIGHT);
        } else {
            messageFlow.setStyle("-fx-background-color: #E8E8E8; -fx-background-radius: 10;");
            messageFlow.setPadding(new Insets(10));
            chatBox.setAlignment(Pos.CENTER_LEFT);
        }
        
        chatBox.getChildren().add(messageFlow);
    }

    public void setExerciseContext(String context) {
        this.exerciseContext = context;
        // Ajouter un message de bienvenue avec le contexte
        Platform.runLater(() -> {
            addMessageToChat("Bonjour ! Je suis votre assistant pour cet exercice. " +
                           "N'hésitez pas à me poser des questions.", false);
        });
    }
} 