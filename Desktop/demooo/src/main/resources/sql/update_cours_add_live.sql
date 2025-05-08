-- Ajouter une colonne is_live à la table cours
ALTER TABLE cours ADD COLUMN is_live BOOLEAN DEFAULT FALSE;

-- Mettre à jour les cours existants pour définir is_live à FALSE
UPDATE cours SET is_live = FALSE WHERE is_live IS NULL; 