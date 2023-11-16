<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116190029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE working_hours_day ADD day_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE working_hours_day ADD work_start TIME(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE working_hours_day ADD work_end TIME(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE working_hours_day ADD open BOOLEAN DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN working_hours_day.work_start IS \'(DC2Type:time_immutable)\'');
        $this->addSql('COMMENT ON COLUMN working_hours_day.work_end IS \'(DC2Type:time_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE working_hours_day DROP day_name');
        $this->addSql('ALTER TABLE working_hours_day DROP work_start');
        $this->addSql('ALTER TABLE working_hours_day DROP work_end');
        $this->addSql('ALTER TABLE working_hours_day DROP open');
    }
}
