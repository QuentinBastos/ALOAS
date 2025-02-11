<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250209193413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['sport'])) {
            $this->addSql('CREATE TABLE sport (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        }

        if (!$schemaManager->tablesExist(['team'])) {
            $this->addSql('CREATE TABLE team (id SERIAL NOT NULL, team_match_result_id INT DEFAULT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE INDEX IDX_C4E0A61F3D48E096 ON team (team_match_result_id)');
        }

        if (!$schemaManager->tablesExist(['team_match_result'])) {
            $this->addSql('CREATE TABLE team_match_result (id SERIAL NOT NULL, tournament_id INT DEFAULT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE INDEX IDX_BA8335D033D1A3E7 ON team_match_result (tournament_id)');
        }

        if (!$schemaManager->tablesExist(['tournament'])) {
            $this->addSql('CREATE TABLE tournament (id SERIAL NOT NULL, sport_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE INDEX IDX_BD5FB8D9AC78BCF8 ON tournament (sport_id)');
        }

        if (!$schemaManager->tablesExist(['users'])) {
            $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON users (username)');
        }

        if (!$schemaManager->tablesExist(['messenger_messages'])) {
            $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
            $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
            $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
            $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
            $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
            $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');

            $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;');
            $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
            $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        }

        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F3D48E096 FOREIGN KEY (team_match_result_id) REFERENCES team_match_result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D033D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61F3D48E096');
        $this->addSql('ALTER TABLE team_match_result DROP CONSTRAINT FK_BA8335D033D1A3E7');
        $this->addSql('ALTER TABLE tournament DROP CONSTRAINT FK_BD5FB8D9AC78BCF8');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_match_result');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}