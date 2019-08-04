<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;
use       App\User;

class Notification
{


    private static function sendNotif($str, $url)
    {

    }

    public static function newImage()
    {

    }

    public static function newLike($username)
    {
    }

    public static function newComment($username, $image_id)
    {

    }

    public static function sendMail($mail, $sub, $msg)
    {
        $val = 'From: webmaster@camagru.com' . "\r\n" .
                'Reply-To: webmaster@camagru.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        mail($mail, $sub, $msg, $val);
    }

    public static function mailRegister($mail, $token, $login)
    {
        $link = $_SERVER['HTTP_ORIGIN'] . "/Public/index.php?p=connection&token=\"" . $token . 
                "&mail=" . $mail;
        $msg = "<html>Hi " . $login . ", welcom to Camagru !<br><br>" .
                "You need to valid account to login you. <br>" .
                "<a href=\"" . $link .
                "\">" . $link . "</a>" . $token . "</html>";
        self::sendMail($mail, "Validation account", $msg);
    }   
}

?>