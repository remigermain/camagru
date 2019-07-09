<!--    check login form  --->
<?php
require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
//include 'require.php';
use App\App;
use App\Error;
 use App\Database;
use App\Connection;

if (isset($_POST) && isset($_POST['submit']))
{
    if ($_POST['submit'] === 'login')
        Connection::login();
    else if ($_POST['submit'] === 'register' )
        Connection::register();
    else if ($_POST['submit'] === 'logout')
        Connection::logout();
    else
        Error::wrongPost();
}
else
    Error::wrongPost();
?>
<h1>dddd</h1>