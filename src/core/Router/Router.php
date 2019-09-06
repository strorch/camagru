<?php

namespace core\Router;

final class Router extends AbstractRouter implements RouterInterface
{
    public static function get($url, $method): void
    {
        static::request($url, $method, 'GET');
    }

    public static function post($url, $method): void
    {
        static::request($url, $method, 'POST');
    }
}
