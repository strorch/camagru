<?php

class PageController
{
    public function LoginPage()
    {

        //session_start();
        if(isset($_SESSION['name']) === true)
            header('Location: /');
        require_once './public/blades/login.php';
    }

    public function FrontPage()
    {
        require_once './public/blades/front_page.php';
    }

    public function ErrorPage()
    {
        require_once './public/blades/404.php';
    }
}