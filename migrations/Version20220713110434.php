<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713110434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_boisson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_burger_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_frite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_menu_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE livraison_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_burger_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_portion_frite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE menu_taille_boisson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quartier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE taille_boisson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE zone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE boisson (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B97C84D6885AC1B ON boisson (gestionnaire_id)');
        $this->addSql('CREATE TABLE boisson_taille (id INT NOT NULL, boisson_id INT DEFAULT NULL, taille_id INT DEFAULT NULL, qte DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E7A2EE1734B8089 ON boisson_taille (boisson_id)');
        $this->addSql('CREATE INDEX IDX_E7A2EE1FF25611A ON boisson_taille (taille_id)');
        $this->addSql('CREATE TABLE burger (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EFE35A0D6885AC1B ON burger (gestionnaire_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commande (id INT NOT NULL, livraison_id INT DEFAULT NULL, gestionnaire_id INT DEFAULT NULL, client_id INT NOT NULL, zone_id INT DEFAULT NULL, quartier_id INT DEFAULT NULL, numero_commande VARCHAR(255) DEFAULT NULL, date_commande DATE DEFAULT NULL, etat VARCHAR(255) NOT NULL, montant_commande VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6885AC1B ON commande (gestionnaire_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9F2C3FAB ON commande (zone_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DDF1E57AB ON commande (quartier_id)');
        $this->addSql('CREATE TABLE commande_boisson (id INT NOT NULL, tailleboisson_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantity INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D2CBAED36F1CA00 ON commande_boisson (tailleboisson_id)');
        $this->addSql('CREATE INDEX IDX_7D2CBAED82EA2E54 ON commande_boisson (commande_id)');
        $this->addSql('CREATE TABLE commande_burger (id INT NOT NULL, burger_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantity INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EDB7A1D817CE5090 ON commande_burger (burger_id)');
        $this->addSql('CREATE INDEX IDX_EDB7A1D882EA2E54 ON commande_burger (commande_id)');
        $this->addSql('CREATE TABLE commande_frite (id INT NOT NULL, frite_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantity INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_19831BAEBE00B4D9 ON commande_frite (frite_id)');
        $this->addSql('CREATE INDEX IDX_19831BAE82EA2E54 ON commande_frite (commande_id)');
        $this->addSql('CREATE TABLE commande_menu (id INT NOT NULL, menu_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantity INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_16693B70CCD7E912 ON commande_menu (menu_id)');
        $this->addSql('CREATE INDEX IDX_16693B7082EA2E54 ON commande_menu (commande_id)');
        $this->addSql('CREATE TABLE gestionnaire (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE livraison (id INT NOT NULL, livreur_id INT DEFAULT NULL, montant_total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A60C9F1FF8646701 ON livraison (livreur_id)');
        $this->addSql('CREATE TABLE livreur (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, matricule_moto VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, etat VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EB7A4E6D6885AC1B ON livreur (gestionnaire_id)');
        $this->addSql('CREATE TABLE menu (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D053A936885AC1B ON menu (gestionnaire_id)');
        $this->addSql('CREATE TABLE menu_burger (id INT NOT NULL, burger_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantity INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3CA402D517CE5090 ON menu_burger (burger_id)');
        $this->addSql('CREATE INDEX IDX_3CA402D5CCD7E912 ON menu_burger (menu_id)');
        $this->addSql('CREATE TABLE menu_portion_frite (id INT NOT NULL, menu_id INT DEFAULT NULL, portion_frite_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29FA693BCCD7E912 ON menu_portion_frite (menu_id)');
        $this->addSql('CREATE INDEX IDX_29FA693B9B17FA7B ON menu_portion_frite (portion_frite_id)');
        $this->addSql('CREATE TABLE menu_taille_boisson (id INT NOT NULL, menu_id INT DEFAULT NULL, tailleboisson_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4030374CCCD7E912 ON menu_taille_boisson (menu_id)');
        $this->addSql('CREATE INDEX IDX_4030374C36F1CA00 ON menu_taille_boisson (tailleboisson_id)');
        $this->addSql('CREATE TABLE portion_frite (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F393CAD6885AC1B ON portion_frite (gestionnaire_id)');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, nom VARCHAR(255) NOT NULL, image BYTEA DEFAULT NULL, prix INT DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, stock DOUBLE PRECISION DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE produit_commande (id INT NOT NULL, produit_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, qte_produit VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47F5946EF347EFB ON produit_commande (produit_id)');
        $this->addSql('CREATE INDEX IDX_47F5946E82EA2E54 ON produit_commande (commande_id)');
        $this->addSql('CREATE TABLE quartier (id INT NOT NULL, zone_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEE8962D9F2C3FAB ON quartier (zone_id)');
        $this->addSql('CREATE TABLE taille_boisson (id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, libelle VARCHAR(255) NOT NULL, stock_tb INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, expired_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, token VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (login)');
        $this->addSql('CREATE TABLE zone (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1FF25611A FOREIGN KEY (taille_id) REFERENCES taille_boisson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_boisson ADD CONSTRAINT FK_7D2CBAED36F1CA00 FOREIGN KEY (tailleboisson_id) REFERENCES boisson_taille (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_boisson ADD CONSTRAINT FK_7D2CBAED82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_burger ADD CONSTRAINT FK_EDB7A1D817CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_burger ADD CONSTRAINT FK_EDB7A1D882EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_frite ADD CONSTRAINT FK_19831BAEBE00B4D9 FOREIGN KEY (frite_id) REFERENCES portion_frite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_frite ADD CONSTRAINT FK_19831BAE82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_menu ADD CONSTRAINT FK_16693B70CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_menu ADD CONSTRAINT FK_16693B7082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestionnaire ADD CONSTRAINT FK_F4461B20BF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A936885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693BCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693B9B17FA7B FOREIGN KEY (portion_frite_id) REFERENCES portion_frite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374C36F1CA00 FOREIGN KEY (tailleboisson_id) REFERENCES taille_boisson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CAD6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE boisson_taille DROP CONSTRAINT FK_E7A2EE1734B8089');
        $this->addSql('ALTER TABLE commande_boisson DROP CONSTRAINT FK_7D2CBAED36F1CA00');
        $this->addSql('ALTER TABLE commande_burger DROP CONSTRAINT FK_EDB7A1D817CE5090');
        $this->addSql('ALTER TABLE menu_burger DROP CONSTRAINT FK_3CA402D517CE5090');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande_boisson DROP CONSTRAINT FK_7D2CBAED82EA2E54');
        $this->addSql('ALTER TABLE commande_burger DROP CONSTRAINT FK_EDB7A1D882EA2E54');
        $this->addSql('ALTER TABLE commande_frite DROP CONSTRAINT FK_19831BAE82EA2E54');
        $this->addSql('ALTER TABLE commande_menu DROP CONSTRAINT FK_16693B7082EA2E54');
        $this->addSql('ALTER TABLE produit_commande DROP CONSTRAINT FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE boisson DROP CONSTRAINT FK_8B97C84D6885AC1B');
        $this->addSql('ALTER TABLE burger DROP CONSTRAINT FK_EFE35A0D6885AC1B');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D6885AC1B');
        $this->addSql('ALTER TABLE livreur DROP CONSTRAINT FK_EB7A4E6D6885AC1B');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A936885AC1B');
        $this->addSql('ALTER TABLE portion_frite DROP CONSTRAINT FK_8F393CAD6885AC1B');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE livraison DROP CONSTRAINT FK_A60C9F1FF8646701');
        $this->addSql('ALTER TABLE commande_menu DROP CONSTRAINT FK_16693B70CCD7E912');
        $this->addSql('ALTER TABLE menu_burger DROP CONSTRAINT FK_3CA402D5CCD7E912');
        $this->addSql('ALTER TABLE menu_portion_frite DROP CONSTRAINT FK_29FA693BCCD7E912');
        $this->addSql('ALTER TABLE menu_taille_boisson DROP CONSTRAINT FK_4030374CCCD7E912');
        $this->addSql('ALTER TABLE commande_frite DROP CONSTRAINT FK_19831BAEBE00B4D9');
        $this->addSql('ALTER TABLE menu_portion_frite DROP CONSTRAINT FK_29FA693B9B17FA7B');
        $this->addSql('ALTER TABLE boisson DROP CONSTRAINT FK_8B97C84DBF396750');
        $this->addSql('ALTER TABLE burger DROP CONSTRAINT FK_EFE35A0DBF396750');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93BF396750');
        $this->addSql('ALTER TABLE portion_frite DROP CONSTRAINT FK_8F393CADBF396750');
        $this->addSql('ALTER TABLE produit_commande DROP CONSTRAINT FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67DDF1E57AB');
        $this->addSql('ALTER TABLE boisson_taille DROP CONSTRAINT FK_E7A2EE1FF25611A');
        $this->addSql('ALTER TABLE menu_taille_boisson DROP CONSTRAINT FK_4030374C36F1CA00');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455BF396750');
        $this->addSql('ALTER TABLE gestionnaire DROP CONSTRAINT FK_F4461B20BF396750');
        $this->addSql('ALTER TABLE livreur DROP CONSTRAINT FK_EB7A4E6DBF396750');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67D9F2C3FAB');
        $this->addSql('ALTER TABLE quartier DROP CONSTRAINT FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP SEQUENCE commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_boisson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_burger_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_frite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_menu_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE livraison_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_burger_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_portion_frite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE menu_taille_boisson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quartier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE taille_boisson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE zone_id_seq CASCADE');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE boisson_taille');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_boisson');
        $this->addSql('DROP TABLE commande_burger');
        $this->addSql('DROP TABLE commande_frite');
        $this->addSql('DROP TABLE commande_menu');
        $this->addSql('DROP TABLE gestionnaire');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('DROP TABLE menu_portion_frite');
        $this->addSql('DROP TABLE menu_taille_boisson');
        $this->addSql('DROP TABLE portion_frite');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE zone');
    }
}
