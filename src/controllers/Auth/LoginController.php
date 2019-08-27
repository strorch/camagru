<?php

namespace controllers\Auth;

use core\AbstractController;
use core\DB;

class LoginController extends AbstractController
{
    public static function LoginCheck()
    {
//        $connection = new DB();
//        //$res = $connection->query("SELECT * FROM `camagru`.`users` WHERE NAME='".$_POST['login']."'");
//        $kek = 'kek';
//        $res = $connection->query("SELECT * FROM users WHERE NAME='".$kek."'");
//
//        //dd($_SESSION);
//        foreach ($res as $val)
//        {
//            session_start();
//            $_SESSION['name'] = $val['NAME'];
//            $_SESSION['passwd'] = $val['PASSWD'];
//            $_SESSION['email'] = $val['EMAIL'];
//            $_SESSION['log_stat'] = $val['LOG_STAT'];
//            header('Location: /');
//        }
//        if (isset($_SESSION) === false)
//        {
//            session_start();
//            $_SESSION['error'] = 'login error';
//            header('Location: /login');
//        }


    }
}
