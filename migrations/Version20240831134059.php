<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831134059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champ CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE code_nomenclature ADD CONSTRAINT FK_B2B2C437B48E9453 FOREIGN KEY (code_str) REFERENCES str_nome (code_str) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F29473A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F2941D8B5E2C FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2717E22E3 FOREIGN KEY (etudiant) REFERENCES esp_etudiant (id_et)');
        $this->addSql('ALTER TABLE esp_note ADD CONSTRAINT FK_7F31CBD373A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_plan_etude CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE messages CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FCCE46C13F FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
        $this->addSql('ALTER TABLE utilisateur CHANGE id_utilisateur id_utilisateur INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE CREATE OR REPLACE d_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champ CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE code_nomenclature DROP FOREIGN KEY FK_B2B2C437B48E9453');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F29473A27E8A');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F2941D8B5E2C');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2AA3B9810');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2717E22E3');
        $this->addSql('ALTER TABLE esp_note DROP FOREIGN KEY FK_7F31CBD373A27E8A');
        $this->addSql('ALTER TABLE esp_plan_etude CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE messages CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT NOT NULL, CHANGE created_at CREATE OR REPLACE d_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FCCE46C13F');
        $this->addSql('ALTER TABLE photos_etudiant CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE id_utilisateur id_utilisateur INT NOT NULL');
    }
}
