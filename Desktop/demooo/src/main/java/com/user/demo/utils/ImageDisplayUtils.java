package com.user.demo.utils;

import javafx.scene.image.Image;
import javafx.scene.image.ImageView;

import java.io.File;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.StandardCopyOption;

/**
 * Utilitaire pour l'affichage des images dans l'application
 */
public class ImageDisplayUtils {
    
    // Image par défaut à utiliser en cas d'erreur
    private static final String DEFAULT_IMAGE = "default.jpg";
    
    /**
     * Charge une image à partir de son URL ou nom et la définit dans un ImageView
     * 
     * @param imageView ImageView où afficher l'image
     * @param imageUrlOrName URL ou nom du fichier image
     * @return true si l'image a été chargée avec succès, false sinon
     */
    public static boolean loadAndSetImage(ImageView imageView, String imageUrlOrName) {
        if (imageView == null) {
            System.err.println("ImageView est null");
            return false;
        }
        
        System.out.println("Tentative de chargement de l'image: " + imageUrlOrName);
        
        // Si aucun nom d'image n'est fourni, utiliser l'image par défaut
        if (imageUrlOrName == null || imageUrlOrName.trim().isEmpty()) {
            imageUrlOrName = DEFAULT_IMAGE;
            System.out.println("Utilisation de l'image par défaut: " + imageUrlOrName);
        }
        
        try {
            // 1. Si c'est une URL, extraire le nom du fichier
            String filename = imageUrlOrName;
            if (imageUrlOrName.startsWith("http://") || imageUrlOrName.startsWith("https://")) {
                filename = FileUploadUtils.extractFilenameFromUrl(imageUrlOrName);
                System.out.println("Nom de fichier extrait de l'URL: " + filename);
            }
            
            // 2. Essayer de charger depuis le chemin XAMPP (méthode principale)
            String xamppPath = "C:\\xampp\\htdocs\\img\\images\\" + filename;
            File xamppFile = new File(xamppPath);
            
            if (xamppFile.exists() && xamppFile.canRead()) {
                System.out.println("Image trouvée dans XAMPP: " + xamppPath);
                Image image = new Image(xamppFile.toURI().toString());
                imageView.setImage(image);
                System.out.println("Image chargée avec succès depuis: " + xamppFile.toURI().toString());
                return true;
            } else {
                System.out.println("Image non trouvée dans XAMPP: " + xamppPath + 
                                  " (exists=" + xamppFile.exists() + 
                                  ", canRead=" + (xamppFile.exists() ? xamppFile.canRead() : "N/A") + 
                                  ", absolute path=" + xamppFile.getAbsolutePath() + ")");
            }
            
            // 3. Essayer de charger depuis les ressources Java
            System.out.println("Tentative depuis les ressources Java");
            URL resourceUrl = ImageDisplayUtils.class.getResource("/com/user/demo/images/" + filename);
            
            if (resourceUrl != null) {
                System.out.println("Image trouvée dans les ressources: " + resourceUrl);
                Image image = new Image(resourceUrl.toString());
                imageView.setImage(image);
                return true;
            }
            
            // 4. Si c'est une URL http, essayer de la charger directement
            if (imageUrlOrName.startsWith("http://") || imageUrlOrName.startsWith("https://")) {
                try {
                    System.out.println("Tentative de chargement direct depuis l'URL: " + imageUrlOrName);
                    Image image = new Image(imageUrlOrName);
                    imageView.setImage(image);
                    return true;
                } catch (Exception e) {
                    System.err.println("Erreur lors du chargement depuis l'URL: " + e.getMessage());
                }
            }
            
            // 5. Si aucune méthode n'a fonctionné, essayer l'image par défaut
            if (!imageUrlOrName.equals(DEFAULT_IMAGE)) {
                System.out.println("Aucune méthode n'a fonctionné, essai avec l'image par défaut");
                return loadAndSetImage(imageView, DEFAULT_IMAGE);
            }
            
            System.err.println("Impossible de charger l'image: " + imageUrlOrName);
            return false;
        } catch (Exception e) {
            System.err.println("Erreur lors du chargement de l'image " + imageUrlOrName + ": " + e.getMessage());
            e.printStackTrace();
            
            // Essayer de charger l'image par défaut
            if (!imageUrlOrName.equals(DEFAULT_IMAGE)) {
                return loadAndSetImage(imageView, DEFAULT_IMAGE);
            }
            return false;
        }
    }
    
    /**
     * Obtient l'URL d'une image pour l'utiliser dans des éléments CSS
     * 
     * @param imageUrlOrName URL ou nom du fichier image
     * @return URL de l'image ou null si l'image n'a pas été trouvée
     */
    public static String getImageUrl(String imageUrlOrName) {
        if (imageUrlOrName == null || imageUrlOrName.trim().isEmpty()) {
            imageUrlOrName = DEFAULT_IMAGE;
        }
        
        try {
            // Si c'est déjà une URL, la retourner
            if (imageUrlOrName.startsWith("http://") || imageUrlOrName.startsWith("https://")) {
                return imageUrlOrName;
            }
            
            // Extraire le nom du fichier
            String filename = FileUploadUtils.extractFilenameFromUrl(imageUrlOrName);
            
            // Vérifier d'abord dans le dossier XAMPP
            File xamppFile = new File("C:\\xampp\\htdocs\\img\\images\\" + filename);
            if (xamppFile.exists() && xamppFile.canRead()) {
                return xamppFile.toURI().toString();
            }
            
            // Essayer l'ancien chemin
            URL imageUrl = ImageDisplayUtils.class.getResource("/com/user/demo/images/" + filename);
            if (imageUrl != null) {
                return imageUrl.toString();
            }
            
            // Essayer le chemin direct
            File directFile = new File(imageUrlOrName);
            if (directFile.exists()) {
                return directFile.toURI().toString();
            }
            
            // Si tout échoue, renvoyer l'URL de l'image par défaut
            return new File("C:\\xampp\\htdocs\\img\\images\\" + DEFAULT_IMAGE).toURI().toString();
        } catch (Exception e) {
            System.err.println("Erreur lors de la récupération de l'URL de l'image " + imageUrlOrName + ": " + e.getMessage());
            return new File("C:\\xampp\\htdocs\\img\\images\\" + DEFAULT_IMAGE).toURI().toString();
        }
    }
} 