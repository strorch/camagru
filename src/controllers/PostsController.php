<?php

declare(strict_types=1);

namespace controllers;


use core\AbstractController;
use core\Model;
use core\Utils;
use http\Message\Body;
use models\Posts;
use models\Sticker;

/**
 * Class PostsController
 * @package controllers
 */
class PostsController extends AbstractController
{
    /**
     * @var Sticker
     */
    private $sticker;

    /**
     * @var Posts
     */
    private $posts;

    /**
     * PostsController constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->posts = $model::getInstance(Posts::class);
        $this->sticker = $model::getInstance(Sticker::class);
    }

    /**
     * @return array
     */
    public function savePost()
    {
        $body = Utils::fetchParse();
        if (empty($body)) {
            return [
                'data' => [
                    'error' => 'empty input',
                ],
            ];
        }
        $userImg = $body['userImg'];
        $requestedSticker = $body['stickerAttrs'];
        $sticker = $this->sticker->getStickerById($requestedSticker['id']);

//        $sticker = imagecreatefromstring(base64_decode(explode(';base64,', $layer['source'])[1]));
//        imagecopyresampled($photo, $sticker, $layer['left'], $layer['top'], 0, 0, $layer['width'], $layer['height'], imagesx($sticker), imagesy($sticker));
//        imagejpeg($photo, getRoot() . 'public/' . $url, 100);

        return [
            'data' => [

            ],
        ];
    }
}