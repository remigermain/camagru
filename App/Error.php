<?php

namespace App;

class Error
{

    public static function wrongPost()
    {
		//header ('Location:/Public/index.php?p=login');
		?>
		<div class="notification is-danger">
 			<button class="delete"></button>
 			Primar lorem ipsum dolor sit amet, consectetur
 			adipiscing elit lorem ipsum dolor. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Sit amet,
 			consectetur adipiscing elit
		</div>
		<?php
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
		print ("1 User dosen't exist or , you need to valid mail before login");
	}

	public static function notAccess()
	{
		print ("1 you not have access to this page");
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