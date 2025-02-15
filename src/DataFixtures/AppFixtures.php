<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $exercice = new Exercice();
            $exercice->setTitre('Exercice ' . $i);
            $exercice->setNiveauDifficulte('facile');
            $exercice->setNoteMinimale(10);
            $exercice->setTempsEstime(30);
            $exercice->setType('Type ' . $i);

            $manager->persist($exercice);
        }

        $manager->flush();
    }
}
