# Intégration de Gemini AI

Ce document explique l'intégration de l'API Gemini AI de Google dans l'application.

## Modifications effectuées

1. **Configuration**
   - Mise à jour du fichier `config.properties` pour utiliser l'API Gemini au lieu d'OpenAI
   - Configuration de la clé API : `AIzaSyCZMq8dcEMnMVxEFAQqSRDCQH1yizjYEcA`
   - Changement de l'URL d'API pour Gemini : `https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent`

2. **Services**
   - Création d'un nouveau service `GeminiService` qui implémente l'API Gemini directement
   - Adaptation du service `ChatGPTService` existant pour déléguer les appels au `GeminiService`
   - Mise à jour du service `ChatbotService` pour communiquer avec l'API Gemini

3. **Dépendances**
   - Mise à jour des dépendances dans le fichier `pom.xml`
   - Remplacement des bibliothèques OpenAI par celles de Gemini

## Utilisation

Aucune modification du code client n'est nécessaire. Les services existants continuent à fonctionner
mais utilisent maintenant Gemini AI au lieu d'OpenAI en arrière-plan.

## Format des requêtes

Le format des requêtes a été adapté pour correspondre à l'API Gemini. Par exemple :

```json
{
  "contents": [
    {
      "role": "user",
      "parts": [
        {
          "text": "Votre prompt ici"
        }
      ]
    }
  ],
  "generationConfig": {
    "temperature": 0.7,
    "maxOutputTokens": 800,
    "topP": 0.8,
    "topK": 40
  }
}
```

## Format des réponses

Le format des réponses Gemini est différent de celui d'OpenAI. Par exemple :

```json
{
  "candidates": [
    {
      "content": {
        "parts": [
          {
            "text": "Texte de réponse généré par Gemini"
          }
        ],
        "role": "model"
      }
    }
  ]
}
```

## Avantages

- Modernisation de l'application avec la technologie Gemini AI de Google
- Potentiellement de meilleures réponses et performances
- Même interface utilisateur et expérience pour les utilisateurs finaux 