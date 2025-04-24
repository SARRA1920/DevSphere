package com.user.demo.util;

import com.user.demo.model.User;

/**
 * Singleton class to manage the current user session
 */
public class SessionManager {
    private static SessionManager instance;
    private User currentUser;
    
    private SessionManager() {
        // Private constructor to enforce singleton pattern
    }
    
    /**
     * Get the singleton instance
     * @return SessionManager instance
     */
    public static SessionManager getInstance() {
        if (instance == null) {
            instance = new SessionManager();
        }
        return instance;
    }
    
    /**
     * Start a new session with the given user
     * @param user The authenticated user
     */
    public void startSession(User user) {
        this.currentUser = user;
    }
    
    /**
     * End the current session
     */
    public void endSession() {
        this.currentUser = null;
    }
    
    /**
     * Check if a user is currently logged in
     * @return true if a user is logged in, false otherwise
     */
    public boolean isLoggedIn() {
        return this.currentUser != null;
    }
    
    /**
     * Get the current logged-in user
     * @return Current user, or null if no user is logged in
     */
    public User getCurrentUser() {
        return this.currentUser;
    }
}