<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230917083645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe_college (id INT AUTO_INCREMENT NOT NULL, cycle_id INT NOT NULL, titre VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, INDEX IDX_D143E7635EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_primaire (id INT AUTO_INCREMENT NOT NULL, cycle_id INT NOT NULL, titre VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, INDEX IDX_225F44515EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle_college (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_college ADD CONSTRAINT FK_D143E7635EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle_college (id)');
        $this->addSql('ALTER TABLE classe_primaire ADD CONSTRAINT FK_225F44515EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_college DROP FOREIGN KEY FK_D143E7635EC1162');
        $this->addSql('ALTER TABLE classe_primaire DROP FOREIGN KEY FK_225F44515EC1162');
        $this->addSql('DROP TABLE classe_college');
        $this->addSql('DROP TABLE classe_primaire');
        $this->addSql('DROP TABLE cycle');
        $this->addSql('DROP TABLE cycle_college');
    }
}
