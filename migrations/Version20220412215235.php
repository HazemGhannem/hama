<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412215235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('ALTER TABLE avis ADD id INT AUTO_INCREMENT NOT NULL, ADD id_avis INT NOT NULL, DROP idAvis, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE rating rating INT NOT NULL, CHANGE iduser iduser VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reclamation (idReclamation INT DEFAULT NULL, dateReclamation VARCHAR(11) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, descriptionReclamation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, imageReclamation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, iduser INT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE avis MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE avis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE avis ADD idAvis INT DEFAULT NULL, DROP id, DROP id_avis, CHANGE titre titre VARCHAR(50) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE rating rating DOUBLE PRECISION DEFAULT NULL, CHANGE iduser iduser INT DEFAULT NULL');
    }
}
