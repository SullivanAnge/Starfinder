<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726205912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perso_competence ADD personnage_id INT DEFAULT NULL, ADD competence_id INT NOT NULL');
        $this->addSql('ALTER TABLE perso_competence ADD CONSTRAINT FK_8885BE145E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE perso_competence ADD CONSTRAINT FK_8885BE1415761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_8885BE145E315342 ON perso_competence (personnage_id)');
        $this->addSql('CREATE INDEX IDX_8885BE1415761DAB ON perso_competence (competence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perso_competence DROP FOREIGN KEY FK_8885BE145E315342');
        $this->addSql('ALTER TABLE perso_competence DROP FOREIGN KEY FK_8885BE1415761DAB');
        $this->addSql('DROP INDEX IDX_8885BE145E315342 ON perso_competence');
        $this->addSql('DROP INDEX IDX_8885BE1415761DAB ON perso_competence');
        $this->addSql('ALTER TABLE perso_competence DROP personnage_id, DROP competence_id');
    }
}
