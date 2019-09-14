<?php

error_reporting(E_ALL);

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT'] === '' ? $_SERVER['PWD'] : $_SERVER['DOCUMENT_ROOT']);
define('STICKERS_DIR', BASE_DIR.'/assets/stickers/');
define('SRC_DIR', BASE_DIR.'/src');
define('CONTROLLERS_DIR', SRC_DIR.'/controllers');
define('BLADES_DIR', SRC_DIR.'/blades');

require_once SRC_DIR . '/core/Autoloader.php';
spl_autoload_register('Autoloader::load');
