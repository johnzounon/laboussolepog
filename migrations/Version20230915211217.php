<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915211217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carnet (id INT AUTO_INCREMENT NOT NULL, annee_academique_id INT NOT NULL, groupe VARCHAR(255) NOT NULL, numero INT NOT NULL, carnet_encours TINYINT(1) NOT NULL, INDEX IDX_576D2650B00F076 (annee_academique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carnet ADD CONSTRAINT FK_576D2650B00F076 FOREIGN KEY (annee_academique_id) REFERENCES annee_academique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carnet DROP FOREIGN KEY FK_576D2650B00F076');
        $this->addSql('DROP TABLE carnet');
    }
}
