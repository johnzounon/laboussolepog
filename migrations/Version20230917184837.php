<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230917184837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scolarite_primaire (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, eleve_id INT NOT NULL, agent_id INT NOT NULL, carnet_id INT NOT NULL, montant_chiffre INT NOT NULL, montant_lettre VARCHAR(255) NOT NULL, tranche VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_3064E2A8F5EA509 (classe_id), INDEX IDX_3064E2AA6CC7B2 (eleve_id), INDEX IDX_3064E2A3414710B (agent_id), INDEX IDX_3064E2AFA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scolarite_primaire ADD CONSTRAINT FK_3064E2A8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe_primaire (id)');
        $this->addSql('ALTER TABLE scolarite_primaire ADD CONSTRAINT FK_3064E2AA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE scolarite_primaire ADD CONSTRAINT FK_3064E2A3414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE scolarite_primaire ADD CONSTRAINT FK_3064E2AFA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scolarite_primaire DROP FOREIGN KEY FK_3064E2A8F5EA509');
        $this->addSql('ALTER TABLE scolarite_primaire DROP FOREIGN KEY FK_3064E2AA6CC7B2');
        $this->addSql('ALTER TABLE scolarite_primaire DROP FOREIGN KEY FK_3064E2A3414710B');
        $this->addSql('ALTER TABLE scolarite_primaire DROP FOREIGN KEY FK_3064E2AFA207516');
        $this->addSql('DROP TABLE scolarite_primaire');
    }
}
