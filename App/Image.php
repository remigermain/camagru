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
      return (App::getDb()->getprepare("SELECT user.id, user.pseudo, image.id as image_id, image.title, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category LIKE category.id WHERE image.id LIKE ? ", [$id], true));
    }

    public static function getUserImg($pseudo, $order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getprepare("SELECT user.id, user.pseudo, image.id as image_id, image.title, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category LIKE category.id WHERE user.pseudo LIKE ? " . $order, [$pseudo]));
    }

    public static function getAllImg($order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getquery("SELECT user.id, user.pseudo, image.id as image_id, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category LIKE category.id ". $order));
    }

    public static function synopsis($sys)
    {
      if (is_null($sys))
        return ("No synopsis");
      $str = substr($sys, 0, 90);
      if (strlen($sys) > 90)
        $str .= "...";
      else if (substr($sys, -1) != '.')
        $str .= ".";
      return ($str);
    }
}
?>