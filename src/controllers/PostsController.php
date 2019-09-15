<?php

declare(strict_types=1);

namespace controllers;


use core\AbstractController;
use core\Model;
use core\Utils;
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
        $sticker = reset($this->sticker->getStickerById($requestedSticker['id']));
        $stickerImgResource = $this->getStickerImgResource($sticker['pict']);
        $userImgResource = $this->getUserImgResource($userImg);

        imagecopyresampled($userImg, $sticker, 200, 200, 0, 0, $layer['width'], $layer['height'], imagesx($sticker), imagesy($sticker));
//        imagejpeg($photo, getRoot() . 'public/' . $url, 100);

        return [
            'data' => [

            ],
        ];
    }

    /**
     * @param string $stickerName
     * @return false|resource
     */
    private function getStickerImgResource(string $stickerName)
    {
        return $this->imageCreateFromFile(STICKERS_DIR . $stickerName);
    }

    /**
     * @param string $base64
     * @return false|resource
     */
    private function getUserImgResource(string $base64)
    {
        $baseString = explode(',', $base64)[1];
        return imagecreatefromstring(base64_decode($baseString));
    }

    /**
     * @param string $filename
     * @return false|resource
     */
    private function imageCreateFromFile(string $filename)
    {
        switch (strtolower(pathinfo($filename,PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                $img = imagecreatefromjpeg($filename);
                break;
            case 'png':
                $img = imagecreatefrompng($filename);
                break;
        }
        imagefilter($img, IMG_FILTER_PIXELATE, 1, true);
        imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
        return $img;
    }

    /**
    $image = imagecreatefromjpeg("captcha/$captcha-$num.jpg");

    // Add some filters
    imagefilter($image, IMG_FILTER_PIXELATE, 1, true);
    imagefilter($image, IMG_FILTER_MEAN_REMOVAL);

    ob_start(); // Let's start output buffering.
    imagejpeg($image); //This will normally output the image, but because of ob_start(), it won't.
    $contents = ob_get_contents(); //Instead, output above is saved to $contents
    ob_end_clean(); //End the output buffer.

    $dataUri = "data:image/jpeg;base64," . base64_encode($contents);
     */
}