<?php

namespace core;

use core\DB;

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
            require SRC_DIR.'/routes.php';
        } catch (\Exception $e) {
            die('routes file is missing');
        }
    }

    public function run(): void
    {
        try {
            $a = new DB();
            $this->getRoutes();
            $a = 'kek';
            require BLADES_DIR."/front_page.php";
        }
        catch (\Throwable $e) {
            echo json_encode($e->getMessage());
            require_once BLADES_DIR."/404.php";
        }
//        session_start();
//        echo 'hello';
    }
}
