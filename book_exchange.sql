-- Adminer 4.8.4 MySQL 9.1.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `books` (`id`, `user_id`, `title`, `author`, `description`, `image`, `is_available`, `created_at`) VALUES
(2,	1,	'Picsou',	'waiks',	'trop cool',	'1773952381_Capture d’écran 2026-03-18 204421.png',	1,	'2026-03-19 20:33:01'),
(4,	1,	'test',	'waiks',	'test',	'1773952832_7b71dfece0b8eecc369e19338c6d3d5b.jpg',	1,	'2026-03-19 20:40:32'),
(7,	2,	'Minecraft',	'Paul',	'trop cool',	'1773956532_7b71dfece0b8eecc369e19338c6d3d5b.jpg',	1,	'2026-03-19 21:42:12');

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE `conversations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user1_id` (`user1_id`),
  KEY `user2_id` (`user2_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conversation_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `bio`, `created_at`) VALUES
(1,	'Ingremeau Maillet Tom',	'tomingremeaumaillet@gmail.com',	'$2y$10$0S46gjx2UjugEv33nQkECeYKEEW6A4FQPGdxYx5KIGqYGt9mCvTWG',	'Je suis un vendeur de livres principalement des BD',	'2026-03-18 19:02:57'),
(2,	'Paul',	'paul@gmail.com',	'$2y$10$75MsBpD.hCeffQyVFlfNb.wsOhNKP6DskpAc0J/3sfeA1j83RxVrm',	'je suis honnete',	'2026-03-19 21:35:09');

-- 2026-03-20 12:37:12
