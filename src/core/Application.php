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
        require_once SRC_DIR."/views/front_page.php";
//        session_start();
//        echo 'hello';
    }
}
