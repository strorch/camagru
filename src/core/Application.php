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
        require_once BLADES_DIR."/front_page.php";
//        session_start();
//        echo 'hello';
    }
}
