<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424191436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD token VARCHAR(255) DEFAULT NULL, CHANGE email_user email_user VARCHAR(180) NOT NULL, CHANGE num_user num_user VARCHAR(8) NOT NULL, CHANGE roles roles JSON NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil CHANGE preferance preferance LONGTEXT NOT NULL, CHANGE id_user id_user INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil ADD CONSTRAINT FK_8E2CA5536B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_user_profile ON userprofil
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8E2CA5536B3CA4B ON userprofil (id_user)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP token, CHANGE email_user email_user VARCHAR(255) NOT NULL, CHANGE num_user num_user INT NOT NULL, CHANGE roles roles JSON DEFAULT '[]' NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil DROP FOREIGN KEY FK_8E2CA5536B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil DROP FOREIGN KEY FK_8E2CA5536B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil CHANGE preferance preferance TEXT NOT NULL, CHANGE id_user id_user INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_8e2ca5536b3ca4b ON userprofil
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_user_profile ON userprofil (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil ADD CONSTRAINT FK_8E2CA5536B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)
        SQL);
    }
}
