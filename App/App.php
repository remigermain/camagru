<?php

namespace App;
use App\Databse;

class App
{
	const DB_NAME = 'camagru';
	const DB_USER = 'root';
	const DB_PASS = 'rootpass';
	const DB_HOST = '172.18.0.2';

	private static $database;
	private static $title = 'camagru';
	private static $path;

	Public static function getDb()
	{
		if ( self::$database === NULL )
		{
			self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
		}
		return (self::$database);
	}

	Public static function session()
	{
		if (session_id() == '' || !isset($_SESSION))
			session_start();
	}

	Public static function sessionExist()
	{
		static::session();
		if (isset($_SESSION) && isset($_SESSION['login']) && static::userExist($_SESSION['pseudo']))
			return (true);
		else
			return (false);
	}

	public static function userExist($pseudo)
	{
		if (APP::getDB()->getprepare("SELECT pseudo FROM user WHERE pseudo LIKE ?", [$pseudo]))
			return (true);
		else
			return (false);
	}

	Public static function getTitle()
	{
		return (self::$title);
	}

	Public static function setTitle($title)
	{
		self::$title = $title;

	}

	Public static function getPath($file)
	{
		if (is_null($file))
			static::$path = str_replace("App", "", __DIR__);
		return (str_replace("App", "", __DIR__) . $file);
	}

	Public static function printString($file)
	{
		return (htmlspecialchars($file));
	}
}

?>
