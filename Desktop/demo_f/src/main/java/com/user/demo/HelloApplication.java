package com.user.demo;

import com.user.demo.util.ImageUtils;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.stage.Stage;

import java.io.IOException;
import java.net.URL;

public class HelloApplication extends Application {
    @Override
    public void start(Stage stage) throws IOException {
        try {
            // Create default profile image if it doesn't exist
            ImageUtils.saveDefaultProfileImage();
            
            // Explicitly get the resource URL to ensure it's found - now loading login-view.fxml instead
            URL resourceUrl = HelloApplication.class.getResource("login-view.fxml");
            if (resourceUrl == null) {
                System.err.println("Error: Could not find login-view.fxml");
                throw new IOException("Resource not found: login-view.fxml");
            }
            
            FXMLLoader fxmlLoader = new FXMLLoader(resourceUrl);
            Scene scene = new Scene(fxmlLoader.load(), 800, 600);
            stage.setTitle("DevSphere - Login");
            stage.setScene(scene);
            stage.setMinWidth(600);
            stage.setMinHeight(500);
            stage.show();
        } catch (Exception e) {
            System.err.println("Error starting application: " + e.getMessage());
            e.printStackTrace();
            throw e;
        }
    }

    public static void main(String[] args) {
        try {
            launch(args);
        } catch (Exception e) {
            System.err.println("Failed to launch application: " + e.getMessage());
            e.printStackTrace();
        }
    }
}