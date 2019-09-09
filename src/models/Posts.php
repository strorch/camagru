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
        $params = [
            ':start_number' => $startNumber,
            ':end_number' => $endNumber,
        ];
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
                             and    t1.id >= :start_number
                             and    t1.id <= :end_number
                             $userCondition
        ", $params);

        foreach ($req_posts as $post) {
            $postPath = $this->getPostPath($post['login'], $post['pict']);
            $image = base64_encode(file_get_contents($postPath));
            yield [
                'user_id' => $post['user_id'],
                'login' => $post['login'],
                'email' => $post['email'],
                'pict_id' => $post['pict_id'],
                'pict' => $image
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
        return BASE_DIR . "/runtime/$username/$postname";
    }
}
