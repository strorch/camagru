<?php

namespace core;

class Utils
{
    public static function fetchParse(): array
    {
        $body = file_get_contents('php://input');

        if ($body === FALSE) {
            exit ;
        }
        return json_decode($body, true);
    }

    public static function dd(array $input): void
    {
        echo '<br>';
        var_dump($input);
        echo '<br>';
        die();
    }

    public static function print_r(array $arr): void
    {
        print_r($arr);
        die();
    }
}
