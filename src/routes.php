<?php

use core\Router\Router;

Router::get("/", 'PageController@FrontPage');

Router::get('/login','PageController@LoginPage');

Router::post('/login','AuthController@LoginAction');

Router::post('/logout','AuthController@LogoutAction');

Router::post('/register','AuthController@RegistrationAction');

Router::get('/profile','PageController@ProfilePage');

Router::get('/settings','PageController@SettingsPage');

Router::get('/getStickers', 'StickerController@getStickers');

Router::post('/savePhoto', 'PostsController@savePost');

Router::post('/deletePhoto', 'PostsController@deletePost');

Router::get('/emailConfirm', 'AuthController@emailConfirm');

Router::post('/sendComment', 'PostsController@commentPost');

Router::post('/sendLike', 'PostsController@likePost');
