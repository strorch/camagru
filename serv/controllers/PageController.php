<?php

class PageController extends Controller
{
    public function LoginPage()
    {
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