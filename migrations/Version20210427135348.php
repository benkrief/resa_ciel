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
        $this->addSql("CREATE TABLE office (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, max_sub INT NOT NULL, date DATE NOT NULL, hour TIME NOT NULL, lieu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sub (id INT AUTO_INCREMENT NOT NULL, id_office_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_580282DC7F957E03 (id_office_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
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
