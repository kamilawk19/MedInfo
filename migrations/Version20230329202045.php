<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329202045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE last_pharmacy_supply_check (id INT AUTO_INCREMENT NOT NULL, id_controller_id INT NOT NULL, last_supply_date DATE NOT NULL, INDEX IDX_7532FC4E48F9762E (id_controller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE last_pharmacy_supply_check ADD CONSTRAINT FK_7532FC4E48F9762E FOREIGN KEY (id_controller_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE last_pharmacy_supply_check DROP FOREIGN KEY FK_7532FC4E48F9762E');
        $this->addSql('DROP TABLE last_pharmacy_supply_check');
    }
}
