<?php

namespace controllers;

use core\AbstractController;
use models\Posts;
use models\User;

class PageController extends AbstractController
{
    public function LoginPage(): array
    {
        $userLogged = User::getUserLoginInfo();
        if ($userLogged) {
            header('Location: /');
        }
        return [
            'view' => 'login',
            'data' => [
                'userLogged' => $userLogged,
            ],
        ];
    }

    public function FrontPage(): array
    {
        $userLogged = User::getUserLoginInfo();
        //TODO: create posts displaying
        $posts = Posts::getPosts(0, 5);

        return [
            'view' => 'indexPage',
            'data' => [
                'userLogged' => $userLogged,
                'posts' => $posts,
            ],
        ];
    }

    public function UserPage(): array
    {
        $userId = $_GET['user_id'];
        $userInfo = User::getAccountInfo($userId);
        $posts = Posts::getPosts(0, 5);
        return [
            'view' => 'indexPage',
            'data' => [
                'userInfo' => $userInfo,
                'posts' => $posts,
            ],
        ];
    }
}
