package com.user.demo.util;

import javafx.scene.image.Image;
import javafx.scene.image.PixelWriter;
import javafx.scene.image.WritableImage;
import javafx.scene.paint.Color;
import javafx.embed.swing.SwingFXUtils;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;

/**
 * Utility class for generating and managing default profile images
 */
public class ImageUtils {
    
    /**
     * Generate a default profile image with user's initials
     * @param name The user's name to extract initials from
     * @param size The image size (width and height)
     * @return Image object with user's initials
     */
    public static Image generateInitialsImage(String name, int size) {
        // Create a writable image
        WritableImage image = new WritableImage(size, size);
        PixelWriter pixelWriter = image.getPixelWriter();
        
        // Background color
        Color bgColor = Color.web("#3498db");
        
        // Fill the circle with background color
        for (int y = 0; y < size; y++) {
            for (int x = 0; x < size; x++) {
                // Calculate if the pixel is inside the circle
                double distance = Math.sqrt(Math.pow(x - size/2.0, 2) + Math.pow(y - size/2.0, 2));
                if (distance <= size/2.0) {
                    pixelWriter.setColor(x, y, bgColor);
                } else {
                    pixelWriter.setColor(x, y, Color.TRANSPARENT);
                }
            }
        }
        
        return image;
    }
    
    /**
     * Save default profile image to the file system
     * @throws IOException if an error occurs while saving the image
     */
    public static void saveDefaultProfileImage() throws IOException {
        // Create default.jpg if it doesn't exist
        Path imagePath = Paths.get("src/main/resources/com/user/demo/images/default.jpg");
        if (!Files.exists(imagePath)) {
            // Generate a solid blue circle image
            int size = 200;
            WritableImage image = new WritableImage(size, size);
            PixelWriter pixelWriter = image.getPixelWriter();
            
            // Background color
            Color bgColor = Color.web("#3498db");
            
            // Fill the circle with background color
            for (int y = 0; y < size; y++) {
                for (int x = 0; x < size; x++) {
                    // Calculate if the pixel is inside the circle
                    double distance = Math.sqrt(Math.pow(x - size/2.0, 2) + Math.pow(y - size/2.0, 2));
                    if (distance <= size/2.0) {
                        pixelWriter.setColor(x, y, bgColor);
                    } else {
                        pixelWriter.setColor(x, y, Color.TRANSPARENT);
                    }
                }
            }
            
            // Convert to BufferedImage for saving
            BufferedImage bufferedImage = SwingFXUtils.fromFXImage(image, null);
            
            // Ensure directory exists
            Files.createDirectories(imagePath.getParent());
            
            // Save the image
            ImageIO.write(bufferedImage, "jpg", imagePath.toFile());
            
            System.out.println("Default profile image created at: " + imagePath);
        }
    }
}