<?php
require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
use App\App;
use App\Error;
use App\User;
use App\Image;


var_dump($_POST);

if (isset($_POST) && isset($_POST['methode']))
{
    if ($_POST['methode'] == "home")
        Image::updateHome($_POST['sys']);
    else if ($_POST['methode'] == "image")
        Image::updateImage($_POST['id'], $_POST['sys'], $_POST['title']);
    else if ($_POST['methode'] == "delete")
        Image::removeImage($_POST['id']);
}
else
    return (Error::wrongRequest());
?>