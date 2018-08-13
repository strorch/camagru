<?php

require_once 'Controller.php';

class Router
{
    private $routes = [];
    private $params = [];

    public function __construct()
    {
        $routes = require 'routes.php';
        foreach ($routes as $key => $val)
            $this->add($key, $val);
    }

    private function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    private function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $key => $item)
        {
            if (preg_match($key, $url))
            {
                $this->params = $item;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match())
        {
            $controled = new Controller($this->params);
            $controled->calling();

           // var_dump($this->params);
        }
        else
        {
            echo "nothing";
            //require_once './application/html/front_page.html';
        }
    }
}