<?php
    require_once "./serv/php/Router.php";
    require_once "./serv/php/DB_connection.php";
    require_once "./serv/php/DB_parser.php";

    $router = new Router();
    $router->run();
