<?php

require_once './src/bootstrap.php';

$config = \core\Config::get();

(new \core\Application($config))->run();
