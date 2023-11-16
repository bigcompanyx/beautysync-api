<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116170947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE company ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD location VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE company ADD published BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE company DROP name');
        $this->addSql('ALTER TABLE company DROP description');
        $this->addSql('ALTER TABLE company DROP location');
        $this->addSql('ALTER TABLE company DROP slug');
        $this->addSql('ALTER TABLE company DROP published');
    }
}
