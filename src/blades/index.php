<?php

/**
 * @var $posts array
 */

$this->setParent('header');
//TODO: paginate page
?>

<script src="/assets/js/pictureActions.js?<?= time() ?>"></script>

<div class="images-container">
    <?php foreach ($posts as $post): ?>
        <div id="<?= $post['pict_id'] ?>" class="image-container">
            <div class="picture-tittle">
                <span><?= $post['login'] ?></span>
            </div>
            <div class="picture-div">
                <img class="picture" src="<?= $post['pict'] ?>" alt="picture of <?= $post['login'] ?> user" />
            </div>
            <?php if (!empty($_SESSION['login'])): ?>
                <div class="picture-actions-block">`
                    <div class="like-field">
                        <button id="<?= $post['pict_id'] ?>" class="send-like">Like</button>
                        <div style="<?php if ($post['is_liked']) : ?>color: red <?php endif ?>">
                            <?= $post['cnt_likes'] ?>
                        </div>
                    </div>
                    <div class="comment-field">
                        <input id="<?= $post['pict_id'] ?>" type="text" class="comment" />
                        <button id="<?= $post['pict_id'] ?>" class="send-comment">Comment</button>
                    </div>
                    <div class="comments-block">
                        <?php foreach ($post['comments'] as $comment): ?>
                            <div class="comment-div" id="<?= $comment['comment_id'] ?>">
                                <div><?= $comment['login'] ?></div>
                                <div><?= $comment['comment'] ?></div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    <?php endforeach ?>
</div>
