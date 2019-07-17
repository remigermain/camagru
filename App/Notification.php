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

    public static function message($str)
    {
        print ($str);
    }
}

?>