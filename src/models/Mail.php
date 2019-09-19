<?php


namespace models;


use core\Application;
use core\Model;
use helpers\SaltGenerator;
use Exception;

class Mail extends Model
{
    public function sendConfirmEmail(array $user): bool
    {
        $link = $this->createMailUrl('emailConfirm', $user);
        $res = mail($user['email'], 'Camagru', 'Confirm your email via link: ' . $link);
        return $res;
    }

    public function sendPasswordEmail(array $user, string $password): bool
    {
        $res = mail($user['email'], 'Camagru', "Your new temporary password: $password\nChange it in settings page");
        return $res;
    }

    private function createMailUrl(string $action, array $user): string
    {
        $url = Application::getConfig()['url'];
        $salt = SaltGenerator::hashName($user['salt']);
        return "{$url['cert']}://{$url['uri']}/$action?id={$user['id']}&secret=$salt";
    }

    public function validateConfirmParams(array $params, User $user): void
    {
        foreach (['id', 'secret'] as $key) {
            if (empty($params[$key])) {
                throw new Exception('Email confirm error');
            }
        }
        $account = $user->getAccountInfo($params['id']);
        if (empty($account)) {
            throw new Exception('Email confirm error');
        }
        if (SaltGenerator::hashName($account['salt']) !== $params['secret']) {
            throw new Exception('Email confirm error');
        }
    }
}