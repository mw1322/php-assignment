<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014171245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marks (id INT AUTO_INCREMENT NOT NULL, rollno_id INT DEFAULT NULL, maths INT NOT NULL, english INT NOT NULL, physics INT NOT NULL, chemistry INT NOT NULL, biology INT NOT NULL, INDEX IDX_3C6AFA53DEF09601 (rollno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, rollno INT NOT NULL, name VARCHAR(255) NOT NULL, father_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marks ADD CONSTRAINT FK_3C6AFA53DEF09601 FOREIGN KEY (rollno_id) REFERENCES students (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marks DROP FOREIGN KEY FK_3C6AFA53DEF09601');
        $this->addSql('DROP TABLE marks');
        $this->addSql('DROP TABLE students');
    }
}
