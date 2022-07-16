<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711152034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_boisson ADD prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_burger ADD prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_frite ADD prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_menu ADD prix DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_boisson DROP prix');
        $this->addSql('ALTER TABLE commande_burger DROP prix');
        $this->addSql('ALTER TABLE commande_frite DROP prix');
        $this->addSql('ALTER TABLE commande_menu DROP prix');
    }
}
