<?php

namespace App\DataFixtures;

use App\Entity\CategoriePublication;
use App\Enum\PublicationCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CategoriePublicationFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (PublicationCategory::cases() as $category) {
            $categoriePublication = new CategoriePublication();
            $categoriePublication->setCategory($category);
            $categoriePublication->setDescription($category->value . ' related discussions');
            $manager->persist($categoriePublication);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['categorie_publication'];
    }
}
