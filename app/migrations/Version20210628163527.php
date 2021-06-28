<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628163527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_tag (item_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E49CCCB1126F525E (item_id), INDEX IDX_E49CCCB1BAD26311 (tag_id), PRIMARY KEY(item_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_tag ADD CONSTRAINT FK_E49CCCB1126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_tag ADD CONSTRAINT FK_E49CCCB1BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tag_item');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_item (tag_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_F1149AA8126F525E (item_id), INDEX IDX_F1149AA8BAD26311 (tag_id), PRIMARY KEY(tag_id, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tag_item ADD CONSTRAINT FK_F1149AA8126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_item ADD CONSTRAINT FK_F1149AA8BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE item_tag');
    }
}
