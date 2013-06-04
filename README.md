spot
====
---Directory & Credential Setup---
        
        Change all static variable values in spot/scripts/functions/directory.php
        to match the values of your development environment.


---MySQL for creating db and table---

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

	CREATE TABLE IF NOT EXISTS `comments` (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `location_id` int(10) unsigned NOT NULL,
	  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;
