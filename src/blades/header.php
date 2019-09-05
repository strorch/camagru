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
    <title>camagru</title>
    <link rel="stylesheet" href="/assets/css/front_page.css">
</head>
<body>

<div class="main">
    <div id="head">
        <p><?= 'temp' //TODO: implement child passing to find blades title?></p>
        <div id="create_block"></div>
        <a href="/">camagru</a>
    </div>
    <br/>
    <?= $childString ?>
</div>

<footer>
    footer
</footer>
</body>
</html>
