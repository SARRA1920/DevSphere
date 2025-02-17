<?php

namespace App\Command;

use App\Entity\Exercice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateExerciceCommand extends Command
{
    protected static $defaultName = 'app:create-sample-exercices';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Crée des exercices exemple');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // QCM HTML
        $qcmHtml = new Exercice();
        $qcmHtml->setTitre('QCM - Bases HTML');
        $qcmHtml->setTypeExercice('qcm');
        $qcmHtml->setNoteMinimale(10);
        $qcmHtml->setType('quiz');
        $qcmHtml->setNiveauDifficulte('facile');
        $qcmHtml->setTempsEstime(15);
        
        $qcmSolution = [
            'Question 1: Quelle balise définit un paragraphe en HTML ?' => ['<p>', '<paragraph>', '<text>', '<para>'],
            'Question 2: Comment définir un titre de niveau 1 ?' => ['<h1>', '<heading1>', '<title>', '<head1>']
        ];
        $qcmHtml->setSolution(json_encode($qcmSolution));
        $qcmHtml->setCriteresEvaluation('Connaissance des balises de base,Compréhension de la hiérarchie des titres');

        // Vrai/Faux JavaScript
        $trueFalseJs = new Exercice();
        $trueFalseJs->setTitre('Vrai/Faux - Les variables en JavaScript');
        $trueFalseJs->setTypeExercice('true_false');
        $trueFalseJs->setNoteMinimale(10);
        $trueFalseJs->setType('quiz');
        $trueFalseJs->setNiveauDifficulte('facile');
        $trueFalseJs->setTempsEstime(5);
        $trueFalseJs->setSolution('true');
        $trueFalseJs->setCriteresEvaluation('En JavaScript, "let" et "var" déclarent des variables avec la même portée.');

        // Exercice de texte libre PHP
        $textPhp = new Exercice();
        $textPhp->setTitre('Expliquez les boucles en PHP');
        $textPhp->setTypeExercice('text');
        $textPhp->setNoteMinimale(12);
        $textPhp->setType('theory');
        $textPhp->setNiveauDifficulte('moyen');
        $textPhp->setTempsEstime(20);
        $textPhp->setSolution("Les boucles en PHP permettent d'exécuter un bloc de code plusieurs fois. Les principales boucles sont for, while, et foreach.");
        $textPhp->setCriteresEvaluation('Mention des types de boucles,Explication du fonctionnement,Cas d\'utilisation');

        try {
            $this->entityManager->persist($qcmHtml);
            $this->entityManager->persist($trueFalseJs);
            $this->entityManager->persist($textPhp);
            $this->entityManager->flush();

            $output->writeln('Exercices créés avec succès !');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('Erreur lors de la création des exercices : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
