<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921053415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arrieres_college ADD carnet_id INT NOT NULL');
        $this->addSql('ALTER TABLE arrieres_college ADD CONSTRAINT FK_4C0E238FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
        $this->addSql('CREATE INDEX IDX_4C0E238FA207516 ON arrieres_college (carnet_id)');
        $this->addSql('ALTER TABLE arrieres_primaire ADD carnet_id INT NOT NULL');
        $this->addSql('ALTER TABLE arrieres_primaire ADD CONSTRAINT FK_DE334F28FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
        $this->addSql('CREATE INDEX IDX_DE334F28FA207516 ON arrieres_primaire (carnet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arrieres_college DROP FOREIGN KEY FK_4C0E238FA207516');
        $this->addSql('DROP INDEX IDX_4C0E238FA207516 ON arrieres_college');
        $this->addSql('ALTER TABLE arrieres_college DROP carnet_id');
        $this->addSql('ALTER TABLE arrieres_primaire DROP FOREIGN KEY FK_DE334F28FA207516');
        $this->addSql('DROP INDEX IDX_DE334F28FA207516 ON arrieres_primaire');
        $this->addSql('ALTER TABLE arrieres_primaire DROP carnet_id');
    }
}
