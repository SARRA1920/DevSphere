package com.user.demo.service;

import java.sql.*;
import java.util.*;
import com.user.demo.model.Tentative;
import com.user.demo.util.DatabaseConnection;

public class DatabaseService {
    private static final String URL = "jdbc:mysql://localhost:3306/exercices_db";
    private static final String USER = "root";
    private static final String PASSWORD = "";

    public static List<Tentative> getTentativesWithReponses() throws SQLException {
        List<Tentative> tentatives = new ArrayList<>();
        String query = """
            SELECT t.*, e.titre as exercice_titre 
            FROM tentative t 
            LEFT JOIN exercice e ON t.exercice_id = e.id 
            WHERE t.reponse IS NOT NULL AND TRIM(t.reponse) != ''
            ORDER BY t.date DESC
        """;
        
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query);
             ResultSet rs = stmt.executeQuery()) {
            
            while (rs.next()) {
                Tentative tentative = new Tentative();
                tentative.setId(rs.getInt("id"));
                tentative.setUser_id(rs.getInt("user_id"));
                tentative.setExercice_id(rs.getInt("exercice_id"));
                tentative.setScore(rs.getInt("score"));
                tentative.setReponse(rs.getString("reponse"));
                tentative.setDate(rs.getTimestamp("date").toLocalDateTime());
                tentative.setStatue(rs.getString("statue"));
                tentative.setNote(rs.getDouble("note"));
                tentatives.add(tentative);
            }
        }
        
        return tentatives;
    }

    public static List<Map<String, Object>> executeQuery(String query) throws SQLException {
        List<Map<String, Object>> resultList = new ArrayList<>();
        
        try (Connection conn = DriverManager.getConnection(URL, USER, PASSWORD);
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            ResultSetMetaData metaData = rs.getMetaData();
            int columnCount = metaData.getColumnCount();
            
            while (rs.next()) {
                Map<String, Object> row = new HashMap<>();
                for (int i = 1; i <= columnCount; i++) {
                    String columnName = metaData.getColumnName(i);
                    Object value = rs.getObject(i);
                    row.put(columnName, value);
                }
                resultList.add(row);
            }
        }
        
        return resultList;
    }
} 