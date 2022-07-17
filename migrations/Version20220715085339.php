<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715085339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_menu_boisson');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_menu_boisson (id INT AUTO_INCREMENT NOT NULL, menu_com_id INT DEFAULT NULL, taille_boisson_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_39B075B8A7CB57EF (menu_com_id), INDEX IDX_39B075B88421F13F (taille_boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_menu_boisson ADD CONSTRAINT FK_39B075B88421F13F FOREIGN KEY (taille_boisson_id) REFERENCES boisson_taille (id)');
        $this->addSql('ALTER TABLE commande_menu_boisson ADD CONSTRAINT FK_39B075B8A7CB57EF FOREIGN KEY (menu_com_id) REFERENCES commande_menu (id)');
    }
}
