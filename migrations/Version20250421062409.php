<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421062409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel MODIFY id_materiel INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON materiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel CHANGE id_materiel id INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX FK_materiel_reservation ON reservation_materiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD materiel_id INT DEFAULT NULL, DROP id_materiel, CHANGE date_debut date_debut DATE DEFAULT CURRENT_DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_8567528516880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8567528516880AAF ON reservation_materiel (materiel_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON materiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel CHANGE id id_materiel INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel ADD PRIMARY KEY (id_materiel)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_8567528516880AAF
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8567528516880AAF ON reservation_materiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD id_materiel INT NOT NULL, DROP materiel_id, CHANGE date_debut date_debut DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX FK_materiel_reservation ON reservation_materiel (id_materiel)
        SQL);
    }
}
