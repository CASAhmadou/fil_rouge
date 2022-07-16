<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706085802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_portion_frite (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, portion_frite_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_29FA693BCCD7E912 (menu_id), INDEX IDX_29FA693B9B17FA7B (portion_frite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_taille_boisson (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, tailleboisson_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_4030374CCCD7E912 (menu_id), INDEX IDX_4030374C36F1CA00 (tailleboisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693BCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693B9B17FA7B FOREIGN KEY (portion_frite_id) REFERENCES portion_frite (id)');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374C36F1CA00 FOREIGN KEY (tailleboisson_id) REFERENCES taille_boisson (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE menu_portion_frite');
        $this->addSql('DROP TABLE menu_taille_boisson');
    }
}
