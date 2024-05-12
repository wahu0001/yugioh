<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240511123632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wish_list_cards DROP FOREIGN KEY FK_94F821EE4ACC9A20');
        $this->addSql('DROP TABLE wish_list_cards');
        $this->addSql('ALTER TABLE wish_lists_cards ADD card_id INT NOT NULL');
        $this->addSql('ALTER TABLE wish_lists_cards ADD CONSTRAINT FK_2C99C2E4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('CREATE INDEX IDX_2C99C2E4ACC9A20 ON wish_lists_cards (card_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wish_list_cards (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, INDEX IDX_94F821EE4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE wish_list_cards ADD CONSTRAINT FK_94F821EE4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE wish_lists_cards DROP FOREIGN KEY FK_2C99C2E4ACC9A20');
        $this->addSql('DROP INDEX IDX_2C99C2E4ACC9A20 ON wish_lists_cards');
        $this->addSql('ALTER TABLE wish_lists_cards DROP card_id');
    }
}
