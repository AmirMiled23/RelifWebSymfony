<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429185440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D49F7E4405
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_818cc9d49f7e4405 ON sponsor
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_818CC9D49F7E4405 ON sponsor (secteur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D49F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D49F7E4405
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_818cc9d49f7e4405 ON sponsor
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX FK_818CC9D49F7E4405 ON sponsor (secteur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D49F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)
        SQL);
    }
}
