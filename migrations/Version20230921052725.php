<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921052725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arrieres_primaire (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, eleve_id INT NOT NULL, agent_id INT NOT NULL, montant_chiffre INT NOT NULL, montant_lettre VARCHAR(255) NOT NULL, tranche VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_DE334F288F5EA509 (classe_id), INDEX IDX_DE334F28A6CC7B2 (eleve_id), INDEX IDX_DE334F283414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arrieres_primaire ADD CONSTRAINT FK_DE334F288F5EA509 FOREIGN KEY (classe_id) REFERENCES classe_primaire (id)');
        $this->addSql('ALTER TABLE arrieres_primaire ADD CONSTRAINT FK_DE334F28A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES arrieres_anterieure (id)');
        $this->addSql('ALTER TABLE arrieres_primaire ADD CONSTRAINT FK_DE334F283414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arrieres_primaire DROP FOREIGN KEY FK_DE334F288F5EA509');
        $this->addSql('ALTER TABLE arrieres_primaire DROP FOREIGN KEY FK_DE334F28A6CC7B2');
        $this->addSql('ALTER TABLE arrieres_primaire DROP FOREIGN KEY FK_DE334F283414710B');
        $this->addSql('DROP TABLE arrieres_primaire');
    }
}
