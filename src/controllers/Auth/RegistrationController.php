<?php

declare(strict_types=1);

namespace controllers\Auth;

use core\AbstractController;
use core\Model;
use models\User;

/**
 * Class RegistrationController
 * @package controllers\Auth
 */
class RegistrationController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * RegistrationController constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $this->model::getInstance(User::class);
    }

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
