<?php
require ("../App/Autoloader.php");
use     App\Autoloader;
use     App\App;
Autoloader::register();
App::session();
APP::getPath(NULL);

$page = 'home';
if (isset($_GET) && isset($_GET['p']))
$page = $_GET['p'];

$val = Autoloader::router($page);
$title = $val['title'];

ob_start();
require ("../Pages/templates/header.php");
require ($val['page']);
require ("../Pages/templates/footer.php");
print(ob_get_clean());
?>
