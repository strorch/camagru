<?php

use core\View;

/**
 * @var $this View
 * @var $posts array
 * @var $paginations array
 */

$this->setParent('header');

?>

<script src="/assets/js/pictureActions.js?<?= time() ?>"></script>

<div class="images-container col s12">
    <?php foreach ($posts as $post): ?>
        <div id="<?= $post['pict_id'] ?>" class="image-container col s12 z-depth-2">
            <div class="picture-tittle">
                <span><?= $post['login'] ?></span>
            </div>
            <hr/>
            <div class="container">
                <div class="picture-div">
                    <img class="picture" src="<?= $post['pict'] ?>" alt="picture of <?= htmlspecialchars($post['login']) ?> user" />
                </div>
            </div>
            <hr/>
            <?php if (!empty($_SESSION['login'])): ?>
                <div class="picture-actions-block container">
                    <div class="row">
                        <div class="like-field col s2 offset-s2">
                            <div class="row">
                                <div class="col s6">
                                    <i class="fa fa-2x fa-heart<?php if (!$post['is_liked']) : ?>-o<?php endif ?>" aria-hidden="true"></i>
                                    <button id="<?= $post['pict_id'] ?>" class="send-like">Like</button>
                                </div>
                                <div class="col s6">
                                    <?= $post['cnt_likes'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="comment-field col s6">
                            <div class="row">
                                <div class="col s10">
                                    <input id="<?= $post['pict_id'] ?>" type="text" class="comment" />
                                    <label for="<?= $post['pict_id'] ?>">Leave comment</label>
                                </div>
                                <div class="col s2">
                                    <button id="<?= $post['pict_id'] ?>" class="send-comment waves-effect waves-light btn">Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comments-block row">
                        <?php foreach ($post['comments'] as $comment): ?>
                            <div class="comment-div col s8 offset-s4 " id="<?= $comment['comment_id'] ?>">
                                <b><?= htmlspecialchars($comment['login']) ?>:</b>  <?= htmlspecialchars($comment['comment']) ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    <?php endforeach ?>
</div>

<div id="pagination" class="container">
    <div class="pagination row">
        <?php foreach ($paginations as $key => $pagination): ?>
            <div class="pagination-item col s1">
                <a href="<?= $pagination ?>"><b><?= $key ?></b></a>
            </div>
        <?php endforeach ?>
    </div>
</div>
