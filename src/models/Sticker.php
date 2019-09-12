<?php


namespace models;


use core\Model;

/**
 * Class Sticker
 * @package models
 */
class Sticker extends Model
{
    public function getAvailableStickers(): array
    {
        return $this->DB->query("
            select  * 
            from    stickers
        ");
    }
}
