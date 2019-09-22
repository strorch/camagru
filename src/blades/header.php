<?php

use core\View;

/**
 * @var $this View
 * @var $childString
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?= $_SESSION['_csrf'] ?>">
    <title>camagru</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/materialize.min.css">
    <link rel="stylesheet" href="/assets/css/profile.css?<?=time()?>">
    <link rel="stylesheet" href="/assets/css/front_page.css?<?=time()?>">
    <link rel="stylesheet" href="/assets/css/login.css?<?=time()?>">
</head>
<body>

<div id="head">
    <?php $this->includeChild('head') ?>
</div>
<div class="container">
    <div class="main">
        <?= $childString ?>
    </div>
</div>

<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            © 2019 mstorcha
            <span class="grey-text text-lighten-4 right">smy980807@ukr.net</span>
        </div>
    </div>
</footer>

</body>
</html>
