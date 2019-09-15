<?php

/**
 * @var $posts array
 */

$this->setParent('header');

?>

<div class="images-container">
    <?php foreach ($posts as $post): ?>
        <div id="<?= $post['pict_id'] ?>" class="image-container">
            <div class="picture-tittle">
                <span><?= $post['login'] ?></span>
            </div>
            <div class="picture-div">
                <img class="picture" src="<?= $post['pict'] ?>" alt="picture of <?= $post['login'] ?> user" />
            </div>
        </div>
    <?php endforeach ?>
</div>
