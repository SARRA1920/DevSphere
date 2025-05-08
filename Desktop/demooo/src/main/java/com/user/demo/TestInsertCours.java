package com.user.demo;

import com.user.demo.service.CoursService;
import java.util.logging.Logger;

public class TestInsertCours {
    private static final Logger LOGGER = Logger.getLogger(TestInsertCours.class.getName());

    public static void main(String[] args) {
        CoursService coursService = new CoursService();
        
        LOGGER.info("Début du test d'insertion d'un cours");
        
        boolean success = coursService.ajouterCoursTest();
        
        if (success) {
            LOGGER.info("Le cours de test a été ajouté avec succès");
        } else {
            LOGGER.severe("Échec de l'ajout du cours de test");
        }
    }
} 