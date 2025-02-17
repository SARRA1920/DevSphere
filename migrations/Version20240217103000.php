<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240217103000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add user_id and update foreign key constraints in tentative table';
    }

    public function up(Schema $schema): void
    {
        // Add user_id column and update exercice_id to be NOT NULL
        $this->addSql('ALTER TABLE tentative ADD user_id INT NOT NULL, CHANGE exercice_id exercice_id INT NOT NULL');
        
        // Add foreign key constraints
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DBC382F9A76ED395 ON tentative (user_id)');
    }

    public function down(Schema $schema): void
    {
        // Remove foreign key constraints first
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9A76ED395');
        $this->addSql('DROP INDEX IDX_DBC382F9A76ED395 ON tentative');
        
        // Then remove columns
        $this->addSql('ALTER TABLE tentative DROP user_id, CHANGE exercice_id exercice_id INT DEFAULT NULL');
    }
}
