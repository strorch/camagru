<?php

return [
    'type' => 'pgsql',
    'host' => "172.20.0.2", //TODO: https://hub.docker.com/r/diouxx/apache-proxy add proxy to configure stable ip
    'port' => '5432',
    'dbName' => 'postgres',
    'user' => 'postgres',
    'password' => 'postgres',
];
