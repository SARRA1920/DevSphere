package com.user.demo.controller;

import com.user.demo.model.Inscription;
import com.user.demo.model.Cours;
import com.user.demo.model.User;
import com.user.demo.util.DatabaseConnection;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.paint.Color;
import javafx.stage.Modality;
import javafx.stage.Stage;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIcon;
import de.jensd.fx.glyphs.fontawesome.FontAwesomeIconView;

import java.io.IOException;
import java.net.URL;
import java.sql.*;
import java.time.LocalDateTime;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;

public class InscriptionCardViewController implements Initializable {
    private static final Logger LOGGER = Logger.getLogger(InscriptionCardViewController.class.getName());
    
    @FXML
    private FlowPane inscriptionsContainer;
    
    @FXML
    private TextField searchField;
    
    @FXML
    private ComboBox<String> statusFilter;
    
    @FXML
    private ComboBox<String> courseFilter;
    
    @FXML
    private Label statusLabel;
    
    private ObservableList<Inscription> inscriptionsList = FXCollections.observableArrayList();
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // Configuration du conteneur
            inscriptionsContainer.setHgap(20);
            inscriptionsContainer.setVgap(20);
            inscriptionsContainer.setPadding(new Insets(20));
            
            // Configuration des filtres
            setupFilters();
            
            // Ajout des listeners pour les filtres
            searchField.textProperty().addListener((obs, oldVal, newVal) -> filterInscriptions());
            
            // Charger les inscriptions
            loadInscriptions();
            
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'initialisation", e);
            showError("Erreur", "Erreur lors de l'initialisation de la vue");
        }
    }
    
    private void setupFilters() {
        // Status filter
        statusFilter.getItems().addAll("Tous les statuts", "En cours", "Validée", "Annulée");
        statusFilter.setValue("Tous les statuts");
        
        // Course filter
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery("SELECT DISTINCT titre FROM cours ORDER BY titre")) {
            
            courseFilter.getItems().add("Tous les cours");
            while (rs.next()) {
                courseFilter.getItems().add(rs.getString("titre"));
            }
            courseFilter.setValue("Tous les cours");
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des cours", e);
        }
    }
    
    private void loadInscriptions() {
        inscriptionsList.clear();
        
        String query = "SELECT i.*, u.name as user_name, c.titre as cours_titre " +
                       "FROM inscription_cours i " +
                       "JOIN user u ON i.user_id = u.id " +
                       "JOIN cours c ON i.cours_id = c.id " +
                       "ORDER BY i.date_inscription DESC";
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                try {
                    Inscription inscription = new Inscription();
                    inscription.setId(rs.getInt("id"));
                    inscription.setUserId(rs.getInt("user_id"));
                    inscription.setCoursId(rs.getInt("cours_id"));
                    inscription.setNom(rs.getString("nom"));
                    inscription.setEmail(rs.getString("email"));
                    inscription.setTelephone(rs.getString("telephone"));
                    
                    // Pour la compatibilité, si le nom est null, utiliser le nom de l'utilisateur
                    if (inscription.getNom() == null || inscription.getNom().isEmpty()) {
                        inscription.setNom(rs.getString("user_name"));
                    }
                    
                    // Convertir java.sql.Timestamp vers java.time.LocalDateTime
                    Timestamp dateTs = rs.getTimestamp("date_inscription");
                    if (dateTs != null) {
                        LocalDateTime localDateTime = dateTs.toLocalDateTime();
                        inscription.setDateInscription(localDateTime);
                    }
                    
                    String statut = rs.getString("statut");
                    if (statut == null || statut.isEmpty()) {
                        statut = "En cours"; // Valeur par défaut
                    }
                    inscription.setStatut(statut);
                    
                    // Créer et configurer le cours
                    Cours cours = new Cours();
                    cours.setId(rs.getInt("cours_id"));
                    cours.setTitre(rs.getString("cours_titre"));
                    
                    // Définir le cours dans l'inscription
                    inscription.setCours(cours);
                    
                    inscriptionsList.add(inscription);
                    
                    LOGGER.info("Inscription chargée: " + inscription.getId() + " - " + inscription.getNom());
                } catch (Exception e) {
                    LOGGER.log(Level.SEVERE, "Erreur lors du chargement d'une inscription spécifique: " + e.getMessage(), e);
                }
            }
            
            LOGGER.info("Nombre total d'inscriptions chargées: " + inscriptionsList.size());
            filterInscriptions();
            updateStatusLabel();
            
        } catch (SQLException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors du chargement des inscriptions: " + e.getMessage(), e);
            e.printStackTrace();
            showError("Erreur", "Impossible de charger les inscriptions: " + e.getMessage());
        }
    }
    
    private void filterInscriptions() {
        String searchText = searchField.getText().toLowerCase();
        String status = statusFilter.getValue();
        String course = courseFilter.getValue();
        
        inscriptionsContainer.getChildren().clear();
        
        inscriptionsList.stream()
            .filter(inscription -> {
                // Filtre par texte de recherche
                boolean matchesSearch = true;
                if (!searchText.isEmpty()) {
                    matchesSearch = (inscription.getNom().toLowerCase().contains(searchText) ||
                                    inscription.getCours().getTitre().toLowerCase().contains(searchText));
                }
                
                // Filtre par statut
                boolean matchesStatus = true;
                if (!"Tous les statuts".equals(status)) {
                    matchesStatus = status.equals(inscription.getStatut());
                }
                
                // Filtre par cours
                boolean matchesCourse = true;
                if (!"Tous les cours".equals(course)) {
                    matchesCourse = course.equals(inscription.getCours().getTitre());
                }
                
                return matchesSearch && matchesStatus && matchesCourse;
            })
            .forEach(inscription -> inscriptionsContainer.getChildren().add(createInscriptionCard(inscription)));
        
        updateStatusLabel();
    }
    
    private VBox createInscriptionCard(Inscription inscription) {
        VBox card = new VBox(10);
        card.getStyleClass().add("inscription-card");
        card.setPadding(new Insets(15));
        card.setMaxWidth(350);
        card.setMinHeight(200);
        card.setStyle("-fx-background-color: white; -fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.1), 10, 0, 0, 10); -fx-background-radius: 5;");
        
        // Entête avec date uniquement (sans le numéro d'inscription)
        HBox headerBox = new HBox(10);
        headerBox.setAlignment(Pos.CENTER_LEFT);
        
        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        
        Label dateLabel = new Label(inscription.getDateInscription() != null ? 
                                   inscription.getDateInscription().toLocalDate().toString() : "Date non définie");
        dateLabel.setStyle("-fx-text-fill: #555;");
        
        headerBox.getChildren().addAll(spacer, dateLabel);
        
        // Titre du cours
        Label coursLabel = new Label(inscription.getCours().getTitre());
        coursLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-wrap-text: true;");
        
        // Nom de l'étudiant
        Label userLabel = new Label("Étudiant: " + inscription.getNom());
        userLabel.setStyle("-fx-font-size: 14px;");
        
        // Statut de l'inscription avec badge coloré
        HBox statusBox = new HBox(10);
        statusBox.setAlignment(Pos.CENTER_LEFT);
        
        Label statusLabel = new Label(inscription.getStatut());
        String statusStyle = "-fx-padding: 5 10; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 3;";
        
        switch (inscription.getStatut()) {
            case "Validée":
                statusLabel.setStyle(statusStyle + "-fx-background-color: #2ecc71;");
                break;
            case "En cours":
                statusLabel.setStyle(statusStyle + "-fx-background-color: #3498db;");
                break;
            case "Annulée":
                statusLabel.setStyle(statusStyle + "-fx-background-color: #e74c3c;");
                break;
            default:
                statusLabel.setStyle(statusStyle + "-fx-background-color: #95a5a6;");
                break;
        }
        
        statusBox.getChildren().add(statusLabel);
        
        // Boutons d'action
        HBox actionsBox = new HBox(10);
        actionsBox.setAlignment(Pos.CENTER);
        
        // Bouton Détails
        Button detailsBtn = new Button("Détails");
        FontAwesomeIconView detailsIcon = new FontAwesomeIconView(FontAwesomeIcon.EYE);
        detailsIcon.setFill(Color.WHITE);
        detailsBtn.setGraphic(detailsIcon);
        detailsBtn.setStyle("-fx-background-color: #3498db; -fx-text-fill: white;");
        detailsBtn.setOnAction(e -> handleDetails(inscription));
        
        // Bouton Modifier
        Button editBtn = new Button("Modifier");
        FontAwesomeIconView editIcon = new FontAwesomeIconView(FontAwesomeIcon.EDIT);
        editIcon.setFill(Color.WHITE);
        editBtn.setGraphic(editIcon);
        editBtn.setStyle("-fx-background-color: #2ecc71; -fx-text-fill: white;");
        editBtn.setOnAction(e -> handleEdit(inscription));
        
        // Bouton Supprimer
        Button deleteBtn = new Button("Supprimer");
        FontAwesomeIconView deleteIcon = new FontAwesomeIconView(FontAwesomeIcon.TRASH);
        deleteIcon.setFill(Color.WHITE);
        deleteBtn.setGraphic(deleteIcon);
        deleteBtn.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white;");
        deleteBtn.setOnAction(e -> handleDelete(inscription));
        
        actionsBox.getChildren().addAll(detailsBtn, editBtn, deleteBtn);
        
        // Ajouter tous les éléments à la carte
        card.getChildren().addAll(headerBox, coursLabel, userLabel, statusBox, actionsBox);
        
        return card;
    }
    
    private void updateStatusLabel() {
        int visibleCount = inscriptionsContainer.getChildren().size();
        statusLabel.setText(String.format("Affichage de %d sur %d inscriptions", visibleCount, inscriptionsList.size()));
    }
    
    @FXML
    private void handleAddInscription() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/inscription-form.fxml"));
            Parent root = loader.load();
            
            Stage stage = new Stage();
            stage.setTitle("Ajouter une inscription");
            stage.setScene(new Scene(root));
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.showAndWait();
            
            // Recharger les inscriptions après l'ajout
            loadInscriptions();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire d'ajout", e);
            showError("Erreur", "Impossible d'ouvrir le formulaire d'ajout");
        }
    }
    
    private void handleDetails(Inscription inscription) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/inscription-details.fxml"));
            Parent root = loader.load();
            
            // Créer un InscriptionDetailsController personnalisé si nécessaire
            // Pour le moment, afficher un dialogue de détails simple
            Stage stage = new Stage();
            stage.setTitle("Détails de l'inscription");
            
            // Créer une vue de détails simple
            VBox detailsBox = new VBox(15);
            detailsBox.setPadding(new Insets(20));
            detailsBox.setMinWidth(400);
            
            Label titleLabel = new Label("Détails de l'inscription");
            titleLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold;");
            
            detailsBox.getChildren().add(titleLabel);
            detailsBox.getChildren().add(new Separator());
            
            // Ajouter les détails de l'inscription sans l'ID
            detailsBox.getChildren().add(createDetailItem("Nom:", inscription.getNom()));
            detailsBox.getChildren().add(createDetailItem("Cours:", inscription.getCours().getTitre()));
            detailsBox.getChildren().add(createDetailItem("Date:", 
                    inscription.getDateInscription() != null ? 
                            inscription.getDateInscription().toLocalDate().toString() : "Non définie"));
            detailsBox.getChildren().add(createDetailItem("Statut:", inscription.getStatut()));
            
            // Bouton de fermeture
            Button closeButton = new Button("Fermer");
            closeButton.setOnAction(e -> stage.close());
            
            HBox buttonBox = new HBox(closeButton);
            buttonBox.setAlignment(Pos.CENTER_RIGHT);
            
            detailsBox.getChildren().add(buttonBox);
            
            Scene scene = new Scene(detailsBox);
            stage.setScene(scene);
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.showAndWait();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture des détails", e);
            showError("Erreur", "Impossible d'afficher les détails de l'inscription");
        }
    }
    
    private HBox createDetailItem(String label, String value) {
        HBox item = new HBox(10);
        Label labelNode = new Label(label);
        labelNode.setStyle("-fx-font-weight: bold;");
        labelNode.setPrefWidth(100);
        
        Label valueNode = new Label(value);
        
        item.getChildren().addAll(labelNode, valueNode);
        return item;
    }
    
    private void handleEdit(Inscription inscription) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/com/user/demo/views/inscription-form.fxml"));
            Parent root = loader.load();
            
            InscriptionFormController controller = loader.getController();
            // Utiliser setInscriptionForModification pour passer l'inscription à modifier
            controller.setInscriptionForModification(inscription);
            
            Stage stage = new Stage();
            stage.setTitle("Modifier l'inscription");
            stage.setScene(new Scene(root));
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.showAndWait();
            
            // Recharger les inscriptions après modification
            loadInscriptions();
            
        } catch (IOException e) {
            LOGGER.log(Level.SEVERE, "Erreur lors de l'ouverture du formulaire de modification", e);
            showError("Erreur", "Impossible d'ouvrir le formulaire de modification");
        }
    }
    
    private void handleDelete(Inscription inscription) {
        // Afficher une boîte de dialogue de confirmation
        Alert confirmDialog = new Alert(Alert.AlertType.CONFIRMATION);
        confirmDialog.setTitle("Confirmation de suppression");
        confirmDialog.setHeaderText("Supprimer l'inscription");
        confirmDialog.setContentText("Êtes-vous sûr de vouloir supprimer cette inscription pour " + 
                                    inscription.getNom() + " au cours " + inscription.getCours().getTitre() + " ?");
        
        Optional<ButtonType> result = confirmDialog.showAndWait();
        if (result.isPresent() && result.get() == ButtonType.OK) {
            try {
                // Effectuer la suppression dans la base de données
                Connection conn = DatabaseConnection.getConnection();
                String query = "DELETE FROM inscription_cours WHERE id = ?";
                PreparedStatement pstmt = conn.prepareStatement(query);
                pstmt.setInt(1, inscription.getId());
                
                LOGGER.info("Tentative de suppression de l'inscription pour " + inscription.getNom());
                
                int rowsAffected = pstmt.executeUpdate();
                if (rowsAffected > 0) {
                    LOGGER.info("Inscription pour " + inscription.getNom() + " supprimée avec succès");
                    
                    // Afficher un message de succès
                    showAlert(Alert.AlertType.INFORMATION, "Succès", "L'inscription a été supprimée avec succès.");
                    
                    // Rafraîchir la liste
                    loadInscriptions();
                } else {
                    showAlert(Alert.AlertType.WARNING, "Avertissement", "Aucune inscription n'a été supprimée.");
                }
                
            } catch (SQLException e) {
                LOGGER.log(Level.SEVERE, "Erreur lors de la suppression de l'inscription pour " + inscription.getNom() + ": " + e.getMessage(), e);
                showError("Erreur", "Impossible de supprimer l'inscription: " + e.getMessage());
            }
        }
    }
    
    @FXML
    private void handleSearch() {
        filterInscriptions();
    }
    
    @FXML
    private void handleStatusFilter() {
        filterInscriptions();
    }
    
    @FXML
    private void handleCourseFilter() {
        filterInscriptions();
    }
    
    @FXML
    private void handleClearFilters() {
        searchField.clear();
        statusFilter.setValue("Tous les statuts");
        courseFilter.setValue("Tous les cours");
        filterInscriptions();
    }
    
    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
    
    private void showError(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
} 