<?php

interface AbstractRouter
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
    protected static function parse_method($method)
    {
        $kek = explode("@", $method);
        return ['class' => $kek[0], 'method' => $kek[1]];
    }

    protected static function parse_url($url)
    {
        $kek = explode("?", $url);
        if (count($kek) > 1)
            return ['url' => $kek[0], 'data' => $kek[1]];
        else
            return ['url' => $url];
    }
}


class Router implements AbstractRouter
{
    use RouterHelper;

    private static $page = false;

    public static function get($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];
        $parsed = self::parse_url($request_url);
        if ($url !== $parsed['url'] || $_SERVER['REQUEST_METHOD'] !== 'GET')
            return;

        $res = self::parse_method($method);
        $class = $res['class'];
        $method = $res['method'];

        $tmp = new $class();
        $tmp->$method();

        self::$page = true;
    }

    public static function post($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];

        if ($url !== $request_url || $_SERVER['REQUEST_METHOD'] !== 'POST')
            return;

        $res = self::parse_method($method);
        $class = $res['class'];
        $method = $res['method'];

        $tmp = new $class();
        $tmp->$method();

        self::$page = true;
    }

    public static function error_page()
    {
        if (self::$page === false)
            require_once './public/blades/404.php';
    }
}