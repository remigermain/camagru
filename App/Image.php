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
        $cat = App::getDb()->getprepare("SELECT id FROM category WHERE id LIKE ?", [$cat]);
        $val = array("email" => $email_id[0][0], "img" => $img, "date" => date("Y/m/d"), "cat" => $cat);
        App::getDb()->setprepare("INSERT INTO image (`user_id`, `image`, `date`, category) VALUES(:email, :img, :date, :cat)", $val);
    }
    
    public static function getImgId($id)
    {
      return (App::getDb()->getprepare("SELECT user.id, image.user_id, image.image, image.date, image.id as image_id, image.synopsis, user.email, user.pseudo FROM image INNER JOIN `user` ON user.id = image.user_id WHERE image.id LIKE ? ", [$id]));
    }

    public static function getUserImg($pseudo, $order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getprepare("SELECT user.id, image.user_id, image.image, image.date, image.id as image_id, user.email, user.pseudo FROM image INNER JOIN `user` ON user.id = image.user_id WHERE user.pseudo LIKE ? " . $order, [$pseudo]));
    }

    public static function getAllImg($order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getquery("SELECT user.id, user.email, user.pseudo, image.user_id, image.image, image.date, image.id as image_id, image.title, image.synopsis  FROM image INNER JOIN `user` WHERE user.id LIKE image.user_id ". $order));
    }

    public static function synopsis($sys)
    {
      $str = substr($sys, 0, 90);
      if (strlen($sys) > 90)
        $str .= "...";
      else if (substr($sys, -1) != '.')
        $str .= ".";
      return ($str);
    }
}
?>