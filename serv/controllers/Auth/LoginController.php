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
    }
}