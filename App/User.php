<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;
use       App\Image;

class User
{
    static Public function getUserInfo($login)
    {
        return (sizeof(Image::getUserImg($login)));
    }
}
?>