<?php

include ("Session.php");

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
        if ($this->control === "main" && $this->action === "none")
            require_once "./public/login.html";
        elseif ($this->control === "admin" && $this->action === "login")
        {
            if (Session::start_session("", htmlentities($_POST["passwd"])) === true)
            {
                header("Location: /admin");
            }
            else
                header("Location: /");
        }
        elseif ($this->control === "admin" && $this->action === "none")
        {
            session_start();
            if ($_SESSION["passwd"] === null)
            {
                header("Location: /");
            }
            else
            {
                require_once "./public/table.html";
            }
        }
        elseif ($this->control === "admin" && $this->action === "get_data")
        {
            //echo json_encode(DB_parser::get_result());
        }
        elseif ($this->control === "none" && $this->action === "fill")
        {
            //Controller::fill_db();

            //echo json_encode(true);
        }
    }
}