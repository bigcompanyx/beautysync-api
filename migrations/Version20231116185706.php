<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116185706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_subscription ADD expiration_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE user_subscription ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user_subscription ADD trial_active BOOLEAN DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN user_subscription.expiration_date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_subscription DROP expiration_date');
        $this->addSql('ALTER TABLE user_subscription DROP status');
        $this->addSql('ALTER TABLE user_subscription DROP trial_active');
    }
}
