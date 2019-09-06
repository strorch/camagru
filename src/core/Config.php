<?php

namespace core;


final class Config
{
    /**
     * @return array'
     */
    public static function get(): array
    {
        return [
            'db' => static::getDBConfig(),
        ];
    }

    /**
     * @return array
     */
    private static function getDBConfig(): array
    {
        return include BASE_DIR . '/config/database.php';
    }
}
