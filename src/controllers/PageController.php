<?php

declare(strict_types=1);

namespace controllers;

use core\AbstractController;
use core\Model;
use models\Posts;
use models\User;

/**
 * Class PageController
 * @package controllers
 */
final class PageController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Posts
     */
    private $posts;

    /**
     * PageController constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $model::getInstance(User::class);
        $this->posts = $model::getInstance(Posts::class);
    }

    /**
     * @return array
     */
    public function FrontPage(): array
    {
        $userLogged = $this->user->getUserLoginInfo();
        $posts = $this->posts->getPosts(0, 5);
        return [
            'view' => 'indexPage',
            'data' => [
                'userLogged' => $userLogged,
                'posts' => $posts,
                'kek' => 'hello',
            ],
        ];
    }

    /**
     * @return array
     */
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
                'kek' => 'hello',
            ],
        ];
    }

    /**
     * @return array
     */
    public function UserPage(): array
    {
        $userId = $_GET['user_id'];
        $userInfo = $this->user->getAccountInfo($userId);
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
