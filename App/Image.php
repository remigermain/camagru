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
        $email_id = App::getDb()->getprepare("SELECT id FROM user WHERE email = ?", [$_SESSION['login']]);
        $cat = App::getDb()->getprepare("SELECT id FROM category WHERE id = ?", [$cat]);
        $val = array("email" => $email_id[0][0], "img" => $img, "date" => date("Y/m/d H:i"), "cat" => $cat);
        App::getDb()->setprepare("INSERT INTO image (`user_id`, `image`, `date`, category) VALUES(:email, :img, :date, :cat)", $val);
    }
    
    public static function getImgById($id)
    {
      return (App::getDb()->getprepare("SELECT user.id, user.username, image.id as image_id, image.title, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category = category.id WHERE image.id = ? ", [$id], true));
    }

    public static function getUserImg($username, $order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getprepare("SELECT user.id, user.username, image.id as image_id, image.title, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category = category.id WHERE user.username = ? " . $order, [$username]));
    }

    public static function getAllImg($order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getquery("SELECT user.id, user.username, image.id as image_id, image.title, image.image, image.synopsis, image.date, home.logo, category.name as category FROM user INNER JOIN image ON user.id = image.user_id INNER JOIN home ON user.id = home.id INNER JOIN category ON image.category = category.id ". $order));
    }

    public static function updateImage($id, $synopsis, $title)
    {
      if (!APP::sessionExist())
        Error::notAccess();
      if (App::getDb()->setprepare("UPDATE image SET synopsis = :sys , title = :title  WHERE image.id = :id", array("id" => $id, "sys" => $synopsis, "title" => $title)))
        App::createJson("Modification success!");
      else
        Error::wrongRequest();
    }

    public static function updateHome($synopsis)
    {
      if (!APP::sessionExist())
        Error::notAccess();
      if (App::getDb()->setprepare("UPDATE home INNER JOIN user ON home.id = user.id SET synopsis = :sys WHERE user.username = :id", array("id" => $_SESSION['username'], "sys" => $synopsis)))
        App::createJson("Modification success!");
      else
        Error::wrongRequest();
    }


    public static function removeImage($id)
    {
      if (!APP::sessionExist())
        Error::notAccess();
      if (App::getDb()->setprepare("DELETE FROM image WHERE id = :id_image AND user_id = :user_id", array("id_image" => $id, "user_id" => $_SESSION['id'])))
        App::createJson("Image as deleted");
      else
        Error::wrongRequest();
    }

    public static function userLikeImage($id_image)
    {
      if (!APP::sessionExist())
        return (false);
      $val = array("image_id" => $id_image, "user_username" => $_SESSION['username']);
      return (App::getDb()->getprepare("SELECT COUNT(*) as bool FROM `like` INNER JOIN user ON user.id = `like`.`user_id` WHERE `like`.image_id = :image_id AND user.username = :user_username", $val, true)['bool']);
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