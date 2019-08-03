<?php
require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
use App\App;
use App\Error;
use App\Database;
use App\Image;

if(isset($_POST["submit"]))
{
    if (isset($_POST['cat']))
        $cat = $_POST['cat'];
    else
        $cat = 0;
   $path = $_FILES["fileToUpload"]["tmp_name"];
   $img = file_get_contents($path);
   $data = base64_encode($img);
    Image::uploadImg($data, $cat);
    header('Location:/Public/index.php?p=user_images');
}
else
    Error::notFound();
?>