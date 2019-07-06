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
else if ($page === 'login')
    require '../Pages/login.php';
else if ($page === 'account')
    require '../Pages/user/account.php';
else if ($page === 'account_images')
    require '../Pages/user/account_images.php';
else if ($page === 'account_home')
    require '../Pages/user/account_home.php';
else if ($page === 'admin_account')
    require '../Pages/admin/admin_account.php';
else if ($page === 'admin_tools')
    require '../Pages/admin/admin_tools.php';
else if ($page === 'admin_home')
    require '../Pages/admin/admin_home.php';
else if ($page === 'image')
    require '../Pages/image.php';
else
    require '../Pages/error.php';
require '../Pages/templates/footer.php';

$content = ob_get_clean();

require '../Pages/templates/default.php'

?>