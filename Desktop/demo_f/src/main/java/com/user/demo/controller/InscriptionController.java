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

import java.net.URL;
import java.sql.*;
import java.time.LocalDateTime;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.io.File;
import java.awt.Desktop;
import java.io.IOException;

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
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            coursList.clear();
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
                CategorieCours categorie = new CategorieCours();
                categorie.setNom(rs.getString("categorie_nom"));
                cours.setCategorie(categorie);
                coursList.add(cours);
            }

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
        
        // Bouton pour voir le PDF (toujours disponible)
        Button pdfButton = new Button("📄 Voir PDF");
        pdfButton.getStyleClass().addAll("pdf-button", "secondary-button");
        pdfButton.setPrefWidth(135);
        
        pdfButton.setOnAction(e -> {
            handleVoirPdf(cours);
        });
        
        buttonsBox.getChildren().add(pdfButton);
        
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
            }

        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'inscription au cours", e);
            showError("Erreur", "Impossible de s'inscrire au cours");
        }
    }

    private void handleVoirPdf(Cours cours) {
        try {
            // Vérifier si l'utilisateur est connecté
            User currentUser = SessionManager.getInstance().getCurrentUser();
            if (currentUser == null) {
                showAlert(Alert.AlertType.WARNING, "Attention", 
                    "Vous devez être connecté pour accéder aux ressources du cours.");
                return;
            }
            
            // Vérifier si l'utilisateur est inscrit à ce cours
            boolean isEnrolled = isUserEnrolledInCourse(cours.getId(), currentUser.getId());
            if (!isEnrolled) {
                showAlert(Alert.AlertType.WARNING, "Accès refusé", 
                    "Vous devez être inscrit à ce cours pour accéder à ses ressources.\n" +
                    "Veuillez vous inscrire au cours \"" + cours.getTitre() + "\" pour y accéder.");
                return;
            }
            
            String pdfFilename = cours.getPdfFilename();
            if (pdfFilename != null && !pdfFilename.isEmpty()) {
                System.out.println("Tentative d'ouverture du PDF: " + pdfFilename + " pour le cours ID: " + cours.getId() + " - " + cours.getTitre());
                
                // S'assurer que le nom du fichier se termine par .pdf
                if (!pdfFilename.toLowerCase().endsWith(".pdf")) {
                    pdfFilename += ".pdf";
                }
                
                // Liste des chemins possibles à vérifier
                String[] possiblePaths = {
                    "C:\\Users\\maram\\demo\\src\\main\\resources\\pdf\\cours\\",
                    "C:\\Users\\maram\\Downloads\\"
                };
                
                File pdfFile = null;
                boolean fileFound = false;
                
                // Vérifier chaque chemin possible
                for (String folderPath : possiblePaths) {
                    File tempFile = new File(folderPath + pdfFilename);
                    System.out.println("Vérification de l'existence du fichier à: " + tempFile.getAbsolutePath());
                    if (tempFile.exists()) {
                        pdfFile = tempFile;
                        fileFound = true;
                        System.out.println("Fichier PDF trouvé à: " + pdfFile.getAbsolutePath());
                        break;
                    }
                }
                
                if (fileFound && pdfFile != null) {
                    Desktop.getDesktop().open(pdfFile);
                    System.out.println("PDF ouvert avec succès: " + pdfFile.getAbsolutePath());
                } else {
                    // Vérifier le contenu des dossiers recherchés
                    System.out.println("Le fichier PDF n'a pas été trouvé dans les emplacements recherchés");
                    for (String folderPath : possiblePaths) {
                        File dir = new File(folderPath);
                        System.out.println("Contenu du dossier (" + dir.getAbsolutePath() + "):");
                        File[] files = dir.listFiles();
                        if (files != null && files.length > 0) {
                            for (File file : files) {
                                System.out.println(" - " + file.getName());
                            }
                        } else {
                            System.out.println("Le dossier est vide ou n'existe pas");
                        }
                    }
                    
                    // Tenter de copier le fichier du dossier de téléchargement vers le dossier de ressources
                    File downloadFile = new File("C:\\Users\\maram\\Downloads\\" + pdfFilename);
                    if (downloadFile.exists()) {
                        File resourcesDir = new File("C:\\Users\\maram\\demo\\src\\main\\resources\\pdf\\cours\\");
                        if (!resourcesDir.exists()) {
                            resourcesDir.mkdirs();
                        }
                        
                        File resourceFile = new File(resourcesDir, pdfFilename);
                        try {
                            java.nio.file.Files.copy(
                                downloadFile.toPath(),
                                resourceFile.toPath(),
                                java.nio.file.StandardCopyOption.REPLACE_EXISTING
                            );
                            System.out.println("Fichier copié de " + downloadFile.getAbsolutePath() + " vers " + resourceFile.getAbsolutePath());
                            
                            // Ouvrir le fichier copié
                            Desktop.getDesktop().open(resourceFile);
                            System.out.println("PDF copié et ouvert avec succès: " + resourceFile.getAbsolutePath());
                            return;
                        } catch (IOException e) {
                            System.out.println("Erreur lors de la copie du fichier: " + e.getMessage());
                        }
                    }
                    
                    showAlert(Alert.AlertType.ERROR, "Erreur", 
                        "Le fichier PDF \"" + pdfFilename + "\" n'a pas été trouvé.\n" +
                        "Emplacements vérifiés :\n" +
                        "- " + possiblePaths[0] + "\n" +
                        "- " + possiblePaths[1] + "\n\n" +
                        "Veuillez placer le fichier dans l'un de ces emplacements.");
                }
            } else {
                showAlert(Alert.AlertType.WARNING, "Attention", 
                    "Aucun fichier PDF n'est associé à ce cours.");
            }
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du PDF", e);
            showAlert(Alert.AlertType.ERROR, "Erreur", 
                "Impossible d'ouvrir le fichier PDF : " + e.getMessage());
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
} 