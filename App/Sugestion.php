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
        return (App::getDb()->getprepare("SELECT * FROM category WHERE name LIKE ? LIMIT 5", [$text]));
    }

    public static function  Title($text)
    {
        return (App::getDb()->getprepare("SELECT * FROM image WHERE title LIKE ? LIMIT 10", [$text]));        
    }
}

?>