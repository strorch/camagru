<?php


namespace controllers;


use core\AbstractController;
use core\Model;
use models\Sticker;

class StickerController extends AbstractController
{
    private $stickers;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->stickers = $model::getInstance(Sticker::class);
    }

    public function getStickers(): array
    {
        return [
//            'view' => 'stickers',
            'data' => [
                'stickers' => $this->stickers->getAvailableStickers(),
            ],
        ];
    }
}