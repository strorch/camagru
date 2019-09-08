<?php


namespace core\Router;

/**
 * Trait RouterResult
 * @package core\Router
 */
trait RouterResult
{
    /**
     * @var mixed[]
     */
    private static $DI;

    /**
     * @param mixed[] $DI
     */
    public static function setDI(array $DI): void
    {
        self::$DI = $DI;
    }

    /**
     * @return mixed[]
     */
    public static function getDI(): array
    {
        if (empty(self::$DI)) {
            return [];
        }
        return self::$DI;
    }
}