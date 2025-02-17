<?php

namespace App\Service;

use App\Entity\Exercice;
use App\Entity\Tentative;

class ExerciceEvaluator
{
    public function evaluate(string $reponse, Exercice $exercice): array
    {
        return match ($exercice->getTypeExercice()) {
            'qcm' => $this->evaluateQCM($reponse, $exercice),
            'html' => $this->evaluateHTML($reponse, $exercice),
            'javascript' => $this->evaluateJavaScript($reponse, $exercice),
            'php' => $this->evaluatePHP($reponse, $exercice),
            'text' => $this->evaluateText($reponse, $exercice),
            'true_false' => $this->evaluateTrueFalse($reponse, $exercice),
            default => throw new \InvalidArgumentException('Type d\'exercice non supporté')
        };
    }

    private function evaluateQCM(string $reponse, Exercice $exercice): array
    {
        $solution = json_decode($exercice->getSolution(), true);
        $reponseUser = json_decode($reponse, true);
        
        if (!$solution || !$reponseUser) {
            return [
                'score' => 0,
                'feedback' => ['Format de réponse invalide'],
                'status' => 'echoue'
            ];
        }
        
        $score = 0;
        $totalQuestions = count($solution);
        $feedback = [];
        
        foreach ($solution as $index => $correctAnswer) {
            if (isset($reponseUser[$index]) && $reponseUser[$index] === $correctAnswer) {
                $score++;
            }
        }
        
        $finalScore = ($score / $totalQuestions) * 100;
        
        return [
            'score' => round($finalScore),
            'feedback' => [
                sprintf('Vous avez correctement répondu à %d question(s) sur %d', $score, $totalQuestions)
            ],
            'status' => $finalScore >= $exercice->getNoteMinimale() * 5 ? 'reussi' : 'echoue'
        ];
    }

    private function evaluateHTML(string $reponse, Exercice $exercice): array
    {
        // Nettoyer et normaliser le HTML
        $reponse = $this->normalizeHTML($reponse);
        $solution = $this->normalizeHTML($exercice->getSolution());
        
        // Vérifier les éléments requis
        $requiredElements = [
            'doctype' => '<!DOCTYPE html>',
            'html' => '<html',
            'head' => '<head',
            'body' => '<body'
        ];
        
        $score = 0;
        $feedback = [];
        
        // Vérifier la structure de base
        foreach ($requiredElements as $element => $search) {
            if (stripos($reponse, $search) !== false) {
                $score += 25;
                $feedback[] = "✓ Structure $element correcte";
            } else {
                $feedback[] = "✗ Structure $element manquante";
            }
        }
        
        // Vérifier les balises spécifiques demandées
        $criteresArray = explode(',', $exercice->getCriteresEvaluation());
        foreach ($criteresArray as $critere) {
            if (stripos($reponse, trim($critere)) !== false) {
                $score += 25;
                $feedback[] = "✓ Élément trouvé : " . trim($critere);
            } else {
                $feedback[] = "✗ Élément manquant : " . trim($critere);
            }
        }
        
        // Normaliser le score final
        $score = min(100, $score);
        
        return [
            'score' => $score,
            'feedback' => $feedback,
            'status' => $score >= $exercice->getNoteMinimale() * 5 ? 'reussi' : 'echoue'
        ];
    }

    private function evaluateJavaScript(string $reponse, Exercice $exercice): array
    {
        // Nettoyer le code
        $reponse = $this->normalizeCode($reponse);
        $solution = $this->normalizeCode($exercice->getSolution());
        
        $score = 0;
        $feedback = [];
        
        // Vérifier la syntaxe de base
        if (strpos($reponse, '{') !== false && strpos($reponse, '}') !== false) {
            $score += 20;
            $feedback[] = "✓ Structure de base correcte";
        }
        
        // Vérifier les éléments spécifiques
        $elements = [
            'for' => 'Boucle for',
            'while' => 'Boucle while',
            'if' => 'Condition if',
            'function' => 'Définition de fonction',
            'console.log' => 'Affichage console'
        ];
        
        foreach ($elements as $keyword => $description) {
            if (strpos($reponse, $keyword) !== false && strpos($solution, $keyword) !== false) {
                $score += 20;
                $feedback[] = "✓ Utilisation correcte : $description";
            }
        }
        
        return [
            'score' => min(100, $score),
            'feedback' => $feedback,
            'status' => $score >= $exercice->getNoteMinimale() * 5 ? 'reussi' : 'echoue'
        ];
    }

    private function evaluatePHP(string $reponse, Exercice $exercice): array
    {
        // Similaire à JavaScript mais avec des éléments PHP spécifiques
        $reponse = $this->normalizeCode($reponse);
        $solution = $this->normalizeCode($exercice->getSolution());
        
        $score = 0;
        $feedback = [];
        
        // Vérifier la syntaxe PHP de base
        if (strpos($reponse, '<?php') !== false) {
            $score += 20;
            $feedback[] = "✓ Balise PHP présente";
        }
        
        // Vérifier les éléments spécifiques
        $elements = [
            'foreach' => 'Boucle foreach',
            'array' => 'Tableau',
            'echo' => 'Affichage',
            'function' => 'Fonction',
            '$' => 'Variables'
        ];
        
        foreach ($elements as $keyword => $description) {
            if (strpos($reponse, $keyword) !== false && strpos($solution, $keyword) !== false) {
                $score += 20;
                $feedback[] = "✓ Utilisation correcte : $description";
            }
        }
        
        return [
            'score' => min(100, $score),
            'feedback' => $feedback,
            'status' => $score >= $exercice->getNoteMinimale() * 5 ? 'reussi' : 'echoue'
        ];
    }

    private function evaluateText(string $reponse, Exercice $exercice): array
    {
        $solution = $exercice->getSolution();
        $motsClefs = explode(',', $exercice->getCriteresEvaluation());
        
        $score = 0;
        $feedback = [];
        $totalMots = count($motsClefs);
        
        foreach ($motsClefs as $mot) {
            $mot = trim($mot);
            if (stripos($reponse, $mot) !== false) {
                $score++;
                $feedback[] = "✓ Concept trouvé : $mot";
            } else {
                $feedback[] = "✗ Concept manquant : $mot";
            }
        }
        
        $finalScore = ($score / $totalMots) * 100;
        
        return [
            'score' => round($finalScore),
            'feedback' => $feedback,
            'status' => $finalScore >= $exercice->getNoteMinimale() * 5 ? 'reussi' : 'echoue'
        ];
    }

    private function evaluateTrueFalse(string $reponse, Exercice $exercice): array
    {
        $solution = strtolower(trim($exercice->getSolution()));
        $reponse = strtolower(trim($reponse));
        
        $score = ($reponse === $solution) ? 100 : 0;
        
        return [
            'score' => $score,
            'feedback' => [
                $score === 100 ? "✓ Réponse correcte" : "✗ Réponse incorrecte"
            ],
            'status' => $score >= $exercice->getNoteMinimale() * 5 ? 'reussi' : 'echoue'
        ];
    }

    private function normalizeHTML(string $html): string
    {
        // Supprimer les espaces et les retours à la ligne
        $html = preg_replace('/\s+/', ' ', trim($html));
        // Supprimer les espaces entre les balises
        $html = preg_replace('/>\s+</', '><', $html);
        // Convertir en minuscules
        return strtolower($html);
    }

    private function normalizeCode(string $code): string
    {
        // Supprimer les commentaires
        $code = preg_replace('/(\/\/[^\n]*|\/\*[\s\S]*?\*\/)/', '', $code);
        // Supprimer les espaces inutiles
        $code = preg_replace('/\s+/', ' ', trim($code));
        return $code;
    }
}
