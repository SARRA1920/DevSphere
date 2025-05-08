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
 * Utilitaire pour gérer les téléchargements de fichiers (images et PDFs)
 */
public class FileUploadUtils {
    
    private static final Logger LOGGER = Logger.getLogger(FileUploadUtils.class.getName());
    
    // Chemin de base pour les téléchargements
    private static final String UPLOAD_BASE_PATH = "C:\\xampp\\htdocs\\img";
    
    // Base URL pour accéder aux fichiers
    private static final String BASE_URL = "http://localhost/img";
    
    // Sous-dossiers
    private static final String IMAGES_SUBFOLDER = "images";
    private static final String PDF_SUBFOLDER = "pdfs";
    
    // Initialisation statique pour créer les dossiers nécessaires
    static {
        initializeDirectories();
    }
    
    /**
     * Initialise les répertoires nécessaires pour les uploads
     */
    public static void initializeDirectories() {
        try {
            // Créer le répertoire de base
            Path basePath = Paths.get(UPLOAD_BASE_PATH);
            if (!Files.exists(basePath)) {
                Files.createDirectories(basePath);
                LOGGER.info("Répertoire de base créé: " + basePath);
            }
            
            // Créer le sous-répertoire pour les images
            Path imagesPath = Paths.get(UPLOAD_BASE_PATH, IMAGES_SUBFOLDER);
            if (!Files.exists(imagesPath)) {
                Files.createDirectories(imagesPath);
                LOGGER.info("Répertoire d'images créé: " + imagesPath);
            }
            
            // Créer le sous-répertoire pour les PDFs
            Path pdfsPath = Paths.get(UPLOAD_BASE_PATH, PDF_SUBFOLDER);
            if (!Files.exists(pdfsPath)) {
                Files.createDirectories(pdfsPath);
                LOGGER.info("Répertoire de PDFs créé: " + pdfsPath);
            }
            
            System.out.println("Répertoires d'upload initialisés:");
            System.out.println("- Base: " + basePath);
            System.out.println("- Images: " + imagesPath);
            System.out.println("- PDFs: " + pdfsPath);
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'initialisation des répertoires d'upload", e);
            System.err.println("ERREUR CRITIQUE: Impossible de créer les répertoires d'upload: " + e.getMessage());
            e.printStackTrace();
        }
    }
    
    /**
     * Télécharge une image dans le dossier configuré
     * 
     * @param file Fichier image à télécharger
     * @param customFilename Nom personnalisé pour le fichier (null pour utiliser le nom original)
     * @return L'URL complète de l'image téléchargée
     * @throws IOException En cas d'erreur lors du téléchargement
     */
    public static String uploadImage(File file, String customFilename) throws IOException {
        return uploadFile(file, customFilename, IMAGES_SUBFOLDER);
    }
    
    /**
     * Télécharge un PDF dans le dossier configuré
     * 
     * @param file Fichier PDF à télécharger
     * @param customFilename Nom personnalisé pour le fichier (null pour utiliser le nom original)
     * @return L'URL complète du PDF téléchargé
     * @throws IOException En cas d'erreur lors du téléchargement
     */
    public static String uploadPdf(File file, String customFilename) throws IOException {
        return uploadFile(file, customFilename, PDF_SUBFOLDER);
    }
    
    /**
     * Méthode générique pour télécharger un fichier
     * 
     * @param file Fichier à télécharger
     * @param customFilename Nom personnalisé (null pour utiliser le nom original)
     * @param subfolder Sous-dossier où placer le fichier
     * @return L'URL complète du fichier téléchargé
     * @throws IOException En cas d'erreur lors du téléchargement
     */
    private static String uploadFile(File file, String customFilename, String subfolder) throws IOException {
        try {
            // Créer le répertoire de destination s'il n'existe pas
            Path destFolder = Paths.get(UPLOAD_BASE_PATH, subfolder);
            if (!Files.exists(destFolder)) {
                Files.createDirectories(destFolder);
                System.out.println("Répertoire créé: " + destFolder);
                
                // S'assurer que le répertoire est accessible en écriture
                File folderFile = destFolder.toFile();
                if (!folderFile.canWrite()) {
                    folderFile.setWritable(true, false);
                    System.out.println("Permissions d'écriture définies pour: " + destFolder);
                }
            }
            
            // Déterminer le nom de fichier à utiliser
            String filename;
            if (customFilename != null && !customFilename.trim().isEmpty()) {
                filename = customFilename;
            } else {
                // Générer un nom unique basé sur le timestamp
                String extension = getFileExtension(file.getName());
                String baseName = removeExtension(file.getName());
                filename = baseName + "_" + System.currentTimeMillis() + extension;
            }
            
            // Copier le fichier vers la destination
            Path destPath = destFolder.resolve(filename);
            Files.copy(file.toPath(), destPath, StandardCopyOption.REPLACE_EXISTING);
            
            // S'assurer que le fichier est accessible en lecture
            File destFile = destPath.toFile();
            if (!destFile.canRead()) {
                destFile.setReadable(true, false);
                System.out.println("Permissions de lecture définies pour: " + destPath);
            }
            
            LOGGER.log(Level.INFO, "Fichier téléchargé avec succès: {0}", destPath.toString());
            System.out.println("Fichier téléchargé avec succès: " + destPath);
            
            // Retourner l'URL complète du fichier (utilisable dans un navigateur)
            String url = BASE_URL + "/" + subfolder + "/" + filename;
            System.out.println("URL générée: " + url);
            return url;
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du téléchargement du fichier", e);
            System.err.println("Erreur lors du téléchargement du fichier: " + e.getMessage());
            e.printStackTrace();
            throw e;
        }
    }
    
    /**
     * Obtient l'extension d'un fichier (avec le point)
     */
    private static String getFileExtension(String filename) {
        int lastDotIndex = filename.lastIndexOf('.');
        if (lastDotIndex > 0) {
            return filename.substring(lastDotIndex);
        }
        return "";
    }
    
    /**
     * Supprime l'extension d'un nom de fichier
     */
    private static String removeExtension(String filename) {
        int lastDotIndex = filename.lastIndexOf('.');
        if (lastDotIndex > 0) {
            return filename.substring(0, lastDotIndex);
        }
        return filename;
    }
    
    /**
     * Vérifie si un fichier existe dans le dossier de téléchargement
     * 
     * @param url URL du fichier ou nom du fichier
     * @param isImage true pour vérifier dans le dossier images, false pour PDFs
     * @return true si le fichier existe
     */
    public static boolean fileExists(String url, boolean isImage) {
        try {
            // Si l'URL est vide, retourner false
            if (url == null || url.trim().isEmpty()) {
                return false;
            }
            
            // Extraire le nom du fichier de l'URL si c'est une URL
            String filename = extractFilenameFromUrl(url);
            if (filename.isEmpty()) {
                return false;
            }
            
            // Vérifier si le fichier existe dans le dossier approprié
            String subfolder = isImage ? IMAGES_SUBFOLDER : PDF_SUBFOLDER;
            Path filePath = Paths.get(UPLOAD_BASE_PATH, subfolder, filename);
            
            System.out.println("Vérification de l'existence du fichier: " + filePath);
            boolean exists = Files.exists(filePath);
            System.out.println("Le fichier existe: " + exists);
            
            return exists;
        } catch (Exception e) {
            System.err.println("Erreur lors de la vérification de l'existence du fichier: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Obtient le chemin complet d'un fichier
     * 
     * @param url URL du fichier ou nom du fichier
     * @param isImage true pour un fichier image, false pour un PDF
     * @return Le chemin complet du fichier
     */
    public static String getFilePath(String url, boolean isImage) {
        // Extraire le nom du fichier de l'URL si c'est une URL
        String filename = extractFilenameFromUrl(url);
        
        String subfolder = isImage ? IMAGES_SUBFOLDER : PDF_SUBFOLDER;
        return Paths.get(UPLOAD_BASE_PATH, subfolder, filename).toString();
    }
    
    /**
     * Extrait le nom du fichier d'une URL
     * 
     * @param url URL ou chemin du fichier
     * @return Le nom du fichier
     */
    public static String extractFilenameFromUrl(String url) {
        try {
            if (url == null || url.trim().isEmpty()) {
                return "";
            }
            
            System.out.println("Extraction du nom de fichier à partir de: " + url);
            
            // Si c'est une URL, extraire le nom du fichier
            if (url.startsWith("http://") || url.startsWith("https://")) {
                // Supprimer les paramètres d'URL s'il y en a
                String cleanUrl = url.contains("?") ? url.substring(0, url.indexOf("?")) : url;
                
                // Récupérer la dernière partie de l'URL après le dernier /
                String filename = cleanUrl.substring(cleanUrl.lastIndexOf('/') + 1);
                System.out.println("Nom de fichier extrait de l'URL: " + filename);
                return filename;
            }
            
            // Si c'est un chemin local, extraire le nom du fichier
            if (url.contains("\\") || url.contains("/")) {
                String filename = url.substring(Math.max(url.lastIndexOf('\\'), url.lastIndexOf('/')) + 1);
                System.out.println("Nom de fichier extrait du chemin: " + filename);
                return filename;
            }
            
            // Sinon, c'est déjà un nom de fichier
            System.out.println("Déjà un nom de fichier: " + url);
            return url;
        } catch (Exception e) {
            System.err.println("Erreur lors de l'extraction du nom de fichier à partir de l'URL: " + e.getMessage());
            e.printStackTrace();
            return "";
        }
    }
    
    /**
     * Obtient l'URL complète d'un fichier à partir de son nom
     * 
     * @param filename Nom du fichier
     * @param isImage true pour un fichier image, false pour un PDF
     * @return L'URL complète du fichier
     */
    public static String getFileUrl(String filename, boolean isImage) {
        // Si c'est déjà une URL, la retourner telle quelle
        if (filename != null && (filename.startsWith("http://") || filename.startsWith("https://"))) {
            return filename;
        }
        
        String subfolder = isImage ? IMAGES_SUBFOLDER : PDF_SUBFOLDER;
        return BASE_URL + "/" + subfolder + "/" + extractFilenameFromUrl(filename);
    }
    
    /**
     * Obtient l'URI file:// d'un fichier pour l'utiliser avec JavaFX
     * 
     * @param filename Nom du fichier
     * @param isImage true pour un fichier image, false pour un PDF
     * @return L'URI file:// du fichier
     */
    public static String getFileUri(String filename, boolean isImage) {
        try {
            // Si c'est déjà une URL http, la retourner telle quelle
            if (filename != null && (filename.startsWith("http://") || filename.startsWith("https://"))) {
                return filename;
            }
            
            // Si c'est déjà une URI file://, la retourner telle quelle
            if (filename != null && filename.startsWith("file:/")) {
                return filename;
            }
            
            // Extraire le nom du fichier
            String extractedFilename = extractFilenameFromUrl(filename);
            
            // Créer un objet File pointant vers le fichier dans le dossier approprié
            String subfolder = isImage ? IMAGES_SUBFOLDER : PDF_SUBFOLDER;
            File file = new File(UPLOAD_BASE_PATH, subfolder + File.separator + extractedFilename);
            
            // Vérifier que le fichier existe
            if (!file.exists()) {
                System.out.println("ATTENTION: Le fichier n'existe pas: " + file.getAbsolutePath());
            }
            
            // Retourner l'URI file://
            String uri = file.toURI().toString();
            System.out.println("URI générée: " + uri);
            return uri;
        } catch (Exception e) {
            System.err.println("Erreur lors de la génération de l'URI file:// pour " + filename + ": " + e.getMessage());
            return null;
        }
    }
} 