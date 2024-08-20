<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715193755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, code_cl VARCHAR(10) NOT NULL, libelle_cl VARCHAR(60) NOT NULL, description_cl VARCHAR(300) NOT NULL, date_cr DATE NOT NULL, date_dern_modif DATE NOT NULL, salle_principale VARCHAR(3) NOT NULL, salle_secondaire_1 VARCHAR(3) NOT NULL, salle_secondaire_2 VARCHAR(3) NOT NULL, niveau_accees INT NOT NULL, filiere VARCHAR(2) NOT NULL, annee_scolaire VARCHAR(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE esp_saison_classe ADD annee_deb VARCHAR(10) NOT NULL, ADD date_demarrage DATE NOT NULL, ADD description VARCHAR(300) NOT NULL, ADD nb_etudiant INT NOT NULL, ADD salle_principale VARCHAR(2) NOT NULL, ADD salle_secondaire_1 VARCHAR(3) NOT NULL, ADD salle_secondaire_2 VARCHAR(3) NOT NULL, ADD nature VARCHAR(1) NOT NULL, ADD type_classe VARCHAR(2) NOT NULL, ADD nb_seance INT NOT NULL, ADD classe_entreprise VARCHAR(1) NOT NULL, ADD semestre INT NOT NULL, ADD cl_eclate VARCHAR(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE classe');
        $this->addSql('ALTER TABLE esp_saison_classe DROP annee_deb, DROP date_demarrage, DROP description, DROP nb_etudiant, DROP salle_principale, DROP salle_secondaire_1, DROP salle_secondaire_2, DROP nature, DROP type_classe, DROP nb_seance, DROP classe_entreprise, DROP semestre, DROP cl_eclate');
    }
}
