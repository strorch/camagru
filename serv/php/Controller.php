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

            $posts = $DB->query("SELECT USER, PICT FROM `posts`;");
            $returned = [];
            foreach ($posts as $post)
            {
                array_push($returned, ["USER" => $post["USER"], "PICT" => $post["PICT"]]);
            }
//            $return[0] = base64_encode(file_get_contents("./public/stikers/mem1.jpg"));
//            $return[1] = base64_encode(file_get_contents("./public/stikers/mem2.jpeg"));
//            $return[2] = base64_encode(file_get_contents("./public/stikers/mem3.jpg"));
//            $return[3] = base64_encode(file_get_contents("./public/stikers/mem4.jpg"));
//            $return[4] = base64_encode(file_get_contents("./public/stikers/mem5.jpg"));
//            $return[5] = base64_encode(file_get_contents("./public/stikers/mem6.jpg"));

            echo json_encode($returned);
        }
        else
            echo "nothing";
    }
}