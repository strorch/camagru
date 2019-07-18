<?php

//use core\Application;
//use core\Config;

error_reporting(E_ALL);

define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
define('SRC_DIR', BASE_DIR.'/src');
define('ASSETS_DIR', BASE_DIR.'/assets');

$config = Config::get();

(new \core\Application($config))->run();