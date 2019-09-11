<?php

/**
 * @var $this View
 * @var $posts array
 */
use core\View;

$this->setParent('header');

?>

<script src="/assets/js/makePhoto.js"></script>
<script src="/assets/js/canvas.js"></script>

<h5>Profile</h5>

<div class="make-photo-container">
    <?php $this->includeChild('canvas') ?>
</div>

<div>
    <div>
        Recently images
    </div>
    <div class="images-container">
        <?php foreach ($posts as $post): ?>
            <div id="<?= $post['pict_id'] ?>" class="image-container">
                <div class="picture-div">
                    <img class="picture" src="data:image/png;base64, <?= $post['pict'] ?>" alt="picture of <?= $post['login'] ?> user" />
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
