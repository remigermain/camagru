<?php
require '../App/Autoloader.php';
use     App\Autoloader;
use     App\App;
Autoloader::register();
App::session();
APP::getPath(NULL);

if (isset($_GET['p']))
    $page = $_GET['p'];
else
    $page = 'home';

$title = NULL;
ob_start();
require '../Pages/templates/header.php';
if ($page === 'home')
    require '../Pages/home.php';
else if ($page === 'connection')
    require '../Pages/connection.php';
else if ($page === 'account')
    require '../Pages/user/account.php';
else if ($page === 'user_upload')
    require '../Pages/user/user_upload.php';
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
if ($title === NULL)
    $title =  $_GET['p'];

require '../Pages/templates/footer.php';
$content = ob_get_clean();
print ($content);
?>