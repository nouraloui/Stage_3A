<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831132945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champ CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE code_nomenclature CHANGE code_str code_str VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE code_nomenclature ADD CONSTRAINT FK_B2B2C437B48E9453 FOREIGN KEY (code_str) REFERENCES str_nome (code_str) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_contrat ADD PRIMARY KEY (numord)');
        $this->addSql('ALTER TABLE esp_entete_note ADD PRIMARY KEY (code_module)');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F29473A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F2941D8B5E2C FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens)');
        $this->addSql('CREATE INDEX IDX_B32F2941D8B5E2C ON esp_entete_note (id_ens)');
        $this->addSql('ALTER TABLE esp_inscription ADD id VARCHAR(255) NOT NULL, ADD compteur_id INT NOT NULL, ADD etudiant VARCHAR(10) DEFAULT NULL, ADD PRIMARY KEY (annee_deb, id)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2717E22E3 FOREIGN KEY (etudiant) REFERENCES esp_etudiant (id_et)');
        $this->addSql('CREATE INDEX IDX_F16890D2AA3B9810 ON esp_inscription (compteur_id)');
        $this->addSql('CREATE INDEX IDX_F16890D2717E22E3 ON esp_inscription (etudiant)');
        $this->addSql('ALTER TABLE esp_note CHANGE note_exam note_exam INT DEFAULT NULL, CHANGE note_tp note_tp INT DEFAULT NULL, CHANGE note_cc note_cc INT DEFAULT NULL, ADD PRIMARY KEY (code_module)');
        $this->addSql('ALTER TABLE esp_note ADD CONSTRAINT FK_7F31CBD373A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_plan_etude ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE messages ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE photos_etudiant ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_et id_et VARCHAR(10) DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FCCE46C13F FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_721D2FCCE46C13F ON photos_etudiant (id_et)');
        $this->addSql('ALTER TABLE salle ADD PRIMARY KEY (code_salle)');
        $this->addSql('ALTER TABLE societe ADD PRIMARY KEY (code_soc)');
        $this->addSql('ALTER TABLE str_nome CHANGE nom_str nom_str VARCHAR(35) NOT NULL, ADD PRIMARY KEY (code_str)');
        $this->addSql('ALTER TABLE utilisateur CHANGE id_utilisateur id_utilisateur INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE CREATE OR REPLACE d_at created_at DATETIME NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champ CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE code_nomenclature DROP FOREIGN KEY FK_B2B2C437B48E9453');
        $this->addSql('ALTER TABLE code_nomenclature CHANGE code_str code_str VARCHAR(2) NOT NULL');
        $this->addSql('DROP INDEX `primary` ON esp_contrat');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F29473A27E8A');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F2941D8B5E2C');
        $this->addSql('DROP INDEX IDX_B32F2941D8B5E2C ON esp_entete_note');
        $this->addSql('DROP INDEX `primary` ON esp_entete_note');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2AA3B9810');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2717E22E3');
        $this->addSql('DROP INDEX IDX_F16890D2AA3B9810 ON esp_inscription');
        $this->addSql('DROP INDEX IDX_F16890D2717E22E3 ON esp_inscription');
        $this->addSql('DROP INDEX `primary` ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription DROP id, DROP compteur_id, DROP etudiant');
        $this->addSql('ALTER TABLE esp_note DROP FOREIGN KEY FK_7F31CBD373A27E8A');
        $this->addSql('DROP INDEX `primary` ON esp_note');
        $this->addSql('ALTER TABLE esp_note CHANGE note_exam note_exam INT NOT NULL, CHANGE note_tp note_tp INT NOT NULL, CHANGE note_cc note_cc INT NOT NULL');
        $this->addSql('ALTER TABLE esp_plan_etude MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON esp_plan_etude');
        $this->addSql('ALTER TABLE esp_plan_etude DROP id');
        $this->addSql('ALTER TABLE messages MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON messages');
        $this->addSql('ALTER TABLE messages DROP id');
        $this->addSql('ALTER TABLE messenger_messages MODIFY id BIGINT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB ON messenger_messages');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT NOT NULL, CHANGE created_at CREATE OR REPLACE d_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FCCE46C13F');
        $this->addSql('DROP INDEX UNIQ_721D2FCCE46C13F ON photos_etudiant');
        $this->addSql('DROP INDEX `primary` ON photos_etudiant');
        $this->addSql('ALTER TABLE photos_etudiant DROP id, CHANGE id_et id_et VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE salle MODIFY code_salle VARCHAR(3) NOT NULL');
        $this->addSql('DROP INDEX `primary` ON salle');
        $this->addSql('ALTER TABLE societe MODIFY code_soc VARCHAR(2) NOT NULL');
        $this->addSql('DROP INDEX `primary` ON societe');
        $this->addSql('ALTER TABLE str_nome MODIFY code_str VARCHAR(2) NOT NULL');
        $this->addSql('DROP INDEX `primary` ON str_nome');
        $this->addSql('ALTER TABLE str_nome CHANGE nom_str nom_str VARCHAR(35) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur MODIFY id_utilisateur INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE id_utilisateur id_utilisateur INT NOT NULL');
    }
}
