<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211103111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP CONSTRAINT fk_c4e0a61f3d48e096');
        $this->addSql('DROP INDEX idx_c4e0a61f3d48e096');
        $this->addSql('ALTER TABLE team ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE team RENAME COLUMN team_match_result_id TO tournament_id');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C4E0A61F33D1A3E7 ON team (tournament_id)');
        $this->addSql('ALTER TABLE team_match_result ADD visitor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD home_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD winner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD visitor_score INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD home_score INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD phase VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D070BEE6D FOREIGN KEY (visitor_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D028CDC89C FOREIGN KEY (home_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D05DFCD4B8 FOREIGN KEY (winner_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BA8335D070BEE6D ON team_match_result (visitor_id)');
        $this->addSql('CREATE INDEX IDX_BA8335D028CDC89C ON team_match_result (home_id)');
        $this->addSql('CREATE INDEX IDX_BA8335D05DFCD4B8 ON team_match_result (winner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61F33D1A3E7');
        $this->addSql('DROP INDEX IDX_C4E0A61F33D1A3E7');
        $this->addSql('ALTER TABLE team DROP name');
        $this->addSql('ALTER TABLE team RENAME COLUMN tournament_id TO team_match_result_id');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT fk_c4e0a61f3d48e096 FOREIGN KEY (team_match_result_id) REFERENCES team_match_result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c4e0a61f3d48e096 ON team (team_match_result_id)');
        $this->addSql('ALTER TABLE team_match_result DROP CONSTRAINT FK_BA8335D070BEE6D');
        $this->addSql('ALTER TABLE team_match_result DROP CONSTRAINT FK_BA8335D028CDC89C');
        $this->addSql('ALTER TABLE team_match_result DROP CONSTRAINT FK_BA8335D05DFCD4B8');
        $this->addSql('DROP INDEX IDX_BA8335D070BEE6D');
        $this->addSql('DROP INDEX IDX_BA8335D028CDC89C');
        $this->addSql('DROP INDEX IDX_BA8335D05DFCD4B8');
        $this->addSql('ALTER TABLE team_match_result DROP visitor_id');
        $this->addSql('ALTER TABLE team_match_result DROP home_id');
        $this->addSql('ALTER TABLE team_match_result DROP winner_id');
        $this->addSql('ALTER TABLE team_match_result DROP visitor_score');
        $this->addSql('ALTER TABLE team_match_result DROP home_score');
        $this->addSql('ALTER TABLE team_match_result DROP phase');
    }
}
