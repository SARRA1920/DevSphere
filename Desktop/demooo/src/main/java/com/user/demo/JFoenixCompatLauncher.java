package com.user.demo;

/**
 * A special launcher that sets JVM arguments required for JFoenix to work with Java 23
 */
public class JFoenixCompatLauncher {
    
    public static void main(String[] args) {
        // Required JVM arguments for JFoenix with Java 23
        String[] jvmArgs = {
            "--add-opens=java.base/java.lang.reflect=ALL-UNNAMED",
            "--add-opens=javafx.graphics/javafx.scene=ALL-UNNAMED",
            "--add-opens=javafx.base/com.sun.javafx.runtime=ALL-UNNAMED",
            "--add-opens=javafx.controls/com.sun.javafx.scene.control.behavior=ALL-UNNAMED",
            "--add-opens=javafx.controls/com.sun.javafx.scene.control=ALL-UNNAMED",
            "--add-opens=javafx.base/com.sun.javafx.binding=ALL-UNNAMED",
            "--add-opens=javafx.base/com.sun.javafx.event=ALL-UNNAMED",
            "--add-opens=javafx.graphics/com.sun.javafx.stage=ALL-UNNAMED"
        };
        
        // Check if we need to apply the arguments
        if (!areJvmArgsApplied()) {
            restartWithArgs(jvmArgs);
        } else {
            // JVM args are already applied, just launch the app
            HelloApplication.main(args);
        }
    }
    
    private static boolean areJvmArgsApplied() {
        try {
            // Try a reflection operation that would be blocked without the arguments
            Class<?> accessibleClass = Class.forName("java.lang.reflect.AccessibleObject");
            java.lang.reflect.Method method = accessibleClass.getDeclaredMethod("setAccessible0", boolean.class);
            method.setAccessible(true);
            return true;
        } catch (Exception e) {
            return false;
        }
    }
    
    private static void restartWithArgs(String[] jvmArgs) {
        try {
            // Get the current JVM executable path
            String javaHome = System.getProperty("java.home");
            String javaBin = javaHome + "/bin/java";
            
            // Get the classpath
            String classpath = System.getProperty("java.class.path");
            
            // Get the main class
            String mainClass = JFoenixCompatLauncher.class.getName();
            
            // Build the new command
            java.util.List<String> command = new java.util.ArrayList<>();
            command.add(javaBin);
            
            // Add all JavaFX module information from current JVM
            String modulePath = System.getProperty("jdk.module.path");
            if (modulePath != null && !modulePath.isEmpty()) {
                command.add("--module-path");
                command.add(modulePath);
            }
            
            String addModules = System.getProperty("jdk.module.addmods");
            if (addModules != null && !addModules.isEmpty()) {
                command.add("--add-modules");
                command.add(addModules);
            } else {
                command.add("--add-modules");
                command.add("javafx.controls,javafx.fxml,java.sql");
            }
            
            // Add the JVM arguments required for JFoenix
            for (String arg : jvmArgs) {
                command.add(arg);
            }
            
            // Add classpath
            command.add("-classpath");
            command.add(classpath);
            
            // Add main class
            command.add("com.user.demo.MainLauncher");
            
            // Print command for debugging
            System.out.println("Restarting with JFoenix compatibility arguments...");
            
            // Create a new process builder
            ProcessBuilder builder = new ProcessBuilder(command);
            builder.inheritIO();
            Process process = builder.start();
            
            // Exit this instance of the JVM
            System.exit(0);
        } catch (Exception e) {
            System.err.println("Failed to restart with JFoenix compatibility arguments: " + e.getMessage());
            e.printStackTrace();
            // Fall back to standard launch
            HelloApplication.main(new String[0]);
        }
    }
}