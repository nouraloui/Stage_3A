<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240819220322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE esp_contrat DROP FOREIGN KEY FK_ESP_CONTRAT_ESP_ENSEIGNANT');
        $this->addSql('DROP INDEX FK_ESP_CONTRAT_ESP_ENSEIGNANT ON esp_contrat');
        $this->addSql('ALTER TABLE esp_contrat DROP id_ens');
        $this->addSql('ALTER TABLE esp_enseignant DROP FOREIGN KEY FK_ESP_ENSEIGNANT_ESP_CONTRAT');
        $this->addSql('ALTER TABLE esp_etudiant CHANGE id_et id_et INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY fk_code_clc');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY fk_id_et');
        $this->addSql('DROP INDEX fk_id_et ON esp_inscription');
        $this->addSql('DROP INDEX fk_code_clc ON esp_inscription');
        $this->addSql('DROP INDEX `primary` ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription DROP id_et');
        $this->addSql('ALTER TABLE esp_inscription ADD PRIMARY KEY (annee_deb)');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY FK_ESP_PLAN_SALLE');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY FK_MOD_PLAN_FOO_CL_SAISON');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY FK_ESP_PLAN_ESP_ENSEIGNANT');
        $this->addSql('ALTER TABLE esp_plan_etude DROP FOREIGN KEY fk_code_cl_plan');
        $this->addSql('DROP INDEX FK_ESP_PLAN_SALLE ON esp_plan_etude');
        $this->addSql('DROP INDEX fk_code_cl_plan ON esp_plan_etude');
        $this->addSql('DROP INDEX FK_ESP_PLAN_ESP_ENSEIGNANT ON esp_plan_etude');
        $this->addSql('DROP INDEX IDX_BC05A47173A27E8A ON esp_plan_etude');
        $this->addSql('DROP INDEX `primary` ON esp_plan_etude');
        $this->addSql('ALTER TABLE esp_plan_etude ADD PRIMARY KEY (code_module)');
        $this->addSql('ALTER TABLE esp_saison_classe DROP FOREIGN KEY fk_annee_deb');
        $this->addSql('ALTER TABLE esp_saison_classe DROP FOREIGN KEY fk_code_cl');
        $this->addSql('DROP INDEX fk_code_cl ON esp_saison_classe');
        $this->addSql('DROP INDEX IDX_E084358FDD948132 ON esp_saison_classe');
        $this->addSql('DROP INDEX `primary` ON esp_saison_classe');
        $this->addSql('ALTER TABLE esp_saison_classe CHANGE code_cl code_cl INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE esp_saison_classe ADD PRIMARY KEY (code_cl)');
        $this->addSql('ALTER TABLE esp_saison_universitaire ADD description VARCHAR(4) NOT NULL, ADD date_debut DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD observation VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant CHANGE id_et id_et INT NOT NULL');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FCCE46C13F FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
        $this->addSql('ALTER TABLE utilisateur CHANGE role role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON classe');
        $this->addSql('ALTER TABLE classe DROP id');
        $this->addSql('ALTER TABLE classe ADD PRIMARY KEY (code_cl)');
        $this->addSql('ALTER TABLE esp_contrat ADD id_ens VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE esp_contrat ADD CONSTRAINT FK_ESP_CONTRAT_ESP_ENSEIGNANT FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens)');
        $this->addSql('CREATE INDEX FK_ESP_CONTRAT_ESP_ENSEIGNANT ON esp_contrat (id_ens)');
        $this->addSql('ALTER TABLE esp_enseignant ADD CONSTRAINT FK_ESP_ENSEIGNANT_ESP_CONTRAT FOREIGN KEY (id_ens) REFERENCES esp_contrat (id_ens)');
        $this->addSql('ALTER TABLE esp_etudiant CHANGE id_et id_et VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE esp_inscription MODIFY annee_deb VARCHAR(4) NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription ADD id_et VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT fk_code_clc FOREIGN KEY (code_cl) REFERENCES esp_saison_classe (code_cl)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT fk_id_et FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
        $this->addSql('CREATE INDEX fk_id_et ON esp_inscription (id_et)');
        $this->addSql('CREATE INDEX fk_code_clc ON esp_inscription (code_cl)');
        $this->addSql('ALTER TABLE esp_inscription ADD PRIMARY KEY (annee_deb, id_et)');
        $this->addSql('ALTER TABLE esp_plan_etude MODIFY code_module VARCHAR(10) NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_plan_etude');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT FK_ESP_PLAN_SALLE FOREIGN KEY (code_salle) REFERENCES salle (code_salle) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT FK_MOD_PLAN_FOO_CL_SAISON FOREIGN KEY (code_module) REFERENCES esp_module (code_module) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT FK_ESP_PLAN_ESP_ENSEIGNANT FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_plan_etude ADD CONSTRAINT fk_code_cl_plan FOREIGN KEY (code_cl) REFERENCES esp_saison_classe (code_cl) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX FK_ESP_PLAN_SALLE ON esp_plan_etude (code_salle)');
        $this->addSql('CREATE INDEX fk_code_cl_plan ON esp_plan_etude (code_cl)');
        $this->addSql('CREATE INDEX FK_ESP_PLAN_ESP_ENSEIGNANT ON esp_plan_etude (id_ens)');
        $this->addSql('CREATE INDEX IDX_BC05A47173A27E8A ON esp_plan_etude (code_module)');
        $this->addSql('ALTER TABLE esp_plan_etude ADD PRIMARY KEY (code_module, code_cl, annee_deb, num_semestre)');
        $this->addSql('ALTER TABLE esp_saison_classe MODIFY code_cl INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON esp_saison_classe');
        $this->addSql('ALTER TABLE esp_saison_classe CHANGE code_cl code_cl VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE esp_saison_classe ADD CONSTRAINT fk_annee_deb FOREIGN KEY (annee_deb) REFERENCES esp_inscription (annee_deb)');
        $this->addSql('ALTER TABLE esp_saison_classe ADD CONSTRAINT fk_code_cl FOREIGN KEY (code_cl) REFERENCES classe (code_cl)');
        $this->addSql('CREATE INDEX fk_code_cl ON esp_saison_classe (code_cl)');
        $this->addSql('CREATE INDEX IDX_E084358FDD948132 ON esp_saison_classe (annee_deb)');
        $this->addSql('ALTER TABLE esp_saison_classe ADD PRIMARY KEY (annee_deb, code_cl)');
        $this->addSql('ALTER TABLE esp_saison_universitaire DROP description, DROP date_debut, DROP date_fin, DROP observation');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FCCE46C13F');
        $this->addSql('ALTER TABLE photos_etudiant CHANGE id_et id_et VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE role role INT NOT NULL');
    }
}
