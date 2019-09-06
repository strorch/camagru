<?php

require_once __DIR__.'/../src/bootstrap.php';

$dbParams = require 'database.php';

$connection = \core\DB::get($dbParams);
$query_str = file_get_contents('./setup.sql');
$connection->exec($query_str);
echo "done";
