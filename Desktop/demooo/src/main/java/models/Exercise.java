package models;

public class Exercise {
    private int id;
    private String title;
    private String description;
    private String difficulty;
    private String category;
    private String hints;
    private String solution;

    public Exercise() {
    }

    public Exercise(int id, String title, String description, String difficulty, String category, String hints, String solution) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.difficulty = difficulty;
        this.category = category;
        this.hints = hints;
        this.solution = solution;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getDifficulty() {
        return difficulty;
    }

    public void setDifficulty(String difficulty) {
        this.difficulty = difficulty;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public String getHints() {
        return hints;
    }

    public void setHints(String hints) {
        this.hints = hints;
    }

    public String getSolution() {
        return solution;
    }

    public void setSolution(String solution) {
        this.solution = solution;
    }
} 