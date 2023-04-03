<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329193835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patitent (id INT AUTO_INCREMENT NOT NULL, id_address_id INT DEFAULT NULL, pesel VARCHAR(11) DEFAULT NULL, document_number VARCHAR(11) DEFAULT NULL, document_name VARCHAR(25) DEFAULT NULL, first_name VARCHAR(12) NOT NULL, second_name VARCHAR(12) DEFAULT NULL, last_name VARCHAR(25) NOT NULL, sex VARCHAR(1) NOT NULL, dialing_code VARCHAR(2) DEFAULT NULL, phone_number VARCHAR(9) NOT NULL, contact_dialing_code VARCHAR(2) DEFAULT NULL, contact_phone_number VARCHAR(9) NOT NULL, INDEX IDX_E6759E4F503D2FA2 (id_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patitent ADD CONSTRAINT FK_E6759E4F503D2FA2 FOREIGN KEY (id_address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patitent DROP FOREIGN KEY FK_E6759E4F503D2FA2');
        $this->addSql('DROP TABLE patitent');
    }
}
