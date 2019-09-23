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
    <button data-target="forget-password" id="button-forget-password" class="tablinks">Forget password?</button>
</div>

<div id="login" class="tabcontent">
    <form method="post" action="/login">
        <?php $this->includeChild('csrf');?>
        <input id="login_login" name="login" type="text"/>
        <label for="login_login">Login</label>
        <br/>
        <input id="login_password" name="password" type="password"/>
        <label for="login_password">Password</label>
        <br/>
        <input class="waves-effect waves-light btn" name="submit" type="submit" value="OK"/>
    </form>
</div>

<div id="register" class="tabcontent">
    <form method="post" action="/register">
        <?php $this->includeChild('csrf');?>
        <input id="register_email" name="email" type="email"/>
        <label for="register_email">Email</label>
        <br/>
        <input id="register_login" name="login" type="text"/>
        <label for="register_login">Login</label>
        <br/>
        <input id="register_password" name="password" type="password"/>
        <label for="register_password">Password</label>
        <br/>
        <input id="register_confirm" name="password_confirm" type="password"/>
        <label for="register_confirm">Confirm</label>
        <br/>
        <input class="waves-effect waves-light btn" name="submit" type="submit" value="OK"/>
    </form>
</div>

<div id="forget-password" class="tabcontent">
    <form method="post" action="/forgetPassword">
        <?php $this->includeChild('csrf');?>
        <input id="forget_login" name="login" type="text"/>
        <label for="forget_login">Login</label>
        <br/>
        <input class="waves-effect waves-light btn" name="submit" type="submit" value="OK"/>
    </form>
</div>
