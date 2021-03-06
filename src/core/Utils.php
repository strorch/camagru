<?php

declare(strict_types=1);

namespace core;

/**
 * Class Utils
 * @package core
 */
class Utils
{
    /**
     * @return array|null
     */
    public static function fetchParse(): ?array
    {
        $body = file_get_contents('php://input');

        if ($body === FALSE) {
            return null;
        }
        return json_decode($body, true);
    }

    /**
     * @param array $input
     */
    public static function dd(array $input): void
    {
        echo '<br>';
        var_dump($input);
        echo '<br>';
        die();
    }

    /**
     * @param array $arr
     */
    public static function print_r(array $arr): void
    {
        print_r($arr);
        die();
    }
}
