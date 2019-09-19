<?php

declare(strict_types=1);

namespace models;

use core\Model;
use Iterator;

/**
 * Class Posts
 * @package models
 */
class Posts extends Model
{
    /**
     * @param int $startNumber
     * @param int $endNumber
     * @param int|null $user_id
     * @return Iterator
     */
    public function getPosts(int $startNumber, int $endNumber, ?int $user_id = null): Iterator
    {
        $userCondition = '';
        $params = [];
        if (!empty($user_id)) {
            $userCondition = 'and   t2.id = :user_id';
            $params[':user_id'] = $user_id;
        }
        $req_posts = $this->DB->query("
            select  t1.id as pict_id, 
                    t1.pict, 
                    t1.user_id, 
                    t2.login, 
                    t2.email
            from    posts t1
            join    users t2 on     t1.user_id=t2.id
                             $userCondition
        ", $params);

        foreach ($req_posts as $post) {
            $likes = $this->getLikes($post['pict_id'], $post['user_id']);
            yield [
                'user_id' => $post['user_id'],
                'login' => $post['login'],
                'email' => $post['email'],
                'pict_id' => $post['pict_id'],
                'pict' => $this->getPostPath($post['login'], $post['pict']),
//                'cnt_likes' => $likes['cnt_likes'],
//                'is_liked' => $likes['is_liked'],
            ];
        }
    }

    /**
     * @param string $id
     * @return array
     */
    public function findPost(string $id): array
    {
        $res = $this->DB->query("
            select  t1.id, 
                    t1.pict
            from    posts t1
            where   t1.id = :id
        ", [':id' => $id]);
        return reset($res);
    }

    /**
     * @param string $username
     * @param string $postname
     * @return string
     */
    private function getPostPath(string $username, string $postname): string
    {
        return "/runtime/$username/$postname";
    }

    /**
     * @param int $userId
     * @param string $pictName
     * @return void
     */
    public function savePost(int $userId, string $pictName): void
    {
        $this->DB->exec("
            SELECT create_post(:user_id, :pict_name)
        ", [":user_id" => $userId, ":pict_name" => $pictName]);
    }

    /**
     * @param int $postId
     */
    public function deletePost(int $postId): void
    {
        $this->DB->exec("
            delete from posts where id=:id
        ", [':id' => $postId]);
    }

    public function setLike(int $userId, int $postId): void
    {
        $this->DB->exec("
            select set_like(:posr_id, :user_id)
        ", [
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);
    }

    public function isUserLicked(int $postId, int $userId): bool
    {
        $res = $this->DB->query("
            select  count(*) as cnt
            from    likes
            where   post_id=:post_id
            and     user_id=:user_id 
        ", [
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);
        $res = reset($res);
        return $res['cnt'] > 0;
    }

    public function getLikes(int $postId, int $userId): int
    {
        $res = $this->DB->query("
            select  count(distinct id) as cnt
            from    likes
            where   post_id=:post_id
        ", [
            ':post_id' => $postId,
        ]);
        return reset($res)['cnt'];
    }
}
