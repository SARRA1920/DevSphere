package com.user.demo.controller;

import com.user.demo.model.Cours;
import com.user.demo.model.Inscription;
import com.user.demo.model.CategorieCours;
import com.user.demo.model.User;
import com.user.demo.util.DatabaseConnection;
import com.user.demo.util.SessionManager;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.geometry.Insets;
import javafx.scene.Node;
import javafx.scene.text.Text;
import javafx.scene.text.TextFlow;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import javafx.event.ActionEvent;

import java.net.URL;
import java.sql.*;
import java.time.LocalDateTime;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.io.File;
import java.awt.Desktop;
import java.io.IOException;
import com.user.demo.utils.FileUploadUtils;

public class InscriptionController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(InscriptionController.class.getName());
    
    @FXML
    private FlowPane coursContainer;
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ComboBox<String> categoryFilter;
    
    @FXML
    private ComboBox<String> statusFilter;

    private ObservableList<Cours> coursList = FXCollections.observableArrayList();
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // Configuration des filtres
        categoryFilter.getItems().addAll("Toutes les catégories", "Programmation", "Design", "Business");
        categoryFilter.setValue("Toutes les catégories");
        
        statusFilter.getItems().addAll("Tous les statuts", "Disponible", "Complet");
        statusFilter.setValue("Tous les statuts");

        // Ajout des listeners pour les filtres
        searchField.textProperty().addListener((obs, oldVal, newVal) -> filterCours());
        categoryFilter.valueProperty().addListener((obs, oldVal, newVal) -> filterCours());
        statusFilter.valueProperty().addListener((obs, oldVal, newVal) -> filterCours());

        // Chargement des cours
        loadCours();
    }

    private void loadCours() {
        String query = "SELECT c.*, cc.nom as categorie_nom FROM cours c " +
                      "LEFT JOIN categorie_cours cc ON c.categorie_cours_id = cc.id";
        
        LOGGER.info("Chargement des cours depuis la base de données...");
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            coursList.clear();
            int liveCours = 0;
            
            while (rs.next()) {
                Cours cours = new Cours();
                cours.setId(rs.getInt("id"));
                cours.setTitre(rs.getString("titre"));
                cours.setDescription(rs.getString("description"));
                cours.setDuree(rs.getString("duree"));
                cours.setNiveau(rs.getString("niveau"));
                cours.setInstructeur(rs.getString("instructeur"));
                cours.setImage(rs.getString("image"));
                cours.setPdfFilename(rs.getString("pdf_filename"));
                
                // Récupérer explicitement le statut live
                boolean isLive = rs.getBoolean("is_live");
                cours.setLive(isLive);
                
                if (isLive) {
                    liveCours++;
                    LOGGER.info("Cours en DIRECT trouvé: ID=" + cours.getId() + ", Titre=" + cours.getTitre());
                }
                
                CategorieCours categorie = new CategorieCours();
                categorie.setNom(rs.getString("categorie_nom"));
                cours.setCategorie(categorie);
                coursList.add(cours);
            }
            
            LOGGER.info("Chargement terminé: " + coursList.size() + " cours au total, dont " + liveCours + " en direct");

            displayCours(coursList);

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours", e);
            showError("Erreur", "Impossible de charger la liste des cours");
        }
    }

    private void displayCours(ObservableList<Cours> cours) {
        coursContainer.getChildren().clear();
        for (Cours c : cours) {
            coursContainer.getChildren().add(createCoursCard(c));
        }
    }

    private Node createCoursCard(Cours cours) {
        VBox card = new VBox(10);
        card.getStyleClass().add("course-card");
        card.setPadding(new Insets(15));
        card.setPrefWidth(300);
        card.setMaxWidth(300);
        
        // En-tête avec numéro et titre
        HBox header = new HBox(10);
        Label number = new Label("#" + cours.getId());
        number.getStyleClass().add("card-number");
        
        Label title = new Label(cours.getTitre());
        title.getStyleClass().add("card-title");
        title.setWrapText(true);
        title.setStyle("-fx-font-weight: bold; -fx-font-size: 16px;");
        
        header.getChildren().addAll(number, title);
        
        // Catégorie
        HBox categoryBox = new HBox(5);
        Label categoryLabel = new Label("🏷️ " + cours.getCategorie().getNom());
        categoryLabel.getStyleClass().add("card-category");
        categoryBox.getChildren().add(categoryLabel);
        
        // Description
        Text description = new Text(cours.getDescription());
        description.setWrappingWidth(270);
        TextFlow descriptionFlow = new TextFlow(description);
        
        // Détails
        VBox details = new VBox(5);
        details.getStyleClass().add("card-details");
        
        Label niveau = new Label("📊 Niveau: " + cours.getNiveau());
        Label duree = new Label("⏱️ Durée: " + cours.getDuree());
        Label instructeur = new Label("👨‍🏫 Instructeur: " + cours.getInstructeur());
        
        details.getChildren().addAll(niveau, duree, instructeur);
        
        // Boutons actions
        HBox buttonsBox = new HBox(10);
        buttonsBox.setAlignment(javafx.geometry.Pos.CENTER);
        
        // Vérifier si l'utilisateur est connecté
        boolean isUserLoggedIn = SessionManager.getInstance().getCurrentUser() != null;
        // Vérifier si l'utilisateur est déjà inscrit à ce cours
        boolean isUserEnrolled = isUserLoggedIn && isUserEnrolledInCourse(cours.getId(), SessionManager.getInstance().getCurrentUser().getId());
        
        // Vérifier si le cours est en direct
        boolean isCoursLive = cours.isLive();
        
        // Si le cours est en direct et que l'utilisateur est inscrit, afficher le bouton Live
        if (isCoursLive && isUserEnrolled) {
            Button liveButton = new Button("🔴 EN DIRECT");
            liveButton.getStyleClass().addAll("live-button");
            liveButton.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white; -fx-font-weight: bold; -fx-padding: 5 10; -fx-background-radius: 5;");
            liveButton.setPrefWidth(135);
            
            liveButton.setOnAction(e -> {
                handleJoinLive(cours);
            });
            
            buttonsBox.getChildren().add(liveButton);
        }
        
        // Bouton d'inscription ou statut
        if (isUserEnrolled) {
            // Si l'utilisateur est déjà inscrit, montrer un label de statut au lieu du bouton
            Label statusLabel = new Label("✓ Inscrit");
            statusLabel.getStyleClass().add("status-inscrit");
            statusLabel.setStyle("-fx-background-color: #dff0d8; -fx-text-fill: #3c763d; -fx-padding: 5 10; -fx-background-radius: 3;");
            statusLabel.setPrefWidth(135);
            statusLabel.setAlignment(javafx.geometry.Pos.CENTER);
            buttonsBox.getChildren().add(statusLabel);
        } else {
            // Sinon, montrer le bouton d'inscription
            Button inscriptionButton = new Button("✅ S'inscrire");
            inscriptionButton.getStyleClass().addAll("inscription-button", "primary-button");
            inscriptionButton.setPrefWidth(135);
            
            inscriptionButton.setOnAction(e -> {
                if (!isUserLoggedIn) {
                    showError("Erreur", "Vous devez être connecté pour vous inscrire à un cours");
                } else {
                    handleInscription(cours);
                }
            });
            
            buttonsBox.getChildren().add(inscriptionButton);
        }
        
        // Bouton PDF s'il y a un PDF associé
        if (cours.getPdfFilename() != null && !cours.getPdfFilename().isEmpty()) {
            Button pdfButton = new Button("📄 Voir PDF");
            pdfButton.getStyleClass().add("pdf-button");
            pdfButton.setStyle("-fx-background-color: #3498db; -fx-text-fill: white; -fx-padding: 5 10; -fx-background-radius: 5;");
            pdfButton.setPrefWidth(135);
            
            // Associer le cours au bouton
            pdfButton.setUserData(cours);
            
            pdfButton.setOnAction(e -> {
                handleViewPdf(e);
            });
            
            buttonsBox.getChildren().add(pdfButton);
        }
        
        // Style de la carte
        card.setStyle("-fx-background-color: white; -fx-effect: dropshadow(gaussian, rgba(0,0,0,0.1), 10, 0, 0, 3);");
        
        // Assemblage de la carte
        card.getChildren().addAll(header, categoryBox, descriptionFlow, details, buttonsBox);
        
        return card;
    }

    private boolean isUserEnrolledInCourse(int coursId, int userId) {
        String query = "SELECT COUNT(*) FROM inscription_cours WHERE cours_id = ? AND user_id = ?";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, coursId);
            stmt.setInt(2, userId);
            
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1) > 0;
                }
            }
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de la vérification de l'inscription", e);
        }
        return false;
    }

    private void filterCours() {
        String searchText = searchField.getText().toLowerCase();
        String category = categoryFilter.getValue();
        String status = statusFilter.getValue();
        
        ObservableList<Cours> filteredList = coursList.filtered(cours -> {
            boolean matchesSearch = cours.getTitre().toLowerCase().contains(searchText) ||
                                  cours.getDescription().toLowerCase().contains(searchText);
            boolean matchesCategory = category.equals("Toutes les catégories") || 
                                    (cours.getCategorie() != null && 
                                     cours.getCategorie().getNom().equals(category));
            boolean matchesStatus = status.equals("Tous les statuts");
            
            return matchesSearch && matchesCategory && matchesStatus;
        });
        
        displayCours(filteredList);
    }
    
    @FXML
    private void handleClearFilters() {
        searchField.clear();
        categoryFilter.setValue("Toutes les catégories");
        statusFilter.setValue("Tous les statuts");
    }

    private void handleInscription(Cours cours) {
        try (Connection conn = DatabaseConnection.getConnection()) {
            // Vérifie si l'utilisateur est déjà inscrit
            String checkQuery = "SELECT * FROM inscription_cours WHERE cours_id = ? AND user_id = ?";
            try (PreparedStatement checkStmt = conn.prepareStatement(checkQuery)) {
                checkStmt.setInt(1, cours.getId());
                checkStmt.setInt(2, SessionManager.getInstance().getCurrentUser().getId());
                
                ResultSet rs = checkStmt.executeQuery();
                if (rs.next()) {
                    showError("Erreur", "Vous êtes déjà inscrit à ce cours");
                    return;
                }
            }

            // Crée l'inscription
            String insertQuery = "INSERT INTO inscription_cours (cours_id, user_id, nom, email, telephone, created_at, date_inscription, statut) " +
                                "VALUES (?, ?, ?, ?, ?, NOW(), NOW(), 'En attente')";
            try (PreparedStatement pstmt = conn.prepareStatement(insertQuery)) {
                User currentUser = SessionManager.getInstance().getCurrentUser();
                
                pstmt.setInt(1, cours.getId());
                pstmt.setInt(2, currentUser.getId());
                pstmt.setString(3, currentUser.getName());
                pstmt.setString(4, currentUser.getEmail());
                pstmt.setString(5, "");  // Téléphone (valeur par défaut vide)
                
                pstmt.executeUpdate();
                showInfo("Succès", "Inscription réussie au cours : " + cours.getTitre());
                
                // Rafraîchir l'affichage pour mettre à jour les boutons
                refreshDisplayAfterInscription();
            }

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'inscription au cours", e);
            showError("Erreur", "Impossible de s'inscrire au cours");
        }
    }

    // Méthode pour rafraîchir l'affichage après une inscription
    private void refreshDisplayAfterInscription() {
        try {
            // On recharge les cours depuis la base de données
            loadCours();
            
            // Alternative: on pourrait simplement recharger la vue actuelle
            // sans requêter à nouveau la base de données
            // filterCours();
        } catch (Exception e) {
            LOGGER.log(Level.WARNING, "Erreur lors du rafraîchissement de l'affichage", e);
        }
    }

    @FXML
    private void handleViewPdf(ActionEvent event) {
        try {
            // Obtenir le cours à partir de la source de l'événement
            Button source = (Button) event.getSource();
            Cours cours = (Cours) source.getUserData();
            
            if (cours != null) {
                String pdfUrl = cours.getPdfFilename();
                if (pdfUrl != null && !pdfUrl.isEmpty()) {
                    System.out.println("Tentative d'ouverture du PDF: " + pdfUrl + " pour le cours ID: " + cours.getId() + " - " + cours.getTitre());
                    
                    // S'assurer que le nom du fichier se termine par .pdf
                    String pdfFilename = FileUploadUtils.extractFilenameFromUrl(pdfUrl);
                    if (!pdfFilename.toLowerCase().endsWith(".pdf")) {
                        pdfFilename += ".pdf";
                    }
                    
                    // Vérifier si c'est une URL ou un nom de fichier
                    String localPath = null;
                    
                    if (pdfUrl.startsWith("http://") || pdfUrl.startsWith("https://")) {
                        // C'est une URL - Obtenir le chemin local à partir de l'URL
                        if (FileUploadUtils.fileExists(pdfUrl, false)) {
                            localPath = FileUploadUtils.getFilePath(pdfUrl, false);
                            System.out.println("PDF trouvé dans le répertoire XAMPP: " + localPath);
                        }
                    }
                    
                    // Si on n'a pas trouvé le fichier dans le répertoire principal, essayer les anciens chemins
                    if (localPath == null || !new File(localPath).exists()) {
                        System.out.println("PDF non trouvé dans le répertoire XAMPP, recherche dans les anciens chemins");
                        
                        // Liste des chemins possibles à vérifier (anciens emplacements pour la compatibilité)
                        String[] possiblePaths = {
                            "C:\\xampp\\htdocs\\img\\pdfs\\",
                            "C:\\Users\\maram\\demo\\src\\main\\resources\\pdf\\cours\\",
                            "C:\\Users\\maram\\Downloads\\"
                        };
                        
                        // Vérifier chaque chemin possible
                        for (String folderPath : possiblePaths) {
                            File tempFile = new File(folderPath + pdfFilename);
                            System.out.println("Vérification de l'existence du fichier à: " + tempFile.getAbsolutePath());
                            
                            if (tempFile.exists()) {
                                localPath = tempFile.getAbsolutePath();
                                System.out.println("Fichier PDF trouvé à: " + localPath);
                                
                                // Si le fichier n'est pas dans le répertoire XAMPP, le copier
                                if (!folderPath.equals(possiblePaths[0])) {
                                    try {
                                        // Copier le fichier vers le répertoire XAMPP pour les futures utilisations
                                        String newPdfUrl = FileUploadUtils.uploadPdf(tempFile, pdfFilename);
                                        System.out.println("PDF copié vers le répertoire XAMPP: " + newPdfUrl);
                                        
                                        // Mettre à jour l'URL dans la base de données
                                        updatePdfUrlInDatabase(cours.getId(), newPdfUrl);
                                    } catch (Exception e) {
                                        System.err.println("Erreur lors de la copie du PDF vers le répertoire XAMPP: " + e.getMessage());
                                    }
                                }
                                
                                break; // On a trouvé le fichier, on arrête la recherche
                            }
                        }
                    }
                    
                    // Tenter d'ouvrir le fichier si on l'a trouvé
                    if (localPath != null && new File(localPath).exists()) {
                        try {
                            // Afficher les informations du fichier
                            File pdfFile = new File(localPath);
                            System.out.println("Ouverture du fichier PDF:");
                            System.out.println("- Chemin: " + pdfFile.getAbsolutePath());
                            System.out.println("- Taille: " + pdfFile.length() + " octets");
                            System.out.println("- Peut lire: " + pdfFile.canRead());
                            
                            // Ouvrir le fichier avec l'application par défaut
                            Desktop.getDesktop().open(pdfFile);
                            System.out.println("PDF ouvert avec succès");
                        } catch (IOException e) {
                            System.err.println("Erreur lors de l'ouverture du PDF: " + e.getMessage());
                            e.printStackTrace();
                            showAlert(Alert.AlertType.ERROR, "Erreur", 
                                "Impossible d'ouvrir le fichier PDF: " + e.getMessage());
                        }
                    } else {
                        System.err.println("PDF non trouvé: " + pdfFilename);
                        showAlert(Alert.AlertType.ERROR, "Erreur", 
                            "Le fichier PDF \"" + pdfFilename + "\" n'a pas été trouvé.\n" +
                            "Veuillez contacter l'administrateur.");
                    }
                } else {
                    showAlert(Alert.AlertType.WARNING, "Attention", 
                        "Aucun fichier PDF n'est associé à ce cours.");
                }
            }
        } catch (Exception e) {
            System.err.println("Erreur générale lors de la manipulation du PDF: " + e.getMessage());
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Une erreur est survenue lors de la manipulation du PDF: " + e.getMessage());
        }
    }

    /**
     * Met à jour l'URL du PDF dans la base de données
     * 
     * @param coursId ID du cours
     * @param newPdfUrl Nouvelle URL du PDF
     */
    private void updatePdfUrlInDatabase(int coursId, String newPdfUrl) {
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement("UPDATE cours SET pdf_filename = ? WHERE id = ?")) {
            
            stmt.setString(1, newPdfUrl);
            stmt.setInt(2, coursId);
            int updated = stmt.executeUpdate();
            
            if (updated > 0) {
                System.out.println("URL du PDF mise à jour dans la base de données pour le cours ID=" + coursId);
            } else {
                System.out.println("Échec de la mise à jour de l'URL du PDF dans la base de données pour le cours ID=" + coursId);
            }
            
        } catch (SQLException e) {
            System.out.println("Erreur lors de la mise à jour de l'URL du PDF: " + e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType type, String title, String message) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    private void showInfo(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    // Méthode pour rejoindre un live
    private void handleJoinLive(Cours cours) {
        try {
            // Vérifier si l'utilisateur est connecté
            User currentUser = SessionManager.getInstance().getCurrentUser();
            if (currentUser == null) {
                showAlert(Alert.AlertType.WARNING, "Attention", 
                    "Vous devez être connecté pour rejoindre le live.");
                return;
            }
            
            // Vérifier si l'utilisateur est inscrit à ce cours
            boolean isEnrolled = isUserEnrolledInCourse(cours.getId(), currentUser.getId());
            if (!isEnrolled) {
                showAlert(Alert.AlertType.WARNING, "Accès refusé", 
                    "Vous devez être inscrit à ce cours pour rejoindre le live.\n" +
                    "Veuillez vous inscrire au cours \"" + cours.getTitre() + "\" pour y accéder.");
                return;
            }
            
            // Charger la vue du live
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/live-view.fxml"));
            Parent root = loader.load();
            
            // Configurer le contrôleur en mode participant
            LiveViewController controller = loader.getController();
            controller.setCours(cours);
            controller.setParticipantMode(true); // Définir le mode participant
            
            // Créer une nouvelle fenêtre
            Stage liveStage = new Stage();
            liveStage.setTitle("Live - " + cours.getTitre() + " (Participant)");
            liveStage.setScene(new Scene(root));
            liveStage.setMaximized(true);
            liveStage.show();
            
            // Informer l'utilisateur
            LOGGER.info("Utilisateur " + currentUser.getName() + " a rejoint le live du cours: " + cours.getTitre() + " en tant que participant");
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture de la fenêtre du live", e);
            showError("Erreur", "Impossible de rejoindre le live: " + e.getMessage());
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur inattendue", e);
            showError("Erreur", "Une erreur inattendue s'est produite: " + e.getMessage());
        }
    }
} 