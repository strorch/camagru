<?php

namespace helpers;

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

    public static function hashName(string $str): string
    {
        return md5($str);
    }
}