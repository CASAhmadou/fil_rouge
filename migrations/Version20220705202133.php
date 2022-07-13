<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705202133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFCF26AD0');
        $this->addSql('DROP INDEX IDX_6EEAA67DFCF26AD0 ON commande');
        $this->addSql('ALTER TABLE commande DROP produit_commande_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FCF26AD0');
        $this->addSql('DROP INDEX IDX_29A5EC27FCF26AD0 ON produit');
        $this->addSql('ALTER TABLE produit DROP produit_commande_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD produit_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFCF26AD0 FOREIGN KEY (produit_commande_id) REFERENCES produit_commande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFCF26AD0 ON commande (produit_commande_id)');
        $this->addSql('ALTER TABLE produit ADD produit_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FCF26AD0 FOREIGN KEY (produit_commande_id) REFERENCES produit_commande (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27FCF26AD0 ON produit (produit_commande_id)');
    }
}
