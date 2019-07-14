<?php

use App\App;
namespace App;

class Comment
{

    public static function getCommentImage($id_image)
    {
        return (App::getDb()->getprepare("SELECT user.pseudo, home.logo, comment.* FROM `comment` INNER JOIN user ON user.id = comment.user_id INNER JOIN image ON image.id = comment.image INNER JOIN home ON user.id = home.id WHERE image.id = ?", [$id_image]));
    }
}

?>