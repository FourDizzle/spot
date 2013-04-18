spot
====
MySQL for creating db and table

CREATE DATABASE conversation;

USE conversation;

CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lat` decimal(9,6) NOT NULL,
  `lon` decimal(9,6) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image_path` text,
  `caption` text,
  `scanned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99998770 ;
