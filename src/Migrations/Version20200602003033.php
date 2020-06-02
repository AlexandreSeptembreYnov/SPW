<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602003033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce ADD sales_at DATETIME DEFAULT NULL, CHANGE nb_visites nb_visites INT DEFAULT NULL, CHANGE nb_favoris nb_favoris INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien ADD address VARCHAR(1000) NOT NULL, CHANGE superficie superficie DOUBLE PRECISION DEFAULT NULL, CHANGE nb_pieces nb_pieces INT DEFAULT NULL, CHANGE jardin jardin TINYINT(1) DEFAULT NULL, CHANGE cave cave TINYINT(1) DEFAULT NULL, CHANGE ceillier ceillier TINYINT(1) DEFAULT NULL, CHANGE loggia loggia TINYINT(1) DEFAULT NULL, CHANGE terrasse terrasse TINYINT(1) DEFAULT NULL, CHANGE garage garage TINYINT(1) DEFAULT NULL, CHANGE verranda verranda TINYINT(1) DEFAULT NULL, CHANGE prix_min prix_min DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE contre_proposition CHANGE id_vendeur_id id_vendeur_id INT DEFAULT NULL, CHANGE id_proposition_achat_id id_proposition_achat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE id_bien_id id_bien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proposition_achat CHANGE id_client_id id_client_id INT DEFAULT NULL, CHANGE id_annonce_id id_annonce_id INT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE vendeur CHANGE id_client_id id_client_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce DROP sales_at, CHANGE nb_visites nb_visites INT DEFAULT NULL, CHANGE nb_favoris nb_favoris INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien DROP address, CHANGE superficie superficie DOUBLE PRECISION DEFAULT \'NULL\', CHANGE nb_pieces nb_pieces INT DEFAULT NULL, CHANGE jardin jardin TINYINT(1) DEFAULT \'NULL\', CHANGE cave cave TINYINT(1) DEFAULT \'NULL\', CHANGE ceillier ceillier TINYINT(1) DEFAULT \'NULL\', CHANGE loggia loggia TINYINT(1) DEFAULT \'NULL\', CHANGE terrasse terrasse TINYINT(1) DEFAULT \'NULL\', CHANGE garage garage TINYINT(1) DEFAULT \'NULL\', CHANGE verranda verranda TINYINT(1) DEFAULT \'NULL\', CHANGE prix_min prix_min DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE contre_proposition CHANGE id_vendeur_id id_vendeur_id INT DEFAULT NULL, CHANGE id_proposition_achat_id id_proposition_achat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE id_bien_id id_bien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proposition_achat CHANGE id_client_id id_client_id INT DEFAULT NULL, CHANGE id_annonce_id id_annonce_id INT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE vendeur CHANGE id_client_id id_client_id INT DEFAULT NULL');
    }
}
