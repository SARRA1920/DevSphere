package com.user.demo.util;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Base64;

/**
 * Utility class for password encryption
 */
public class PasswordEncryption {
    
    /**
     * Encrypt a password using SHA-256 algorithm
     * @param plainPassword The plain text password
     * @return The encrypted password
     */
    public static String encryptPassword(String plainPassword) {
        try {
            MessageDigest md = MessageDigest.getInstance("SHA-256");
            byte[] hashedBytes = md.digest(plainPassword.getBytes());
            return Base64.getEncoder().encodeToString(hashedBytes);
        } catch (NoSuchAlgorithmException e) {
            System.err.println("Error encrypting password: " + e.getMessage());
            e.printStackTrace();
            return plainPassword; // Fallback to plain password if encryption fails
        }
    }
    
    /**
     * Verify if a plain password matches an encrypted password
     * @param plainPassword The plain text password to check
     * @param encryptedPassword The encrypted password to check against
     * @return true if the passwords match, false otherwise
     */
    public static boolean verifyPassword(String plainPassword, String encryptedPassword) {
        String encryptedInput = encryptPassword(plainPassword);
        return encryptedInput.equals(encryptedPassword);
    }
}