<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711125356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson_taille DROP FOREIGN KEY FK_E7A2EE18638D89F');
        $this->addSql('DROP INDEX IDX_E7A2EE18638D89F ON boisson_taille');
        $this->addSql('ALTER TABLE boisson_taille CHANGE taile_id taille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1FF25611A FOREIGN KEY (taille_id) REFERENCES taille_boisson (id)');
        $this->addSql('CREATE INDEX IDX_E7A2EE1FF25611A ON boisson_taille (taille_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson_taille DROP FOREIGN KEY FK_E7A2EE1FF25611A');
        $this->addSql('DROP INDEX IDX_E7A2EE1FF25611A ON boisson_taille');
        $this->addSql('ALTER TABLE boisson_taille CHANGE taille_id taile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE18638D89F FOREIGN KEY (taile_id) REFERENCES taille_boisson (id)');
        $this->addSql('CREATE INDEX IDX_E7A2EE18638D89F ON boisson_taille (taile_id)');
    }
}
