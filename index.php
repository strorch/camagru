<?php

    require_once "./serv/php/Router.php";
    require_once "./serv/php/DB_connection.php";

    $router = new Router();
    $router->run();
//
//    $to_stikers = "./public/stikers/";
//    $return = [];
//    $return[0] = "mem1.jpg";
//    $return[1] = "mem2.jpeg";
//    $return[2] = "mem3.jpg";
//    $return[3] = "mem4.jpg";
//    $return[4] = "mem5.jpg";
//    $return[5] = "mem6.jpg";

//$return = [];
//$return[0] = base64_encode(file_get_contents("./public/stikers/mem1.jpg"));
//$return[1] = base64_encode(file_get_contents("./public/stikers/mem2.jpeg"));
//$return[2] = base64_encode(file_get_contents("./public/stikers/mem3.jpg"));
//$return[3] = base64_encode(file_get_contents("./public/stikers/mem4.jpg"));
//$return[4] = base64_encode(file_get_contents("./public/stikers/mem5.jpg"));
//$return[5] = base64_encode(file_get_contents("./public/stikers/mem6.jpg"));
//
//    $DB = new DB_connection("localhost", "camagru", "root", "123456");
//
//    for ($i = 0; $i < 6; $i++)
//    {
//        $DB->exec("INSERT INTO `posts` (USER, PICT) VALUES ('kek', '".$to_stikers.$return[$i]."');<br/>");
//    }