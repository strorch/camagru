<?php

/**
 * @var $posts array
 */
$this->setParent('header');

?>

<h5>Profile</h5>

<div class="images-container">
    <?php foreach ($posts as $post): ?>
        <div id="<?= $post['pict_id'] ?>" class="image-container">
            <div class="picture-tittle">
                <span><?= $post['login'] ?></span>
            </div>
            <div class="picture-div">
                <img class="picture" src="data:image/png;base64, <?= $post['pict'] ?>" alt="picture of <?= $post['login'] ?> user" />
            </div>
        </div>
    <?php endforeach ?>
</div>
