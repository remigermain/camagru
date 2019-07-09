<?php

namespace App;
use       App\Error;
use       App\Database;
use       App\App;

class Connection
{
    private static function find_user($email, $pass = null, $pseudo = null)
    {
        if ($pseudo)
            return (APP::getDB()->getprepare("SELECT email, pseudo FROM user WHERE email LIKE ? OR pseudo LIKE ?", array($email, $pseudo), true));
        else
            return (APP::getDB()->getprepare("SELECT email, pass FROM user WHERE email LIKE ? AND pass LIKE ?", array($email, $pass), true));
    }
    
    public static function login()
    {
        if (static::find_user($_POST['email'], hash('whirlpool', $_POST['password'])))
        {
            session_start();
            $_SESSION['login'] = $_POST['email'];
            header('Location:/Public/index.php');
        }
        else
            Error::user_notvalid();
    }
    
    public static function logout()
    {
        session_start();
        unset($_SESSION['login']);
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
                "creation_date" => date("Y/m/d"),
                "valid" => $valid);
            APP::getDB()->setprepare("INSERT INTO user (pseudo, email, pass, creation_date, valid) VALUE(:pseudo, :email, :pass, :creation_date, :valid)", $val);
            header('Location:/Public/index.php?p=connection');
        }
        else
            Error::user_notvalid();
    }

}

?>