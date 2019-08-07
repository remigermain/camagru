<?php
require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
use App\Error;
use App\Image;

if(isset($_POST) && isset($_POST["submit"])
&& isset($_POST["title"]) && isset($_POST["synopsys"]) && isset($_POST["image"]))
{
    $cat = 0;
    if (isset($_POST['cat']))
        $cat = $_POST['cat'];
    $path = $_FILES["fileToUpload"]["tmp_name"];
    $img = base64_encode(file_get_contents($path));
    Image::uploadImg($img, $cat, $_POST['title'], $_POST['synopsys']);
}
else
    Error::wrongRequest();
?>