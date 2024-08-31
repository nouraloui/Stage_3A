<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831140203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_saison_classe DROP FOREIGN KEY FK_E084358FC22967BB');
        $this->addSql('DROP INDEX IDX_E084358FC22967BB ON esp_saison_classe');
        $this->addSql('ALTER TABLE esp_saison_classe ADD espSaisonUniversitaire VARCHAR(255) DEFAULT NULL, DROP esp_saison_universitaire_id');
        $this->addSql('ALTER TABLE esp_saison_classe ADD CONSTRAINT FK_E084358F9A05FBBE FOREIGN KEY (espSaisonUniversitaire) REFERENCES esp_saison_universitaire (annee_deb)');
        $this->addSql('CREATE INDEX IDX_E084358F9A05FBBE ON esp_saison_classe (espSaisonUniversitaire)');
        $this->addSql('ALTER TABLE esp_saison_universitaire MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON esp_saison_universitaire');
        $this->addSql('ALTER TABLE esp_saison_universitaire DROP id, CHANGE annee_deb annee_deb VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE esp_saison_universitaire ADD PRIMARY KEY (annee_deb)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_saison_classe DROP FOREIGN KEY FK_E084358F9A05FBBE');
        $this->addSql('DROP INDEX IDX_E084358F9A05FBBE ON esp_saison_classe');
        $this->addSql('ALTER TABLE esp_saison_classe ADD esp_saison_universitaire_id INT DEFAULT NULL, DROP espSaisonUniversitaire');
        $this->addSql('ALTER TABLE esp_saison_classe ADD CONSTRAINT FK_E084358FC22967BB FOREIGN KEY (esp_saison_universitaire_id) REFERENCES esp_saison_universitaire (id)');
        $this->addSql('CREATE INDEX IDX_E084358FC22967BB ON esp_saison_classe (esp_saison_universitaire_id)');
        $this->addSql('ALTER TABLE esp_saison_universitaire ADD id INT AUTO_INCREMENT NOT NULL, CHANGE annee_deb annee_deb VARCHAR(100) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
