<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116184838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service ADD price INT NOT NULL');
        $this->addSql('ALTER TABLE service ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD duration INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE service DROP name');
        $this->addSql('ALTER TABLE service DROP price');
        $this->addSql('ALTER TABLE service DROP description');
        $this->addSql('ALTER TABLE service DROP duration');
    }
}
