package com.user.demo.util;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.util.Base64;

/**
 * Utility class for password security (hashing, salting, verification)
 */
public class PasswordUtil {
    
    private static final int SALT_LENGTH = 16;
    
    /**
     * Generates a random salt for password hashing
     * @return Base64 encoded salt string
     */
    public static String generateSalt() {
        SecureRandom random = new SecureRandom();
        byte[] salt = new byte[SALT_LENGTH];
        random.nextBytes(salt);
        return Base64.getEncoder().encodeToString(salt);
    }
    
    /**
     * Hashes a password with the provided salt using SHA-256
     * @param password The plain text password
     * @param salt The salt to use for hashing
     * @return The hashed password
     */
    public static String hashPassword(String password, String salt) {
        try {
            MessageDigest md = MessageDigest.getInstance("SHA-256");
            md.update(Base64.getDecoder().decode(salt));
            byte[] hashedPassword = md.digest(password.getBytes());
            return Base64.getEncoder().encodeToString(hashedPassword);
        } catch (NoSuchAlgorithmException e) {
            throw new RuntimeException("Error hashing password", e);
        }
    }
    
    /**
     * Verifies if a password matches a hashed password
     * @param password The plain text password to verify
     * @param hashedPassword The stored hashed password
     * @param salt The salt used when hashing the stored password
     * @return true if the password matches, false otherwise
     */
    public static boolean verifyPassword(String password, String hashedPassword, String salt) {
        String hashedInput = hashPassword(password, salt);
        return hashedInput.equals(hashedPassword);
    }
}