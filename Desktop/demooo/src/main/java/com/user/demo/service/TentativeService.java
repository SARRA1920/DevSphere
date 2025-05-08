package com.user.demo.service;

import com.user.demo.model.Tentative;
import com.user.demo.model.Exercice;
import com.user.demo.util.DatabaseConnection;
import java.sql.*;
import java.time.LocalDateTime;
import java.util.List;
import java.util.ArrayList;
import java.util.regex.Pattern;
import java.util.regex.Matcher;

public class TentativeService {
    
    private final ExerciceService exerciceService = new ExerciceService();
    
    public void ajouter(Tentative tentative) {
        String query = "INSERT INTO tentative (user_id, exercice_id, score, reponse, date, statue, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query, Statement.RETURN_GENERATED_KEYS)) {
            
            pstmt.setInt(1, tentative.getUser_id());
            pstmt.setInt(2, tentative.getExercice_id());
            pstmt.setInt(3, tentative.getScore());
            pstmt.setString(4, tentative.getReponse());
            pstmt.setTimestamp(5, Timestamp.valueOf(LocalDateTime.now()));
            pstmt.setString(6, tentative.getStatue());
            pstmt.setDouble(7, tentative.getNote());
            
            pstmt.executeUpdate();
            
            // Récupérer l'ID généré
            try (ResultSet generatedKeys = pstmt.getGeneratedKeys()) {
                if (generatedKeys.next()) {
                    tentative.setId(generatedKeys.getInt(1));
                } else {
                    throw new SQLException("Échec de la récupération de l'ID généré pour la tentative");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de l'ajout de la tentative: " + e.getMessage());
        }
    }

    public void modifier(Tentative tentative) {
        String query = "UPDATE tentative SET user_id=?, exercice_id=?, score=?, reponse=?, statue=?, note=? WHERE id=?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, tentative.getUser_id());
            pstmt.setInt(2, tentative.getExercice_id());
            pstmt.setInt(3, tentative.getScore());
            pstmt.setString(4, tentative.getReponse());
            pstmt.setString(5, tentative.getStatue());
            pstmt.setDouble(6, tentative.getNote());
            pstmt.setInt(7, tentative.getId());
            
            pstmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la modification de la tentative: " + e.getMessage());
        }
    }

    public void supprimer(Tentative tentative) {
        String query = "DELETE FROM tentative WHERE id = ?";
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, tentative.getId());
            pstmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la suppression de la tentative: " + e.getMessage());
        }
    }

    public List<Tentative> afficher() {
        List<Tentative> tentatives = new ArrayList<>();
        String query = """
            SELECT t.*, e.titre as exercice_titre 
            FROM tentative t 
            LEFT JOIN exercice e ON t.exercice_id = e.id 
            ORDER BY t.date DESC
            """;
        
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            while (rs.next()) {
                Tentative tentative = new Tentative();
                tentative.setId(rs.getInt("id"));
                tentative.setUser_id(rs.getInt("user_id"));
                tentative.setExercice_id(rs.getInt("exercice_id"));
                tentative.setScore(rs.getInt("score"));
                tentative.setReponse(rs.getString("reponse"));
                tentative.setDate(rs.getTimestamp("date").toLocalDateTime());
                tentative.setStatue(rs.getString("statue"));
                tentative.setNote(rs.getDouble("note"));
                
                // Créer un objet Exercice avec le titre
                String exerciceTitre = rs.getString("exercice_titre");
                if (exerciceTitre != null) {
                    Exercice exercice = new Exercice();
                    exercice.setId(rs.getInt("exercice_id"));
                    exercice.setTitre(exerciceTitre);
                    tentative.setExercice(exercice);
                }
                
                tentatives.add(tentative);
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la récupération des tentatives: " + e.getMessage());
        }
        
        return tentatives;
    }
    
    public List<Tentative> getTentativesByExercice(int exerciceId) {
        List<Tentative> tentatives = new ArrayList<>();
        String query = """
            SELECT t.*, e.titre as exercice_titre 
            FROM tentative t 
            LEFT JOIN exercice e ON t.exercice_id = e.id 
            WHERE t.exercice_id = ? 
            ORDER BY t.date DESC
            """;
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, exerciceId);
            ResultSet rs = pstmt.executeQuery();
            
            while (rs.next()) {
                Tentative tentative = new Tentative();
                tentative.setId(rs.getInt("id"));
                tentative.setUser_id(rs.getInt("user_id"));
                tentative.setExercice_id(rs.getInt("exercice_id"));
                tentative.setScore(rs.getInt("score"));
                tentative.setReponse(rs.getString("reponse"));
                tentative.setDate(rs.getTimestamp("date").toLocalDateTime());
                tentative.setStatue(rs.getString("statue"));
                tentative.setNote(rs.getDouble("note"));
                
                // Créer un objet Exercice avec le titre
                String exerciceTitre = rs.getString("exercice_titre");
                if (exerciceTitre != null) {
                    Exercice exercice = new Exercice();
                    exercice.setId(rs.getInt("exercice_id"));
                    exercice.setTitre(exerciceTitre);
                    tentative.setExercice(exercice);
                }
                
                tentatives.add(tentative);
            }
        } catch (SQLException e) {
            e.printStackTrace();
            throw new RuntimeException("Erreur lors de la récupération des tentatives: " + e.getMessage());
        }
        
        return tentatives;
    }

    /**
     * Évalue une tentative d'exercice et met à jour ses attributs score, note et statut
     * @param tentative La tentative à évaluer
     * @return La tentative évaluée
     */
    public Tentative evaluerTentative(Tentative tentative) {
        // Récupérer l'exercice associé à la tentative
        Exercice exercice = exerciceService.getById(tentative.getExercice_id());
        if (exercice == null) {
            throw new RuntimeException("Exercice introuvable pour l'évaluation");
        }
        
        String solution = exercice.getSolution();
        String reponseUtilisateur = tentative.getReponse();
        String criteresEvaluation = exercice.getCriteresEvaluation();
        double noteMinimale = exercice.getNoteMinimale();
        String typeExercice = exercice.getTypeExercice();
        
        // Score par défaut (score sur 100 et note sur 20)
        int score = 0;
        double note = 0;
        String statut = "ÉCHEC";
        
        // Évaluation en fonction du type d'exercice (renvoie une note sur 5)
        double noteBase = 0;
        if (typeExercice != null && typeExercice.equalsIgnoreCase("javascript")) {
            // Évaluation pour un exercice JavaScript
            noteBase = evaluerJavaScript(reponseUtilisateur, solution, criteresEvaluation);
        } else if (typeExercice != null && typeExercice.equalsIgnoreCase("qcm")) {
            // Évaluation pour un QCM
            noteBase = evaluerQCM(reponseUtilisateur, solution);
        } else {
            // Évaluation générique pour les autres types d'exercices
            noteBase = evaluerGenerique(reponseUtilisateur, solution, criteresEvaluation);
        }
        
        // Convertir la note de base (sur 5) en note sur 20
        note = noteBase * 4;
        
        // Calculer le score sur 100 points
        score = (int) Math.round(note * 5);
        
        // Déterminer si l'exercice est réussi en fonction de la note minimale
        // Une note élevée (≥ 18/20, équivalent à 4.5/5) est toujours considérée comme réussie
        if (note >= noteMinimale || note >= 18) {
            statut = "RÉUSSI";
        }
        
        // Mettre à jour les attributs de la tentative
        tentative.setScore(score);
        tentative.setNote(note);
        tentative.setStatue(statut);
        
        // Mettre à jour la tentative dans la base de données
        modifier(tentative);
        
        return tentative;
    }
    
    /**
     * Évalue une réponse JavaScript en vérifiant si elle contient les éléments essentiels
     * @param reponseUtilisateur La réponse de l'utilisateur
     * @param solution La solution attendue
     * @param criteresEvaluation Les critères d'évaluation
     * @return Une note entre 0 et 5
     */
    private double evaluerJavaScript(String reponseUtilisateur, String solution, String criteresEvaluation) {
        double note = 0;
        
        // Vérifier si la réponse n'est pas vide
        if (reponseUtilisateur == null || reponseUtilisateur.trim().isEmpty()) {
            return 0;
        }
        
        // Critères communs pour les fonctions JavaScript
        boolean contientFunction = reponseUtilisateur.contains("function");
        boolean contientReturn = reponseUtilisateur.contains("return");
        boolean contientCrochets = reponseUtilisateur.contains("{") && reponseUtilisateur.contains("}");
        
        // Attribuer des points pour les éléments de base (jusqu'à 1.5 points)
        if (contientFunction) note += 0.5;
        if (contientReturn) note += 0.5;
        if (contientCrochets) note += 0.5;
        
        // Vérification spécifique pour un exercice de génération de mot de passe
        if (reponseUtilisateur.contains("générer") || reponseUtilisateur.contains("generer") || 
            reponseUtilisateur.contains("password") || reponseUtilisateur.contains("mot de passe")) {
            
            // Vérifier les éléments spécifiques liés aux mots de passe (jusqu'à 3.5 points)
            boolean utiliseRandom = reponseUtilisateur.contains("Math.random");
            boolean utiliseLongueur = reponseUtilisateur.contains("length") || reponseUtilisateur.contains("longueur");
            boolean manipuleCaracteres = reponseUtilisateur.contains("charAt") || 
                                         reponseUtilisateur.contains("substring") || 
                                         reponseUtilisateur.contains("concat") ||
                                         reponseUtilisateur.contains("+=");
            boolean declarationVariables = reponseUtilisateur.contains("var ") || 
                                           reponseUtilisateur.contains("let ") || 
                                           reponseUtilisateur.contains("const ");
            boolean utiliseParametres = Pattern.compile("function\\s+\\w+\\s*\\(\\s*\\w+\\s*\\)").matcher(reponseUtilisateur).find();
            
            if (utiliseRandom) note += 0.7;
            if (utiliseLongueur) note += 0.7;
            if (manipuleCaracteres) note += 0.7;
            if (declarationVariables) note += 0.7;
            if (utiliseParametres) note += 0.7;
        }
        
        // Si des critères d'évaluation spécifiques sont fournis, les utiliser
        if (criteresEvaluation != null && !criteresEvaluation.isEmpty()) {
            String[] criteres = criteresEvaluation.split(",");
            double pointsParCritere = 5.0 / criteres.length;
            
            for (String critere : criteres) {
                if (reponseUtilisateur.toLowerCase().contains(critere.trim().toLowerCase())) {
                    note += pointsParCritere;
                }
            }
        }
        
        // Limiter la note à 5 maximum
        return Math.min(5, note);
    }
    
    /**
     * Évalue une réponse de type QCM
     * @param reponseUtilisateur La réponse de l'utilisateur
     * @param solution La solution attendue
     * @return Une note entre 0 et 5
     */
    private double evaluerQCM(String reponseUtilisateur, String solution) {
        if (reponseUtilisateur == null || solution == null) {
            return 0;
        }
        
        // Normaliser les réponses (supprimer espaces, majuscules)
        String reponseNormalisee = reponseUtilisateur.trim().toLowerCase();
        String solutionNormalisee = solution.trim().toLowerCase();
        
        // Si la réponse est exactement la solution
        if (reponseNormalisee.equals(solutionNormalisee)) {
            return 5.0;
        }
        
        // Si la solution est une liste de réponses séparées par des virgules
        String[] solutionsPossibles = solutionNormalisee.split(",");
        for (String sol : solutionsPossibles) {
            if (reponseNormalisee.equals(sol.trim())) {
                return 5.0;
            }
        }
        
        // Réponse partiellement correcte (contient des éléments de la solution)
        for (String sol : solutionsPossibles) {
            if (reponseNormalisee.contains(sol.trim()) || sol.trim().contains(reponseNormalisee)) {
                return 2.5; // Note partielle
            }
        }
        
        return 0;
    }
    
    /**
     * Évaluation générique pour tout type d'exercice
     * @param reponseUtilisateur La réponse de l'utilisateur
     * @param solution La solution attendue
     * @param criteresEvaluation Les critères d'évaluation
     * @return Une note entre 0 et 5
     */
    private double evaluerGenerique(String reponseUtilisateur, String solution, String criteresEvaluation) {
        if (reponseUtilisateur == null || reponseUtilisateur.trim().isEmpty()) {
            return 0;
        }
        
        double note = 0;
        double similitude = calculerSimilitude(reponseUtilisateur.toLowerCase(), solution.toLowerCase());
        
        // Attribuer une note basée sur la similitude
        if (similitude > 0.9) { // Plus de 90% de similitude
            note = 5.0;
        } else if (similitude > 0.75) { // Plus de 75% de similitude
            note = 4.0;
        } else if (similitude > 0.6) { // Plus de 60% de similitude
            note = 3.0;
        } else if (similitude > 0.4) { // Plus de 40% de similitude
            note = 2.0;
        } else if (similitude > 0.2) { // Plus de 20% de similitude
            note = 1.0;
        }
        
        // Vérifier les critères d'évaluation spécifiques
        if (criteresEvaluation != null && !criteresEvaluation.isEmpty()) {
            String[] criteres = criteresEvaluation.split(",");
            double bonusPossible = 2.0; // Bonus maximum pour les critères spécifiques
            double bonusParCritere = bonusPossible / criteres.length;
            
            for (String critere : criteres) {
                if (reponseUtilisateur.toLowerCase().contains(critere.trim().toLowerCase())) {
                    note += bonusParCritere;
                }
            }
        }
        
        // Limiter la note à 5 maximum
        return Math.min(5, note);
    }
    
    /**
     * Calcule la similitude entre deux chaînes en utilisant la distance de Levenshtein
     * @param str1 Première chaîne
     * @param str2 Deuxième chaîne
     * @return Un score de similitude entre 0 et 1
     */
    private double calculerSimilitude(String str1, String str2) {
        int distance = distanceLevenshtein(str1, str2);
        int maxLength = Math.max(str1.length(), str2.length());
        
        if (maxLength == 0) return 1.0; // Les deux chaînes sont vides
        
        return 1.0 - ((double) distance / maxLength);
    }
    
    /**
     * Calcule la distance de Levenshtein entre deux chaînes
     * @param str1 Première chaîne
     * @param str2 Deuxième chaîne
     * @return La distance entre les deux chaînes
     */
    private int distanceLevenshtein(String str1, String str2) {
        int[][] distance = new int[str1.length() + 1][str2.length() + 1];
        
        for (int i = 0; i <= str1.length(); i++) {
            distance[i][0] = i;
        }
        
        for (int j = 0; j <= str2.length(); j++) {
            distance[0][j] = j;
        }
        
        for (int i = 1; i <= str1.length(); i++) {
            for (int j = 1; j <= str2.length(); j++) {
                int cout = (str1.charAt(i - 1) == str2.charAt(j - 1)) ? 0 : 1;
                distance[i][j] = Math.min(
                    Math.min(distance[i - 1][j] + 1, distance[i][j - 1] + 1),
                    distance[i - 1][j - 1] + cout
                );
            }
        }
        
        return distance[str1.length()][str2.length()];
    }
}
 
