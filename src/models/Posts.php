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
        if (!empty($user_id)) {
            $condition = 'tt.user_id = :user_id';
            $params[':user_id'] = $user_id;
        } else {
            $condition = 'tt.num > :start_num and tt.num <= :end_num';
            $params[':start_num'] = $startNumber;
            $params[':end_num'] = $endNumber;
        }
        $req_posts = $this->DB->query("
            select  *
            from    (
                        select  t1.id as pict_id,
                                t1.pict,
                                t1.user_id,
                                t2.login,
                                t2.email,
                                row_number() over (order by t1.id desc)  as num
                        from    posts t1
                        join    users t2 on     t1.user_id=t2.id
                        order   by t1.id desc
                    ) tt
            where   $condition
        ", $params);

        foreach ($req_posts as $post) {
            yield [
                'user_id' => $post['user_id'],
                'login' => $post['login'],
                'email' => $post['email'],
                'pict_id' => $post['pict_id'],
                'pict' => $this->getPostPath($post['login'], $post['pict']),
                'cnt_likes' => $this->getLikes($post['pict_id']),
                'is_liked' => $this->isUserLiked($post['pict_id'], $_SESSION['id'] ?? $post['user_id']),
                'comments' => $this->getComments($post['pict_id']),
            ];
        }
    }

    public function getPagination(): ?array
    {
        $count_posts = $this->DB->query("
            select  count(*) as cnt
            from    posts
        ");
        $count_posts = reset($count_posts)['cnt'];
        $countOnPage = 5;
        foreach (range(0, $count_posts / $countOnPage) as $number) {
            $min = $number *  $countOnPage;
            $max = $min + $countOnPage;
            $res[$number + 1] = "/?startNum=$min&endNum=$max";
        }
        return $res;
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
            select set_like(:user_id, :post_id)
        ", [
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);
    }

    public function removeLike(int $postId, int $userId): void
    {
        $this->DB->exec("
            delete from likes where user_id=:user_id and post_id=:post_id
        ", [
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);
    }

    public function isUserLiked(int $postId, int $userId): bool
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

    public function getLikes(int $postId): int
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

    public function getComments(int $postId): array
    {
        return $this->DB->query("
            select  t1.id as comment_id,
                    t2.login,
                    t1.comment
            from    comments    t1
            join    users       t2  on  t2.id = t1.user_id
                                    and t1.post_id = :post_id
        ", [':post_id' => $postId]);
    }

    public function addComment(int $postId, int $userId, string $comment): void
    {
        $this->DB->exec("
            select set_comment(:post_id, :user_id, :comment)
        ", [
            ':post_id' => $postId,
            ':user_id' => $userId,
            ':comment' => $comment,
        ]);
    }
}
