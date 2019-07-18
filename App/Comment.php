<?php

use App\App;
namespace App;

class Comment
{

    public static function getCommentImage($id_image)
    {
        return (App::getDb()->getprepare("SELECT user.username, home.logo, comment.* FROM `comment` INNER JOIN user ON user.id = comment.user_id INNER JOIN image ON image.id = comment.image INNER JOIN home ON user.id = home.id WHERE image.id = ? ORDER BY comment.id DESC", [$id_image]));
    }

    static public function commentImage($id_image, $comment)
    {
        if (!App::sessionExist())
            Error::notAccess();
        $val = array("user_id" => $_SESSION['id'], "id_image" => $id_image, "date" => date("Y/m/d H:i"), "comment" => $comment);
        App::getDb()->setprepare("INSERT INTO comment (user_id, `image`, `date`, comment) VALUES(:user_id, :id_image, :date, :comment)", $val);
        print(json_encode(array("user_name" => $_SESSION['username'])));
    }

}

?>