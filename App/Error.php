<?php

namespace App;
use App\App;

class Error
{

    public static function wrongRequest()
    {
		App::createJson("Request error", 0);
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
		App::createJson("User dosen't exist or , you need to valid mail before login", 0);
	}

	public static function notAccess()
	{
		App::createJson("You not have access to this page", 0);
	}

	public static function user_notExist()
	{
		App::createJson("The user name entered does not belong to any account. Please check it and try again.", 0);
	}

	public static function user_validMail()
	{
		App::createJson("You need to valid mail before login.", 0);
	}

	public static function stringError($file)
	{
		App::createJson($filem, 0);
	}

	public static function noSession($str)
	{
		return ("You need to be connected to " . App::printString($str));
	}

	public static function user_Exist($username)
	{
		App::createJson("Username \"" . $username . "\" already exists.", 0);
	}

	public static function mail_Exist($mail)
	{
		App::createJson("Mail \"" . App::printString($mail) . "\" already exists.", 0);
	}

	public static function not_samePass()
	{
		App::createJson("the password are not same!", 0);
	}
}
?>