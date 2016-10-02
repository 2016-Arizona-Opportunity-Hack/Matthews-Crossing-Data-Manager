-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `cxa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `cxa`;

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE `auth_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` char(12) DEFAULT NULL,
  `token` char(64) DEFAULT NULL,
  `userid` int(11) unsigned NOT NULL,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` longtext,
  `authorization` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0=No Permissions1=Team Account2=Judge Account3=Competition Administrator4=Site Administrator',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid_UNIQUE` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`userid`, `username`, `password`, `name`, `email`, `authorization`) VALUES
(1,	'admin',	'$2y$10$n/jZ9/PO59Asj6WrMZXl..ACi5nnPC3bDbk4LuLGrMHMqWlOhGKVa',	'Administrator',	'example@example.com',	4),
(777,	'guest',	'heaven',	'guest',	NULL,	0);

DROP TABLE IF EXISTS `user_limbo`;
CREATE TABLE `user_limbo` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` longtext,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2016-10-02 05:14:56
