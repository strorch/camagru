<?php

declare(strict_types=1);

namespace helpers;


use Exception;

/**
 * Class UserValidator
 * @package helpers
 */
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

    /**
     * @param string $login
     * @throws Exception
     */
    public static function username(string $login): void
    {
        if (strlen($login) < 6 || empty(preg_match("/^[a-zA-Z ]*$/", $login))) {
            throw new Exception("Wrong login! Only letters and white space allowed");
        }
    }

    /**
     * @param string $email
     * @throws Exception
     */
    public static function email(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Wrong login! Invalid email format");
        }
    }

    /**
     * @param string $password
     * @throws Exception
     */
    public static function password(string $password): void
    {
        if (strlen($password) < 6 || empty(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))) {
            throw new Exception("Weak password!");
        }
    }
}