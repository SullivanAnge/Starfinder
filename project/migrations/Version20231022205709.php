<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022205709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arme ADD type_id INT NOT NULL, CHANGE `port?ee` portee NUMERIC(10, 2) DEFAULT NULL, CHANGE `conso?mation` consomation INT DEFAULT NULL, CHANGE sspecial special VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_18207379C54C8C93 FOREIGN KEY (type_id) REFERENCES type_arme (id)');
        $this->addSql('CREATE INDEX IDX_18207379C54C8C93 ON arme (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_18207379C54C8C93');
        $this->addSql('DROP INDEX IDX_18207379C54C8C93 ON arme');
        $this->addSql('ALTER TABLE arme DROP type_id, CHANGE portee port?ee NUMERIC(10, 2) DEFAULT NULL, CHANGE consomation conso?mation INT DEFAULT NULL, CHANGE special sspecial VARCHAR(255) DEFAULT NULL');
    }
}
