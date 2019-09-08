<?php

declare(strict_types=1);

namespace controllers\Auth;

use core\AbstractController;
use core\Model;
use models\User;

/**
 * Class LoginController
 * @package controllers\Auth
 */
class LoginController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * LoginController constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $model::getInstance(User::class);
    }

    public function LoginAction(): void
    {
        $user = $this->user->findLoginingUser($_POST['login'], $_POST['password']);
        if (empty($user)) {
            $this->redirect('/login?error=1');
            return;
        }

        $this->redirect('/');
    }
}
