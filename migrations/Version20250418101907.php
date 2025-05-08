<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418101907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis CHANGE commentaire commentaire LONGTEXT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss DROP FOREIGN KEY aviss_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss DROP FOREIGN KEY aviss_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE id_event id_event INT DEFAULT NULL, CHANGE commentaire commentaire LONGTEXT NOT NULL, CHANGE date_creation date_creation DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_user ON aviss
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A63CACBCFB88E14F ON aviss (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_event ON aviss
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A63CACBCD52B4B97 ON aviss (id_event)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss ADD CONSTRAINT aviss_ibfk_1 FOREIGN KEY (utilisateur_id) REFERENCES user (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss ADD CONSTRAINT aviss_ibfk_2 FOREIGN KEY (id_event) REFERENCES event (id_event)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY cart_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY cart_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart CHANGE product_id product_id INT DEFAULT NULL, CHANGE total_price total_price NUMERIC(10, 0) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES produit (id_equip)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX product_id ON cart
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BA388B74584665A ON cart (product_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT cart_ibfk_1 FOREIGN KEY (product_id) REFERENCES produit (id_equip) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categorie_event CHANGE nom_categorie nom_categorie VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conference ADD resource_id INT NOT NULL, DROP resource, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE presenteur presenteur VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE theme theme VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conference ADD CONSTRAINT FK_911533C889329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_911533C889329D25 ON conference (resource_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event DROP FOREIGN KEY event_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event DROP FOREIGN KEY event_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event CHANGE id_categorie id_categorie INT DEFAULT NULL, CHANGE nom_event nom_event VARCHAR(255) NOT NULL, CHANGE adresse_event adresse_event VARCHAR(255) NOT NULL, CHANGE description_event description_event VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7C9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie_event (id_categorie)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_categorie ON event
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3BAE0AA7C9486A13 ON event (id_categorie)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event ADD CONSTRAINT event_ibfk_1 FOREIGN KEY (id_categorie) REFERENCES categorie_event (id_categorie) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY inscription_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription CHANGE conference_id conference_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL, CHANGE date_inscription date_inscription DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX conference_id ON inscription
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5E90F6D6604B8382 ON inscription (conference_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT inscription_ibfk_1 FOREIGN KEY (conference_id) REFERENCES conference (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel CHANGE description description VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment CHANGE purchase_date purchase_date DATETIME NOT NULL, CHANGE total_amount total_amount NUMERIC(10, 0) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit CHANGE prix prix NUMERIC(10, 0) NOT NULL, CHANGE category category VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation CHANGE type type VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse DROP FOREIGN KEY reponse_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse CHANGE description description LONGTEXT NOT NULL, CHANGE idReclamation idReclamation INT DEFAULT NULL, CHANGE date_reponse date_reponse DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC78E3D9B7C FOREIGN KEY (idReclamation) REFERENCES reclamation (id_reclamation)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_reclamation ON reponse
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5FB6DEC78E3D9B7C ON reponse (idReclamation)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_1 FOREIGN KEY (idReclamation) REFERENCES reclamation (id_reclamation) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE resource CHANGE type type VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY sponsor_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX email ON sponsor
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY sponsor_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor CHANGE telephone telephone VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D49F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX secteur_id ON sponsor
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_818CC9D49F7E4405 ON sponsor (secteur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT sponsor_ibfk_1 FOREIGN KEY (secteur_id) REFERENCES secteur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE date_inscri date_inscri DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil DROP FOREIGN KEY userprofil_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil CHANGE id_user id_user INT DEFAULT NULL, CHANGE preferance preferance LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_user ON userprofil
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8E2CA5536B3CA4B ON userprofil (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil ADD CONSTRAINT userprofil_ibfk_1 FOREIGN KEY (id_user) REFERENCES user (id_user)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis CHANGE commentaire commentaire TEXT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss DROP FOREIGN KEY FK_A63CACBCFB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss DROP FOREIGN KEY FK_A63CACBCD52B4B97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss CHANGE utilisateur_id utilisateur_id INT NOT NULL, CHANGE id_event id_event INT NOT NULL, CHANGE commentaire commentaire TEXT NOT NULL, CHANGE date_creation date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_a63cacbcfb88e14f ON aviss
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_user ON aviss (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_a63cacbcd52b4b97 ON aviss
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_event ON aviss (id_event)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss ADD CONSTRAINT FK_A63CACBCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aviss ADD CONSTRAINT FK_A63CACBCD52B4B97 FOREIGN KEY (id_event) REFERENCES event (id_event)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart CHANGE product_id product_id INT NOT NULL, CHANGE total_price total_price NUMERIC(10, 2) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT cart_ibfk_1 FOREIGN KEY (product_id) REFERENCES produit (id_equip) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_ba388b74584665a ON cart
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX product_id ON cart (product_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES produit (id_equip)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categorie_event CHANGE nom_categorie nom_categorie VARCHAR(30) NOT NULL, CHANGE description description VARCHAR(50) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conference DROP FOREIGN KEY FK_911533C889329D25
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_911533C889329D25 ON conference
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conference ADD resource VARCHAR(100) NOT NULL, DROP resource_id, CHANGE titre titre VARCHAR(100) NOT NULL, CHANGE presenteur presenteur VARCHAR(100) NOT NULL, CHANGE lieu lieu VARCHAR(100) NOT NULL, CHANGE theme theme VARCHAR(100) NOT NULL, CHANGE status status VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7C9486A13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7C9486A13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event CHANGE id_categorie id_categorie INT NOT NULL, CHANGE nom_event nom_event VARCHAR(30) NOT NULL, CHANGE adresse_event adresse_event VARCHAR(40) NOT NULL, CHANGE description_event description_event VARCHAR(50) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event ADD CONSTRAINT event_ibfk_1 FOREIGN KEY (id_categorie) REFERENCES categorie_event (id_categorie) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_3bae0aa7c9486a13 ON event
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_categorie ON event (id_categorie)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7C9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie_event (id_categorie)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6604B8382
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription CHANGE conference_id conference_id INT NOT NULL, CHANGE nom nom VARCHAR(100) DEFAULT NULL, CHANGE prenom prenom VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE telephone telephone VARCHAR(20) DEFAULT NULL, CHANGE date_inscription date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_5e90f6d6604b8382 ON inscription
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX conference_id ON inscription (conference_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE materiel CHANGE description description VARCHAR(550) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment CHANGE purchase_date purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE total_amount total_amount NUMERIC(10, 2) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit CHANGE prix prix NUMERIC(10, 2) NOT NULL, CHANGE category category VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation CHANGE type type VARCHAR(100) NOT NULL, CHANGE status status VARCHAR(50) NOT NULL, CHANGE description description TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC78E3D9B7C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC78E3D9B7C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse CHANGE description description TEXT NOT NULL, CHANGE date_reponse date_reponse DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE idReclamation idReclamation INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse ADD CONSTRAINT reponse_ibfk_1 FOREIGN KEY (idReclamation) REFERENCES reclamation (id_reclamation) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_5fb6dec78e3d9b7c ON reponse
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_reclamation ON reponse (idReclamation)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC78E3D9B7C FOREIGN KEY (idReclamation) REFERENCES reclamation (id_reclamation)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE resource CHANGE type type VARCHAR(50) NOT NULL, CHANGE description description TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D49F7E4405
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D49F7E4405
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor CHANGE telephone telephone VARCHAR(20) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT sponsor_ibfk_1 FOREIGN KEY (secteur_id) REFERENCES secteur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX email ON sponsor (email)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_818cc9d49f7e4405 ON sponsor
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX secteur_id ON sponsor (secteur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D49F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE date_inscri date_inscri DATE DEFAULT 'CURRENT_TIMESTAMP' NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil DROP FOREIGN KEY FK_8E2CA5536B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil CHANGE id_user id_user INT NOT NULL, CHANGE preferance preferance TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_8e2ca5536b3ca4b ON userprofil
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_user ON userprofil (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE userprofil ADD CONSTRAINT FK_8E2CA5536B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)
        SQL);
    }
}
