<?php

namespace controllers;

use core\AbstractController;

class PageController extends AbstractController
{
    public function LoginPage()
    {

        //session_start();
//        if(isset($_SESSION['name']) === true)
//            header('Location: /');
//        require_once './public/blades/login.php';
    }

    public function FrontPage(): array
    {
        return [
            'view' => 'sceleton',
            'data' => [
                'var' => 12,
                'kek' => 1,
            ],
        ];
//        require_once './public/blades/front_page.php';
    }

    public function ErrorPage()
    {
//        require_once './public/blades/404.php';
    }
}
