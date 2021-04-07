<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113231643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE referentiel_competence (referentiel_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_2377878B805DB139 (referentiel_id), INDEX IDX_2377878B15761DAB (competence_id), PRIMARY KEY(referentiel_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE referentiel_competence ADD CONSTRAINT FK_2377878B805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referentiel_competence ADD CONSTRAINT FK_2377878B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE referentiel_groupecompetence');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE referentiel_groupecompetence (referentiel_id INT NOT NULL, groupecompetence_id INT NOT NULL, INDEX IDX_32944F2A337E4DC6 (groupecompetence_id), INDEX IDX_32944F2A805DB139 (referentiel_id), PRIMARY KEY(referentiel_id, groupecompetence_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE referentiel_groupecompetence ADD CONSTRAINT FK_32944F2A337E4DC6 FOREIGN KEY (groupecompetence_id) REFERENCES groupecompetence (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referentiel_groupecompetence ADD CONSTRAINT FK_32944F2A805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE referentiel_competence');
    }
}
