<?php

/**
 * @var $this View
 * @var $posts array
 */
use core\View;

$this->setParent('header');

?>

<!--<video id="video" width="640" height="480" autoplay></video>-->
<!--<button id="snap">Snap Photo</button>-->
<!--<canvas id="canvas" width="640" height="480"></canvas>-->
<!---->
<!--<script>-->
<!--    var video = document.getElementById('video');-->
<!---->
<!--    // Get access to the camera!-->
<!--    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {-->
<!--        // Not adding `{ audio: true }` since we only want video now-->
<!--        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {-->
<!--            //video.src = window.URL.createObjectURL(stream);-->
<!--            video.srcObject = stream;-->
<!--            video.play();-->
<!--        });-->
<!--    }-->
<!--    var canvas = document.getElementById('canvas');-->
<!--    var context = canvas.getContext('2d');-->
<!---->
<!--    // Trigger photo take-->
<!--    document.getElementById("snap").addEventListener("click", function() {-->
<!--        context.drawImage(video, 0, 0, 640, 480);-->
<!--    });-->
<!--</script>-->
<script src="/assets/js/makePhoto.js?<?= time() ?>"></script>
<script src="/assets/js/canvas.js?<?= time() ?>"></script>

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
