<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831134134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champ (id INT AUTO_INCREMENT NOT NULL, cha_code_str VARCHAR(2) NOT NULL, valeur VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champ_str2 (code_champ VARCHAR(2) NOT NULL, nom_champ VARCHAR(255) NOT NULL, masque_champ VARCHAR(40) NOT NULL, PRIMARY KEY(code_champ)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (code_cl VARCHAR(10) NOT NULL, saison_id INT NOT NULL, id INT NOT NULL, libelle_cl VARCHAR(60) NOT NULL, description_cl VARCHAR(300) NOT NULL, date_cr DATE NOT NULL, date_dern_modif DATE NOT NULL, salle_principale VARCHAR(3) NOT NULL, salle_secondaire_1 VARCHAR(3) NOT NULL, salle_secondaire_2 VARCHAR(3) NOT NULL, niveau_accees INT NOT NULL, filiere VARCHAR(2) NOT NULL, annee_scolaire VARCHAR(4) NOT NULL, catergorie VARCHAR(20) NOT NULL, ouvert TINYINT(1) NOT NULL, INDEX IDX_8F87BF96F965414C (saison_id), PRIMARY KEY(code_cl)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_nomenclature (code_nome VARCHAR(3) NOT NULL, code_str VARCHAR(2) DEFAULT NULL, lib_nome VARCHAR(100) NOT NULL, INDEX IDX_B2B2C437B48E9453 (code_str), PRIMARY KEY(code_nome)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compteur (id INT AUTO_INCREMENT NOT NULL, code_cpt VARCHAR(2) NOT NULL, lib_cpt VARCHAR(20) NOT NULL, date_cr DATE NOT NULL, date_last_modif DATE NOT NULL, taille INT NOT NULL, valeur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_contrat (numord VARCHAR(10) NOT NULL, annee VARCHAR(4) NOT NULL, date_etab DATE NOT NULL, diplome VARCHAR(2) NOT NULL, grade VARCHAR(2) NOT NULL, institution VARCHAR(40) NOT NULL, PRIMARY KEY(numord)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_enseignant (id_ens VARCHAR(10) NOT NULL, nom_ens VARCHAR(30) NOT NULL, type_ens VARCHAR(1) NOT NULL, date_rec DATE NOT NULL, niveau VARCHAR(2) NOT NULL, date_saisie DATE NOT NULL, date_dern_modif DATE NOT NULL, etat VARCHAR(1) NOT NULL, observation VARCHAR(300) NOT NULL, PRIMARY KEY(id_ens)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_entete_note (code_module VARCHAR(10) NOT NULL, id_ens VARCHAR(10) DEFAULT NULL, code_cl VARCHAR(10) NOT NULL, annee_deb VARCHAR(4) NOT NULL, date_saisie DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, semestre INT NOT NULL, INDEX IDX_B32F2941D8B5E2C (id_ens), PRIMARY KEY(code_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_etudiant (id_et VARCHAR(10) NOT NULL, code_cl VARCHAR(10) NOT NULL, nom_et VARCHAR(30) NOT NULL, pnom_et VARCHAR(30) NOT NULL, date_nais_et DATE NOT NULL, lieu_nais_et VARCHAR(30) NOT NULL, nature_et VARCHAR(2) NOT NULL, fonction_et VARCHAR(30) NOT NULL, adresse_et VARCHAR(100) NOT NULL, tel_et VARCHAR(120) NOT NULL, tel_parent_et VARCHAR(30) NOT NULL, e_mail_et VARCHAR(60) NOT NULL, cycle_et VARCHAR(2) NOT NULL, nature_bac VARCHAR(2) NOT NULL, date_bac DATE NOT NULL, num_bac_et VARCHAR(20) NOT NULL, etab_bac VARCHAR(100) NOT NULL, diplome_sup_et VARCHAR(100) NOT NULL, niveau_diplome_sup_et INT NOT NULL, etab_origine VARCHAR(100) NOT NULL, speialite_esp_et VARCHAR(2) NOT NULL, date_entree_esp_et DATE NOT NULL, annee_entree_esp_et VARCHAR(4) NOT NULL, classe_courante_et VARCHAR(10) NOT NULL, situation_financiere_et VARCHAR(2) NOT NULL, niveau_courant_et INT NOT NULL, moyenne_dern_semestre_et INT NOT NULL, resultat_final_et VARCHAR(2) NOT NULL, diplome_obtenu_esp_et VARCHAR(2) NOT NULL, date_sortie_et DATE NOT NULL, observation_et VARCHAR(1000) NOT NULL, photo_et VARBINARY(255) NOT NULL, sexe VARCHAR(1) NOT NULL, nationalite VARCHAR(20) NOT NULL, num_cin_passeport VARCHAR(30) NOT NULL, date_saisie DATE NOT NULL, date_dern_modif DATE NOT NULL, agent VARCHAR(10) NOT NULL, num_ord VARCHAR(10) NOT NULL, date_delivrance DATE NOT NULL, lieu_delivrance VARCHAR(30) NOT NULL, niveau_acces INT NOT NULL, nature_cours VARCHAR(2) NOT NULL, nature_piece_id INT NOT NULL, adresse_parent VARCHAR(100) NOT NULL, cp_parent VARCHAR(6) NOT NULL, ville_parent VARCHAR(30) NOT NULL, pays_parent VARCHAR(30) NOT NULL, cp_et VARCHAR(6) NOT NULL, ville_et VARCHAR(255) NOT NULL, pays_et VARCHAR(30) NOT NULL, e_mail_parent VARCHAR(60) NOT NULL, inscription TINYINT(1) NOT NULL, affecte TINYINT(1) NOT NULL, INDEX IDX_E31A1F30D3EE9EAF (code_cl), PRIMARY KEY(id_et)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_inscription (annee_deb VARCHAR(4) NOT NULL, id VARCHAR(255) NOT NULL, compteur_id INT NOT NULL, etudiant VARCHAR(10) DEFAULT NULL, esp_annee_deb VARCHAR(10) NOT NULL, code_cl VARCHAR(10) NOT NULL, cout_annuel INT NOT NULL, frais_ins INT NOT NULL, type_rglt VARCHAR(2) NOT NULL, mode_rglt VARCHAR(2) NOT NULL, code_dev VARCHAR(4) NOT NULL, cout_dev INT NOT NULL, sit_rglt VARCHAR(1) NOT NULL, credit_rglt INT NOT NULL, nb_credit_module INT NOT NULL, moy_sem1 INT NOT NULL, moy_sem2 INT NOT NULL, moy_general INT NOT NULL, resultat VARCHAR(1) NOT NULL, niveau_accees INT NOT NULL, type_insc VARCHAR(1) NOT NULL, niv_langue VARCHAR(5) NOT NULL, code_cl_langue VARCHAR(10) NOT NULL, utilisateur VARCHAR(16) NOT NULL, dern_utilisateur VARCHAR(16) NOT NULL, date_preinsc DATE NOT NULL, date_insc DATE NOT NULL, code_cl1 VARCHAR(107) NOT NULL, id_et VARCHAR(10) NOT NULL, INDEX IDX_F16890D2AA3B9810 (compteur_id), INDEX IDX_F16890D2717E22E3 (etudiant), PRIMARY KEY(annee_deb, id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_module (code_module VARCHAR(10) NOT NULL, designation VARCHAR(50) NOT NULL, description VARCHAR(1000) NOT NULL, nb_heures INT NOT NULL, PRIMARY KEY(code_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_note (code_module VARCHAR(10) NOT NULL, code_cl VARCHAR(10) NOT NULL, annee_deb VARCHAR(4) NOT NULL, id_et VARCHAR(10) NOT NULL, note_exam INT DEFAULT NULL, note_tp INT DEFAULT NULL, note_cc INT DEFAULT NULL, is_confirmed TINYINT(1) NOT NULL, PRIMARY KEY(code_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_plan_etude (id INT AUTO_INCREMENT NOT NULL, num_panier VARCHAR(5) NOT NULL, code_module VARCHAR(10) NOT NULL, code_cl VARCHAR(10) NOT NULL, annee_deb VARCHAR(4) NOT NULL, annee_fin VARCHAR(4) NOT NULL, description VARCHAR(500) NOT NULL, nb_heures INT NOT NULL, coef INT NOT NULL, num_semestre INT NOT NULL, num_periodfe INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, date_examen DATE NOT NULL, date_rattrapage DATE NOT NULL, nb_horaire_realises INT NOT NULL, acomptabiliser INT NOT NULL, esp_annee_deb VARCHAR(10) NOT NULL, code_salle VARCHAR(3) NOT NULL, id_ens VARCHAR(10) NOT NULL, id_ens2 VARCHAR(10) NOT NULL, nb_heures_ens INT NOT NULL, nb_heures_ens2 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_saison_classe (id INT AUTO_INCREMENT NOT NULL, esp_saison_universitaire_id INT DEFAULT NULL, annee_deb VARCHAR(10) NOT NULL, date_demarrage DATE NOT NULL, description VARCHAR(300) NOT NULL, code_cl VARCHAR(10) NOT NULL, nb_etudiant INT NOT NULL, salle_principale VARCHAR(2) NOT NULL, salle_secondaire_1 VARCHAR(3) NOT NULL, salle_secondaire_2 VARCHAR(3) NOT NULL, nature VARCHAR(1) NOT NULL, type_classe VARCHAR(2) NOT NULL, nb_seance INT NOT NULL, classe_entreprise VARCHAR(1) NOT NULL, semestre INT NOT NULL, cl_eclate VARCHAR(1) NOT NULL, INDEX IDX_E084358FC22967BB (esp_saison_universitaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esp_saison_universitaire (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(4) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, observation VARCHAR(500) NOT NULL, annee_deb VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, m_sgid VARCHAR(40) NOT NULL, m_sgtitle VARCHAR(255) NOT NULL, m_sgtext VARCHAR(255) NOT NULL, m_sgicon VARCHAR(12) NOT NULL, m_sgbutton VARCHAR(17) NOT NULL, m_sgdefaultbutton DOUBLE PRECISION NOT NULL, m_sgseverity DOUBLE PRECISION NOT NULL, m_sgprint VARCHAR(1) NOT NULL, m_sguserinput VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos_etudiant (id INT AUTO_INCREMENT NOT NULL, id_et VARCHAR(10) DEFAULT NULL, photos_id LONGBLOB NOT NULL, UNIQUE INDEX UNIQ_721D2FCCE46C13F (id_et), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (code_salle VARCHAR(3) NOT NULL, description VARCHAR(200) NOT NULL, PRIMARY KEY(code_salle)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (code_soc VARCHAR(2) NOT NULL, nom_soc VARCHAR(100) NOT NULL, adr_soc VARCHAR(40) NOT NULL, tel_soc VARCHAR(20) NOT NULL, fax_soc VARCHAR(20) NOT NULL, sigle VARBINARY(255) NOT NULL, e_mail VARCHAR(50) NOT NULL, code_postal VARCHAR(4) NOT NULL, date_cr DATE NOT NULL, date_maj DATE NOT NULL, ville VARCHAR(40) NOT NULL, rib VARCHAR(25) NOT NULL, code_tva VARCHAR(15) NOT NULL, banque VARCHAR(20) NOT NULL, rc VARCHAR(15) NOT NULL, code_rglt_comptant VARCHAR(3) NOT NULL, code_rglt_espece VARCHAR(3) NOT NULL, annee_deb VARCHAR(4) NOT NULL, annee_fin VARCHAR(4) NOT NULL, taux_exam INT NOT NULL, taux_ds INT NOT NULL, taux_tp INT NOT NULL, PRIMARY KEY(code_soc)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE str_nome (code_str VARCHAR(2) NOT NULL, nom_str VARCHAR(35) NOT NULL, PRIMARY KEY(code_str)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id_utilisateur INT AUTO_INCREMENT NOT NULL, cin INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, role INT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96F965414C FOREIGN KEY (saison_id) REFERENCES esp_saison_classe (id)');
        $this->addSql('ALTER TABLE code_nomenclature ADD CONSTRAINT FK_B2B2C437B48E9453 FOREIGN KEY (code_str) REFERENCES str_nome (code_str) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F29473A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_entete_note ADD CONSTRAINT FK_B32F2941D8B5E2C FOREIGN KEY (id_ens) REFERENCES esp_enseignant (id_ens)');
        $this->addSql('ALTER TABLE esp_etudiant ADD CONSTRAINT FK_E31A1F30D3EE9EAF FOREIGN KEY (code_cl) REFERENCES classe (code_cl)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2717E22E3 FOREIGN KEY (etudiant) REFERENCES esp_etudiant (id_et)');
        $this->addSql('ALTER TABLE esp_note ADD CONSTRAINT FK_7F31CBD373A27E8A FOREIGN KEY (code_module) REFERENCES esp_module (code_module)');
        $this->addSql('ALTER TABLE esp_saison_classe ADD CONSTRAINT FK_E084358FC22967BB FOREIGN KEY (esp_saison_universitaire_id) REFERENCES esp_saison_universitaire (id)');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FCCE46C13F FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96F965414C');
        $this->addSql('ALTER TABLE code_nomenclature DROP FOREIGN KEY FK_B2B2C437B48E9453');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F29473A27E8A');
        $this->addSql('ALTER TABLE esp_entete_note DROP FOREIGN KEY FK_B32F2941D8B5E2C');
        $this->addSql('ALTER TABLE esp_etudiant DROP FOREIGN KEY FK_E31A1F30D3EE9EAF');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2AA3B9810');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2717E22E3');
        $this->addSql('ALTER TABLE esp_note DROP FOREIGN KEY FK_7F31CBD373A27E8A');
        $this->addSql('ALTER TABLE esp_saison_classe DROP FOREIGN KEY FK_E084358FC22967BB');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FCCE46C13F');
        $this->addSql('DROP TABLE champ');
        $this->addSql('DROP TABLE champ_str2');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE code_nomenclature');
        $this->addSql('DROP TABLE compteur');
        $this->addSql('DROP TABLE esp_contrat');
        $this->addSql('DROP TABLE esp_enseignant');
        $this->addSql('DROP TABLE esp_entete_note');
        $this->addSql('DROP TABLE esp_etudiant');
        $this->addSql('DROP TABLE esp_inscription');
        $this->addSql('DROP TABLE esp_module');
        $this->addSql('DROP TABLE esp_note');
        $this->addSql('DROP TABLE esp_plan_etude');
        $this->addSql('DROP TABLE esp_saison_classe');
        $this->addSql('DROP TABLE esp_saison_universitaire');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE photos_etudiant');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE str_nome');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
