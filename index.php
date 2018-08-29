<?php

    require_once "./serv/php/Router.php";
    require_once "./serv/php/DB_connection.php";

    $router = new Router();
    $router->run();


    $mem1 = file_get_contents("./public/stikers/mem1.jpg");
    $mem2 = file_get_contents("./public/stikers/mem2.jpeg");
    $mem3 = file_get_contents("./public/stikers/mem3.jpg");
    $mem4 = file_get_contents("./public/stikers/mem4.jpg");

//        header("Content-type: image/jpeg");
       // echo $mem1;
