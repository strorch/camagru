<?php

declare(strict_types=1);

namespace models;


use core\Model;
use helpers\SaltGenerator;
use Exception;

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
            from    users where id = :id
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

    /**
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function checkUserRow(array $data): void
    {
        foreach (['submit', 'email', 'login', 'password', 'password_confirm'] as $attr) {
            if (empty($data[$attr])) {
                throw new Exception("Attribute '$attr' is empty");
            }
        }
        if ($data['password'] !== $data['password_confirm']) {
            throw new Exception("Wrong password confirmation");
        }
        if (strlen($data['login']) < 6 || empty(preg_match("/^[a-zA-Z ]*$/", $data['login']))) {
            throw new Exception("Wrong login! Only letters and white space allowed");
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Wrong login! Invalid email format");
        }
        if (strlen($data['password']) < 6 || empty(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['password']))) {
            throw new Exception("Weak password!");
        }
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
}
