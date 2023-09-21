<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915235049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, agent_id INT NOT NULL, carnet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, classe VARCHAR(255) NOT NULL, montant_chiffre INT NOT NULL, montant_lettre VARCHAR(255) NOT NULL, tuteur VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_5E90F6D63414710B (agent_id), INDEX IDX_5E90F6D6FA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D63414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D63414710B');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FA207516');
        $this->addSql('DROP TABLE inscription');
    }
}
