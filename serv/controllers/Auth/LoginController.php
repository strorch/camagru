<?php
/**
 * Created by PhpStorm.
 * User: mstorcha
 * Date: 9/16/18
 * Time: 7:02 PM
 */

class LoginController
{
    public static function LoginCheck()
    {
        include './config/database.php';
        $connection = new DB_connection($DB_DSN, $DB_USER, $DB_PASSWORD);
        //$res = $connection->query("SELECT * FROM `camagru`.`users` WHERE NAME='".$_POST['login']."'");
        $kek = 'kek';
        $res = $connection->query("SELECT * FROM `camagru`.`users` WHERE NAME='".$kek."'");

        //dd($_SESSION);
        foreach ($res as $val)
        {
            session_start();
            $_SESSION['name'] = $val['NAME'];
            $_SESSION['passwd'] = $val['PASSWD'];
            $_SESSION['email'] = $val['EMAIL'];
            $_SESSION['log_stat'] = $val['LOG_STAT'];
            header('Location: /');
        }
        if (isset($_SESSION) === false)
        {
            session_start();
            $_SESSION['error'] = 'login error';
            header('Location: /login');
        }


    }
}