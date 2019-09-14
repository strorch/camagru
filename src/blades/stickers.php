<?php
/**
 * @var $stickers array
 * https://stackoverflow.com/questions/10876558/display-image-through-html-image-element-object
 */
?>

<?php foreach ($stickers as $key => $sticker): ?>
    <div class="sticker">
        <img class="picture" src="data:image/png;base64, <?= $sticker['pict'] ?>" alt="sticker <?= $key ?>" />
    </div>
<? endforeach ?>