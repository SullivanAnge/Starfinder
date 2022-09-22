<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726194908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, race_id INT NOT NULL, themes_id INT NOT NULL, nom VARCHAR(255) NOT NULL, carac_for INT NOT NULL, carac_dex INT NOT NULL, carac_con INT NOT NULL, carac_int INT NOT NULL, carac_sag INT NOT NULL, mod_force INT NOT NULL, mod_dex INT NOT NULL, mod_con INT NOT NULL, mod_int INT NOT NULL, mod_sag INT NOT NULL, mod_cha INT NOT NULL, pe INT NOT NULL, pv INT NOT NULL, pp INT NOT NULL, cae INT NOT NULL, cac INT NOT NULL, vigueur INT NOT NULL, reflexe INT NOT NULL, volonte INT NOT NULL, att_cac INT NOT NULL, att_dist INT NOT NULL, att_lancer INT NOT NULL, INDEX IDX_6AEA486D8F5EA509 (classe_id), INDEX IDX_6AEA486D6E59D40D (race_id), INDEX IDX_6AEA486D94F4A9D2 (themes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_competence (personnage_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_F81B36A5E315342 (personnage_id), INDEX IDX_F81B36A15761DAB (competence_id), PRIMARY KEY(personnage_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D94F4A9D2 FOREIGN KEY (themes_id) REFERENCES themes (id)');
        $this->addSql('ALTER TABLE personnage_competence ADD CONSTRAINT FK_F81B36A5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_competence ADD CONSTRAINT FK_F81B36A15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage_competence DROP FOREIGN KEY FK_F81B36A5E315342');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE personnage_competence');
    }
}
