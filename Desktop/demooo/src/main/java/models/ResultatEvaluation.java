package models;

import java.util.List;

public class ResultatEvaluation {
    private double score;
    private double scoreMax;
    private String feedback;
    private List<DetailEvaluation> details;

    public ResultatEvaluation() {
    }

    public ResultatEvaluation(double score, double scoreMax, String feedback, List<DetailEvaluation> details) {
        this.score = score;
        this.scoreMax = scoreMax;
        this.feedback = feedback;
        this.details = details;
    }

    // Getters and Setters
    public double getScore() {
        return score;
    }

    public void setScore(double score) {
        this.score = score;
    }

    public double getScoreMax() {
        return scoreMax;
    }

    public void setScoreMax(double scoreMax) {
        this.scoreMax = scoreMax;
    }

    public String getFeedback() {
        return feedback;
    }

    public void setFeedback(String feedback) {
        this.feedback = feedback;
    }

    public List<DetailEvaluation> getDetails() {
        return details;
    }

    public void setDetails(List<DetailEvaluation> details) {
        this.details = details;
    }
} 