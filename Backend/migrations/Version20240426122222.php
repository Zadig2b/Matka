<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426122222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_voyage (categorie_id INT NOT NULL, voyage_id INT NOT NULL, INDEX IDX_B9BB236CBCF5E72D (categorie_id), INDEX IDX_B9BB236C68C9E5AF (voyage_id), PRIMARY KEY(categorie_id, voyage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, voyage_user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, duree VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', description LONGTEXT DEFAULT NULL, prix VARCHAR(50) NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_3F9D895551E74AA1 (voyage_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_voyage ADD CONSTRAINT FK_B9BB236CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_voyage ADD CONSTRAINT FK_B9BB236C68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895551E74AA1 FOREIGN KEY (voyage_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_voyage DROP FOREIGN KEY FK_B9BB236CBCF5E72D');
        $this->addSql('ALTER TABLE categorie_voyage DROP FOREIGN KEY FK_B9BB236C68C9E5AF');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895551E74AA1');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_voyage');
        $this->addSql('DROP TABLE voyage');
    }
}
