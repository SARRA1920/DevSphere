<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250212014700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update existing publications to use WEB category';
    }

    public function up(Schema $schema): void
    {
        // Set default category for existing publications
        $this->addSql("UPDATE publication SET category = 'Web Development' WHERE category = '' OR category IS NULL");
    }

    public function down(Schema $schema): void
    {
        // No need for down migration as we're just setting default values
    }
}
