<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;
use       App\Notification;
use       App\Pages;

class Connection
{
    private static function find_user($email, $pass = null, $username = null)
    {
        if ($username)
            return (APP::getDB()->getprepare("SELECT email, username, valid FROM user WHERE email = ? OR username = ?", array($email, $username), true));
        else
            return (APP::getDB()->getprepare("SELECT email, pass, valid FROM user WHERE email = ? AND pass = ?", array($email, $pass), true));
    }

    private static function getusername($email)
    {
        return (APP::getDB()->getprepare("SELECT email, username FROM user WHERE email = ?", [$email], true));
    }
    
    private static function getIdusername($email)
    {
        return (APP::getDB()->getprepare("SELECT id FROM user WHERE email = ?", [$email], true));
    }
    
    public static function login()
    {
        $val = static::find_user($_POST['email'], hash('whirlpool', $_POST['password']));
        if ($val && $val['valid'])
        {
            App::session();
            $_SESSION['mail'] = $_POST['email'];
            $_SESSION['username'] = static::getusername($_POST['email'])['username'];
            $_SESSION['id'] = static::getIdusername($_POST['email'])['id'];
            Pages::page_Json("user_home&user=" . $_SESSION['username']);
        }
        else if ($val)
            Error::user_validMail();
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
        Pages::page_Json("home");
    }

    public static function register($valid = "0")
    {
        $pattern_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        $pattern_username = "/^[a-zA-Z0-9]{6,31}$/i";
        $pattern_pass = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,199}$/i";

        $ret = static::find_user($_POST['email'], NULL, $_POST['username']);
        if ($_POST['password'] != $_POST['confpassword'])
            Error::not_samePass();
        else if ($ret && $ret['username'] == $_POST['username'])
            Error::user_Exist($_POST['username']);
        else if ($ret && $ret['email'] == $_POST['email'])
            Error::mail_Exist($_POST['email']);
        else if (!preg_match($pattern_email, $_POST['email']))
            Error::createJson("Wrong email!");
        else if (!preg_match($pattern_username, $_POST['username']))
            Error::createJson("Wrong username!");
        else if (!preg_match($pattern_pass, $_POST['password']))
            Error::createJson("Wrong password!");
        else
        {
            $val = array(
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "pass" => hash('whirlpool', $_POST['password']),
                "creation_date" => date("Y/m/d H:i"),
                "valid" => $valid);
            if (!APP::getDB()->setprepare("INSERT INTO user (username, email, pass, creation_date, valid) VALUE(:username, :email, :pass, :creation_date, :valid)", $val))
                return (Error::server());
            $val = array(
                "sys" => "No synopis",
                "logo" => base64_encode(file_get_contents(App::getPath("vue/img/profil.png"))));
            if (!APP::getDB()->setprepare("INSERT INTO home (synopsis, logo) VALUE(:sys, :logo)", $val))
                return (Error::server());
            if (!APP::getDB()->setquery("INSERT INTO notification (notiffollow, notifcomment, `notiflike`, notifimage) VALUE(1, 1, 1, 1)"))
                return (Error::server());
            App::createJson("account successfully created.");
            $token = App::tokenCreator(128);
            Notification::mailRegister($_POST['email'], $token, $_POST['username']);
        }
    }

    public static function newPassword($mail)
    {
        $ret = App::getDb()->getprepare("SELECT * FROM user WHERE user.email = ?", [$mail], true);
        if (!$ret)
            Error::user_notExist($mail);
        else
        {
            $pass = APP::generatePassword();
            $val = array("new_pass" => hash('whirlpool', $pass), "email" => $mail);
            if (App::getDB()->setprepare("UPDATE user SET user.pass = :new_pass WHERE user.email = :email", $val))
                return(Error::server());
            $msg = "Hi ". $ret['username'] . ", " . "<br />Your new password is ". $pass . "<br /><br />Camagru.";
            Notification::sendMail($mail, "[Camagru] Reset Password", $msg);
            App::createJson("Email sended to " . $mail . ".");
        }
    }

    public static function validToken($mail, $token)
    {
        $val = array("mail" => $mail, "token" => $token);
        if (App::getDb()->getprepare("SELECT COUNT(*) as count FROM user WHERE user.email = :mail AND user.token = :token", $val, true)['count'] &&
            App::getDb()->setprepare("UPDATE user WHERE user.mail = :mail AND user.valid = `1` AND user.token = `null`", $val))
            return (true);
        else
            return (false);
    }
}

?>