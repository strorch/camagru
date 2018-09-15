<?php

class Router
{
    private static function parse_method($method)
    {
        $kek = explode("@", $method);
        return ['class' => $kek[0], 'method' => $kek[1]];
    }

    public static function get($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];

        if ($url !== $request_url || $_SERVER['REQUEST_METHOD'] !== 'GET')
            return;

        $res = Router::parse_method($method);
        $class = $res['class'];
        $method = $res['method'];

        $tmp = new $class;
        $tmp->$method();
    }

    public static function post($url, $method)
    {
        $request_url = $_SERVER['REQUEST_URI'];

        if ($url !== $request_url || $_SERVER['REQUEST_METHOD'] !== 'POST')
            return;

        $res = Router::parse_method($method);
        $class = $res['class'];
        $method = $res['method'];

        $tmp = new $class;
        $tmp->$method();
    }
}