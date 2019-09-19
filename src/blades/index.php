<?php

/**
 * @var $posts array
 */

$this->setParent('header');
//TODO: paginate page
//TODO: leave comment and like
?>

<script src="/assets/js/pictureActions.js"></script>

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
                    </div>
                    <div class="comment-field">
                        <input id="<?= $post['pict_id'] ?>" type="text" class="comment" />
                        <button id="<?= $post['pict_id'] ?>" class="send-comment">Comment</button>
                    </div>
                </div>
            <?php endif ?>
        </div>
    <?php endforeach ?>
</div>
