<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518133248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, code_agent VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, id_agent_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, nb_visites INT DEFAULT NULL, nb_favoris INT DEFAULT NULL, vendu TINYINT(1) DEFAULT \'0\', created_at DATETIME NOT NULL, INDEX IDX_F65593E564CF9D9E (id_agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, superficie DOUBLE PRECISION DEFAULT NULL, nb_pieces INT DEFAULT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, jardin TINYINT(1) DEFAULT NULL, cave TINYINT(1) DEFAULT NULL, ceillier TINYINT(1) DEFAULT NULL, loggia TINYINT(1) DEFAULT NULL, terrasse TINYINT(1) DEFAULT NULL, garage TINYINT(1) DEFAULT NULL, verranda TINYINT(1) DEFAULT NULL, prix_min DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(15) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contre_proposition (id INT AUTO_INCREMENT NOT NULL, id_vendeur_id INT DEFAULT NULL, id_proposition_achat_id INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_B0AAD32020068689 (id_vendeur_id), UNIQUE INDEX UNIQ_B0AAD320C27488F3 (id_proposition_achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris_client (favoris_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_FD2230E851E8871B (favoris_id), INDEX IDX_FD2230E819EB6921 (client_id), PRIMARY KEY(favoris_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris_annonce (favoris_id INT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_43BF3AE051E8871B (favoris_id), INDEX IDX_43BF3AE08805AB2F (annonce_id), PRIMARY KEY(favoris_id, annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, id_bien_id INT DEFAULT NULL, image LONGBLOB DEFAULT NULL, INDEX IDX_C53D045F6308117F (id_bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition_achat (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, id_annonce_id INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_98F9368699DED506 (id_client_id), INDEX IDX_98F936862D8F2BF8 (id_annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, carte_identite LONGBLOB NOT NULL, UNIQUE INDEX UNIQ_7AF4999699DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E564CF9D9E FOREIGN KEY (id_agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE contre_proposition ADD CONSTRAINT FK_B0AAD32020068689 FOREIGN KEY (id_vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('ALTER TABLE contre_proposition ADD CONSTRAINT FK_B0AAD320C27488F3 FOREIGN KEY (id_proposition_achat_id) REFERENCES proposition_achat (id)');
        $this->addSql('ALTER TABLE favoris_client ADD CONSTRAINT FK_FD2230E851E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris_client ADD CONSTRAINT FK_FD2230E819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris_annonce ADD CONSTRAINT FK_43BF3AE051E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris_annonce ADD CONSTRAINT FK_43BF3AE08805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6308117F FOREIGN KEY (id_bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE proposition_achat ADD CONSTRAINT FK_98F9368699DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE proposition_achat ADD CONSTRAINT FK_98F936862D8F2BF8 FOREIGN KEY (id_annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE vendeur ADD CONSTRAINT FK_7AF4999699DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE property');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E564CF9D9E');
        $this->addSql('ALTER TABLE favoris_annonce DROP FOREIGN KEY FK_43BF3AE08805AB2F');
        $this->addSql('ALTER TABLE proposition_achat DROP FOREIGN KEY FK_98F936862D8F2BF8');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F6308117F');
        $this->addSql('ALTER TABLE favoris_client DROP FOREIGN KEY FK_FD2230E819EB6921');
        $this->addSql('ALTER TABLE proposition_achat DROP FOREIGN KEY FK_98F9368699DED506');
        $this->addSql('ALTER TABLE vendeur DROP FOREIGN KEY FK_7AF4999699DED506');
        $this->addSql('ALTER TABLE favoris_client DROP FOREIGN KEY FK_FD2230E851E8871B');
        $this->addSql('ALTER TABLE favoris_annonce DROP FOREIGN KEY FK_43BF3AE051E8871B');
        $this->addSql('ALTER TABLE contre_proposition DROP FOREIGN KEY FK_B0AAD320C27488F3');
        $this->addSql('ALTER TABLE contre_proposition DROP FOREIGN KEY FK_B0AAD32020068689');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, surface INT NOT NULL, rooms INT NOT NULL, bedrooms INT NOT NULL, floor INT NOT NULL, price INT NOT NULL, heat INT NOT NULL, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sold TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contre_proposition');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE favoris_client');
        $this->addSql('DROP TABLE favoris_annonce');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE proposition_achat');
        $this->addSql('DROP TABLE vendeur');
    }
}
