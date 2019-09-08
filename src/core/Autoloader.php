<?php

declare(strict_types=1);

/**
 * Class Autoloader
 */
class Autoloader
{
    /**
     * @param string $file
     */
    public static function load(string $file): void
    {
        $file = str_replace('\\', '/', $file);
        $filepath = BASE_DIR . '/src/' . $file . '.php';
        try {
            include $filepath;
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
