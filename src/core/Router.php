<?php

class Router
{
    private static $page = false;

    private static function parse_method($method)
    {
        $kek = explode("@", $method);
        return ['class' => $kek[0], 'method' => $kek[1]];
    }

    private static function parse_url($url)
    {
        $kek = explode("?", $url);
        if (count($kek) > 1)
            return ['url' => $kek[0], 'data' => $kek[1]];
        else
            return ['url' => $url];
    }

    public static function get($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];
        $parsed = self::parse_url($request_url);
        if ($url !== $parsed['url'] || $_SERVER['REQUEST_METHOD'] !== 'GET')
            return;

        $res = Router::parse_method($method);
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

        $res = Router::parse_method($method);
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