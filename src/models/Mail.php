<?php

declare(strict_types=1);

namespace models;


use core\Application;
use core\Model;
use helpers\SaltGenerator;
use Exception;

/**
 * Class Mail
 * @package models
 */
class Mail extends Model
{
    //TODO: normalize class
    /**
     * @param array $user
     * @return bool
     */
    public function sendConfirmEmail(array $user): bool
    {
        $link = $this->createMailUrl('emailConfirm', $user);
        return mail($user['email'], 'Camagru', 'Confirm your email via link: ' . $link);
    }

    /**
     * @param array $user
     * @param string $password
     * @return bool
     */
    public function sendPasswordEmail(array $user, string $password): bool
    {
        $res = mail($user['email'], 'Camagru', "Your new temporary password: $password\nChange it in settings page");
        return $res;
    }

    /**
     * @param string $action
     * @param array $user
     * @return string
     */
    private function createMailUrl(string $action, array $user): string
    {
        $url = Application::getConfig()['url'];
        $salt = SaltGenerator::hashName($user['salt']);
        return "{$url['cert']}://{$url['uri']}/$action?id={$user['id']}&secret=$salt";
    }

    /**
     * @param array $params
     * @param User $user
     * @throws Exception
     */
    public function validateConfirmParams(array &$params, User $user): void
    {
        foreach (['id', 'secret'] as $key) {
            $params[$key] = strip_tags($params[$key]);
            if (empty($params[$key])) {
                throw new Exception('Email confirm error');
            }
        }
        $account = $user->getAccountInfo((int)($params['id']));
        if (empty($account)) {
            throw new Exception('Email confirm error');
        }
        if (SaltGenerator::hashName($account['salt']) !== $params['secret']) {
            throw new Exception('Email confirm error');
        }
    }

    /**
     * @param string $ownerEmail
     * @param string $sender
     * @param string $comment
     * @return bool
     */
    public function sendCommentNotification(string $ownerEmail, string $sender, string $comment): bool
    {
        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset: utf8\r\n";
        $text = "
            <html>
                <head>
                    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
                </head>
                <body>
                   <h3>User @$sender sent you comment:</h3>
                   <br/>
                   $comment
                </body>
            </html>
        ";
        return mail($ownerEmail, 'Camagru', $text, $header);
    }
}
