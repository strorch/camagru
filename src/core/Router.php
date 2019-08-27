<?php

namespace core;

use Exception;

interface RouterInterface
{
    public static function get(string $url, string $method): void;

    public static function post(string $url, string $method): void;
}

trait ResultTrait
{
    private static $DI;

    public static function setDI(array $DI): void
    {
        self::$DI = $DI;
    }
    public static function getDI(): array
    {
        if (empty(self::$DI)) {
            return [];
        }
        return self::$DI;
    }
}

abstract class AbstractRouter
{
    use ResultTrait;

    private static function parseMethod(string $method): array
    {
        $statement = explode("@", $method);
        if (count($statement) !== 2) {
            throw new Exception("wrong routes initializing");
        }
        return [
            'class' => $statement[0],
            'method' => $statement[1],
        ];
    }

    protected static function request(string $url, string $method, string $type): void
    {
        $request_url = $_SERVER['REQUEST_URI'];
        $parsed = parse_url($request_url);

        if (empty($parsed['path'])) {
            throw new Exception('Invalid uri in Router.php');
        }
        if ($_SERVER['REQUEST_METHOD'] !== $type || $url !== $parsed['path']) {
            return;
        }
        $result = static::parseMethod($method);
        self::setDI($result);
    }
}


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
