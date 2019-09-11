<?php

use core\Router\Router;

Router::get("/", 'PageController@FrontPage');

Router::get('/login','PageController@LoginPage');

Router::post('/login','Auth\LoginController@LoginAction');

Router::post('/logout','Auth\LoginController@LogoutAction');

Router::post('/register','Auth\RegistrationController@RegistrationAction');

Router::get('/profile','PageController@ProfilePage');

Router::get('/settings','PageController@SettingsPage');
