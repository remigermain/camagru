<?php

require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();


if (isset($_GET['p']))
    $page = $_GET['p'];
else
    $page = 'home';

ob_start();

require '../Pages/templates/header.php';
if ($page === 'home')
    require '../Pages/home.php';
else if ($page === 'account')
    require '../Pages/account.php';
else if ($page === 'add_images.php')
    require '../Pages/add_images.php';
else
    require '../Pages/error.php';
require '../Pages/templates/footer.php';

$content = ob_get_clean();

require '../Pages/templates/default.php'

?>