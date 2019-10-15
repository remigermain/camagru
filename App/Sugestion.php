<?php

namespace App;
use       App\App;

class Sugestion
{
    public static function  User($text)
    {
        return (App::getDb()->getprepare("SELECT user.username, home.logo FROM user INNER JOIN `home` ON home.id = user.id WHERE username LIKE ? LIMIT 5", [$text]));
    }

    public static function  Category($text)
    {
        $val = App::getDb()->getprepare("SELECT * FROM category WHERE name LIKE ? LIMIT 5", [$text]);
        foreach ($val as $key => $key2)
        {
            if ($val[$key]['image'] == null)
            {
                $enco = base64_encode(file_get_contents(App::getPath("vue/img/notag.png")));
                $val[$key]['image'] = $enco;
            }
        }
        return ($val);
    }

    public static function  Title($text)
    {
        return (App::getDb()->getprepare("SELECT * FROM image WHERE title LIKE ? LIMIT 10", [$text]));
    }
}

?>