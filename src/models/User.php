<?php

declare(strict_types=1);

namespace models;


use Closure;
use core\Model;
use helpers\SaltGenerator;
use Exception;
use helpers\UserValidator;

/**
 * Class User
 * @package models
 */
class User extends Model
{
    /**
     * @return bool
     */
    public function getUserLoginInfo(): bool
    {
        return !empty($_SESSION['login']);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAccountInfo(int $id): array
    {
        $userInfo =  $this->DB->query("
            select  *
            from    users
            where   id = :id
        ", [
            ':id' => $id,
        ]);
        $userInfo = reset($userInfo);
        $usersPosts = $this->DB->query("
            select  id, pict
            from    posts 
            where   user_id = :user_id
        ", [
            ':user_id' => $id,
        ]);
        $userInfo['posts'] = $usersPosts;
        return $userInfo;
    }

    public function getInfoByPostId(int $postId): array
    {
        $userId =  $this->DB->query("
            select  user_id
            from    posts 
            where   id = :id
        ", [
            ':id' => $postId,
        ]);
        if (empty($userId)) {
            return [];
        }
        $userId = reset($userId)['user_id'];
        return $this->getAccountInfo($userId);
    }

    /**
     * @param string $login
     * @param string $password
     * @return array
     */
    public function findLoginingUser(string $login, string $password): array
    {
        $res = $this->DB->query("
            select  * 
            from    users 
            where   login = :login
            and     password = :password
        ", [
            ':login' => $login,
            ':password' => $password,
        ]);
        if (empty($res)) {
            return [];
        }
        return reset($res);
    }

    public function getUserByLogin(string $login): array
    {
        $res = $this->DB->query("
            select  * 
            from    users
            where   login = :login
        ", [':login' => $login]);
        return reset($res);
    }

    /**
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function checkUserRow(array &$data): void
    {
        foreach (['submit', 'email', 'login', 'password', 'password_confirm'] as $attr) {
            if (empty($data[$attr])) {
                throw new Exception("Attribute '$attr' is empty");
            }
        }
        if ($data['password'] !== $data['password_confirm']) {
            throw new Exception("Wrong password confirmation");
        }
        UserValidator::email($data['email']);
        UserValidator::username($data['login']);
        UserValidator::password($data['password']);
        $res = $this->DB->query("
            select  *
            from    users
            where   login = trim(:login)
            or      email = trim(:email)
        ", [
            ':login' => $data['login'],
            ':email' => $data['email'],
        ]);
        if (!empty($res)) {
            throw new Exception("Login or email already in use");
        }
    }

    /**
     * @param array $row
     * @return array
     * @throws \Exception
     */
    public function saveUser(array $row): array
    {
        $salt = SaltGenerator::generateRandomName();
        $this->DB->exec("
            select create_user(:login, :password, :email, :salt, 0)
        ", [
            ':login' => $row['login'],
            ':password' => $row['password'],
            ':email' => $row['email'],
            ':salt' => $salt,
        ]);
        $res = $this->findLoginingUser($row['login'], $row['password']);
        if (empty($res)) {
            throw new \Exception('Cant find registered user');
        }
        return $res;
    }

    public function confirmEmail(string $id): void
    {
        $salt = SaltGenerator::generateRandomName();
        $this->DB->exec("
            update  users 
            set     salt=:salt,
                    log_stat = 1
            where   id=:id
        ", [
            ':salt' => $salt,
            ':id' => $id,
        ]);
    }

    public function changeRoutine(int $user_id, string $attribute, string $newValue, Closure $callback = null): bool
    {
        $this->DB->exec("
            update  users 
            set     $attribute=:newValue
            where   id = :user_id
        ", [
            ':user_id' => $user_id,
            ':newValue' => $newValue,
        ]);
        if (!empty($callback)) {
            return $callback();
        }
        return true;
    }
}
