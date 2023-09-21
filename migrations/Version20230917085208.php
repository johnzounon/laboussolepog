<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230917085208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD classe_primaire_id INT DEFAULT NULL, ADD classe_college_id INT DEFAULT NULL, DROP classe');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D664FE47F1 FOREIGN KEY (classe_primaire_id) REFERENCES classe_primaire (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D23AC599 FOREIGN KEY (classe_college_id) REFERENCES classe_college (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D664FE47F1 ON inscription (classe_primaire_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6D23AC599 ON inscription (classe_college_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D664FE47F1');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D23AC599');
        $this->addSql('DROP INDEX IDX_5E90F6D664FE47F1 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6D23AC599 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD classe VARCHAR(255) NOT NULL, DROP classe_primaire_id, DROP classe_college_id');
    }
}
