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

    public static function getImg($pseudo)
    {
     //   $val = '%' . str_replace('@', '%', $login);
        return (App::getDb()->getprepare("SELECT * FROM image INNER JOIN `user` WHERE user.id LIKE image.email AND user.pseudo LIKE ?", [$pseudo]));
    }

    public static function getAllImg()
    {
        return (App::getDb()->getquery("SELECT * FROM image INNER JOIN `user` WHERE user.id LIKE image.email"));
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
         //   die(var_dump($key2));
            $tab .= '<div class="column is-3"><div class="card"><div class="card-image"><figure class="image is-4by3"><a href="../Public/index.php?p=image">';
            $tab .= '<img src="data:image/jpeg;base64, ' . $key2['image'] . '" alt="Placeholder image"></a>';
            $tab .= '</figure></div><div class="card-content"><div class="media"><div class="media-left"><figure class="image is-48x48">';
            $tab .= '<img class="is-rounded" src="../vue/img/profil.jpg" alt="Placeholder image"></figure></div><div class="content">';
            $tab .= '<p class="title is-6"><a href="../Public/index.php?p=user_home&user=' . $key2['pseudo'] . '">' . $key2['pseudo'] . '</a></p><time datetime="2016-1-1">' . $key2['creation_date'] . '</time>';
            $tab .= '</div><a class="button is-link">Like</a></div></div></div></div>';
        }
        $tab .= '</div></div>';
        print ($tab);
    }

    public static function printHome($pseudo)
    {
        $tab = '
            <div class="box">
                  <div class="container">
                    <div class="box">
                      <article class="media">
                        <div class="media-left">
                          <figure class="image is-128x128">
                            <img class="is-rounded" src="../vue/img/profil.jpg" alt="Image">
                          </figure>
                        </div>
                        <div class="media-content">
                          <div class="content">
                            <p><strong>'. $pseudo . '</strong><br>
                              <a class="button is-warning is-outlined">Follower</a>
                              <br><br>
                              <span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                              </span>
                            </p>
                          </div>
                          <div class="tags are-large">
                            <span class="tag">Follower 666</span>
                            <span class="tag">Image 666</span>
                            <span class="tag">Like 666</span>
                          </div>
                        </div>
                      </article>
                    </div>
                  </div>';
        return ($tab);
    }
}
?>