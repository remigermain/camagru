CREATE DATABASE IF NOT EXISTS `camagru`;
CREATE TABLE IF NOT EXISTS camagru.`user`(`id` INT(11) NOT NULL AUTO_INCREMENT, `username` Varchar(32), `pass` Varchar(200), `email` LONGTEXT, `creation_date` DATE NOT NULL, `token` INT(1), `notif` INT(1), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`home`(`id` INT(11) NOT NULL AUTO_INCREMENT, `user_id` INT(11),  `synopsis` LONGTEXT, `logo` LONGTEXT , PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`image`(`id` INT(11) NOT NULL AUTO_INCREMENT, `user_id` INT(11), `image` LONGTEXT, `date` DATE NOT NULL, `title` Varchar(30), `synopsis` LONGTEXT, `category` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`comment`(`id` INT(11) NOT NULL AUTO_INCREMENT, `user_id` INT(11), `image_id` INT(11), `date` DATE NOT NULL, `comment` LONGTEXT, PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`category`(`id` INT(11) NOT NULL AUTO_INCREMENT, `name` VARCHAR(32), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`follower`(`id` INT(11) NOT NULL AUTO_INCREMENT, `user_id` VARCHAR(32), `follower` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS camagru.`notification`(`id` INT(11) NOT NULL AUTO_INCREMENT, `follow` INT(1), `like` INT(1), `comment` INT(1), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO camagru.user (username, email, pass, creation_date) VALUES("rgermain", "a@a", "a", "2018-02-08");