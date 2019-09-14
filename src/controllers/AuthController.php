<?php

declare(strict_types=1);

namespace controllers;

use core\AbstractController;
use core\Model;
use Exception;
use models\User;

/**
 * Class AuthController
 * @package controllers\Auth
 */
class AuthController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * AuthController constructor.
     * @param Model $model
     * @throws Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $model::getInstance(User::class);
    }

    /**
     * @throws Exception
     */
    public function LoginAction(): void
    {
        $this->checkCsrf();
        $user = $this->user->findLoginingUser($_POST['login'], $_POST['password']);
        if (empty($user)) {
            $this->redirect('/login?error=1');
            return;
        }
        $user = reset($user);
        foreach (['id', 'login', 'password', 'log_stat'] as $attr) {
            $_SESSION[$attr] = $user[$attr];
        }
        $this->redirect('/');
    }

    /**
     * @throws Exception
     */
    public function LogoutAction(): void
    {
        $this->checkCsrf();
        $_SESSION = [];
        $this->redirect('/');
    }

    /**
     * @throws Exception
     */
    public function RegistrationAction()
    {
        $this->checkCsrf();
//        $user = $this->user->findLoginingUser($_POST['login'], $_POST['password']);
//        if (empty($user)) {
//            $this->redirect('/login?error=1');
//            return;
//        }
//        $user = reset($user);
//        foreach (['id', 'login', 'password', 'log_stat'] as $attr) {
//            $_SESSION[$attr] = $user[$attr];
//        }
        $this->redirect('/');
    }
}
