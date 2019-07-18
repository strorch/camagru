<?php

namespace core;

class Application
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function run(): void
    {
//        session_start();
        echo 'hello';
    }
}