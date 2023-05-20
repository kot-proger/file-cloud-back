<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519153600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE access_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE access_token (id INT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6A2DD68A76ED395 ON access_token (user_id)');
        $this->addSql('COMMENT ON COLUMN access_token.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN access_token.valid IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD68A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file ALTER upload_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN file.upload_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE log ALTER date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN log.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE notification ALTER date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN notification.date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE access_token_id_seq CASCADE');
        $this->addSql('ALTER TABLE access_token DROP CONSTRAINT FK_B6A2DD68A76ED395');
        $this->addSql('DROP TABLE access_token');
        $this->addSql('ALTER TABLE log ALTER date TYPE DATE');
        $this->addSql('COMMENT ON COLUMN log.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE file ALTER upload_date TYPE DATE');
        $this->addSql('COMMENT ON COLUMN file.upload_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE notification ALTER date TYPE DATE');
        $this->addSql('COMMENT ON COLUMN notification.date IS \'(DC2Type:date_immutable)\'');
    }
}
