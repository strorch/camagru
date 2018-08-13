<?php

require_once '../../config/setup.php';

class UserActions
{
    static function Login($name, $passwd, $DB)
    {
        $names = $DB->query("SELECT name from `camagru`.`users`;");

        foreach ($names as $id)
        {
            $tmp = $id[0];
            echo $tmp.PHP_EOL;

            if ($tmp === $name)
            {
                echo 'kek';
                break;
                //session_start();
                //$_SESSION["name"] = $tmp;
                //header("Location: /");
            }
        }
        //$DB->exec( "INSERT INTO camagru.users (name, passwd, logstat) VALUES ('kek', '123456', 0);");
        //header("Location: /");
    }
}

$name = $_POST["login"];
$passwd = $_POST["passwd"];

if ($name === '' || $passwd === '')
    header("Location: /");

UserActions::Login($name, $passwd, $DB);