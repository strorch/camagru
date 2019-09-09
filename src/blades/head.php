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
    <?php endif ?>
<?php else: ?>
    <a href="/profile">
        <div>Profile</div>
    </a>
    <a href="/settings">
        <div>Settings</div>
    </a>
<?php endif ?>

<div id="create_block"></div>
<a href="/">camagru</a>


