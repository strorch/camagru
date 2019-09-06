<?php

namespace controllers;

use core\AbstractController;
use core\Model;
use models\Posts;
use models\User;

final class PageController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $model::getInstance(User::class);
    }

    public function LoginPage(): array
    {
        $userLogged = $this->user->getUserLoginInfo();
        if ($userLogged) {
            $this->redirect('/');
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
        $userLogged = $this->user->getUserLoginInfo();
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
        $userInfo = $this->user->getAccountInfo();
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
