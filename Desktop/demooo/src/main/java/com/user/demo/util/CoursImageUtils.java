package com.user.demo.util;

import javafx.scene.image.Image;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;

public class CoursImageUtils {
    private static final String COURSES_IMAGES_DIR = "src/main/resources/com/user/demo/images/courses/";
    private static final String DEFAULT_COURSE_IMAGE = "default-course.jpg";
    private static final String XAMPP_IMAGES_DIR = "C:/xampp/htdocs/img/images/";
    
    // Initialisation statique
    static {
        try {
            // Initialiser le système d'images au démarrage
            initializeImageSystem();
        } catch (Exception e) {
            System.err.println("Erreur lors de l'initialisation du système d'images: " + e.getMessage());
        }
    }
    
    /**
     * Initialise tout le système d'images au démarrage de l'application
     */
    public static void initializeImageSystem() {
        try {
            System.out.println("Initialisation du système d'images...");
            
            // S'assurer que le dossier XAMPP existe
            File xamppDir = new File(XAMPP_IMAGES_DIR);
            if (!xamppDir.exists()) {
                if (xamppDir.mkdirs()) {
                    System.out.println("Dossier XAMPP créé: " + xamppDir.getAbsolutePath());
                } else {
                    System.err.println("ERREUR: Impossible de créer le dossier XAMPP: " + xamppDir.getAbsolutePath());
                }
            }
            
            // S'assurer que l'image par défaut existe dans le dossier des ressources
            ensureDefaultCourseImageExists();
            
            // S'assurer que l'image par défaut existe aussi dans le dossier XAMPP
            copyDefaultImageToXampp();
            
            System.out.println("Système d'images initialisé avec succès.");
        } catch (Exception e) {
            System.err.println("Erreur lors de l'initialisation du système d'images: " + e.getMessage());
            e.printStackTrace();
        }
    }
    
    /**
     * Copie l'image par défaut vers le dossier XAMPP
     */
    private static void copyDefaultImageToXampp() {
        try {
            File xamppDefaultImage = new File(XAMPP_IMAGES_DIR + DEFAULT_COURSE_IMAGE);
            
            // Si l'image existe déjà dans XAMPP, ne rien faire
            if (xamppDefaultImage.exists()) {
                System.out.println("L'image par défaut existe déjà dans XAMPP: " + xamppDefaultImage.getAbsolutePath());
                return;
            }
            
            System.out.println("Copie de l'image par défaut vers XAMPP...");
            
            // Essayer d'abord de copier depuis le dossier des ressources
            File resourceImage = new File(COURSES_IMAGES_DIR + DEFAULT_COURSE_IMAGE);
            if (resourceImage.exists()) {
                Files.copy(resourceImage.toPath(), xamppDefaultImage.toPath(), StandardCopyOption.REPLACE_EXISTING);
                System.out.println("Image par défaut copiée depuis les ressources vers XAMPP.");
                return;
            }
            
            // Sinon, essayer de copier depuis les ressources internes
            InputStream resourceStream = CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE);
            if (resourceStream != null) {
                Files.copy(resourceStream, xamppDefaultImage.toPath(), StandardCopyOption.REPLACE_EXISTING);
                resourceStream.close();
                System.out.println("Image par défaut copiée depuis les ressources internes vers XAMPP.");
                return;
            }
            
            // Si on n'a pas pu trouver l'image par défaut, créer une image vide
            System.err.println("ATTENTION: Impossible de trouver l'image par défaut. Création d'un fichier vide.");
            xamppDefaultImage.createNewFile();
            
        } catch (Exception e) {
            System.err.println("Erreur lors de la copie de l'image par défaut vers XAMPP: " + e.getMessage());
            e.printStackTrace();
        }
    }
    
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
        
        // Si c'est une URL (commence par http:// ou 172...)
        if (imageName.startsWith("http://") || imageName.contains("172.")) {
            // Extraire le nom du fichier de l'URL
            String fileName = imageName.substring(imageName.lastIndexOf("/") + 1);
            System.out.println("Extraction du nom de fichier depuis URL: " + fileName);
            
            // Vérifier si l'image existe dans le dossier XAMPP
            File xamppFile = new File(XAMPP_IMAGES_DIR + fileName);
            if (xamppFile.exists()) {
                System.out.println("Image trouvée dans XAMPP: " + xamppFile.getAbsolutePath());
                return "xampp:" + fileName; // Préfixe pour indiquer que c'est dans XAMPP
            }
        }
        
        // Vérifier si l'image existe dans le dossier des ressources
        File imageFile = new File(COURSES_IMAGES_DIR + imageName);
        if (!imageFile.exists()) {
            return DEFAULT_COURSE_IMAGE;
        }
        
        return imageName;
    }
    
    public static Image loadCourseImage(String imageName) {
        try {
            // Si l'image est null ou vide, charger l'image par défaut
            if (imageName == null || imageName.trim().isEmpty()) {
                System.out.println("Nom d'image vide ou null, chargement de l'image par défaut");
                File defaultImageFile = new File(XAMPP_IMAGES_DIR + DEFAULT_COURSE_IMAGE);
                if (defaultImageFile.exists()) {
                    return new Image(defaultImageFile.toURI().toString());
                } else {
                    return new Image(CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE));
                }
            }
            
            System.out.println("Tentative de chargement de l'image: " + imageName);
            
            // 1. Si c'est une URL commençant par http://172... ou contenant 172.
            if (imageName.startsWith("http://172.") || imageName.contains("172.")) {
                try {
                    System.out.println("URL 172.x.x.x détectée, tentative de chargement direct");
                    return new Image(imageName);
                } catch (Exception e) {
                    System.out.println("Échec du chargement direct depuis l'URL 172.x.x.x: " + e.getMessage());
                    
                    // Extraire le nom du fichier et essayer depuis XAMPP
                    String fileName = imageName.substring(imageName.lastIndexOf("/") + 1);
                    System.out.println("Tentative avec le nom de fichier extrait: " + fileName);
                    File xamppFile = new File(XAMPP_IMAGES_DIR + fileName);
                    
                    if (xamppFile.exists()) {
                        System.out.println("Image trouvée dans XAMPP: " + xamppFile.getAbsolutePath());
                        return new Image(xamppFile.toURI().toString());
                    } else {
                        System.out.println("Image non trouvée dans XAMPP: " + xamppFile.getAbsolutePath());
                    }
                }
            }
            
            // 2. Si c'est une autre URL HTTP
            if (imageName.startsWith("http://") || imageName.startsWith("https://")) {
                try {
                    System.out.println("URL HTTP détectée, tentative de chargement direct");
                    return new Image(imageName);
                } catch (Exception e) {
                    System.out.println("Échec du chargement direct depuis l'URL HTTP: " + e.getMessage());
                    
                    // Extraire le nom du fichier et essayer depuis XAMPP
                    String fileName = imageName.substring(imageName.lastIndexOf("/") + 1);
                    File xamppFile = new File(XAMPP_IMAGES_DIR + fileName);
                    
                    if (xamppFile.exists()) {
                        System.out.println("Image trouvée dans XAMPP: " + xamppFile.getAbsolutePath());
                        return new Image(xamppFile.toURI().toString());
                    }
                }
            }
            
            // 3. Vérifier si c'est un préfixe xampp: (traitement spécial)
            String finalImageName = getCourseImagePath(imageName);
            if (finalImageName.startsWith("xampp:")) {
                String fileName = finalImageName.substring(6); // Enlever "xampp:"
                File xamppFile = new File(XAMPP_IMAGES_DIR + fileName);
                
                if (xamppFile.exists()) {
                    System.out.println("Image trouvée avec préfixe xampp: " + xamppFile.getAbsolutePath());
                    return new Image(xamppFile.toURI().toString());
                }
            }
            
            // 4. Essayer directement le chemin dans XAMPP
            File directXamppFile = new File(XAMPP_IMAGES_DIR + imageName);
            if (directXamppFile.exists()) {
                System.out.println("Image trouvée directement dans XAMPP: " + directXamppFile.getAbsolutePath());
                return new Image(directXamppFile.toURI().toString());
            }
            
            // 5. Essayer depuis les ressources
            File resourceFile = new File(COURSES_IMAGES_DIR + finalImageName);
            if (resourceFile.exists()) {
                System.out.println("Image trouvée dans les ressources: " + resourceFile.getAbsolutePath());
                return new Image(resourceFile.toURI().toString());
            }
            
            // 6. Si toutes les tentatives ont échoué, charger l'image par défaut
            System.out.println("Toutes les tentatives ont échoué, chargement de l'image par défaut");
            
            // Essayer depuis XAMPP d'abord
            File defaultXamppFile = new File(XAMPP_IMAGES_DIR + DEFAULT_COURSE_IMAGE);
            if (defaultXamppFile.exists()) {
                System.out.println("Image par défaut chargée depuis XAMPP");
                return new Image(defaultXamppFile.toURI().toString());
            }
            
            // Sinon, essayer depuis les ressources
            return new Image(CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE));
            
        } catch (Exception e) {
            System.err.println("Erreur lors du chargement de l'image: " + e.getMessage());
            e.printStackTrace();
            
            try {
                // Retourner l'image par défaut en cas d'erreur
                File defaultXamppFile = new File(XAMPP_IMAGES_DIR + DEFAULT_COURSE_IMAGE);
                if (defaultXamppFile.exists()) {
                    return new Image(defaultXamppFile.toURI().toString());
                }
                
                return new Image(CoursImageUtils.class.getResourceAsStream("/com/user/demo/images/courses/" + DEFAULT_COURSE_IMAGE));
            } catch (Exception ex) {
                // Si même l'image par défaut ne peut pas être chargée, créer une image vide
                System.err.println("Impossible de charger l'image par défaut: " + ex.getMessage());
                return new Image(new java.io.ByteArrayInputStream(new byte[0]));
            }
        }
    }
    
    /**
     * Méthode de diagnostic pour tester le chargement d'une image avec différents formats
     * @param originalUrl L'URL originale de l'image à tester
     * @return true si l'image a pu être chargée avec au moins une méthode
     */
    public static boolean testImageLoading(String originalUrl) {
        System.out.println("\n========== TEST DE CHARGEMENT D'IMAGE ==========");
        System.out.println("URL originale: " + originalUrl);
        
        boolean success = false;
        
        // Test 1: URL originale
        try {
            System.out.println("\nTEST 1: Chargement direct depuis l'URL originale");
            Image image = new Image(originalUrl);
            System.out.println("✅ SUCCÈS: L'image a été chargée directement depuis l'URL originale");
            success = true;
        } catch (Exception e) {
            System.out.println("❌ ÉCHEC: " + e.getMessage());
        }
        
        // Test 2: Extraire le nom du fichier et chercher dans XAMPP
        try {
            System.out.println("\nTEST 2: Extraction du nom de fichier et recherche dans XAMPP");
            String fileName = originalUrl.substring(originalUrl.lastIndexOf("/") + 1);
            System.out.println("Nom de fichier extrait: " + fileName);
            
            File xamppFile = new File(XAMPP_IMAGES_DIR + fileName);
            System.out.println("Chemin XAMPP: " + xamppFile.getAbsolutePath());
            
            if (xamppFile.exists()) {
                System.out.println("Le fichier existe dans XAMPP");
                Image image = new Image(xamppFile.toURI().toString());
                System.out.println("✅ SUCCÈS: L'image a été chargée depuis XAMPP");
                success = true;
            } else {
                System.out.println("❌ ÉCHEC: Le fichier n'existe pas dans XAMPP");
            }
        } catch (Exception e) {
            System.out.println("❌ ÉCHEC: " + e.getMessage());
        }
        
        // Test 3: Chercher dans les ressources
        try {
            System.out.println("\nTEST 3: Recherche dans les ressources");
            String fileName = originalUrl.substring(originalUrl.lastIndexOf("/") + 1);
            File resourceFile = new File(COURSES_IMAGES_DIR + fileName);
            System.out.println("Chemin des ressources: " + resourceFile.getAbsolutePath());
            
            if (resourceFile.exists()) {
                System.out.println("Le fichier existe dans les ressources");
                Image image = new Image(resourceFile.toURI().toString());
                System.out.println("✅ SUCCÈS: L'image a été chargée depuis les ressources");
                success = true;
            } else {
                System.out.println("❌ ÉCHEC: Le fichier n'existe pas dans les ressources");
            }
        } catch (Exception e) {
            System.out.println("❌ ÉCHEC: " + e.getMessage());
        }
        
        // Résultat final
        System.out.println("\nRÉSULTAT FINAL: " + (success ? "✅ Au moins une méthode a fonctionné" : "❌ Toutes les méthodes ont échoué"));
        System.out.println("==============================================\n");
        
        return success;
    }
} 