<?php


namespace models;


use core\Model;

class User extends Model
{
    public static function getUserLoginInfo(): bool
    {
        return !empty($_SESSION['login']);
    }

    public static function getAccountInfo(string $id): array
    {

    }
}