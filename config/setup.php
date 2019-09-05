<?php

require_once __DIR__.'/../src/bootstrap.php';

$connection = new \core\DB();
var_dump($connection);
die();
$query_str = file_get_contents('./setup.sql');
$connection->exec($query_str);
echo "done";
