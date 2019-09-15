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
        $sticker = $this->sticker->getStickerById($requestedSticker['id']);
        $sticker = reset($sticker);
        $stickerImgResource = $this->getStickerImgResource($sticker['pict']);
        $userImgResource = $this->getUserImgResource($userImg);

        imagecopyresampled(
            $userImgResource,
            $stickerImgResource,
            imagesx($stickerImgResource),
            imagesy($stickerImgResource),
            0,
            0,
            200,
            200,
            imagesx($stickerImgResource),
            imagesy($stickerImgResource)
        );
        $photoNum = $this->posts->lastInsertUserPhoto($_SESSION['id']);
        $dirToSave = BASE_DIR . "/runtime/{$_SESSION['login']}/";
        $fileToSave = "pict$photoNum.jpg";
        mkdir($dirToSave, 0777, true);
        imagejpeg($userImgResource, $dirToSave . $fileToSave);
        imagedestroy($userImgResource);
        imagedestroy($stickerImgResource);
        $this->posts->savePost($_SESSION['id'], $fileToSave);

        return [
            'data' => [
                'res' => 'success',
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
}