<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250501Reactions extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add publication and user relationships to Reaction entity';
    }

    public function up(Schema $schema): void
    {
        // Add publication_id column to reaction table
        $this->addSql('ALTER TABLE reaction ADD publication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reaction ADD user_id INT NOT NULL');
        
        // Add foreign key constraints
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F738B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        
        // Add indexes
        $this->addSql('CREATE INDEX IDX_A4D707F738B217A7 ON reaction (publication_id)');
        $this->addSql('CREATE INDEX IDX_A4D707F7A76ED395 ON reaction (user_id)');
    }

    public function down(Schema $schema): void
    {
        // Drop foreign key constraints
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F738B217A7');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F7A76ED395');
        
        // Drop indexes
        $this->addSql('DROP INDEX IDX_A4D707F738B217A7 ON reaction');
        $this->addSql('DROP INDEX IDX_A4D707F7A76ED395 ON reaction');
        
        // Drop columns
        $this->addSql('ALTER TABLE reaction DROP publication_id');
        $this->addSql('ALTER TABLE reaction DROP user_id');
    }
}
