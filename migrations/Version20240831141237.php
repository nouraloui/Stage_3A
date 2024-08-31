<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831141237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_inscription ADD code_cl_id INT NOT NULL, DROP code_cl');
        $this->addSql('ALTER TABLE esp_inscription ADD CONSTRAINT FK_F16890D21C15B755 FOREIGN KEY (code_cl_id) REFERENCES compteur (id)');
        $this->addSql('CREATE INDEX IDX_F16890D21C15B755 ON esp_inscription (code_cl_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esp_inscription DROP FOREIGN KEY FK_F16890D21C15B755');
        $this->addSql('DROP INDEX IDX_F16890D21C15B755 ON esp_inscription');
        $this->addSql('ALTER TABLE esp_inscription ADD code_cl VARCHAR(10) NOT NULL, DROP code_cl_id');
    }
}
