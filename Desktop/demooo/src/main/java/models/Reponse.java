package models;

public class Reponse {
    private Long questionId;
    private String reponseUtilisateur;

    public Reponse() {
    }

    public Reponse(Long questionId, String reponseUtilisateur) {
        this.questionId = questionId;
        this.reponseUtilisateur = reponseUtilisateur;
    }

    // Getters and Setters
    public Long getQuestionId() {
        return questionId;
    }

    public void setQuestionId(Long questionId) {
        this.questionId = questionId;
    }

    public String getReponseUtilisateur() {
        return reponseUtilisateur;
    }

    public void setReponseUtilisateur(String reponseUtilisateur) {
        this.reponseUtilisateur = reponseUtilisateur;
    }
} 