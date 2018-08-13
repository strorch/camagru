<?php

class Controller
{
    private $control;
    private $action;

    public function __construct($params)
    {
        $this->control = $params["controller"];
        $this->action = $params["action"];
    }

    public function calling()
    {
        if ($this->control === "main")
            require_once './application/html/front_page.html';
        elseif ($this->control === "register")
            require_once './application/html/take_photo.html';
    }
}