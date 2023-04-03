<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329192437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD id_address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649503D2FA2 FOREIGN KEY (id_address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649503D2FA2 ON user (id_address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649503D2FA2');
        $this->addSql('DROP INDEX IDX_8D93D649503D2FA2 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP id_address_id');
    }
}
