<?php

error_reporting(E_ALL);

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
define('SRC_DIR', BASE_DIR.'/src');
define('CONTROLLERS_DIR', SRC_DIR.'/controllers');
define('ASSETS_DIR', BASE_DIR.'/assets');
define('BLADES_DIR', ASSETS_DIR.'/blades');

require_once SRC_DIR . '/core/Autoloader.php';
spl_autoload_register('Autoloader::load');
