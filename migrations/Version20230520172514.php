<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520172514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE directory_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE directory (id INT NOT NULL, user_id INT NOT NULL, parent_dir_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_467844DAA76ED395 ON directory (user_id)');
        $this->addSql('CREATE INDEX IDX_467844DAA1A04E20 ON directory (parent_dir_id)');
        $this->addSql('ALTER TABLE directory ADD CONSTRAINT FK_467844DAA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE directory ADD CONSTRAINT FK_467844DAA1A04E20 FOREIGN KEY (parent_dir_id) REFERENCES directory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE directory_id_seq CASCADE');
        $this->addSql('ALTER TABLE directory DROP CONSTRAINT FK_467844DAA76ED395');
        $this->addSql('ALTER TABLE directory DROP CONSTRAINT FK_467844DAA1A04E20');
        $this->addSql('DROP TABLE directory');
    }
}
