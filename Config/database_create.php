<?php

//  create database

return array(
    "CREATE DATABASE IF NOT EXISTS `camagru`", // create data
    "CREATE TABLE IF NOT EXISTS camagru.`user`(`id` INT(11) NOT NULL AUTO_INCREMENT, `login` Varchar(32), `pass` Varchar(200), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1", // table USER
    "CREATE TABLE IF NOT EXISTS camagru.`account`(`id` INT(11) NOT NULL AUTO_INCREMENT, `login` INT(11), `email` LONGTEXT, `synopsis` LONGTEXT, `logo` LONGTEXT ,`creation_date` DATE NOT NULL, `folowers` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1", // table ACCOUNT
    "CREATE TABLE IF NOT EXISTS camagru.`image`(`id` INT(11) NOT NULL AUTO_INCREMENT, `login` INT(11), `image` LONGTEXT, `date` DATE NOT NULL, `categorie` INT(11), `comment` INT(11), `like` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1",   // table IMAGE
    "CREATE TABLE IF NOT EXISTS camagru.`comment`(`id` INT(11) NOT NULL AUTO_INCREMENT, `login` INT(11), `image` INT(11), `date` DATE NOT NULL, `comment` LONGTEXT, `like` INT(11), `not_like` INT(11), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1",  // table COMMENT
    "CREATE TABLE IF NOT EXISTS camagru.`categorie`(`id` INT(11) NOT NULL AUTO_INCREMENT, `name` VARCHAR(32), PRIMARY KEY(`id`))ENGINE=MyISAM DEFAULT CHARSET=latin1;");  // table CATEGORIE
    
?>s