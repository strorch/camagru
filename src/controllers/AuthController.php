<?php

declare(strict_types=1);

namespace controllers;

use core\AbstractController;
use core\Model;
use Exception;
use models\Mail;
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
     * @var Mail
     */
    private $mail;

    /**
     * AuthController constructor.
     * @param Model $model
     * @throws Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $model::getInstance(User::class);
        $this->mail = $model::getInstance(Mail::class);
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
        }
        $this->registerSession($user);
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

        try {
            $this->user->checkUserRow($_POST);
        } catch (Exception $e) {
            $this->redirect('/login?error=2');
        }
        $user = $this->user->saveUser($_POST);
        $this->registerSession($user);
        if (!$this->mail->sendConfirmEmail($user)) {
            $this->redirect('/?error=3');
        }
        $this->redirect('/');
    }

    /**
     * @param array $user
     */
    private function registerSession(array $user): void
    {
        foreach (['id', 'login', 'password', 'log_stat', 'notifications'] as $attr) {
            $_SESSION[$attr] = $user[$attr];
        }
    }
}
