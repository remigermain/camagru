<?php
require '../App/Autoloader.php';
use App\Autoloader;
use App\Error;
use App\Image;
use App\User;
use App\App;
Autoloader::register();
if (!App::sessionExist())
    return (Error::noSession("Follow it."));
if (isset($_POST) && isset($_POST['methode']))
{
    if ($_POST['methode'] == "follow")
        User::userFollow($_POST['id']);
    else if ($_POST['methode'] == "like")
        Image::imageLike($_POST['id']);
    else
        return (Error::wrongRequest());
}
else
    return (Error::wrongRequest());
?>