<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121130453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product CHANGE description description VARCHAR(700) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD profilimage VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE postalcode postalcode INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product CHANGE description description VARCHAR(700) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user DROP profilimage, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE postalcode postalcode INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
