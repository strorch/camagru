<?php

use core\View;

/**
 * @var $this View
 * @var $childString
 */

print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?= $_SESSION['_csrf'] ?>">
    <title>camagru</title>
    <link rel="stylesheet" href="/assets/css/profile.css?<?=time()?>">
    <link rel="stylesheet" href="/assets/css/front_page.css?<?=time()?>">
    <link rel="stylesheet" href="/assets/css/login.css?<?=time()?>">
</head>
<body>

<div id="head">
    <?php $this->includeChild('head') ?>
</div>

<div class="main">
    <?= $childString ?>
</div>

<footer>
    footer
</footer>
</body>
</html>
