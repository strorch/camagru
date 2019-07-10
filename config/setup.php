<?php

require_once '../serv/app/DB_connection.php';

define('ROOTPATH', __DIR__.'/..');

$connection = new DBConnection();

$query_str = file_get_contents('./setup.sql');

$connection->exec($query_str);


$to_stikers = "./public/stikers/";
$return[] = "mem1.jpg";
$return[] = "mem2.jpeg";
$return[] = "mem3.jpg";
$return[] = "mem4.jpg";
$return[] = "mem5.jpg";
$return[] = "mem6.jpg";
$return[] = "mem7.jpg";


foreach ($return as $value)
{
    echo "KEKEKEKE     ".$value;
    $connection->exec("INSERT INTO posts (\"USER\", PICT) VALUES ('".$value."', '".$to_stikers.$value."');");
}
echo "done";
