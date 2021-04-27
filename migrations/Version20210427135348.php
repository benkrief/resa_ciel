<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427135348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE SEQUENCE office_seq");
        $this->addSql("CREATE TABLE office (id INT DEFAULT NEXTVAL ('office_seq') NOT NULL, title VARCHAR(255) NOT NULL, max_sub INT NOT NULL, date DATE NOT NULL, hour TIME(0) NOT NULL, lieu VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE SEQUENCE sub_seq");
        $this->addSql("CREATE TABLE sub (id INT DEFAULT NEXTVAL ('sub_seq') NOT NULL, id_office_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_580282DC7F957E03 ON sub (id_office_id)");
        $this->addSql("ALTER TABLE sub ADD CONSTRAINT FK_580282DC7F957E03 FOREIGN KEY (id_office_id) REFERENCES office (id)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE sub DROP FOREIGN KEY FK_580282DC7F957E03");
        $this->addSql("DROP TABLE office");
        $this->addSql("DROP TABLE sub");
    }
}
