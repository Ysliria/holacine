<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720080229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classification (id INT AUTO_INCREMENT NOT NULL, indice VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, classification_id INT NOT NULL, style_id INT NOT NULL, realisateur_id INT NOT NULL, producteur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, annee INT NOT NULL, INDEX IDX_8244BE222A86559F (classification_id), INDEX IDX_8244BE22BACD6074 (style_id), INDEX IDX_8244BE22F1D8422E (realisateur_id), INDEX IDX_8244BE22AB9BB300 (producteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_artiste (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_7CB92E6C567F5183 (film_id), INDEX IDX_7CB92E6C21D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE222A86559F FOREIGN KEY (classification_id) REFERENCES classification (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22F1D8422E FOREIGN KEY (realisateur_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22AB9BB300 FOREIGN KEY (producteur_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE film_artiste ADD CONSTRAINT FK_7CB92E6C567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_artiste ADD CONSTRAINT FK_7CB92E6C21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22F1D8422E');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22AB9BB300');
        $this->addSql('ALTER TABLE film_artiste DROP FOREIGN KEY FK_7CB92E6C21D25844');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE222A86559F');
        $this->addSql('ALTER TABLE film_artiste DROP FOREIGN KEY FK_7CB92E6C567F5183');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22BACD6074');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE classification');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_artiste');
        $this->addSql('DROP TABLE style');
    }
}
