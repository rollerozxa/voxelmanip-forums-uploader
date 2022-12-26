-- Adminer 4.8.1 MySQL 10.9.4-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE `uploader_categories` (
  `id` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(64) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `files` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `uploader_categories` (`id`, `sort`, `name`, `description`, `files`) VALUES
(1,	200,	'Misc.',	'Other stuff that don\'t fit into the above categories.',	10),
(2,	100,	'Post layout files',	'Files for your post layouts.',	1),
(3,	50,	'Images',	'For images you want to attach to posts.',	1),
(4,	25,	'Code',	'Upload larger files with source code as an alternative to a pastebin.',	0);

CREATE TABLE `uploader_files` (
  `id` int(10) unsigned NOT NULL,
  `cat` int(10) unsigned NOT NULL DEFAULT 1,
  `filename` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2022-12-26 10:31:20
