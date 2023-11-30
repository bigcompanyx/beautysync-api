<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130082349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_service (booking_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(booking_id, service_id))');
        $this->addSql('CREATE INDEX IDX_BB23DFF23301C60 ON booking_service (booking_id)');
        $this->addSql('CREATE INDEX IDX_BB23DFF2ED5CA9E6 ON booking_service (service_id)');
        $this->addSql('ALTER TABLE booking_service ADD CONSTRAINT FK_BB23DFF23301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking_service ADD CONSTRAINT FK_BB23DFF2ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE booking_service DROP CONSTRAINT FK_BB23DFF23301C60');
        $this->addSql('ALTER TABLE booking_service DROP CONSTRAINT FK_BB23DFF2ED5CA9E6');
        $this->addSql('DROP TABLE booking_service');
    }
}
