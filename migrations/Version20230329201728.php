<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329201728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment ADD id_dialysis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844F2D87AF3 FOREIGN KEY (id_dialysis_id) REFERENCES dialysis (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F844F2D87AF3 ON appointment (id_dialysis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844F2D87AF3');
        $this->addSql('DROP INDEX UNIQ_FE38F844F2D87AF3 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP id_dialysis_id');
    }
}
