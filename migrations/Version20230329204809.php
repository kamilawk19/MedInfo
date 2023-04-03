<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329204809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicines ADD fk_medicine_id INT NOT NULL');
        $this->addSql('ALTER TABLE medicines ADD CONSTRAINT FK_885F06BC468BB83E FOREIGN KEY (fk_medicine_id) REFERENCES pharmacy_supply (id)');
        $this->addSql('CREATE INDEX IDX_885F06BC468BB83E ON medicines (fk_medicine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicines DROP FOREIGN KEY FK_885F06BC468BB83E');
        $this->addSql('DROP INDEX IDX_885F06BC468BB83E ON medicines');
        $this->addSql('ALTER TABLE medicines DROP fk_medicine_id');
    }
}
