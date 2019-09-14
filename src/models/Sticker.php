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
        $stickerNames =  $this->DB->query("
            select  id,
                    pict
            from    stickers
        ");
        foreach ($stickerNames as $stickerName) {
            $stickers[] = base64_encode(file_get_contents(STICKERS_DIR . $stickerName));
        }

    }
}
