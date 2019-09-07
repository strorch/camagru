<?php
/**
 * Alt+6 - todo list
 */

require_once './src/bootstrap.php';

$config = \core\Config::get();

(new \core\Application($config))->run();


//echo 'site works';