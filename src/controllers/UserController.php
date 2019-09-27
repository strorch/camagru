<?php

declare(strict_types=1);

namespace controllers;


use core\AbstractController;
use core\Model;
use core\Utils;
use Exception;
use helpers\UserValidator;
use models\Mail;
use models\User;

/**
 * Class UserController
 * @package controllers
 */
class UserController extends AbstractController
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
     * UserController constructor.
     * @param Model $model
     * @throws Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $this->model::getInstance(User::class);
        $this->mail = $this->model::getInstance(Mail::class);
    }

    public function emailConfirm(): void
    {
        try {
            $this->mail->validateConfirmParams($_GET, $this->user);
        } catch (Exception $e) {
            $this->redirect('/?error=4');
        }
        $this->user->confirmEmail($_GET['id']);
        $_SESSION['log_stat'] = 1;
        $this->redirect('/');
    }

    public function sendNewPassword(): void
    {
        $this->checkCsrf();

        $user = $this->user->getUserByLogin($_POST['login']);
        if (empty($user)) {
            $this->redirect('/error=5');
        }
        $newPassword = 'passwd1';
        $this->mail->sendPasswordEmail($user, $newPassword);
        $this->user->changeRoutine($user, 'password', $newPassword);
        $this->redirect('/');
    }

    /**
     * @return array
     * @throws Exception
     */
    public function changeUsername(): array
    {
        //TODO: normalize
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
        if (empty($body['newValue'])) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        try {
            UserValidator::username($body['newValue']);
        } catch (Exception $e) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        $accountInfo = $this->user->getAccountInfo($_SESSION['id']);

        $this->user->changeRoutine($accountInfo, 'login', $body['newValue']);
        if (!empty($accountInfo['posts'])) {
            rename(BASE_DIR . "/runtime/{$accountInfo['login']}", BASE_DIR . "/runtime/{$body['newValue']}");
        }
        $_SESSION['login'] = $body['newValue'];
        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function changeEmail(): array
    {
        //TODO: normalize
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
        if (empty($body['newValue'])) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        try {
            UserValidator::email($body['newValue']);
        } catch (Exception $e) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }

        $accountInfo = $this->user->getAccountInfo($_SESSION['id']);

        $emailActions = function () use ($accountInfo) {
            $this->user->changeRoutine($accountInfo, 'log_stat', '0');
            $_SESSION['log_stat'] = 0;
            return $this->mail->sendConfirmEmail($accountInfo);
        };
        $emailActions->bindTo($this);

        if (!$this->user->changeRoutine($accountInfo, 'email', $body['newValue'], $emailActions)) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function changePassword(): array
    {
        //TODO: normalize
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
        if (empty($body['newValue'])) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }

        try {
            UserValidator::password($body['newValue']);
        } catch (Exception $e) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        $accountInfo = $this->user->getAccountInfo($_SESSION['id']);

        if (!$this->user->changeRoutine($accountInfo, 'password', $body['newValue'])) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        $_SESSION['password'] = $body['newValue'];
        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function enableNotifications(): array
    {
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
        if (empty($body)) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        $accountInfo = $this->user->getAccountInfo($_SESSION['id']);
        $value = strval((int)$body['checked']);
        $this->user->changeRoutine($accountInfo, 'notifications', $value);
        $_SESSION['notifications'] = $value;
        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }
}
