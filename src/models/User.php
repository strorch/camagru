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
     * @param string $id
     * @return array
     */
    public function getAccountInfo(string $id): array
    {
        return [];
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
            where   name = :login
            and     password = :password
        ", [
            ':login' => $login,
            ':password' => $password,
        ]);
    }
}