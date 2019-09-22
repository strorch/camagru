<?php

declare(strict_types=1);

namespace controllers;

use core\AbstractController;
use core\Model;
use Exception;
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
     * @throws Exception
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
        $startNum = 0;
        $endNum = 5;
        if (!empty($_GET['startNum']) && !empty($_GET['endNum'])) {
            $startNum = (int)$_GET['startNum'];
            $endNum = (int)$_GET['endNum'];
        }
        $userLogged = $this->user->getUserLoginInfo();
        $posts = $this->posts->getPosts($startNum, $endNum);
        $pagination = $this->posts->getPagination();
        return [
            'view' => 'index',
            'data' => [
                'userLogged' => $userLogged,
                'posts' => $posts,
                'paginations' => $pagination,
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
    public function ProfilePage(): array
    {
        $logedInfo = $this->user->getUserLoginInfo();
        if (!$logedInfo || $_SESSION['log_stat'] === 0) {
            $this->redirect('/');
        }
        $userInfo = $this->user->getAccountInfo($_SESSION['id']);
        $posts = $this->posts->getPosts(0, 100, $userInfo['id']);
        return [
            'view' => 'profile',
            'data' => [
                'userLogged' => $logedInfo,
                'userInfo' => $userInfo,
                'posts' => $posts,
            ],
        ];
    }

    /**
     * @return array
     */
    public function SettingsPage(): array
    {
        $logedInfo = $this->user->getUserLoginInfo();
        if (!$logedInfo) {
            $this->redirect('/');
        }
        $userInfo = $this->user->getAccountInfo($_SESSION['id']);
        $posts = $this->posts->getPosts(0, 5, $userInfo['id']);
        return [
            'view' => 'settings',
            'data' => [
                'userLogged' => $logedInfo,
                'userInfo' => $userInfo,
                'posts' => $posts,
            ],
        ];
    }
}
