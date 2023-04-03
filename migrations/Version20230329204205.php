<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329204205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicines ADD id_dialysis_id INT NOT NULL');
        $this->addSql('ALTER TABLE medicines ADD CONSTRAINT FK_885F06BCF2D87AF3 FOREIGN KEY (id_dialysis_id) REFERENCES dialysis (id)');
        $this->addSql('CREATE INDEX IDX_885F06BCF2D87AF3 ON medicines (id_dialysis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicines DROP FOREIGN KEY FK_885F06BCF2D87AF3');
        $this->addSql('DROP INDEX IDX_885F06BCF2D87AF3 ON medicines');
        $this->addSql('ALTER TABLE medicines DROP id_dialysis_id');
    }
}
