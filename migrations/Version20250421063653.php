<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421063653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel CHANGE date_debut date_debut DATE DEFAULT CURRENT_DATE NOT NULL, CHANGE id_materiel id_materiel INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_8567528548095C04 FOREIGN KEY (id_materiel) REFERENCES materiel (id_materiel) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_materiel_reservation ON reservation_materiel
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8567528548095C04 ON reservation_materiel (id_materiel)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_8567528548095C04
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_8567528548095C04
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel CHANGE id_materiel id_materiel INT NOT NULL, CHANGE date_debut date_debut DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_8567528548095c04 ON reservation_materiel
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX FK_materiel_reservation ON reservation_materiel (id_materiel)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_8567528548095C04 FOREIGN KEY (id_materiel) REFERENCES materiel (id_materiel) ON DELETE SET NULL
        SQL);
    }
}
