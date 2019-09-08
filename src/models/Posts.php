<?php

declare(strict_types=1);

namespace models;

use core\Model;

class Posts extends Model
{
    public function getPosts(int $startNumber, int $endNumber): \Iterator
    {
        $req_posts = $this->DB->query("
            select  t1.id as pict_id, 
                    t1.pict, 
                    t1.user_id, 
                    t2.name as username, 
                    t2.email 
            from    posts t1 
            join    users t2 on t1.user_id=t2.id
        ");

        foreach ($req_posts as $post) {
            $tmp = base64_encode(file_get_contents($post['pict']));
            yield [
                'user' => $post['USER'],
                'pict' => $tmp
            ];
        }
    }
}
