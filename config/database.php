<?php

return [
    'type' => 'pgsql',
    'host' => "192.168.48.2", //TODO: https://hub.docker.com/r/diouxx/apache-proxy add proxy to configure stable ip
//    'host' => "172.24.0.2",
    'port' => '5432',
    'dbName' => 'postgres',
    'user' => 'postgres',
    'password' => 'postgres',
];
