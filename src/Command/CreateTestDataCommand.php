<?php

namespace App\Command;

use App\Entity\Cours;
use App\Entity\CategorieCours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateTestDataCommand extends Command
{
    protected static $defaultName = 'app:create-test-data';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Creates test data for courses and categories');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

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
            $this->entityManager->persist($category);
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
            $this->entityManager->persist($course);
        }

        $this->entityManager->flush();

        $io->success('Test data created successfully!');
        return Command::SUCCESS;
    }
}
