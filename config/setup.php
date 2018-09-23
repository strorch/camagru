<?php

require_once 'database.php';
require_once '../serv/app/DB_connection.php';

$connection = new DB_connection($DB_DSN, $DB_USER, $DB_PASSWORD);



$to_stikers = "./public/stikers/";
$return = [];
$return[0] = "mem1.jpg";
$return[1] = "mem2.jpeg";
$return[2] = "mem3.jpg";
$return[3] = "mem4.jpg";
$return[4] = "mem5.jpg";
$return[5] = "mem6.jpg";
$return[6] = "mem7.jpg";


    for ($i = 0; $i < 7; $i++)
    {
        $connection->exec("INSERT INTO `posts` (USER, PICT) VALUES ('".$return[$i]."', '".$to_stikers.$return[$i]."');");
    }
 //$connection->exec("INSERT into users (name, passwd, EMAIL, LOG_STAT) VALUES ('fa', 'erg', 'greegerege', 1);");
