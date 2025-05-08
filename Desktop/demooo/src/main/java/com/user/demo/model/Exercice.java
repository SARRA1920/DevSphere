package com.user.demo.model;

import javafx.beans.property.*;

public class Exercice {

    private final IntegerProperty id = new SimpleIntegerProperty();
    private final IntegerProperty userId = new SimpleIntegerProperty();
    private final StringProperty titre = new SimpleStringProperty();
    private final StringProperty niveauDifficulte = new SimpleStringProperty();
    private final DoubleProperty noteMinimale = new SimpleDoubleProperty();
    private final IntegerProperty tempsEstime = new SimpleIntegerProperty();
    private final StringProperty fichierPdf = new SimpleStringProperty();
    private final StringProperty type = new SimpleStringProperty();
    private final StringProperty typeExercice = new SimpleStringProperty();
    private final StringProperty solution = new SimpleStringProperty();
    private final StringProperty criteresEvaluation = new SimpleStringProperty();
    private final StringProperty description = new SimpleStringProperty();

    // Constructeur par défaut
    public Exercice() {
    }

    // Constructeur sans ID (ajout)
    public Exercice(int userId, String titre, String niveauDifficulte, double noteMinimale,
                    int tempsEstime, String fichierPdf, String type, String typeExercice,
                    String solution, String criteresEvaluation, String description) {

        this.userId.set(userId);
        this.titre.set(titre);
        this.niveauDifficulte.set(niveauDifficulte);
        this.noteMinimale.set(noteMinimale);
        this.tempsEstime.set(tempsEstime);
        this.fichierPdf.set(fichierPdf);
        this.type.set(type);
        this.typeExercice.set(typeExercice);
        this.solution.set(solution);
        this.criteresEvaluation.set(criteresEvaluation);
        this.description.set(description);
    }

    // Constructeur avec ID (lecture depuis DB)
    public Exercice(int id, int userId, String titre, String niveauDifficulte, double noteMinimale,
                    int tempsEstime, String fichierPdf, String type, String typeExercice,
                    String solution, String criteresEvaluation, String description) {

        this.id.set(id);
        this.userId.set(userId);
        this.titre.set(titre);
        this.niveauDifficulte.set(niveauDifficulte);
        this.noteMinimale.set(noteMinimale);
        this.tempsEstime.set(tempsEstime);
        this.fichierPdf.set(fichierPdf);
        this.type.set(type);
        this.typeExercice.set(typeExercice);
        this.solution.set(solution);
        this.criteresEvaluation.set(criteresEvaluation);
        this.description.set(description);
    }

    // Getters JavaFX properties
    public IntegerProperty idProperty() { return id; }
    public IntegerProperty userIdProperty() { return userId; }
    public StringProperty titreProperty() { return titre; }
    public StringProperty niveauDifficulteProperty() { return niveauDifficulte; }
    public DoubleProperty noteMinimaleProperty() { return noteMinimale; }
    public IntegerProperty tempsEstimeProperty() { return tempsEstime; }
    public StringProperty fichierPdfProperty() { return fichierPdf; }
    public StringProperty typeProperty() { return type; }
    public StringProperty typeExerciceProperty() { return typeExercice; }
    public StringProperty solutionProperty() { return solution; }
    public StringProperty criteresEvaluationProperty() { return criteresEvaluation; }
    public StringProperty descriptionProperty() { return description; }

    // Getters et setters traditionnels
    public int getId() { return id.get(); }
    public void setId(int id) { this.id.set(id); }

    public int getUserId() { return userId.get(); }
    public void setUserId(int userId) { this.userId.set(userId); }

    public String getTitre() { return titre.get(); }
    public void setTitre(String titre) { this.titre.set(titre); }

    public String getNiveauDifficulte() { return niveauDifficulte.get(); }
    public void setNiveauDifficulte(String niveauDifficulte) { this.niveauDifficulte.set(niveauDifficulte); }

    public double getNoteMinimale() { return noteMinimale.get(); }
    public void setNoteMinimale(double noteMinimale) { this.noteMinimale.set(noteMinimale); }

    public int getTempsEstime() { return tempsEstime.get(); }
    public void setTempsEstime(int tempsEstime) { this.tempsEstime.set(tempsEstime); }

    public String getFichierPdf() { return fichierPdf.get(); }
    public void setFichierPdf(String fichierPdf) { this.fichierPdf.set(fichierPdf); }

    public String getType() { return type.get(); }
    public void setType(String type) { this.type.set(type); }

    public String getTypeExercice() { return typeExercice.get(); }
    public void setTypeExercice(String typeExercice) { this.typeExercice.set(typeExercice); }

    public String getSolution() { return solution.get(); }
    public void setSolution(String solution) { this.solution.set(solution); }

    public String getCriteresEvaluation() { return criteresEvaluation.get(); }
    public void setCriteresEvaluation(String criteresEvaluation) { this.criteresEvaluation.set(criteresEvaluation); }

    public String getDescription() { return description.get(); }
    public void setDescription(String description) { this.description.set(description); }

    @Override
    public String toString() {
        return "Exercice{" +
                "id=" + id.get() +
                ", userId=" + userId.get() +
                ", titre='" + titre.get() + '\'' +
                ", niveauDifficulte='" + niveauDifficulte.get() + '\'' +
                ", noteMinimale=" + noteMinimale.get() +
                ", tempsEstime=" + tempsEstime.get() +
                ", fichierPdf='" + fichierPdf.get() + '\'' +
                ", type='" + type.get() + '\'' +
                ", typeExercice='" + typeExercice.get() + '\'' +
                ", solution='" + solution.get() + '\'' +
                ", criteresEvaluation='" + criteresEvaluation.get() + '\'' +
                ", description='" + description.get() + '\'' +
                '}';
    }
}
