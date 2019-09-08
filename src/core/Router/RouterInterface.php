<?php

declare(strict_types=1);

namespace core\Router;


/**
 * Interface RouterInterface
 * @package core\Router
 */
interface RouterInterface
{
    /**
     * @param string $url
     * @param string $method
     */
    public static function get(string $url, string $method): void;

    /**
     * @param string $url
     * @param string $method
     */
    public static function post(string $url, string $method): void;
}