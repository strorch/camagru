<?php

namespace models;

use core\Model;

class Posts extends Model
{
    public function getPosts(int $startNumber, int $endNumber): \Iterator
    {
        yield 1;
//        $req_posts = $this->DB->query("SELECT * FROM posts;");
//
//        foreach ($req_posts as $post) {
//            $tmp = base64_encode(file_get_contents($post['pict']));
//            yield [
//                'user' => $post['USER'],
//                'pict' => $tmp
//            ];
//        }
    }
}
