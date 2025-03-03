<?php

namespace App\Command;

use App\Entity\BadWord;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class InitBadWordsCommand extends Command
{
    protected static $defaultName = 'app:init-bad-words';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Initialise la base de données avec une liste de mots inappropriés');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $badWords = [
            // Insultes générales (sévérité 8-10)
            ['word' => 'connard', 'severity' => 9],
            ['word' => 'salaud', 'severity' => 8],
            ['word' => 'merde', 'severity' => 8],
            ['word' => 'putain', 'severity' => 8],
            
            // Langage grossier (sévérité 5-7)
            ['word' => 'con', 'severity' => 6],
            ['word' => 'crétin', 'severity' => 5],
            ['word' => 'débile', 'severity' => 5],
            ['word' => 'idiot', 'severity' => 5],
            
            // Expressions agressives (sévérité 6-8)
            ['word' => 'va te faire', 'severity' => 7],
            ['word' => 'nique', 'severity' => 8],
            ['word' => 'casse-toi', 'severity' => 6],
            
            // Discrimination (sévérité 9-10)
            ['word' => 'raciste', 'severity' => 10],
            ['word' => 'nazi', 'severity' => 10],
            
            // Menaces (sévérité 8-10)
            ['word' => 'je vais te tuer', 'severity' => 10],
            ['word' => 'je vais te frapper', 'severity' => 9],
            
            // Expressions inappropriées (sévérité 4-6)
            ['word' => 'ferme ta gueule', 'severity' => 7],
            ['word' => 'ta gueule', 'severity' => 6],
            ['word' => 'gueule', 'severity' => 4],
            
            // Mots irrespectueux (sévérité 3-5)
            ['word' => 'imbécile', 'severity' => 4],
            ['word' => 'abruti', 'severity' => 4],
            ['word' => 'stupide', 'severity' => 3],
            
            // Expressions de mépris (sévérité 4-6)
            ['word' => 'nul', 'severity' => 4],
            ['word' => 'incompétent', 'severity' => 5],
            ['word' => 'minable', 'severity' => 5]
        ];

        $count = 0;
        foreach ($badWords as $word) {
            $badWord = new BadWord();
            $badWord->setWord($word['word']);
            $badWord->setSeverity($word['severity']);
            $badWord->setIsActive(true);
            $badWord->setCreatedAt(new \DateTimeImmutable());
            
            $this->entityManager->persist($badWord);
            $count++;
        }

        $this->entityManager->flush();

        $io->success(sprintf('%d mots inappropriés ont été ajoutés à la base de données.', $count));

        return Command::SUCCESS;
    }
}
