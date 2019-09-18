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
                    'res' => 'error',
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
        $dirToSave = BASE_DIR . "/runtime/{$_SESSION['login']}/";
        $fileToSave =  $this->generateRandomName() . '.jpg';
        @mkdir($dirToSave, 0777, true);
        $res = imagejpeg($userImgResource, $dirToSave . $fileToSave);
        $this->posts->savePost($_SESSION['id'], $fileToSave);

        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }

    /**
     * @return string
     */
    private function generateRandomName(): string
    {
        $num1 = (string)rand(0, 50);
        $num2 = (string)rand(50, 10);
        return md5($num1 . $num2);
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
     * @return array
     */
    public function deletePost(): array
    {
        $body = Utils::fetchParse();
        if (empty($body)) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        $this->posts->
//        $this->posts->deletePost((int)$body['postId']);
        $dir = BASE_DIR . "/runtime/{$_SESSION['login']}/";
//        $fileToDel = "pict{$body['postId']}.jpg";
//        unlink($dir . $fileToDel);
        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }

    public function test()
    {
        $res = mail('homiak.max@gmail.com', 'Subjectgregrergrege', 'Bodygergergegrege');
        return [
            'data' => [
                'res' => $res,
            ]
        ];
    }
}