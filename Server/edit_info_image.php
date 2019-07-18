<?php
require '../App/Autoloader.php';
use App\Autoloader;
use App\Error;
use App\Image;
Autoloader::register();

if (isset($_POST) && isset($_POST['submit']))
{
    if ($_POST['submit'] == "home")
        Image::updateHome($_POST['sys']);
    else if ($_POST['submit'] == "image")
        Image::updateImage($_POST['id'], $_POST['sys'], $_POST['title']);
    else if ($_POST['submit'] == "delete")
        Image::removeImage($_POST['id']);
}
else
    Error::wrongRequest();
?>