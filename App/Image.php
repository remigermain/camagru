<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;

class Image
{

    public static function uploadImg($img, $cat)
    {
        App::session();
        $email_id = App::getDb()->getprepare("SELECT id FROM user WHERE email LIKE ?", [$_SESSION['login']]);
        $cat = App::getDb()->getprepare("SELECT id FROM categorie WHERE id LIKE ?", [$cat]);
        $val = array("email" => $email_id[0][0], 
                    "img" => $img,
                    "date" => date("Y/m/d"),
                    "cat" => $cat);
        App::getDb()->setprepare("INSERT INTO image (email, `image`, `date`, categorie) VALUES(:email, :img, :date, :cat)", $val);
    }
}
?>