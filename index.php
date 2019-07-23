<?php
/**
 * Alt+6 - todo list
 */

require_once 'src/core/Autoloader.php';
spl_autoload_register('Autoloader::load');

error_reporting(E_ALL);

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
define('SRC_DIR', BASE_DIR.'/src');
define('ASSETS_DIR', BASE_DIR.'/assets');
define('BLADES_DIR', ASSETS_DIR.'/blades');

$config = \core\Config::get();

(new \core\Application($config))->run();
