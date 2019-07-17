<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;
use       App\Notification;

class Connection
{
    private static function find_user($email, $pass = null, $username = null)
    {
        if ($username)
            return (APP::getDB()->getprepare("SELECT email, username FROM user WHERE email LIKE ? OR username LIKE ?", array($email, $username), true));
        else
            return (APP::getDB()->getprepare("SELECT email, pass FROM user WHERE email LIKE ? AND pass LIKE ?", array($email, $pass), true));
    }

    private static function getusername($email)
    {
        return (APP::getDB()->getprepare("SELECT email, username FROM user WHERE email LIKE ?", [$email], true));
    }
    
    private static function getIdusername($email)
    {
        return (APP::getDB()->getprepare("SELECT id FROM user WHERE email LIKE ?", [$email], true));
    }
    
    public static function login()
    {
        if (static::find_user($_POST['email'], hash('whirlpool', $_POST['password'])))
        {
            App::session();
            $_SESSION['mail'] = $_POST['email'];
            $_SESSION['username'] = static::getusername($_POST['email'])['username'];
            $_SESSION['id'] = static::getIdusername($_POST['email'])['id'];
            header('Location:/Public/index.php');
        }
        else
            Error::user_notvalid();
    }
    
    public static function logout()
    {
        App::session();
        unset($_SESSION['mail']);
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        session_destroy();
        header('Location:/Public/index.php?p=home');
    }

    public static function register($valid = "1")
    {
        if (!static::find_user($_POST['email'], NULL, $_POST['username']) && $_POST['password'] === $_POST['confpassword'])
        {
            $val = array(
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "pass" => hash('whirlpool', $_POST['password']),
                "creation_date" => date("Y/m/d H:i"),
                "valid" => $valid);
            APP::getDB()->setprepare("INSERT INTO user (username, email, pass, creation_date, valid) VALUE(:username, :email, :pass, :creation_date, :valid)", $val);
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
            $msg = "Hi ". $ret['username'] . ", " . "<br />Your new password is ". $pass . "<br /><br />Camagru.";
            Notification::sendMail($mail, "[Camagru] Reset Password", $msg);
            Notification::Message("0 Email sended to " . $mail . ".");
        }
    }
}

?>