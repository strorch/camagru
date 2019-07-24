<?php

namespace core;

class Application
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    private function getViews()
    {

    }

//    private function

    public function run(): void
    {
        try {
            $a = 'kek';
            require BLADES_DIR."/front_page.php";
        }
        catch (\Throwable $e) {

        }
//        session_start();
//        echo 'hello';
    }
}
