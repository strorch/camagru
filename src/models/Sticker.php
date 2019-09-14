<?php

declare(strict_types=1);

namespace models;


use core\Model;
use Iterator;

/**
 * Class Sticker
 * @package models
 */
class Sticker extends Model
{
    public function getAvailableStickers(): Iterator
    {
        $stickerNames =  $this->DB->query("
            select  id,
                    pict
            from    stickers
        ");
        foreach ($stickerNames as $stickerName) {
            $sticker['pict'] = base64_encode(file_get_contents(STICKERS_DIR . $stickerName['pict']));
            $sticker['id'] = $stickerName['id'];
            yield $sticker;
        }
    }

    public function getStickerById(string $id): array
    {
        return  $this->DB->query("
            select  id,
                    pict
            from    stickers
            where   id=:id
        ", ['id' => $id]);
    }
}
