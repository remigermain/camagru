<?php
//   check login form //
require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
//include 'require.php';
use App\App;
use App\Error;
use App\Database;
use App\Connection;
//var_dump("gergrgerge");
//print(json_encode($_POST));
//return ;
if (isset($_POST) && isset($_POST['submit']))
{
    if ($_POST['submit'] === 'login')
        Connection::login();
    else if ($_POST['submit'] === 'register' )
        Connection::register();
    else if ($_POST['submit'] === 'logout')
        Connection::logout();
    else if ($_POST['submit'] === 'forgot')
        Connection::newPassword($_POST['email']);
    else
        Error::wrongRequest();
}
else
    Error::wrongRequest();
?>