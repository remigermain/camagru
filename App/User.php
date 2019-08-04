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
        $info = App::getDb()->getprepare("SELECT * FROM user INNER JOIN home ON home.id = user.id WHERE user.username = ?", [$login], true);
        $follower = App::getDb()->getprepare("SELECT COUNT(*) as follower FROM follower INNER JOIN user ON user.id = follower.user_id WHERE user.username = ?", [$login], true);
        $like = App::getDb()->getprepare("SELECT COUNT(*) as `like` FROM `like` INNER JOIN image ON `like`.`image_id` = image.id INNER JOIN user ON user.id = image.user_id WHERE user.username = ?", [$login], true);
        $image_nb = App::getDb()->getprepare("SELECT COUNT(*) as `image_nb` FROM `image` INNER JOIN user ON user.id = image.user_id WHERE user.username = ?", [$login], true);
        $notif = App::getDb()->getprepare("SELECT * FROM notification WHERE id = ?", [static::getUserId($login)], true) ;
        $info['nb_image'] = $image_nb['image_nb'];
        $info['follower'] = $follower['follower'];
        $info['like'] = $like['like'];
        $info['notif'] = $notif;
        return ($info);
    }

    static Public function getUserId($username)
    {
        return (App::getDb()->getprepare("SELECT id FROM user WHERE user.username = ?", [$username], true)['id']);
    }

    static Public function changeMail($new_mail)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            App::session();
            $val = array("new_mail" => $new_mail, "old_email" => $_SESSION['mail']);
            if (!App::getDb()->getprepare("SELECT user.email FROM user WHERE user.email = ?", [$new_mail]))
            {
                App::getDb()->setprepare("UPDATE `user` SET email = :new_mail WHERE email = :old_email", $val);
                $_SESSION['mail'] = $new_mail;
                App::createJson("Mail has changed.");
            }
            else
                Error::mail_Exist($new_mail);
        }
    }   

    static Public function changeusername($new_username)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            App::session();
            if (strlen($new_username) <= 6)
                return (Error::createJson("username must be higher 6 character"));
            $val = array("new_username" => $new_username, "old_username" => $_SESSION['username']);
            if (!App::userExist($new_username))
            {
                App::getDb()->setprepare("UPDATE `user` SET username = :new_username WHERE username = :old_username", $val);
                $_SESSION['username'] = $new_username;
                App::createJson("Username has changed.");
            }
            else
                Error::username_Exist($new_username);
        }
    }

    static Public function changePassword($old_pass, $new_pass, $conf_pass)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            if ($new_pass !== $conf_pass)
                return (Error::not_samePass());
            App::session();
            $val = array("old_pass" => hash('whirlpool', $old_pass), "email" => $_SESSION['mail']);
            if (App::getDb()->getprepare("SELECT * FROM user WHERE email = :email AND pass = :old_pass", $val))
            {
                $val = array("old_pass" => hash('whirlpool', $old_pass), "new_pass" => hash('whirlpool', $new_pass), "email" => $_SESSION['mail']);
                App::getDb()->setprepare("UPDATE `user` SET pass = :new_pass WHERE email = :email AND pass = :old_pass", $val);
                App::createJson("Password has changed.");
            }
            else
                Error::createJson("Your old password not like this!");
        }
    }

    static Public function changeLogo($img)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            App::session();
            $val = array("img" => $img, "email" => $_SESSION['mail']);
            if (App::getDb()->setprepare("UPDATE `home` INNER JOIN `user` ON home.id = user.id SET home.logo = :img WHERE user.email = :email", $val))
                App::createJson("Profils image as changed!");
            else
                Error::wrongRequest();
        }
    }

    static public function changeNotify($follow, $comment, $like)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            $val = array("follow" => $follow, "comment" => $comment, "nlike" => $like, "id" => static::getUserId($_SESSION['username']));
            APP::getDB()->setprepare("UPDATE notification SET notiffollow = :follow , notifcomment = :comment , notiflike = :nlike WHERE id = :id", $val);
            App::createJson("Notification as changed!");
        }
    }

    static Public function UserFollowUser($username, $username2)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            $user1 = User::getUserId($username);
            $user2 = User::getUserId($username2);
            $val = array("follower" => $user1, "user_id" => $user2);
            return (App::getDb()->getprepare("SELECT COUNT(*) as count FROM `follower` WHERE user_id = :user_id AND follower = :follower", $val, true)['count']);
        }
    }

    static Public function userFollow($username)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            App::session();
            $id_follower = User::getUserId($username);
            if ($id_follower == $_SESSION['id'])
                Error::stringError("You can't follow you !");
            {
                $val = array("follower" => $_SESSION['id'], "user_id" => $id_follower);
                $ret = App::getDb()->getprepare("SELECT COUNT(*) as count FROM `follower` WHERE user_id = :user_id AND follower = :follower", $val, true)['count'];
                if (intval($ret))
                    App::getDb()->setprepare("DELETE FROM follower WHERE user_id = :user_id AND follower = :follower", $val);
                else
                    App::getDb()->setprepare("INSERT INTO follower (user_id, follower) VALUES(:user_id, :follower)", $val);
                App::createJson("Modification success!");
            }
        }
    }

    static Public function userLikeImage($id_image)
    {
        if (!App::sessionExist())
            Error::notAccess();
        else
        {
            App::session();
            $val = array("user_id" => $_SESSION['id'], "image_id" => $id_image);
            $ret = Image::userLikeImage($id_image);
            if ($ret)
                App::getDb()->setprepare("DELETE FROM `like` WHERE user_id = :user_id AND image_id = :image_id", $val);
            else
                App::getDb()->setprepare("INSERT INTO `like` (user_id, image_id) VALUES(:user_id, :image_id)", $val);
            App::createJson("Modification success!");
        }
    }
}
?>