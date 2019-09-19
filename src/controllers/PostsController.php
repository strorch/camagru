<?php

declare(strict_types=1);

namespace controllers;


use core\AbstractController;
use core\Model;
use core\Utils;
use helpers\SaltGenerator;
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
        $fileToSave =  SaltGenerator::generateRandomName(true) . '.jpg';
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
        $toDel = $this->posts->findPost($body['postId']);
        $this->posts->deletePost($toDel['id']);
        $dir = BASE_DIR . "/runtime/{$_SESSION['login']}/";
        $fileToDel = $toDel['pict'];
        unlink($dir . $fileToDel);
        return [
            'data' => [
                'res' => 'success',
            ],
        ];
    }

    public function likePost(): array
    {
        $body = Utils::fetchParse();
        if (empty($_SESSION['login'])) {
            return [
                'data' => [
                    'res' => 'error'
                ],
            ];
        }
        if ($this->posts->isUserLiked((int)$body['post_id'], $_SESSION['id'])) {
            $this->posts->removeLike((int)$body['post_id'], $_SESSION['id']);
        } else {
            $this->posts->setLike((int)$body['post_id'], $_SESSION['id']);
        }
        $likes = $this->posts->getLikes((int)$body['post_id']);
        return [
            'data' => [
                'res' => 'success',
                'likes' => $likes,
            ]
        ];
    }

    public function commentPost(): array
    {
        $body = Utils::fetchParse();
        if (empty($_SESSION['login']) || empty($body)) {
            return [
                'data' => [
                    'res' => 'error'
                ],
            ];
        }
        $this->posts->addComment((int)$body['post_id'], $_SESSION['id'], $body['comment']);
        return [
            'data' => [
                'res' => 'success',
            ]
        ];
    }
}
