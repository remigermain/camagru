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
		if (isset($_SESSION) && isset($_SESSION['username']) && static::userExist($_SESSION['username']))
			return (true);
		else
			return (false);
	}

	public static function userExist($username)
	{
		if (APP::getDB()->getprepare("SELECT username FROM user WHERE username LIKE ?", [$username]))
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
		return ("/var/www/html/" . $file);
	}

	Public static function printString($file)
	{
		return (htmlspecialchars($file));
	}

	public static function generatePassword($length = 8)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-#$%';
		$count = mb_strlen($chars);
	
		for ($i = 0, $result = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$result .= mb_substr($chars, $index, 1);
		}
		return $result;
	}

	Public static function calculPage($tab, $page_number)
	{
		if ($page_number <= 0)
			return (0);
		$count = count($tab);
		$final = floor($count / $page_number);
		if (($count % $page_number) > 0)
			$final++;
		if ($final == 0)
			$final++;
		return ($final);
	}

	Public static function paginationCurrent($i, $j)
	{
		if ($i == $j)
			return ("is-current");
		return ("");
	}

	static public function Pagination($com, $number)
    {
        $i = 0;
        while ($i < $number && isset($com[$i]))
            unset($com[$i++]);
        return ($com);
	}
	
	Public static function createJson($msg, $status = 1)
	{
		$res['status'] = $status;
		$res['msg'] = $msg;
		$res = json_encode($res);
		print($res);		
	}
}

?>
