<?php
/**
 * @var $stickers array
 */
?>

<?php foreach ($stickers as $key => $sticker): ?>
    <div class="sticker-div" data-id="<?= $sticker['id'] ?>">
        <img class="sticker" src="data:image/png;base64, <?= $sticker['pict'] ?>" alt="sticker <?= $key ?>" />
    </div>
<? endforeach ?>