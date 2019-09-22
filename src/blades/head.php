<?php

/**
 * @var $this View
 */

use core\View;

?>

<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo">Camagru</a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php if (empty($_SESSION['login'])): ?>
                <?php if ($_SERVER['REQUEST_URI'] !== '/login'): ?>
                    <li><a href="/login">Sign in</a></li>
                <?php endif ?>
            <?php else: ?>

                <?php if ($_SESSION['log_stat'] === 0): ?>
                    <li><h5>You should to confirm your email to make photos!</h5></li>
                <?php else: ?>
                    <li><a href="/profile">Profile</a></li>
                <?php endif ?>
                <li><a href="/settings">Settings</a></li>
                <li>
                    <form action="/logout" method="post">
                        <?php $this->includeChild('csrf') ?>
                        <input class="waves-effect waves-light btn" name="submit" type="submit" value="logout"/>
                    </form>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>



