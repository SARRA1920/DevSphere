package models;

import java.time.LocalDateTime;
import java.util.List;

public class Tentative {
    private Long exerciceId;
    private Long userId;
    private List<Reponse> reponses;
    private LocalDateTime dateSubmission;

    public Tentative() {
    }

    public Tentative(Long exerciceId, Long userId, List<Reponse> reponses) {
        this.exerciceId = exerciceId;
        this.userId = userId;
        this.reponses = reponses;
        this.dateSubmission = LocalDateTime.now();
    }

    // Getters and Setters
    public Long getExerciceId() {
        return exerciceId;
    }

    public void setExerciceId(Long exerciceId) {
        this.exerciceId = exerciceId;
    }

    public Long getUserId() {
        return userId;
    }

    public void setUserId(Long userId) {
        this.userId = userId;
    }

    public List<Reponse> getReponses() {
        return reponses;
    }

    public void setReponses(List<Reponse> reponses) {
        this.reponses = reponses;
    }

    public LocalDateTime getDateSubmission() {
        return dateSubmission;
    }

    public void setDateSubmission(LocalDateTime dateSubmission) {
        this.dateSubmission = dateSubmission;
    }
} 