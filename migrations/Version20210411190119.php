<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411190119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abscence (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abscence_seance_cours (abscence_id INT NOT NULL, seance_cours_id INT NOT NULL, INDEX IDX_FCAE2F8B189F6FF7 (abscence_id), INDEX IDX_FCAE2F8B9274F8C8 (seance_cours_id), PRIMARY KEY(abscence_id, seance_cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abscence_seance_cours ADD CONSTRAINT FK_FCAE2F8B189F6FF7 FOREIGN KEY (abscence_id) REFERENCES abscence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abscence_seance_cours ADD CONSTRAINT FK_FCAE2F8B9274F8C8 FOREIGN KEY (seance_cours_id) REFERENCES seance_cours (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abscence_seance_cours DROP FOREIGN KEY FK_FCAE2F8B189F6FF7');
        $this->addSql('DROP TABLE abscence');
        $this->addSql('DROP TABLE abscence_seance_cours');
    }
}
