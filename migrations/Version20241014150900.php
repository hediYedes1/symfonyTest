<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014150900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vol ADD aerop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBF5AECE6 FOREIGN KEY (aerop_id) REFERENCES aeroport (id)');
        $this->addSql('CREATE INDEX IDX_95C97EBF5AECE6 ON vol (aerop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBF5AECE6');
        $this->addSql('DROP INDEX IDX_95C97EBF5AECE6 ON vol');
        $this->addSql('ALTER TABLE vol DROP aerop_id');
    }
}
