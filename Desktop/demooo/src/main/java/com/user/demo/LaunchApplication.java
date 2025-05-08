package com.user.demo;

/**
 * Helper class to run the application from IntelliJ IDEA with the correct module path
 */
public class LaunchApplication {
    public static void main(String[] args) {
        // This is just a wrapper around the real main class to make IntelliJ's run configuration work
        HelloApplication.main(args);
    }
}