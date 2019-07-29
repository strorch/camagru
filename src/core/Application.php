<?php

namespace core;

use core\Router;

class Application
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    private function getRoutes()
    {
        try {
            require SRC_DIR.'routes.php';
        } catch (\Exception $e) {
            die('routes file is missing');
        }
    }

//    private function

    public function run(): void
    {
        try {
            $this->getRoutes();
            $a = 'kek';
            require BLADES_DIR."/front_page.php";
        }
        catch (\Throwable $e) {

        }
//        session_start();
//        echo 'hello';
    }
}
