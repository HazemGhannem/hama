<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412225353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD rating INT NOT NULL, ADD idUser INT NOT NULL, DROP dateAvis');
        $this->addSql('ALTER TABLE reclamation ADD imageReclamtion VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservationpack ADD iduser_id INT DEFAULT NULL, ADD idpack_id INT DEFAULT NULL, DROP iduser, DROP idpack');
        $this->addSql('ALTER TABLE reservationpack ADD CONSTRAINT FK_8FB76A06786A81FB FOREIGN KEY (iduser_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservationpack ADD CONSTRAINT FK_8FB76A06C61DE079 FOREIGN KEY (idpack_id) REFERENCES packs (id)');
        $this->addSql('CREATE INDEX IDX_8FB76A06786A81FB ON reservationpack (iduser_id)');
        $this->addSql('CREATE INDEX IDX_8FB76A06C61DE079 ON reservationpack (idpack_id)');
        $this->addSql('ALTER TABLE services CHANGE idesp idesp INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD dateAvis DATE NOT NULL, DROP rating, DROP idUser');
        $this->addSql('ALTER TABLE reclamation DROP imageReclamtion');
        $this->addSql('ALTER TABLE reservationpack DROP FOREIGN KEY FK_8FB76A06786A81FB');
        $this->addSql('ALTER TABLE reservationpack DROP FOREIGN KEY FK_8FB76A06C61DE079');
        $this->addSql('DROP INDEX IDX_8FB76A06786A81FB ON reservationpack');
        $this->addSql('DROP INDEX IDX_8FB76A06C61DE079 ON reservationpack');
        $this->addSql('ALTER TABLE reservationpack ADD iduser INT NOT NULL, ADD idpack INT NOT NULL, DROP iduser_id, DROP idpack_id');
        $this->addSql('ALTER TABLE services CHANGE idesp idesp INT NOT NULL');
    }
}
