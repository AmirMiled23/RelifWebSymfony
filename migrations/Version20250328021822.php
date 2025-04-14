<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250328021822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE secteur ADD sponsor VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD secteur_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D49F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_818CC9D49F7E4405 ON sponsor (secteur_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE secteur DROP sponsor
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D49F7E4405
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_818CC9D49F7E4405 ON sponsor
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP secteur_id
        SQL);
    }
}
