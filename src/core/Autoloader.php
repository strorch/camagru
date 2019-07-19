<?php

class Autoloader
{
    public static function load($file): void
    {
        $file = str_replace('\\', '/', $file);
        $filepath = $_SERVER['DOCUMENT_ROOT'] . '/src/' . $file . '.php';
        require_once($filepath);
    }
}
