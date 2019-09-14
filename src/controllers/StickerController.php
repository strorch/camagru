<?php

declare(strict_types=1);

namespace controllers;


use core\AbstractController;
use core\Model;
use models\Sticker;

/**
 * Class StickerController
 * @package controllers
 */
class StickerController extends AbstractController
{
    /**
     * @var Sticker
     */
    private $stickers;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->stickers = $model::getInstance(Sticker::class);
    }

    /**
     * @return array
     */
    public function getStickers(): array
    {
        return [
            'view' => 'stickers',
            'data' => [
                'stickers' => $this->stickers->getAvailableStickers(),
            ],
        ];
    }
}