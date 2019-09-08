<?php

declare(strict_types=1);

namespace core\Router;

/**
 * Class Router
 * @package core\Router
 */
final class Router extends AbstractRouter implements RouterInterface
{
    /**
     * @param string $url
     * @param string $method
     * @throws \Exception
     */
    public static function get($url, $method): void
    {
        static::request($url, $method, 'GET');
    }

    /**
     * @param string $url
     * @param string $method
     * @throws \Exception
     */
    public static function post($url, $method): void
    {
        static::request($url, $method, 'POST');
    }
}
