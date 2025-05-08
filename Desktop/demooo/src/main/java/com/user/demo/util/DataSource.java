package com.user.demo.util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DataSource {

    private static DataSource instance;
    private Connection connection;

    private final String URL = "jdbc:mysql://localhost:3306/devsphere";
    private final String USERNAME = "root";
    private final String PASSWORD = "";

    private DataSource() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            throw new RuntimeException("MySQL JDBC Driver not found", e);
        }
    }

    public static DataSource getInstance() {
        if(instance == null) {
            instance = new DataSource();
        }
        return instance;
    }

    public Connection getConnection() throws SQLException {
        if (connection == null || connection.isClosed()) {
            connection = DriverManager.getConnection(URL, USERNAME, PASSWORD);
        } else {
            // Vérifier si la connexion est toujours valide
            try {
                if (!connection.isValid(2)) {  // timeout de 2 secondes
                    connection = DriverManager.getConnection(URL, USERNAME, PASSWORD);
                }
            } catch (SQLException e) {
                connection = DriverManager.getConnection(URL, USERNAME, PASSWORD);
            }
        }
        return connection;
    }

    public void closeConnection() {
        if (connection != null) {
            try {
                connection.close();
            } catch (SQLException e) {
                System.err.println("Error closing connection: " + e.getMessage());
            }
        }
    }
}
