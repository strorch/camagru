<?php

use core\Router\Router;

Router::get("/", 'PageController@FrontPage');

Router::get('/login','PageController@LoginPage');

Router::get('/profile','LoginController@LoginCheck');

Router::get('/settings','RegistrationController@RegistrationCheck');