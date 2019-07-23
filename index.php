<?php

require_once 'src/core/Autoloader.php';
spl_autoload_register('Autoloader::load');

error_reporting(E_ALL);

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
define('SRC_DIR', BASE_DIR.'/src');
define('ASSETS_DIR', BASE_DIR.'/assets');

session_start();

$_SESSION['kek'] = "lololo";

$config = \core\Config::get();

(new \core\Application($config))->run();
