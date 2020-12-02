-- Adminer 4.7.3 MySQL dump

DROP DATABASE IF EXISTS `classroom`;
CREATE DATABASE `classroom`

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


DROP TABLE IF EXISTS `classroom`;
CREATE TABLE `classroom` (
  `class_code` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'section',
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `room` int(11) DEFAULT NULL,
  PRIMARY KEY (`class_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `classroom` (`class_code`, `class_name`, `section`, `detail`, `room`) VALUES
(1,	'Hello World',	'',	'',	0),
(2,	'Lập trình web',	'',	'',	0),
(3,	'TDS2',	'',	'',	0),
(4,	'LOL',	'Mua 2020',	'',	0),
(5,	'PhP',	'2020',	'',	0);

DROP TABLE IF EXISTS `list_class`;
CREATE TABLE `list_class` (
  `id_list` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `class_code` int(11) NOT NULL,
  `teacher` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_list`),
  UNIQUE KEY `email_class_code` (`email`,`class_code`),
  KEY `class_code` (`class_code`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `list_class` (`id_list`, `email`, `class_code`, `teacher`) VALUES
(1,	'admin@gmail.com',	1,	1),
(2,	'admin@gmail.com',	2,	1),
(3,	'admin@gmail.com',	3,	1),
(4,	'meocondethuong100@gmail.com',	1,	0),
(5,	'meocondethuong100@gmail.com',	4,	1),
(6,	'meocondethuong100@gmail.com',	5,	1),
(7,	'phuclee710@gmail.com',	2,	0),
(8,	'phuclee710@gmail.com',	3,	0),
(9,	'phuclee710@gmail.com',	4,	0);

DROP TABLE IF EXISTS `reset_token`;
CREATE TABLE `reset_token` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token` varchar(255) NOT NULL,
  `exp` int(11) NOT NULL,
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_email` (`username`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `full_name`, `email`, `username`, `password`, `created_at`) VALUES
(1,	'Nhon',	'phuclee710@gmail.com',	'phuclee1260',	'$2y$10$vUKy8SCzeWOOOuvgJ5Gz/evAIUBtdwcsNvqts7/rQ1AM/Sf5n.1sm',	'2020-12-02 11:11:57'),
(2,	'Phuc',	'meocondethuong100@gmail.com',	'phuclee710',	'$2y$10$vEdo.Fb1nXjF9K9.XHKdNeulYumiL8/muk1eh9LXgXVAbfdsc5K9S',	'2020-12-02 11:12:20'),
(3,	'admin',	'admin@gmail.com',	'admin',	'$2y$10$NH9rJ4Wht2CmUBzy77dDS.PzohN/82lMvM/EoFSjtowp9a3gRZfFW',	'2020-12-02 11:12:31');

-- 2020-12-02 04:15:35
