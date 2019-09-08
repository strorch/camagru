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
                <span><?= $post['username'] ?></span>
            </div>
            <div class="picture-div">
                <img class="picture" src="data:image/png;base64, <?= $post['pict'] ?>" alt="Red dot" />
            </div>
        </div>

    <?php endforeach ?>
</div>
