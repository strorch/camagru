#!/usr/bin/php
<?php

require_once __DIR__.'/../src/bootstrap.php';

$dbParams = require __DIR__ . '/database.php';

$connection = \core\DB::get($dbParams);
$query_str = file_get_contents(__DIR__ . '/setup.sql');
$connection->exec($query_str);
echo "Migration done";
