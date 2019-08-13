-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `homestead`;
CREATE DATABASE `homestead` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */;
USE `homestead`;

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_bin DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `user` int(11) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`ID`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO `tasks` (`id`, `name`, `done`, `user`, `created`) VALUES
(22,	'Get shampooed',	0,	1,	'2019-08-01 08:54:22'),
(28,	'Fetch shoes',	0,	1,	'2019-04-04 00:00:00'),
(39,	'Test',	1,	1,	'2019-08-06 04:39:43'),
(49,	'Get Oculus Quest',	0,	1,	'2019-08-06 08:42:51');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO `users` (`ID`, `username`) VALUES
(1,	'ikhmal'),
(2,	'mala');

-- 2019-08-06 08:48:02
