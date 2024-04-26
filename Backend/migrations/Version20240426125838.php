<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426125838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_generale (id INT AUTO_INCREMENT NOT NULL, statut_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_3F44B220F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_generale ADD CONSTRAINT FK_3F44B220F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE demande ADD statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5F6203804 ON demande (statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5F6203804');
        $this->addSql('ALTER TABLE demande_generale DROP FOREIGN KEY FK_3F44B220F6203804');
        $this->addSql('DROP TABLE demande_generale');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP INDEX IDX_2694D7A5F6203804 ON demande');
        $this->addSql('ALTER TABLE demande DROP statut_id');
    }
}
