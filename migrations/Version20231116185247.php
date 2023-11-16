<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116185247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription_plan ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE subscription_plan ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE subscription_plan ADD price INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_plan ADD duration INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_plan ADD duration_unit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE subscription_plan ADD trial_duration INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subscription_plan ADD trial_duration_unit VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE subscription_plan DROP name');
        $this->addSql('ALTER TABLE subscription_plan DROP description');
        $this->addSql('ALTER TABLE subscription_plan DROP price');
        $this->addSql('ALTER TABLE subscription_plan DROP duration');
        $this->addSql('ALTER TABLE subscription_plan DROP duration_unit');
        $this->addSql('ALTER TABLE subscription_plan DROP trial_duration');
        $this->addSql('ALTER TABLE subscription_plan DROP trial_duration_unit');
    }
}
