<?php


namespace models;


use core\Model;

class User extends Model
{
    public function getUserLoginInfo(): bool
    {
        return !empty($_SESSION['login']);
    }

    public function getAccountInfo(string $id): array
    {

    }
}