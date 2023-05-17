<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517131406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE file_access_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE file_access (id INT NOT NULL, file_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BE7E0DEB93CB796C ON file_access (file_id)');
        $this->addSql('CREATE INDEX IDX_BE7E0DEBA76ED395 ON file_access (user_id)');
        $this->addSql('ALTER TABLE file_access ADD CONSTRAINT FK_BE7E0DEB93CB796C FOREIGN KEY (file_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file_access ADD CONSTRAINT FK_BE7E0DEBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE log_operation');
        $this->addSql('DROP INDEX idx_8f3f68c59cfda725');
        $this->addSql('ALTER TABLE log ADD log_operation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE log DROP log_operation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE file_access_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE log_operation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE log_operation (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE file_access DROP CONSTRAINT FK_BE7E0DEB93CB796C');
        $this->addSql('ALTER TABLE file_access DROP CONSTRAINT FK_BE7E0DEBA76ED395');
        $this->addSql('DROP TABLE file_access');
        $this->addSql('ALTER TABLE log ADD log_operation_id INT NOT NULL');
        $this->addSql('ALTER TABLE log DROP log_operation');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT fk_8f3f68c59cfda725 FOREIGN KEY (log_operation_id) REFERENCES log_operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8f3f68c59cfda725 ON log (log_operation_id)');
    }
}
