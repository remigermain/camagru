<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;
use       App\Notification;

class Connection
{
    private static function find_user($email, $pass = null, $pseudo = null)
    {
        if ($pseudo)
            return (APP::getDB()->getprepare("SELECT email, pseudo FROM user WHERE email LIKE ? OR pseudo LIKE ?", array($email, $pseudo), true));
        else
            return (APP::getDB()->getprepare("SELECT email, pass FROM user WHERE email LIKE ? AND pass LIKE ?", array($email, $pass), true));
    }

    private static function getPseudo($email)
    {
        return (APP::getDB()->getprepare("SELECT email, pseudo FROM user WHERE email LIKE ?", [$email], true));
    }
    
    private static function getIdPseudo($email)
    {
        return (APP::getDB()->getprepare("SELECT id FROM user WHERE email LIKE ?", [$email], true));
    }
    
    public static function login()
    {
        if (static::find_user($_POST['email'], hash('whirlpool', $_POST['password'])))
        {
            App::session();
            $_SESSION['login'] = $_POST['email'];
            $_SESSION['pseudo'] = static::getPseudo($_POST['email'])['pseudo'];
            $_SESSION['id'] = static::getIdPseudo($_POST['email'])['id'];
            header('Location:/Public/index.php');
        }
        else
            Error::user_notvalid();
    }
    
    public static function logout()
    {
        App::session();
        unset($_SESSION['login']);
        unset($_SESSION['pseudo']);
        unset($_SESSION['id']);
        session_destroy();
        header('Location:/Public/index.php?p=home');
    }

    public static function register($valid = "1")
    {
        if (!static::find_user($_POST['email'], NULL, $_POST['pseudo']) && $_POST['password'] === $_POST['confpassword'])
        {
            $val = array(
                "pseudo" => $_POST['pseudo'],
                "email" => $_POST['email'],
                "pass" => hash('whirlpool', $_POST['password']),
                "creation_date" => date("Y/m/d H:i"),
                "valid" => $valid);
            APP::getDB()->setprepare("INSERT INTO user (pseudo, email, pass, creation_date, valid) VALUE(:pseudo, :email, :pass, :creation_date, :valid)", $val);
            $val = array(
                "sys" => "No synopis",
                "logo" => base64_encode(file_get_contents(App::getPath("vue/img/profil.png"))));
            APP::getDB()->setprepare("INSERT INTO home (synopsis, logo) VALUE(:sys, :logo)", $val);
            header('Location:/Public/index.php?p=connection');
        }
        else
            Error::user_notvalid();
    }

    public static function newPassword($mail)
    {
        $ret = App::getDb()->getprepare("SELECT * FROM user WHERE user.email = ?", [$mail], true);
        if (!$ret)
            Error::user_notvalid();
        else
        {
            $pass = APP::generatePassword();
            $val = array("new_pass" => hash('whirlpool', $pass), "email" => $mail);
            App::getDB()->setprepare("UPDATE user SET user.pass = :new_pass WHERE user.email LIKE :email", $val);
            $msg = "Hi ". $ret['pseudo'] . ", " . "<br />Your new password is ". $pass . "<br /><br />Camagru.";
            Notification::sendMail($mail, "[Camagru] Reset Password", $msg);
        }
    }
}

?>