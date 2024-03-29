<?php

namespace App;

class	Autoloader
{
	static function	register()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	static function	autoload($class_name)
	{
		if (strpos($class_name, __NAMESPACE__ . '\\') == 0)
		{
			$class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
			$class_name = str_replace('\\', '/', $class_name);
			require __DIR__ . '/' . $class_name . '.php';
		}
	}

	static function file($file)
	{
		if (strpos($class_name, __NAMESPACE__ . '\\') == 0)
		{
			$class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
			$class_name = str_replace('\\', '/', $class_name);
			require __DIR__ . '/' . $class_name . '.php';
		}
	}

	static function router($page)
	{
		if (!file_exists("../Pages/" . $page . ".php"))
			$page = "error";
		$val['title'] = $page;
		$val['page'] = "../Pages/" . $page . ".php";
		return ($val);
	}
}
?>
