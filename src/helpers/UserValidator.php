<?php


namespace helpers;


use Exception;

class UserValidator
{

    /**
     * @param array $user
     */
    public static function registerSession(array $user): void
    {
        foreach (['id', 'login', 'password', 'log_stat', 'notifications'] as $attr) {
            $_SESSION[$attr] = $user[$attr];
        }
    }

    public static function username(string $login)
    {
        if (strlen($login) < 6 || empty(preg_match("/^[a-zA-Z ]*$/", $login))) {
            throw new Exception("Wrong login! Only letters and white space allowed");
        }
    }

    public static function email(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Wrong login! Invalid email format");
        }
    }

    public static function password(string $password)
    {
        if (strlen($password) < 6 || empty(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))) {
            throw new Exception("Weak password!");
        }
    }
}