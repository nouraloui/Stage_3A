<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830230247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F29473A27E8A');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F2941D8B5E2C');
        $this->addSql('ALTER TABLE esp_note DROP FOREIGN KEY FK_code_moduleN');
        $this->addSql('DROP TABLE esp_entete_note');
        $this->addSql('DROP TABLE esp_note');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE classe ADD id INT AUTO_INCREMENT NOT NULL, ADD saison_id INT NOT NULL, ADD code_cl_id INT NOT NULL, ADD catergorie VARCHAR(20) NOT NULL, ADD ouvert TINYINT(1) NOT NULL, DROP code_cl, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96F965414C FOREIGN KEY (saison_id) REFERENCES esp_saison_classe (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF961C15B755 FOREIGN KEY (code_cl_id) REFERENCES compteur (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96F965414C ON classe (saison_id)');
        $this->addSql('CREATE INDEX IDX_8F87BF961C15B755 ON classe (code_cl_id)');
        $this->addSql('ALTER TABLE code_nomenclature DROP FOREIGN KEY FK_B2B2C437B48E9453');
        $this->addSql('DROP INDEX IDX_B2B2C437B48E9453 ON code_nomenclature');
        $this->addSql('ALTER TABLE code_nomenclature DROP code_str');
        $this->addSql('ALTER TABLE compteur ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE esp_etudiant ADD id INT AUTO_INCREMENT NOT NULL, ADD classe_id INT DEFAULT NULL, ADD inscription TINYINT(1) NOT NULL, ADD affecte TINYINT(1) NOT NULL, DROP id_et, CHANGE photo_et photo_et VARBINARY(255) NOT NULL, CHANGE cycle_et cycle_et VARCHAR(2) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE esp_etudiant ADD CONSTRAINT FK_E31A1F308F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_E31A1F308F5EA509 ON esp_etudiant (classe_id)');
        $this->addSql('DROP INDEX `primary` ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription ADD id VARCHAR(255) NOT NULL, ADD code_cl_id INT NOT NULL, ADD etudiant_id INT NOT NULL, DROP code_cl, DROP id_et');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D21C15B755 FOREIGN KEY (code_cl_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES esp_etudiant (id)');
        $this->addSql('CREATE INDEX IDX_F16890D21C15B755 ON esp_inscription (code_cl_id)');
        $this->addSql('CREATE INDEX IDX_F16890D2DDEAB1A3 ON esp_inscription (etudiant_id)');
        $this->addSql('ALTER TABLE esp_inscription ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY fk_ESP_PLAN_REFERENCE_SALLE');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY fk_espContrat_EspEnsiegnant');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY fk_ESP_PLAN_REFERENCE_ESP_MOD_CL_SAISON');
        $this->addSql('DROP INDEX fk_espContrat_EspEnsiegnant ON esp_plan_etude');
        $this->addSql('DROP INDEX fk_ESP_PLAN_REFERENCE_SALLE ON esp_plan_etude');
        $this->addSql('ALTER TABLE esp_plan_etude ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE esp_saison_classe ADD id INT AUTO_INCREMENT NOT NULL, ADD esp_saison_universitaire_id INT DEFAULT NULL, CHANGE code_cl code_cl VARCHAR(10) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE esp_saison_classe ADD CONSTRAINT FK_E084358FC22967BB FOREIGN KEY (esp_saison_universitaire_id) REFERENCES esp_saison_universitaire (id)');
        $this->addSql('CREATE INDEX IDX_E084358FC22967BB ON esp_saison_classe (esp_saison_universitaire_id)');
        $this->addSql('ALTER TABLE esp_saison_universitaire ADD id INT AUTO_INCREMENT NOT NULL, DROP annee_deb, CHANGE description description VARCHAR(4) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FCCE46C13F');
        $this->addSql('ALTER TABLE photos_etudiant ADD id INT AUTO_INCREMENT NOT NULL, ADD id_et_id INT NOT NULL, DROP id_et, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FC42865F9 FOREIGN KEY (id_et_id) REFERENCES esp_etudiant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_721D2FC42865F9 ON photos_etudiant (id_et_id)');
        $this->addSql('ALTER TABLE str_nome CHANGE nom_str nom_str VARCHAR(35) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE esp_entete_note (code_module VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_ens VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, code_cl VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, annee_deb VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_saisie DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, semestre INT NOT NULL, INDEX FK_B32F2941D8B5E2C (id_ens), INDEX FK_B32F29473A27E8A (code_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE esp_note (code_module VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code_cl VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, annee_deb VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_et VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, note_exam INT NOT NULL, note_tp INT NOT NULL, note_cc INT NOT NULL, is_confirmed TINYINT(1) NOT NULL, INDEX FK_code_moduleN (code_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id_utilisateur INT AUTO_INCREMENT NOT NULL, cin INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role INT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F29473A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F2941D8B5E2C FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens)');
        $this->addSql('ALTER TABLE esp_note ADD CONSTRAINT FK_code_moduleN FOREIGN KEY (code_module) REFERENCES esp_module (code_module) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96F965414C');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF961C15B755');
        $this->addSql('DROP INDEX IDX_8F87BF96F965414C ON classe');
        $this->addSql('DROP INDEX IDX_8F87BF961C15B755 ON classe');
        $this->addSql('DROP INDEX `PRIMARY` ON classe');
        $this->addSql('ALTER TABLE classe ADD code_cl VARCHAR(10) NOT NULL, DROP id, DROP saison_id, DROP code_cl_id, DROP catergorie, DROP ouvert');
        $this->addSql('ALTER TABLE classe ADD PRIMARY KEY (code_cl)');
        $this->addSql('ALTER TABLE code_nomenclature ADD code_str VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE code_nomenclature ADD CONSTRAINT FK_B2B2C437B48E9453 FOREIGN KEY (code_str) REFERENCES str_nome (code_str) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B2B2C437B48E9453 ON code_nomenclature (code_str)');
        $this->addSql('ALTER TABLE compteur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON compteur');
        $this->addSql('ALTER TABLE compteur DROP id');
        $this->addSql('ALTER TABLE compteur ADD PRIMARY KEY (code_cpt)');
        $this->addSql('ALTER TABLE esp_etudiant MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE esp_etudiant DROP FOREIGN KEY FK_E31A1F308F5EA509');
        $this->addSql('DROP INDEX IDX_E31A1F308F5EA509 ON esp_etudiant');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_etudiant');
        $this->addSql('ALTER TABLE esp_etudiant ADD id_et VARCHAR(10) NOT NULL, DROP id, DROP classe_id, DROP inscription, DROP affecte, CHANGE cycle_et cycle_et VARCHAR(255) NOT NULL, CHANGE photo_et photo_et VARCHAR(5000) NOT NULL');
        $this->addSql('ALTER TABLE esp_etudiant ADD PRIMARY KEY (id_et)');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D21C15B755');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2DDEAB1A3');
        $this->addSql('DROP INDEX IDX_F16890D21C15B755 ON esp_inscription');
        $this->addSql('DROP INDEX IDX_F16890D2DDEAB1A3 ON esp_inscription');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription ADD code_cl VARCHAR(10) NOT NULL, ADD id_et VARCHAR(10) NOT NULL, DROP id, DROP code_cl_id, DROP etudiant_id');
        $this->addSql('ALTER TABLE esp_inscription ADD PRIMARY KEY (annee_deb)');
        $this->addSql('ALTER TABLE esp_plan_etude MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_plan_etude');
        $this->addSql('ALTER TABLE esp_plan_etude DROP id');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT fk_ESP_PLAN_REFERENCE_SALLE FOREIGN KEY (code_salle) REFERENCES salle (code_salle) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT fk_espContrat_EspEnsiegnant FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT fk_ESP_PLAN_REFERENCE_ESP_MOD_CL_SAISON FOREIGN KEY (code_module) REFERENCES esp_module (code_module) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fk_espContrat_EspEnsiegnant ON esp_plan_etude (id_ens)');
        $this->addSql('CREATE INDEX fk_ESP_PLAN_REFERENCE_SALLE ON esp_plan_etude (code_salle)');
        $this->addSql('ALTER TABLE esp_plan_etude ADD PRIMARY KEY (code_module)');
        $this->addSql('ALTER TABLE esp_saison_classe MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE esp_saison_classe DROP FOREIGN KEY FK_E084358FC22967BB');
        $this->addSql('DROP INDEX IDX_E084358FC22967BB ON esp_saison_classe');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_saison_classe');
        $this->addSql('ALTER TABLE esp_saison_classe DROP id, DROP esp_saison_universitaire_id, CHANGE code_cl code_cl VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE esp_saison_classe ADD PRIMARY KEY (code_cl)');
        $this->addSql('ALTER TABLE esp_saison_universitaire MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_saison_universitaire');
        $this->addSql('ALTER TABLE esp_saison_universitaire ADD annee_deb VARCHAR(255) NOT NULL, DROP id, CHANGE description description VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE esp_saison_universitaire ADD PRIMARY KEY (annee_deb)');
        $this->addSql('ALTER TABLE photos_etudiant MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FC42865F9');
        $this->addSql('DROP INDEX UNIQ_721D2FC42865F9 ON photos_etudiant');
        $this->addSql('DROP INDEX `PRIMARY` ON photos_etudiant');
        $this->addSql('ALTER TABLE photos_etudiant ADD id_et VARCHAR(10) NOT NULL, DROP id, DROP id_et_id');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FCCE46C13F FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
        $this->addSql('ALTER TABLE photos_etudiant ADD PRIMARY KEY (id_et)');
        $this->addSql('ALTER TABLE str_nome CHANGE nom_str nom_str VARCHAR(35) DEFAULT NULL');
    }
}
