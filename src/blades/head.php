<?php

/**
 * @var $this View
 */

use core\View;

?>


<?php if (empty($_SESSION['login'])): ?>
    <?php if ($_SERVER['REQUEST_URI'] !== '/login'): ?>
        <a href="/login">
            <div>Sign in</div>
        </a>
    <?php else: ?>

    <?php endif ?>
<?php else: ?>
<!--    <p>Hello, <span>--><?php //$_SESSION['login'] ?><!--</span></p>-->
<?php endif ?>

<div id="create_block"></div>
<a href="/">camagru</a>


