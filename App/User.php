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
        return (App::getDb()->getprepare("SELECT * FROM user INNER JOIN home ON home.id = user.id WHERE user.pseudo LIKE ?", [$login], true));
    }

    static Public function changeMail($new_mail)
    {
        App::session();
        $val = array("new_mail" => $new_mail, "old_email" => $_SESSION['login']);
        App::getDb()->setprepare("UPDATE `user` SET email = :new_mail WHERE email LIKE :old_email", $val);
        $_SESSION['login'] = $new_mail;
    }

    static Public function changePseudo($new_pseudo)
    {
        App::session();
        $val = array("new_pseudo" => $new_pseudo, "old_pseudo" => $_SESSION['pseudo']);
        App::getDb()->setprepare("UPDATE `user` SET pseudo = :new_pseudo WHERE pseudo LIKE :old_pseudo", $val);
        $_SESSION['pseudo'] = $new_pseudo;
    }

    static Public function changePassword($old_pass, $new_pass, $conf_pass)
    {
        App::session();
        $val = array("old_pass" => $old_pass, "new_pass" => $new_pass, "email" => $_SESSION['login']);
        App::getDb()->setprepare("UPDATE `user` SET password = :new_pass WHERE email LIKE :email AND password LIKE :old_password", $val);
    }

    static Public function changeLogo($img)
    {
        App::session();
        $val = array("img" => $img, "email" => $_SESSION['login']);
        App::getDb()->setprepare("UPDATE `home` INNER JOIN `user` ON home.id = user.id SET home.logo = :img WHERE user.email LIKE :email", $val);
    }
}
?>