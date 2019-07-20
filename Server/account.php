<?php

require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
use App\App;
use App\Error;
use App\Database;
use App\Image;
use App\User;
App::session();

function change_logo()
{
    $path = $_FILES["fileToUpload"]["tmp_name"];
    $img = file_get_contents($path);
    User::changeLogo(base64_encode($img));
}

if(isset($_POST["submit"]))
{
    if($_POST['submit'] == "changepass")
        User::changePassword($_POST['oldpassword'], $_POST['newpassword'], $_POST['confpassword']);
    else if($_POST['submit'] == "profil")
    {
        if ($_POST['username'] == $_SESSION['username'] &&
        $_POST['email'] == $_SESSION['mail'] && !isset($_POST['logo']))
            print(json_encode(array("status" => -1)));
        if ($_POST['email'] !== $_SESSION['mail'])
            User::changeMail($_POST['email']);
        if ($_POST['username'] !== $_SESSION['username'])
            User::changeusername($_POST['username']);
        if (isset($_POST['logo']))
            change_logo();
    }
    else if($_POST['submit'] == "notif")
        User::changeNotify($_POST['follow'], $_POST['comment'], $_POST['like']);
    else
        Error::wrongRequest();
}
else
    Error::wrongRequest();
?>