<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330185903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seance_cours (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, enseignant VARCHAR(255) NOT NULL, startdate_at DATETIME NOT NULL, enddate_at DATETIME NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance_cours_candidat (seance_cours_id INT NOT NULL, candidat_id INT NOT NULL, INDEX IDX_913DC5CD9274F8C8 (seance_cours_id), INDEX IDX_913DC5CD8D0EB82 (candidat_id), PRIMARY KEY(seance_cours_id, candidat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seance_cours_candidat ADD CONSTRAINT FK_913DC5CD9274F8C8 FOREIGN KEY (seance_cours_id) REFERENCES seance_cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance_cours_candidat ADD CONSTRAINT FK_913DC5CD8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance_cours_candidat DROP FOREIGN KEY FK_913DC5CD9274F8C8');
        $this->addSql('DROP TABLE seance_cours');
        $this->addSql('DROP TABLE seance_cours_candidat');
    }
}
