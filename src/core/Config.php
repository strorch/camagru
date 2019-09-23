<?php

declare(strict_types=1);

namespace core;


/**
 * Class Config
 * @package core
 */
final class Config
{
    /**
     * @return array
     */
    public static function get(): array
    {
        return [
            'db' => static::getDBConfig(),
            'url' => static::getHttpConfig(),
        ];
    }

    /**
     * @return array
     */
    private static function getDBConfig(): array
    {
        return include BASE_DIR . '/config/database.php';
    }

    /**
     * @return array
     */
    private static function getHttpConfig(): array
    {
        return include BASE_DIR . '/config/http.php';
    }
}
