<?php

declare(strict_types=1);

namespace models;


use core\Model;

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
            select  id, pict, cmt
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
     * @return array|null
     */
    public function findLoginingUser(string $login, string $password): ?array
    {
        return $this->DB->query("
            select  * 
            from    users 
            where   login = :login
            and     password = :password
        ", [
            ':login' => $login,
            ':password' => $password,
        ]);
    }
}
