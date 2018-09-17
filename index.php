<?php

    require_once "./serv/php/Router.php";
    require_once "./serv/php/DB_connection.php";

    $router = new Router();
    $router->run();
