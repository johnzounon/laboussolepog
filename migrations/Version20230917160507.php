<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230917160507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scolarite_college (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, carnet_id INT NOT NULL, agent_id INT NOT NULL, montant_chiffre INT NOT NULL, montant_lettre VARCHAR(255) NOT NULL, tranche VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_3CBD2957A6CC7B2 (eleve_id), INDEX IDX_3CBD2957FA207516 (carnet_id), INDEX IDX_3CBD29573414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scolarite_college ADD CONSTRAINT FK_3CBD2957A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE scolarite_college ADD CONSTRAINT FK_3CBD2957FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
        $this->addSql('ALTER TABLE scolarite_college ADD CONSTRAINT FK_3CBD29573414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scolarite_college DROP FOREIGN KEY FK_3CBD2957A6CC7B2');
        $this->addSql('ALTER TABLE scolarite_college DROP FOREIGN KEY FK_3CBD2957FA207516');
        $this->addSql('ALTER TABLE scolarite_college DROP FOREIGN KEY FK_3CBD29573414710B');
        $this->addSql('DROP TABLE scolarite_college');
    }
}
