<?php

define('ROOTPATH', __DIR__);

require_once "./config/database.php";
require_once "./serv/app/Parent/Router.php";
require_once "./serv/app/Parent/Utils.php";
require_once "./serv/app/DB_connection.php";
require_once "./serv/app/Posts.php";
require_once "./serv/controllers/PageController.php";
require_once "./serv/controllers/Auth/LoginController.php";
require_once "./serv/controllers/Auth/RegistrationController.php";

require_once 'serv/routes/web.php';

