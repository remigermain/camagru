<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;
use       App\User;

class Notification
{
    public static function sendMail($mail, $sub, $msg)
    {
        $val = 'From: webmaster@camagru.com' . "\r\n" .
                'Reply-To: webmaster@camagru.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
       // App::createJson(mail($mail, $sub, $msg, $val) ? "mail true" : "mail false");
    }

    public static function newImage($username, $mail, $image_id)
    {
        App::session();
        $link = App::path() . "Public/index.php?p=image&id=" . $image_id;
        $msg =  "<html>Hi " . $username . ", <br><br>" . $_SESSION['username'] . 
                "</div>have post new image !<br>" .
                "<a href=\"" . $link . "\"> Image link </a>Link</html>";
        self::sendMail($mail,  $_SESSION['username'] . " have poste new image", $msg);
    }

    public static function newLike($username, $mail, $image_id)
    {
        App::session();
        $link = App::path() . "Public/index.php?p=image&id=" . $image_id;
        $user_link = App::path() . "Public/index.php?p=user_home&user=" . $_SESSION['username'];
        $msg =  "<html>Hi " . $username . ", <br><br><a href=\"" . $user_link . ">" . $_SESSION['username'] . "</a>" .
                "</div>have like your image !<br>" .
                "<a href=\"" . $link . "\"> Image link </a>Link</html>";
        self::sendMail($mail,  $_SESSION['username'] . " have like your image", $msg);
    }

    public static function newComment($username, $mail, $image_id, $msg)
    {
        App::session();
        $link = App::path() . "Public/index.php?p=user_home&user=". $_SESSION['username'];
        $msg =  "<html>Hi " . $username . ", <br><br>" . $_SESSION['username'] . 
                "</div>have comment your image !<br>" .
                "<h3>" . $msg . "</h3>" .
                "<a href=\"" . $link . "\"> Image link </a>Link</html>";
        self::sendMail($mail,  $_SESSION['username'] . " have comment your image", $msg);
    }

    public static function newFollow($username, $mail, $userid)
    {
        App::session();
        $link = App::path() . "Public/index.php?p=user_home&id=" . $userid;
        $msg =  "<html>Hi " . $username . ", <br><br>" . $_SESSION['username'] . 
                "</div>have follow you !<br>" .
                "<a href=\"" . $link . "\">" . $_SESSION['username'] . "home pages </a>Link</html>";
        self::sendMail($mail,  $_SESSION['username'] . " have follow you!", $msg);
    }

    public static function mailRegister($mail, $token, $login)
    {
        $link = App::path() . "Public/index.php?p=connection&token=\"" . $token . 
                "&mail=" . $mail;
        $msg = "<img src=\"../vue/img/logo.png\">";
        $msg .= "<html>Hi " . $login . ", welcom to Camagru !<br><br>" .
                "You need to valid account to login you. <br>" .
                "<a href=\"" . $link .
                "\">" . $link . "</a>" . $token . "</html>";
        self::sendMail($mail, "Validation account", $msg);
    }   
}

?>