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
        $val = array("email" => $email_id[0][0], "img" => $img, "date" => date("Y/m/d H:i"), "cat" => $cat);
        App::getDb()->setprepare("INSERT INTO image (`user_id`, `image`, `date`, category) VALUES(:email, :img, :date, :cat)", $val);
    }
    
    public static function getImgById($id)
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
      return (App::getDb()->getquery("SELECT user.id, user.pseudo, image.id as image_id, image.title, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category LIKE category.id ". $order));
    }

    public static function updateImage($id, $synopsis, $title)
    {
      if (!APP::sessionExist())
        Error::notAccess();
      return (App::getDb()->setprepare("UPDATE image SET synopsis = :sys , title = :title  WHERE image.id LIKE :id", array("id" => $id, "sys" => $synopsis, "title" => $title)));
    }

    public static function updateHome($synopsis)
    {
      if (!APP::sessionExist())
        Error::notAccess();
      return (App::getDb()->setprepare("UPDATE home INNER JOIN user ON home.id = user.id SET synopsis = :sys WHERE user.pseudo = :id", array("id" => $_SESSION['pseudo'], "sys" => $synopsis)));
    }


    public static function removeImage($id)
    {
      if (!APP::sessionExist())
        Error::notAccess();
      return (App::getDb()->setprepare("DELETE FROM image WHERE id LIKE :id_image AND user_id LIKE :user_id", array("id_image" => $id, "user_id" => $_SESSION['id'])));
    }

    public static function userLikeImage($id_image)
    {
      if (!APP::sessionExist())
        return (false);
      $val = array("image_id" => $id_image, "user_pseudo" => $_SESSION['pseudo']);
      return (App::getDb()->getprepare("SELECT COUNT(*) as bool FROM `like` INNER JOIN user ON user.id = `like`.`user_id` WHERE `like`.image_id = :image_id AND user.pseudo = :user_pseudo", $val, true)['bool']);
    }

    public static function subSynopsis($sys)
    {
      if (is_null($sys))
        return ("No synopsis");
      $str = substr($sys, 0, 90);
      if (strlen($sys) > 90)
        $str .= "...";
      else if (substr($sys, -1) != '.')
        $str .= ".";
      return (App::printString($str));
    }

    public static function subTitle($title)
    {
      if (is_null($title))
        return ("No Title");
      $str = substr($title, 0, 20);
      if (strlen($title) > 20)
        $str .= "...";
      return (App::printString($str));
    }
}
?>