<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711104002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84D82EA2E54 ON boisson (commande_id)');
        $this->addSql('ALTER TABLE burger ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D82EA2E54 ON burger (commande_id)');
        $this->addSql('ALTER TABLE menu ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_7D053A9382EA2E54 ON menu (commande_id)');
        $this->addSql('ALTER TABLE portion_frite ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CAD82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_8F393CAD82EA2E54 ON portion_frite (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84D82EA2E54');
        $this->addSql('DROP INDEX IDX_8B97C84D82EA2E54 ON boisson');
        $this->addSql('ALTER TABLE boisson DROP commande_id');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D82EA2E54');
        $this->addSql('DROP INDEX IDX_EFE35A0D82EA2E54 ON burger');
        $this->addSql('ALTER TABLE burger DROP commande_id');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9382EA2E54');
        $this->addSql('DROP INDEX IDX_7D053A9382EA2E54 ON menu');
        $this->addSql('ALTER TABLE menu DROP commande_id');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CAD82EA2E54');
        $this->addSql('DROP INDEX IDX_8F393CAD82EA2E54 ON portion_frite');
        $this->addSql('ALTER TABLE portion_frite DROP commande_id');
    }
}
