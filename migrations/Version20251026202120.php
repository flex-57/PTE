<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251026202120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere_evaluation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_metier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, domaine_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_1323A5754272FC9F (domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_critere_evaluation (evaluation_id INT NOT NULL, critere_evaluation_id INT NOT NULL, INDEX IDX_888FD829456C5646 (evaluation_id), INDEX IDX_888FD829BE83FF65 (critere_evaluation_id), PRIMARY KEY(evaluation_id, critere_evaluation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, domaine_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_51A00D8C4272FC9F (domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_critere_metier (metier_id INT NOT NULL, critere_metier_id INT NOT NULL, INDEX IDX_90FBDED1ED16FA20 (metier_id), INDEX IDX_90FBDED1CFF77A88 (critere_metier_id), PRIMARY KEY(metier_id, critere_metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5754272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE evaluation_critere_evaluation ADD CONSTRAINT FK_888FD829456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluation_critere_evaluation ADD CONSTRAINT FK_888FD829BE83FF65 FOREIGN KEY (critere_evaluation_id) REFERENCES critere_evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE metier_critere_metier ADD CONSTRAINT FK_90FBDED1ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_critere_metier ADD CONSTRAINT FK_90FBDED1CFF77A88 FOREIGN KEY (critere_metier_id) REFERENCES critere_metier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5754272FC9F');
        $this->addSql('ALTER TABLE evaluation_critere_evaluation DROP FOREIGN KEY FK_888FD829456C5646');
        $this->addSql('ALTER TABLE evaluation_critere_evaluation DROP FOREIGN KEY FK_888FD829BE83FF65');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C4272FC9F');
        $this->addSql('ALTER TABLE metier_critere_metier DROP FOREIGN KEY FK_90FBDED1ED16FA20');
        $this->addSql('ALTER TABLE metier_critere_metier DROP FOREIGN KEY FK_90FBDED1CFF77A88');
        $this->addSql('DROP TABLE critere_evaluation');
        $this->addSql('DROP TABLE critere_metier');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE evaluation_critere_evaluation');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE metier_critere_metier');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
