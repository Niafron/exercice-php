<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 * migration pour gérer les potions
 */
final class Version20220919124751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE potion (id INT AUTO_INCREMENT NOT NULL, hero_id INT NOT NULL, name VARCHAR(150) NOT NULL, bonus INT NOT NULL, INDEX IDX_4AB6B0AD45B0BCD (hero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE potion ADD CONSTRAINT FK_4AB6B0AD45B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE potion DROP FOREIGN KEY FK_4AB6B0AD45B0BCD');
        $this->addSql('DROP TABLE potion');
    }
}
