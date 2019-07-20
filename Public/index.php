<?php
require '../App/Autoloader.php';
use     App\Autoloader;
use     App\App;
Autoloader::register();
App::session();
APP::getPath(NULL);

if (isset($_GET) && isset($_GET['p']))
    $page = $_GET['p'];
else
    $page = 'home';

$title = $page;
ob_start();
if ($page === 'home')
    require '../Pages/home.php';
else if ($page === 'connection')
    require '../Pages/connection.php';
else if ($page === 'account')
    require '../Pages/user/account.php';
else if ($page === 'upload_image')
    require '../Pages/user/upload_image.php';
else if ($page === 'user_home')
    require '../Pages/user/user_home.php';
else if ($page === 'admin_account')
    require '../Pages/admin/admin_account.php';
else if ($page === 'admin_tools')
    require '../Pages/admin/admin_tools.php';
else if ($page === 'admin_home')
    require '../Pages/admin/admin_home.php';
else if ($page === 'notification')
    require '../Pages/user/user_notification.php';
else if ($page === 'image')
    require '../Pages/image.php';
else if ($page === 'about')
    require '../Pages/about.php';
else
{
    require '../Pages/error.php';
    $title = "error";
}

$content = ob_get_clean();
require '../Pages/templates/header.php';
print ($content);
require '../Pages/templates/footer.php';
?>
