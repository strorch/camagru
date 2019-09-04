<?php

error_reporting(E_ALL);

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT'] === '' ? $_SERVER['PWD'] : $_SERVER['DOCUMENT_ROOT']);
define('SRC_DIR', BASE_DIR.'/src');
define('CONTROLLERS_DIR', SRC_DIR.'/controllers');
define('ASSETS_DIR', BASE_DIR.'/assets');
define('STICKERS_DIR', ASSETS_DIR.'/stickers/');
define('JS_DIR', ASSETS_DIR.'/js');
define('CSS_DIR', ASSETS_DIR.'/css');
define('BLADES_DIR', SRC_DIR.'/blades');

require_once SRC_DIR . '/core/Autoloader.php';
spl_autoload_register('Autoloader::load');
