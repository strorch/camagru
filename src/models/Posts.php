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
     * @param string|null $user_id
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
            select  distinct
                    t1.id as pict_id, 
                    t1.pict, 
                    t1.user_id, 
                    t2.login, 
                    t2.email
            from    posts t1
            join    users t2 on     t1.user_id=t2.id
                             $userCondition
        ", $params);

        foreach ($req_posts as $post) {
            yield [
                'user_id' => $post['user_id'],
                'login' => $post['login'],
                'email' => $post['email'],
                'pict_id' => $post['pict_id'],
                'pict' => $this->getPostPath($post['login'], $post['pict']),
            ];
        }
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
     * @return bool
     */
    public function savePost(int $userId, string $pictName): void
    {
        $this->DB->exec("
            SELECT create_post(:user_id, :pict_name)
        ", [":user_id" => $userId, ":pict_name" => $pictName]);
    }

    /**
     * @param int $userId
     * @return int
     */
    public function lastInsertUserPhoto(int $userId): int
    {
        $tmp = $this->DB->query("
            select  count(*) as cnt
            from    posts
            where   user_id=:user_id
        ", ['user_id' => $userId]);
        return reset($tmp)['cnt'];
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
}
