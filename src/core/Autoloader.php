<?php

class Autoloader
{
    public static function load($file): void
    {
        $file = str_replace('\\', '/', $file);
        $filepath = $_SERVER['DOCUMENT_ROOT'] . '/src/' . $file . '.php';
        try {
            include $filepath;
        } catch (Throwable $e) {
            echo json_encode([
                'type' => 'Autoloader error',
                'error' => $e,
                'path' => $filepath,
            ]);
        }
    }
}
