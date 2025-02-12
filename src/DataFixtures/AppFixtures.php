<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Entity\CategorieCours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create Categories
        $categories = [];
        $categoryData = [
            ['Web Development', 'Learn modern web development technologies'],
            ['Mobile Development', 'Master mobile app development'],
            ['Data Science', 'Explore data science and analytics'],
            ['DevOps', 'Learn DevOps practices and tools']
        ];

        foreach ($categoryData as [$name, $description]) {
            $category = new CategorieCours();
            $category->setNom($name);
            $category->setDescription($description);
            $manager->persist($category);
            $categories[] = $category;
        }

        // Create Courses
        $coursesData = [
            [
                'PHP Symfony Framework',
                'Master Symfony framework and build modern web applications',
                '40 hours',
                'Intermediate',
                0 // Web Development
            ],
            [
                'React Native Fundamentals',
                'Build cross-platform mobile apps with React Native',
                '35 hours',
                'Beginner',
                1 // Mobile Development
            ],
            [
                'Python for Data Analysis',
                'Learn data analysis with Python and popular libraries',
                '45 hours',
                'Advanced',
                2 // Data Science
            ],
            [
                'Docker and Kubernetes',
                'Master containerization and orchestration',
                '30 hours',
                'Advanced',
                3 // DevOps
            ]
        ];

        foreach ($coursesData as [$title, $description, $duration, $level, $categoryIndex]) {
            $course = new Cours();
            $course->setTitre($title);
            $course->setDescription($description);
            $course->setDuree($duration);
            $course->setNiveau($level);
            $course->setCategorieCours($categories[$categoryIndex]);
            $manager->persist($course);
        }

        $manager->flush();
    }
}
