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
    if (strlen($text) <= 0)
        return App::createJson(null, 1, "type", "help");
    if ($text[0] == "@")
    {
        $type = "user";
        $text = substr($text, 1);
    }
    else if ($text[0] == "#")
    {
        $type = "category";
        $text = substr($text, 1);
    }
    else
    {
        $type = "other";
        $mode = 0;
    }
    $new_text = "%" . str_replace("%", "\\%", $text) . "%";
    $val = NULL;
    if (strlen($text) <= 0)
        $type = "help";
    else if ($type == "user")
        $val = Sugestion::User($new_text);
    else if ($type == "category")
        $val = Sugestion::Category($new_text);
    else
        $val = Sugestion::Title($new_text);
    App::createJson($val, 1, "type", $type);
}
else
    Error::wrongRequest();
?>