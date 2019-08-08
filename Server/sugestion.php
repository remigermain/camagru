<?php
require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
use App\Error;
use App\Image;
use App\Sugestion;
use App\App;


if(isset($_POST) && isset($_POST["submit"]) && isset($_POST["sugestion"]))
{
    $text = trim($_POST['sugestion']);
    $new_text = "%" . substr($text, 1) . "%";
    $type = "other";
    $val = NULL;
    if (strlen($text) <= 0 || (strlen($text) == 1 && ($text[0] == "@" || $text[0] == "#")))
            $type = "help";
    else if (substr($text, 0, 1) == "@")
    {
        $val = Sugestion::User($new_text);
        $type = "user";
    }
    else if (substr($text, 0, 1) == "#")
    {
        $val = Sugestion::Category($new_text);
        $type = "category";
    }
    else
        $val = Sugestion::Title($new_text);
    App::createJson($val, 1, "type", $type);
}
else
    Error::wrongRequest();
?>