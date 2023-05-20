<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520173246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file ADD directory_id INT NOT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F36102C94069F FOREIGN KEY (directory_id) REFERENCES directory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8C9F36102C94069F ON file (directory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE file DROP CONSTRAINT FK_8C9F36102C94069F');
        $this->addSql('DROP INDEX IDX_8C9F36102C94069F');
        $this->addSql('ALTER TABLE file DROP directory_id');
    }
}
