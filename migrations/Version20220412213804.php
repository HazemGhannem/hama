<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412213804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE reclamation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (idAvis INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, rating DOUBLE PRECISION DEFAULT NULL, iduser INT DEFAULT NULL, PRIMARY KEY(idAvis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (idReclamation INT AUTO_INCREMENT NOT NULL, dateReclamation VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, descriptionReclamation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, imageReclamation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nomReclameur VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenomReclameur VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, etatReclamation VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT DEFAULT NULL, PRIMARY KEY(idReclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }
}
