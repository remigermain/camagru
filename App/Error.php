<?php

namespace App;

class Error
{

    public static function wrongPost()
    {
		header ('Location:/Public/index.php?p=login');
    }
    
    Public static function notFound()
	{
		header ('HTTP/1.0 404 Not Found');
		header ('Location:/Public/index.php?p=404');
	}

	public static function	pop($str)
	{
		print $str;
	}

	public static function user_notvalid()
	{
		$str = "User dosen't exist or , you need to valid mail before login";
		header ('Location:/Public/index.php?p=error&error=' . $str);
	}

	public static function notAccess()
	{
		$str = "you not have access to this page";
		header ('Location:/Public/index.php?p=error&error=' . $str);
	}

	public static function stringError($file)
	{
		return ($file);
	}

	public static function noSession($str)
	{
		return ("You need to be connected to " . $str);
	}
}
?>