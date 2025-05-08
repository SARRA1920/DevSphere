package com.user.demo.utils;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Utilitaire pour initialiser l'application et les ressources au démarrage
 */
public class ApplicationStartupUtils {
    
    private static final Logger LOGGER = Logger.getLogger(ApplicationStartupUtils.class.getName());
    private static boolean initialized = false;
    
    /**
     * Initialise l'application et ses ressources
     */
    public static void initialize() {
        if (initialized) {
            return;
        }
        
        try {
            System.out.println("=== INITIALISATION DE L'APPLICATION ===");
            
            // Initialiser les répertoires d'upload
            FileUploadUtils.initializeDirectories();
            
            // Copier l'image par défaut vers le répertoire XAMPP si elle n'y est pas déjà
            copyDefaultResources();
            
            System.out.println("=== INITIALISATION TERMINÉE ===");
            initialized = true;
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'initialisation de l'application", e);
            System.err.println("ERREUR CRITIQUE: Impossible d'initialiser l'application: " + e.getMessage());
            e.printStackTrace();
        }
    }
    
    /**
     * Copie les ressources par défaut vers le répertoire XAMPP
     */
    private static void copyDefaultResources() {
        try {
            // Copier l'image par défaut
            copyDefaultImage("default.jpg");
            
            // Autres ressources par défaut à copier
            // copyDefaultImage("logo.png");
            // ... autres ressources
            
        } catch (Exception e) {
            LOGGER.log(Level.WARNING, "Erreur lors de la copie des ressources par défaut", e);
            System.err.println("Attention: Impossible de copier les ressources par défaut: " + e.getMessage());
        }
    }
    
    /**
     * Copie une image depuis les ressources vers le répertoire XAMPP
     */
    private static void copyDefaultImage(String imageName) {
        try {
            // Chemin de destination complet dans XAMPP
            String xamppImagePath = "C:\\xampp\\htdocs\\img\\images\\" + imageName;
            File xamppImageFile = new File(xamppImagePath);
            
            // Vérifier si l'image existe déjà dans le répertoire XAMPP
            if (xamppImageFile.exists()) {
                System.out.println("L'image " + imageName + " existe déjà dans le répertoire XAMPP: " + xamppImagePath);
                return;
            }
            
            // Essayer de trouver l'image dans les ressources
            String resourcePath = "/com/user/demo/images/" + imageName;
            java.net.URL imageUrl = ApplicationStartupUtils.class.getResource(resourcePath);
            
            if (imageUrl != null) {
                System.out.println("Image trouvée dans les ressources: " + imageUrl);
                
                // Créer le répertoire XAMPP si nécessaire
                File xamppDir = new File("C:\\xampp\\htdocs\\img\\images");
                if (!xamppDir.exists()) {
                    if (xamppDir.mkdirs()) {
                        System.out.println("Répertoire XAMPP créé: " + xamppDir.getAbsolutePath());
                    } else {
                        System.err.println("Impossible de créer le répertoire XAMPP: " + xamppDir.getAbsolutePath());
                    }
                }
                
                // Copier l'image directement des ressources vers XAMPP
                try {
                    Files.copy(imageUrl.openStream(), xamppImageFile.toPath(), StandardCopyOption.REPLACE_EXISTING);
                    System.out.println("Image " + imageName + " copiée avec succès vers: " + xamppImageFile.getAbsolutePath());
                    
                    // S'assurer que le fichier est lisible
                    xamppImageFile.setReadable(true, false);
                } catch (IOException e) {
                    System.err.println("Erreur lors de la copie directe de l'image: " + e.getMessage());
                    e.printStackTrace();
                }
            } else {
                System.err.println("ATTENTION: Impossible de trouver l'image " + imageName + " dans les ressources");
                
                // Créer une image par défaut simple si elle n'existe pas dans les ressources
                if (imageName.equals("default.jpg")) {
                    try {
                        // Créer le répertoire XAMPP si nécessaire
                        File xamppDir = new File("C:\\xampp\\htdocs\\img\\images");
                        if (!xamppDir.exists()) {
                            xamppDir.mkdirs();
                        }
                        
                        // Nous ne pouvons pas créer une image depuis zéro ici, mais nous pouvons le signaler
                        System.err.println("L'image par défaut 'default.jpg' n'existe pas et doit être créée manuellement dans: " + xamppImageFile.getAbsolutePath());
                    } catch (Exception e) {
                        System.err.println("Erreur lors de la tentative de création d'une image par défaut: " + e.getMessage());
                    }
                }
            }
        } catch (Exception e) {
            LOGGER.log(Level.WARNING, "Erreur lors de la copie de l'image " + imageName, e);
            System.err.println("Attention: Impossible de copier l'image " + imageName + ": " + e.getMessage());
            e.printStackTrace();
        }
    }
} 