<?php
require '../App/Autoloader.php';
use App\Autoloader;
use App\Error;
use App\Image;
use App\User;
use App\Comment;
use App\App;
Autoloader::register();
if (!App::sessionExist())
{
    if ($_POST['submit'] == "follow")
        return (Error::noSession("Follow user!"));
    else if ($_POST['submit'] == "like")
        return (Error::noSession("like this photos!"));
    else if ($_POST['submit'] == "comment")
        return (Error::noSession("Comment photos!"));
}
if (isset($_POST) && isset($_POST['submit']))
{
    if ($_POST['submit'] == "follow")
        User::userFollow($_POST['id']);
    else if ($_POST['submit'] == "like")
        User::userLikeImage($_POST['id']);
    else if ($_POST['submit'] == "comment")
        Comment::commentImage($_POST['id'], $_POST['comment']);
    else
        return (Error::wrongRequest());
}
else
    return (Error::wrongRequest());
?>