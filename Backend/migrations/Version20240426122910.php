<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426122910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Activites (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_Activites (voyage_id INT NOT NULL, Activites_id INT NOT NULL, INDEX IDX_4492702B68C9E5AF (voyage_id), INDEX IDX_4492702B5B8C31B7 (Activites_id), PRIMARY KEY(voyage_id, Activites_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voyage_Activites ADD CONSTRAINT FK_4492702B68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_Activites ADD CONSTRAINT FK_4492702B5B8C31B7 FOREIGN KEY (Activites_id) REFERENCES Activites (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage_Activites DROP FOREIGN KEY FK_4492702B68C9E5AF');
        $this->addSql('ALTER TABLE voyage_Activites DROP FOREIGN KEY FK_4492702B5B8C31B7');
        $this->addSql('DROP TABLE Activites');
        $this->addSql('DROP TABLE voyage_Activites');
    }
}
