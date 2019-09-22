<?php

/**
 * @var $this View
 * @var $posts array
 */
use core\View;

$this->setParent('header');

?>
<script src="/assets/js/makePhoto.js?<?= time() ?>"></script>

<h5>Profile</h5>

<button class="waves-effect waves-light btn" id="make-photo">Make photo</button>
<button class="waves-effect waves-light btn" id="load-picture">Load picture</button>

<div class="actions-container">
    <div id='make-photo-container' class="make-photo-container"></div>
    <div id="sticker-container"></div>
</div>

<div class="container">
    <div>
        Recently images
    </div>
    <div id="images-container" class="images-container">
        <?php foreach ($posts as $post): ?>
            <div id="<?= $post['pict_id'] ?>" class="image-container col s8 z-depth-2">
                <div class="picture-div">
                    <img class="picture" src="<?= $post['pict'] ?>" alt="picture #<?= $post['pict_id'] ?>" />
                    <button id="<?= $post['pict_id'] ?>" class="delete-picture waves-effect waves-light btn-small red">Delete</button>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
