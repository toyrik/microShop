-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: mysql
-- Время создания: Июн 28 2021 г., 17:04
-- Версия сервера: 10.4.20-MariaDB-1:10.4.20+maria~focal
-- Версия PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `symfony`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210628163527', '2021-06-28 16:36:24', 151);

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `name`, `show_count`) VALUES
(1, 'Кроссовки Nike', 5),
(2, 'Джинсы Levi\'s', 10),
(3, 'Куртка NORMANN', 0),
(4, 'Футболка Adidas', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `item_tag`
--

DROP TABLE IF EXISTS `item_tag`;
CREATE TABLE IF NOT EXISTS `item_tag` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`tag_id`),
  KEY `IDX_E49CCCB1126F525E` (`item_id`),
  KEY `IDX_E49CCCB1BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `item_tag`
--

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
(4, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'одежда'),
(2, 'обувь'),
(3, 'стиль'),
(4, 'повседневное'),
(5, 'черное'),
(6, 'белое');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `item_tag`
--
ALTER TABLE `item_tag`
  ADD CONSTRAINT `FK_E49CCCB1126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E49CCCB1BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
