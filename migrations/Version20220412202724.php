<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412202724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservationservice CHANGE iduser iduser INT DEFAULT NULL, CHANGE prixresserv prixresserv DOUBLE PRECISION DEFAULT NULL, CHANGE etat etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE services CHANGE idesp idesp INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservationservice CHANGE iduser iduser INT NOT NULL, CHANGE prixresserv prixresserv DOUBLE PRECISION NOT NULL, CHANGE etat etat TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE services CHANGE idesp idesp INT NOT NULL');
    }
}
