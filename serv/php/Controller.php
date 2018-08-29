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
            require_once "./public/html/login.html";
        elseif ($this->control === "user" && $this->action === "loged")
        {
            session_start();
            $arr = [];
            $arr["login"] = $_SESSION["login"];
            $arr["passwd"] = $_SESSION["passwd"];
            echo json_encode($arr);
        }
        elseif ($this->control === "user" && $this->action === "login")
        {
            session_start();
            $_SESSION["login"] = $_POST["login"];
            $_SESSION["passwd"] = $_POST["passwd"];
            header("Location: /");
        }
        elseif ($this->control === "main" && $this->action === "posts")
        {
            $DB = new DB_connection("localhost", "camagru", "root", "123456");

            $result = $DB->query("");
        }
        else
            echo "nothing";
    }
}