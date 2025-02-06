<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204154710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F3D48E096');
        $this->addSql('DROP INDEX IDX_C4E0A61F3D48E096 ON team');
        $this->addSql('ALTER TABLE team ADD name VARCHAR(255) NOT NULL, CHANGE team_match_result_id tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F33D1A3E7 ON team (tournament_id)');
        $this->addSql('ALTER TABLE team_match_result ADD visitor_id INT DEFAULT NULL, ADD home_id INT DEFAULT NULL, ADD winner_id INT DEFAULT NULL, ADD visitor_score INT NOT NULL, ADD home_score INT NOT NULL, ADD phase VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D070BEE6D FOREIGN KEY (visitor_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D028CDC89C FOREIGN KEY (home_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D05DFCD4B8 FOREIGN KEY (winner_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_BA8335D070BEE6D ON team_match_result (visitor_id)');
        $this->addSql('CREATE INDEX IDX_BA8335D028CDC89C ON team_match_result (home_id)');
        $this->addSql('CREATE INDEX IDX_BA8335D05DFCD4B8 ON team_match_result (winner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F33D1A3E7');
        $this->addSql('DROP INDEX IDX_C4E0A61F33D1A3E7 ON team');
        $this->addSql('ALTER TABLE team DROP name, CHANGE tournament_id team_match_result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F3D48E096 FOREIGN KEY (team_match_result_id) REFERENCES team_match_result (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F3D48E096 ON team (team_match_result_id)');
        $this->addSql('ALTER TABLE team_match_result DROP FOREIGN KEY FK_BA8335D070BEE6D');
        $this->addSql('ALTER TABLE team_match_result DROP FOREIGN KEY FK_BA8335D028CDC89C');
        $this->addSql('ALTER TABLE team_match_result DROP FOREIGN KEY FK_BA8335D05DFCD4B8');
        $this->addSql('DROP INDEX IDX_BA8335D070BEE6D ON team_match_result');
        $this->addSql('DROP INDEX IDX_BA8335D028CDC89C ON team_match_result');
        $this->addSql('DROP INDEX IDX_BA8335D05DFCD4B8 ON team_match_result');
        $this->addSql('ALTER TABLE team_match_result DROP visitor_id, DROP home_id, DROP winner_id, DROP visitor_score, DROP home_score, DROP phase');
    }
}
