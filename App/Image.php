<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;

class Image
{

    public static function uploadImg($img, $cat, $title, $synopsis)
    {
      App::session();
      if (!APP::sessionExist())
        Error::notAccess();
      else
      {
        $cat = App::getDb()->getprepare("SELECT id FROM category WHERE id = ?", [$cat]);
        $val = array("id" => $_SESSION['id'], "img" => $img, "date" => date("Y/m/d H:i"), "cat" => $cat[0]['id'], "title" => $title, "synopsis" => $synopsis);
        if (App::getDb()->setprepare("INSERT INTO image (`user_id`, `image`, `date`, category, title, synopsis) VALUES(:id, :img, :date, :cat, :title, :synopsis)", $val))
        {
          $info = User::getUserInfo(Image::getImgById($id_image)['username']);
          Notification::newImage($info['username'], $info['email'], $id_image);
          App::createJson("upload success!");
        }
        else
          Error::server();
      }
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
      App::session();
      if (!APP::sessionExist())
        Error::notAccess();
      else if (App::getDb()->setprepare("UPDATE image SET synopsis = :sys , title = :title  WHERE image.id = :id", array("id" => $id, "sys" => $synopsis, "title" => $title)))
        App::createJson("Modification success!");
      else
        Error::server();
    }

    public static function updateHome($synopsis)
    {
      App::session();
      if (!APP::sessionExist())
        Error::notAccess();
      else
      {
        $val = array("sys" => $synopsis, "id" => $_SESSION['id']);
        if (App::getDb()->setprepare("UPDATE home INNER JOIN user ON home.id = user.id SET synopsis = :sys WHERE user.id = :id", $val))
          App::createJson("Modification success!");
        else
          Error::server();
      }
    }


    public static function removeImage($id)
    {
      App::session();
      if (!APP::sessionExist())
        Error::notAccess();
      else
      {
        $array = array("id_image" => $id, "user_id" => $_SESSION['id']);
        if (App::getDb()->getprepare("SELECT COUNT(*) as count FROM image WHERE id = :id_image AND user_id = :user_id", $array, true)['count'])
        {
          if (App::getDb()->setprepare("DELETE FROM image WHERE id = :id_image AND user_id = :user_id", $array))
            App::createJson("Image as deleted");
          else
            Error::server();
        }
        else
          Error::server();
      }
    }

    public static function userLikeImage($id_image)
    {
      App::session();
      if (APP::sessionExist())
      {
        $val = array("image_id" => $id_image, "user_username" => $_SESSION['username']);
        return (App::getDb()->getprepare("SELECT COUNT(*) as bool FROM `favorite` INNER JOIN user ON user.id = `favorite`.`user_id` WHERE `favorite`.image_id = :image_id AND user.username = :user_username", $val, true)['bool']);
      }
      return (NULL);
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