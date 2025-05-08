package models;

public class DetailEvaluation {
    private Long questionId;
    private boolean estCorrect;
    private String commentaire;

    public DetailEvaluation() {
    }

    public DetailEvaluation(Long questionId, boolean estCorrect, String commentaire) {
        this.questionId = questionId;
        this.estCorrect = estCorrect;
        this.commentaire = commentaire;
    }

    // Getters and Setters
    public Long getQuestionId() {
        return questionId;
    }

    public void setQuestionId(Long questionId) {
        this.questionId = questionId;
    }

    public boolean isEstCorrect() {
        return estCorrect;
    }

    public void setEstCorrect(boolean estCorrect) {
        this.estCorrect = estCorrect;
    }

    public String getCommentaire() {
        return commentaire;
    }

    public void setCommentaire(String commentaire) {
        this.commentaire = commentaire;
    }
} 