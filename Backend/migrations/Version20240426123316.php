<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426123316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_voyage (pays_id INT NOT NULL, voyage_id INT NOT NULL, INDEX IDX_8E9DDE04A6E44244 (pays_id), INDEX IDX_8E9DDE0468C9E5AF (voyage_id), PRIMARY KEY(pays_id, voyage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pays_voyage ADD CONSTRAINT FK_8E9DDE04A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_voyage ADD CONSTRAINT FK_8E9DDE0468C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays_voyage DROP FOREIGN KEY FK_8E9DDE04A6E44244');
        $this->addSql('ALTER TABLE pays_voyage DROP FOREIGN KEY FK_8E9DDE0468C9E5AF');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE pays_voyage');
    }
}
