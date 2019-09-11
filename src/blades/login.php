<?php

/**
 * @var $this View
 */

use core\View;

$this->setParent('header');

?>

<script src="/assets/js/login_tabs.js?<?= time() ?>"></script>

<div class="tab">
    <button data-target="login" id="button-login" class="tablinks">Login</button>
    <button data-target="register" id="button-register" class="tablinks">Register</button>
</div>

<div id="login" class="tabcontent">
    <form method="post" action="/login">
        <?php $this->includeChild('csrf');?>
        <input name="login" type="text"/>Login
        <br/>
        <input name="password" type="password"/>Password
        <br/>
        <input name="submit" type="submit" value="OK"/>
    </form>
</div>

<div id="register" class="tabcontent">
    <form method="post" action="/register">
        <?php $this->includeChild('csrf');?>
        <input name="email" type="email"/>Email
        <br/>
        <input name="login" type="text"/>Login
        <br/>
        <input name="password" type="password"/>Password
        <br/>
        <input name="password_confirm" type="password"/>Confirm
        <br/>
        <input name="submit" type="submit" value="OK"/>
    </form>
</div>
