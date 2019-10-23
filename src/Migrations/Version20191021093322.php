<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021093322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_68C58ED9A76ED395 (user_id), INDEX IDX_68C58ED94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, name VARCHAR(75) NOT NULL, description VARCHAR(700) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, publishdate DATETIME NOT NULL, INDEX IDX_D34A04AD9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(50) NOT NULL, ADD lastname VARCHAR(50) NOT NULL, ADD postalcode INT DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(500) DEFAULT NULL, ADD creationdate DATE NOT NULL, ADD changedate DATE NOT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED94584665A');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP postalcode, DROP address, DROP description, DROP creationdate, DROP changedate, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
