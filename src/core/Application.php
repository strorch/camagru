<?php

namespace core;

class Application
{
    private $config;

    private $view;

    private $controller;

    private $model;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function run(): void
    {
        try {
            session_start();

            $this->view = new View();
            $this->model = new Model();
            $this->controller = new ApplicationController($this->model, $this->view);

            $this->controller->handleRequest();
        }
        catch (\Throwable $e) {
            echo json_encode($e->getMessage());
        }
    }
}
