<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250302BadWords extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crée la table bad_word pour le système de filtrage de contenu';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bad_word (
            id INT AUTO_INCREMENT NOT NULL,
            word VARCHAR(255) NOT NULL,
            severity INT NOT NULL,
            is_active TINYINT(1) NOT NULL,
            created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE bad_word');
    }
}
