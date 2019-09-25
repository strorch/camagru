<?php

declare(strict_types=1);

namespace controllers;


use core\AbstractController;
use core\Model;
use core\Utils;
use helpers\SaltGenerator;
use models\Mail;
use models\Posts;
use models\Sticker;
use models\User;

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
     * @var User
     */
    private $users;

    /**
     * @var Mail
     */
    private $mail;

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
        $this->users = $model::getInstance(User::class);
        $this->mail = $model::getInstance(Mail::class);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function savePost(): array
    {
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
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
            200,
            100,
            0,
            0,
            imagesx($stickerImgResource),
            imagesy($stickerImgResource),
            imagesx($stickerImgResource),
            imagesy($stickerImgResource)
        );
        $dirToSave = BASE_DIR . "/runtime/{$_SESSION['login']}/";
        $fileToSave =  SaltGenerator::generateRandomName(true) . '.jpg';
        @mkdir($dirToSave, 0777);
        if (!imagejpeg($userImgResource, $dirToSave . $fileToSave)) {
            return [
                'data' => [
                    'res' => 'error',
                ],
            ];
        }
        $this->posts->savePost($_SESSION['id'], $fileToSave);

        $posts = $this->posts->getPosts(0, 100, $_SESSION['id']);
        $tmp = '';
        foreach ($posts as $post) {
            $tmp .= "
            <div id=\"{$post['pict_id']}\" class=\"image-container col s8 z-depth-2\">
                <div class=\"picture-div\">
                    <img class=\"picture\" src=\"{$post['pict']}\" alt=\"picture of {$post['login']} user\" />
                    <button id=\"{$post['pict_id']}\" class=\"delete-picture waves-effect waves-light btn-small red\">Delete</button>
                </div>
            </div>
        ";
        }

        return [
            'data' => [
                'res' => 'success',
                'posts' => $tmp,
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
     * @throws \Exception
     */
    public function deletePost(): array
    {
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
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

    /**
     * @return array
     * @throws \Exception
     */
    public function likePost(): array
    {
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
        if (empty($_SESSION['login'])) {
            return [
                'data' => [
                    'res' => 'error'
                ],
            ];
        }
        $like = true;
        if ($this->posts->isUserLiked((int)$body['post_id'], $_SESSION['id'])) {
            $like = false;
            $this->posts->removeLike((int)$body['post_id'], $_SESSION['id']);
        } else {
            $this->posts->setLike((int)$body['post_id'], $_SESSION['id']);
        }
        $likes = $this->posts->getLikes((int)$body['post_id']);
        return [
            'data' => [
                'res' => 'success',
                'likes' => $likes,
                'is_like' => $like,
            ]
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function commentPost(): array
    {
        $body = Utils::fetchParse();
        $this->checkCsrf($body);
        if (empty($_SESSION['login']) || empty($body)) {
            return [
                'data' => [
                    'res' => 'error'
                ],
            ];
        }
        $this->posts->addComment((int)$body['post_id'], $_SESSION['id'], $body['comment']);
        $userInfo = $this->users->getInfoByPostId((int)$body['post_id']);
        if ($userInfo['notifications']) {
            if (!$this->mail->sendCommentNotification($userInfo['email'], strval($_SESSION['login']), $body['comment'])) {
                return [
                    'data' => [
                        'res' => 'error',
                    ]
                ];
            }
        }
        $tmp = '';
        $comments = $this->posts->getComments((int)$body['post_id']);
        foreach ($comments as $comment) {
            $tmp .= "
                <div class=\"comment-div col s8 offset-s4 \" id=\"{$comment['comment_id']}\">
                    <b>{$comment['login']}:</b>  {$comment['comment']}
                </div>
            ";
        }
        return [
            'data' => [
                'res' => 'success',
                'comments' => $tmp,
            ]
        ];
    }
}
