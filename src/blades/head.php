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
    <div>
        <a href="/profile">
            <div>Profile</div>
        </a>
    </div>
    <div>
        <a href="/settings">
            <div>Settings</div>
        </a>
    </div>
    <div>
        <form action="/logout" method="post">
            <?php $this->includeChild('csrf') ?>
            <input name="submit" type="submit" value="logout"/>
        </form>
    </div>
<?php endif ?>

<div id="create_block"></div>
<a href="/">camagru</a>


