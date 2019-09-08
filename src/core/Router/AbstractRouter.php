<?php


namespace core\Router;

use Exception;

/**
 * Class AbstractRouter
 * @package core\Router
 */
abstract class AbstractRouter
{
    use RouterResult;

    /**
     * @param string $method
     * @return array
     * @throws Exception
     */
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

    /**
     * @param string $url
     * @param string $method
     * @param string $type
     * @throws Exception
     */
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