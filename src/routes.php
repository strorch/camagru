<?php

    Router::get("/", 'PageController@FrontPage');

    Router::get('/login','PageController@LoginPage');

    Router::post('/login_action','LoginController@LoginCheck');

    Router::post('/register_action','RegistrationController@RegistrationCheck');

    Router::error_page();