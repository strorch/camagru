<?php

namespace core;

class Application
{
    public function __construct(array $config)
    {

    }

    public function run(): void
    {
//        session_start();
        echo 'hello';
    }
}