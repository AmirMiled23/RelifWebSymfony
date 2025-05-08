<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418093704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX id_materiel ON avis
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis CHANGE commentaire commentaire LONGTEXT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel CHANGE description description VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_75EA56E016BA31DB ON messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messenger_messages CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE queue_name queue_name VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_materiel_reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_materiel_reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel CHANGE id_materiel id_materiel INT DEFAULT NULL, CHANGE date_debut date_debut DATE DEFAULT CURRENT_DATE NOT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_8567528548095C04 FOREIGN KEY (id_materiel) REFERENCES materiel (id_materiel)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_materiel_reservation ON reservation_materiel
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8567528548095C04 ON reservation_materiel (id_materiel)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_materiel_reservation FOREIGN KEY (id_materiel) REFERENCES materiel (id_materiel) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);

        // Supprimez ou commentez la ligne suivante si l'index n'existe pas
        // $this->addSql('DROP INDEX id_materiel ON materiel');

        // Assurez-vous que les autres commandes sont correctes
        $this->addSql('ALTER TABLE materiel MODIFY id_materiel INT AUTO_INCREMENT PRIMARY KEY');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE avis CHANGE commentaire commentaire TEXT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_materiel ON avis (id_materiel)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel CHANGE description description VARCHAR(550) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE queue_name queue_name VARCHAR(190) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', CHANGE available_at available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_8567528548095C04
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel DROP FOREIGN KEY FK_8567528548095C04
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel CHANGE id_materiel id_materiel INT NOT NULL, CHANGE date_debut date_debut DATE NOT NULL, CHANGE date_fin date_fin DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_materiel_reservation FOREIGN KEY (id_materiel) REFERENCES materiel (id_materiel) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_8567528548095c04 ON reservation_materiel
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX FK_materiel_reservation ON reservation_materiel (id_materiel)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_materiel ADD CONSTRAINT FK_8567528548095C04 FOREIGN KEY (id_materiel) REFERENCES materiel (id_materiel)
        SQL);
    }
}
