<?php

    Router::get("/", 'PageController@FrontPage');
    Router::get('/login','PageController@LoginPage');
    Router::post('/login_action','PageController@LoginPage');
    //Router::get('/error','PageController@ErrorPage');