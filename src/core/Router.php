<?php

namespace core;

use Exception;

interface RouterInterface
{
    public static function get(string $url, string $method);

    public static function post(string $url, string $method);
}

interface Executable
{
//    public static
}

trait RouterHelper
{
    protected static function parseMethod($method)
    {
        $statement = explode("@", $method);
        if (count($statement) !== 2)
            throw new Exception("wrong routes initializing");
        return [
            'class' => $statement[0],
            'method' => $statement[1]
        ];
    }
}


class Router implements RouterInterface
{
    use RouterHelper;

    private static $page = false;

    public static function get($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];
        ///TODO: chack parsing with standart method
        $parsed = parse_url($request_url);
        if ($url !== $parsed['url'] || $_SERVER['REQUEST_METHOD'] !== 'GET') {
            return;
        }
        $res = self::parseMethod($method);
        $class = $res['class'];
        $method = $res['method'];

        $tmp = new $class();
        $tmp->$method();

        self::$page = true;
    }

    public static function post($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];

        if ($url !== $request_url || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $res = self::parseMethod($method);
        $class = $res['class'];
        $method = $res['method'];

        $tmp = new $class();
        $tmp->$method();

        self::$page = true;
    }

    public static function error_page()
    {
        if (self::$page === false) {
            require_once BLADES_DIR.'/404.php';
        }
    }
}
