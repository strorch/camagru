<?php
/**
 * Created by PhpStorm.
 * User: mstorcha
 * Date: 9/16/18
 * Time: 4:18 PM
 */

class Posts
{
    public static $posts;

    public function __construct()
    {
        $connection = new DBConnection();
        $req_posts = $connection->query("SELECT * FROM posts;");

        foreach ($req_posts as $post)
        {
            echo "{$post['pict']} {$post['USER']}<br/>";

            $tmp = base64_encode(file_get_contents($post['pict']));
            $posts[] = ['user' => $post['USER'], 'pict' => $tmp];
        }
        self::$posts = $posts;
    }
}