<?php

error_reporting(E_ALL);

class Autoloader
{
    public static function autoload($file, $ext = FALSE, $dir = FALSE)
    {
        $file = str_replace('\\', '/', $file);

        if($ext === FALSE) {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/src';
            $filepath = $_SERVER['DOCUMENT_ROOT'] . '/src/' . $file . '.php';
            echo $filepath;
        }
        else {
            $path = $_SERVER['DOCUMENT_ROOT'] . (($dir) ? '/' . $dir : '');
            $filepath = $path . '/' . $file . '.' . $ext;
        }
        if($ext === FALSE) {
            require_once($filepath);
        }
        else {
            return $filepath;
        }
    }
}
\spl_autoload_register('Autoloader::autoload');

use core\Application;

(function(){

    $config = [];

    (new Application($config))->run();
})();