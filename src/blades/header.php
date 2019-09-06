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
    <title>camagru</title>
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

<script src="/assets/js/login_tabs.js?<?=time()?>"></script>

<footer>
    footer
</footer>
</body>
</html>
