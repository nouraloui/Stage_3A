<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831130302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_etudiant DROP id');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2BF396750');
        $this->addSql('DROP INDEX IDX_F16890D2BF396750 ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription ADD etudiant VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2717E22E3 FOREIGN KEY (etudiant) REFERENCES esp_etudiant (id_et)');
        $this->addSql('CREATE INDEX IDX_F16890D2717E22E3 ON esp_inscription (etudiant)');
        $this->addSql('DROP INDEX UNIQ_721D2FC42865F9 ON photos_etudiant');
        $this->addSql('ALTER TABLE photos_etudiant ADD id_et VARCHAR(10) DEFAULT NULL, DROP id_et_id');
        $this->addSql('ALTER TABLE photos_etudiant ADD CONSTRAINT FK_721D2FCCE46C13F FOREIGN KEY (id_et) REFERENCES esp_etudiant (id_et)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_721D2FCCE46C13F ON photos_etudiant (id_et)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_etudiant ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D2717E22E3');
        $this->addSql('DROP INDEX IDX_F16890D2717E22E3 ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription DROP etudiant');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D2BF396750 FOREIGN KEY (id) REFERENCES esp_etudiant (id_et)');
        $this->addSql('CREATE INDEX IDX_F16890D2BF396750 ON esp_inscription (id)');
        $this->addSql('ALTER TABLE photos_etudiant DROP FOREIGN KEY FK_721D2FCCE46C13F');
        $this->addSql('DROP INDEX UNIQ_721D2FCCE46C13F ON photos_etudiant');
        $this->addSql('ALTER TABLE photos_etudiant ADD id_et_id INT NOT NULL, DROP id_et');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_721D2FC42865F9 ON photos_etudiant (id_et_id)');
    }
}
