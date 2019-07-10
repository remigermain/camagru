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
        $cat = App::getDb()->getprepare("SELECT id FROM categorie WHERE id LIKE ?", [$cat]);
        $val = array("email" => $email_id[0][0], 
                    "img" => $img,
                    "date" => date("Y/m/d"),
                    "cat" => $cat);
        App::getDb()->setprepare("INSERT INTO image (email, `image`, `date`, categorie) VALUES(:email, :img, :date, :cat)", $val);
    }

    public static function getImg($pseudo, $order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getprepare("SELECT user.id, image.email, image.image, image.date, user.email, user.pseudo FROM image INNER JOIN `user` ON user.id = image.email WHERE user.pseudo LIKE ? " . $order, [$pseudo]));
    }

    public static function getAllImg($order = NULL)
    {
      if (!$order)
        $order = "ORDER BY image.id DESC";
      return (App::getDb()->getquery("SELECT user.id, image.email, image.image, image.date, user.email, user.pseudo FROM image INNER JOIN `user` WHERE user.id LIKE image.email ". $order));
    }

    public static function getHome($pseudo)
    {
    }

    public static function printImg($login)
    {
        $val = static::getImg($login);
        $tab = '  <div class="container"><div class="columns is-multiline">';
        foreach ($val as $key => $key2)
        {
            $tab .= '<div class="column is-3"><div class="card"><div class="card-image"><figure class="image is-4by3"><a href="../Public/index.php?p=image">';
            $tab .= '<img src="data:image/jpeg;base64, ' . $key2['image'] . '" alt="Placeholder image"></a>';
            $tab .= '</figure></div><footer class="card-footer"><p href="#" class="card-footer-item"><i class="material-icons">thumb_up_al</i>like</p>';
            if (App::sessionExist() && $_SESSION['pseudo'] == $login)
                $tab .= '<a href="#" class="card-footer-item">Delete</a></footer>';
            $tab .= '</div></div>';
        }
        $tab .= '</div></div>';
        print ($tab);
    }

    public static function printAllImg()
    {
        $tab = '  <div class="container"><div class="columns is-multiline">';
        $val = static::getAllImg();
        foreach ($val as $key => $key2)
        {
         // require '../Pages/templates/image_homepage.php';
         //   die(var_dump($key2));
            $tab .= '<div class="column is-3"><div class="card"><div class="card-image"><figure class="image is-4by3"><a href="../Public/index.php?p=image">';
            $tab .= '<img src="data:image/jpeg;base64, ' . $key2['image'] . '" alt="Placeholder image"></a>';
            $tab .= '</figure></div><div class="card-content"><div class="media"><div class="media-left"><figure class="image is-48x48">';
            $tab .= '<img class="is-rounded" src="../vue/img/profil.jpg" alt="Placeholder image"></figure></div><div class="content">';
            $tab .= '<p class="title is-6"><a href="../Public/index.php?p=user_home&user=' . $key2['pseudo'] . '">' . $key2['pseudo'] . '</a></p><time datetime="2016-1-1">' . $key2['date'] . '</time>';
            $tab .= '</div><a class="button is-link">Like</a></div></div></div></div>';
        }
        $tab .= '</div></div>';
        print ($tab);
    }

    public static function printHome($pseudo)
    {
      $image = "/../vue/img/profil.jpg";
      $follower = rand() % 666;
      $number = rand() % 666;
      $synopsis = "Au XIVe siècle, un bergsman (paysan libre qui outre ses activités agricoles produit aussi du fer) d'origine allemande nommé Englika établit un haut fourneau et une forge utilisant l'énergie des rapides de la rivière Snytenån (ou Snytsboån). Le village d'Englikobenning est né, et des bergsmän s'y succèdent pour gérer les fourneaux et les forges. La situation change à la fin du ";
      $like = rand() % 666;
      require '../Pages/templates/home.php';
    }
}
?>