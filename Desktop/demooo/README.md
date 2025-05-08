# Gestion des Exercices

## Import d'exercices depuis Excel

### Format du fichier Excel
Le fichier Excel doit contenir les colonnes suivantes dans cet ordre :
1. Titre
2. Niveau de difficulté (Débutant, Intermédiaire, Avancé)
3. Note minimale (nombre décimal)
4. Temps estimé (en minutes)
5. Fichier PDF (chemin du fichier)
6. Type (QCM, Programmation, Analyse, Conception)
7. Type d'exercice
8. Solution
9. Critères d'évaluation
10. Description

### Comment importer des exercices
1. Préparez votre fichier Excel (.xlsx) avec les colonnes ci-dessus
2. Dans l'application, cliquez sur le bouton "Importer"
3. Sélectionnez votre fichier Excel
4. Les exercices seront automatiquement importés dans la base de données

### Exemple de structure du fichier Excel
| Titre | Niveau | Note Min | Temps | PDF | Type | Type Exercice | Solution | Critères | Description |
|-------|---------|----------|-------|-----|------|---------------|----------|-----------|-------------|
| Ex 1  | Débutant| 10.0     | 30    |     | QCM  | Quiz         | A,B,C    | ...       | ...         |
| Ex 2  | Avancé  | 12.0     | 60    |     | Prog | Java         | ...      | ...       | ...         |

### Notes importantes
- La première ligne du fichier Excel doit contenir les en-têtes
- Les valeurs numériques (note minimale, temps) doivent être des nombres
- Les champs texte peuvent contenir du texte formaté
- Si un champ est vide, il sera importé comme une chaîne vide 