<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204135133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F7B3406DF');
        $this->addSql('CREATE TABLE team_match_result (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, INDEX IDX_BA8335D033D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_match_result ADD CONSTRAINT FK_BA8335D033D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE pool DROP FOREIGN KEY FK_AF91A98633D1A3E7');
        $this->addSql('DROP TABLE pool');
        $this->addSql('DROP INDEX IDX_C4E0A61F7B3406DF ON team');
        $this->addSql('ALTER TABLE team CHANGE pool_id team_match_result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F3D48E096 FOREIGN KEY (team_match_result_id) REFERENCES team_match_result (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F3D48E096 ON team (team_match_result_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F3D48E096');
        $this->addSql('CREATE TABLE pool (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, INDEX IDX_AF91A98633D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pool ADD CONSTRAINT FK_AF91A98633D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE team_match_result DROP FOREIGN KEY FK_BA8335D033D1A3E7');
        $this->addSql('DROP TABLE team_match_result');
        $this->addSql('DROP INDEX IDX_C4E0A61F3D48E096 ON team');
        $this->addSql('ALTER TABLE team CHANGE team_match_result_id pool_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F7B3406DF FOREIGN KEY (pool_id) REFERENCES pool (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F7B3406DF ON team (pool_id)');
    }
}
