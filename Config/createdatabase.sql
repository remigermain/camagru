CREATE DATABASE IF NOT EXISTS `camagru`;
CREATE TABLE IF NOT EXISTS camagru.`user`(`id` INT(11) NOT NULL AUTO_INCREMENT, `email` Varchar(32), `pass` Varchar(200), `email` LONGTEXT, `creation_date` DATE NOT NULL, `valid` INT(1), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`home`(`id` INT(11) NOT NULL AUTO_INCREMENT, `email` INT(11),  `synopsis` LONGTEXT, `logo` LONGTEXT , PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`image`(`id` INT(11) NOT NULL AUTO_INCREMENT, `email` INT(11), `image` LONGTEXT, `date` DATE NOT NULL, `categorie` INT(11), `comment` INT(11), `like` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`comment`(`id` INT(11) NOT NULL AUTO_INCREMENT, `email` INT(11), `image` INT(11), `date` DATE NOT NULL, `comment` LONGTEXT, `like` INT(11), `not_like` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`categorie`(`id` INT(11) NOT NULL AUTO_INCREMENT, `name` VARCHAR(32), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`follower`(`id` INT(11) NOT NULL AUTO_INCREMENT, `email` VARCHAR(32), `follower` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO camagru.user (pseudo, email, pass, creation_date) VALUES("rgermain", "rr@gg.fr", "aa", "12922445");