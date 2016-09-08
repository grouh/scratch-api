SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `scratch_api`;

INSERT INTO `playlists` (`id`, `user_id`, `title`, `createdAt`, `updatedAt`) VALUES
(1,	1,	'Slow Focus',	'2016-09-08 16:59:52',	'2016-09-08 16:59:52');

INSERT INTO `playlists_songs` (`playlist_id`, `song_id`, `createdAt`, `updatedAt`) VALUES
(1,	1,	'2016-09-08 17:40:57',	'2016-09-08 17:40:57'),
(1,	2,	'2016-09-08 17:41:03',	'2016-09-08 17:41:03'),
(1,	5,	'2016-09-08 17:41:10',	'2016-09-08 17:41:10'),
(1,	3,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00');

INSERT INTO `songs` (`id`, `title`, `duration`, `createdAt`, `updatedAt`) VALUES
(1,	'Brainfreeze',	12000,	'2016-09-08 17:16:50',	'2016-09-08 17:16:50'),
(2,	'The Red Wing',	250,	'2016-09-08 17:39:32',	'2016-09-08 17:39:32'),
(3,	'Year of the Dog',	100,	'2016-09-08 17:39:47',	'2016-09-08 17:39:47'),
(4,	'Sentients',	500,	'2016-09-08 17:40:14',	'2016-09-08 17:40:14'),
(5,	'Stalker',	455,	'2016-09-08 17:40:29',	'2016-09-08 17:40:29');

INSERT INTO `users` (`id`, `username`, `email`, `enabled`, `firstname`, `lastname`) VALUES
(1,	'sypam',	'sypam@smile.fr',	1,	'sylvain',	'pamart'),
(2,	'jeroc',	'jeroc@smile.fr',	1,	'Jean',	'Rocherfort');