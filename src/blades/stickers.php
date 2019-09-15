<?php
/**
 * @var $stickers array
 */
?>

<?php foreach ($stickers as $key => $sticker): ?>
    <div class="sticker-div" data-id="<?= $sticker['id'] ?>">
        <img class="sticker" src="<?= $sticker['pict'] ?>" alt="sticker <?= $sticker['id'] ?>" />
    </div>
<? endforeach ?>