<?php

namespace App;

class App
{
	const DB_NAME = 'camagru';
	const DB_USER = 'root';
	const DB_PASS = 'rootpass';
	const DB_HOST = '172.18.0.2';

	private static $database;
	private static $title = 'camagru';

	Public static function getDb()
	{
		if ( self::$database === NULL )
		{
			self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
		}
		return (self::$database);
	}

	Public static function notFound()
	{
		header ('HTTP/1.0 404 Not Found');
		header ('Location:index.php?=404');
	}

	Public static function getTitle()
	{
		return (self::$title);
	}

	Public static function setTitle($title)
	{
		self::$title = $title;

	}
}

?>
