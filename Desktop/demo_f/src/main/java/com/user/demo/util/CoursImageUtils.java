package com.user.demo.util;

import javafx.scene.image.Image;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;

public class CoursImageUtils {
    private static final String COURSES_IMAGES_DIR = "src/main/resources/com/user/demo/images/courses/";
    private static final String DEFAULT_COURSE_IMAGE = "default-course.jpg";
    
    public static void ensureDefaultCourseImageExists() throws IOException {
        Path defaultImagePath = Paths.get(COURSES_IMAGES_DIR, DEFAULT_COURSE_IMAGE);
        if (!Files.exists(defaultImagePath)) {
            // Créer le répertoire s'il n'existe pas
            Files.createDirectories(defaultImagePath.getParent());
            
            // Copier l'image par défaut depuis les ressources
            try {
                Files.copy(
                    CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE),
                    defaultImagePath
                );
            } catch (IOException e) {
                System.err.println("Impossible de créer l'image par défaut des cours: " + e.getMessage());
                throw e;
            }
        }
    }
    
    public static String getDefaultCourseImage() {
        return DEFAULT_COURSE_IMAGE;
    }
    
    public static String getCourseImagePath(String imageName) {
        if (imageName == null || imageName.trim().isEmpty()) {
            return DEFAULT_COURSE_IMAGE;
        }
        
        File imageFile = new File(COURSES_IMAGES_DIR + imageName);
        if (!imageFile.exists()) {
            return DEFAULT_COURSE_IMAGE;
        }
        
        return imageName;
    }
    
    public static Image loadCourseImage(String imageName) {
        String finalImageName = getCourseImagePath(imageName);
        try {
            File imageFile = new File(COURSES_IMAGES_DIR + finalImageName);
            if (imageFile.exists()) {
                return new Image(imageFile.toURI().toString());
            } else {
                // Charger depuis les ressources
                return new Image(CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE));
            }
        } catch (Exception e) {
            System.err.println("Erreur lors du chargement de l'image: " + e.getMessage());
            // Retourner l'image par défaut en cas d'erreur
            return new Image(CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE));
        }
    }
} 