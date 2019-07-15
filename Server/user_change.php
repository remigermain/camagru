<?php

require '../App/Autoloader.php';
use     App\Autoloader;
Autoloader::register();
//include 'require.php';
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
    if($_POST['submit'] == "change_password")
        User::changePassword($_POST['oldpassword'], $_POST['newpassword'], $_POST['confpassword']);
    else if($_POST['submit'] == "change_email")
        User::changeMail($_POST['email']);
    else if($_POST['submit'] == "change_pseudo")
        User::changePseudo($_POST['pseudo']);
    else if($_POST['submit'] == "change_logo")
        change_logo();
    else
        Error::notFound();
}
else
    Error::notFound();
header('Location:/Public/index.php?p=user_home&user=' . $_SESSION['pseudo']);
?>