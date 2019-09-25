<?php

namespace helpers;

/**
 * Class SaltGenerator
 * @package helpers
 */
class SaltGenerator
{
    /**
     * @param bool $hashed
     * @return string
     */
    public static function generateRandomName(bool $hashed = false): string
    {
        $num1 = (string)rand(0, 50);
        $num2 = (string)rand(50, 10);
        if ($hashed) {
            return md5($num1 . $num2);
        }
        return $num1 . $num2;
    }

    /**
     * @param string $str
     * @return string
     */
    public static function hashName(string $str): string
    {
        return md5($str);
    }

    /**
     * @param string $password
     * @param string $salt
     * @return string
     */
    public static function passwordHash(string $password, string $salt): string
    {
        return static::hashName(static::hashName($password) . $salt);
    }
}
