<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629065000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Заполнеие таблиц тестовыми данными';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            INSERT INTO `item` (`id`, `name`, `show_count`) VALUES 
            (1, "Кросовки Nike", 5),
            (2, "Джинсы Levi\'s",10),
            (3, "Куртка NORMANN",0),
            (4, "Футболка Adidas",1)
        ');

        $this->addSql('
            INSERT INTO `tag` (`id`, `name`) VALUES 
            (1, "одежда"),
            (2, "обувь"),
            (3, "стиль"),
            (4, "повседневное"),
            (5, "черное"),
            (6, "белое")
        ');

        $this->addSql('
            INSERT INTO `item_tag` (`item_id`, `tag_id`) VALUES 
            (1, 2),
            (1, 3),
            (1, 5),
            (2, 1),
            (2, 4),
            (3, 1),
            (3, 4),
            (3, 6),
            (4, 1),
            (4, 6)
        ');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
