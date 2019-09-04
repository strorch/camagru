<?php

/**
 * @var $this View
 */

use core\View;

$this->setParent('header');

?>
<div class="tab">
    <button class="tablinks" id='default'>Login</button>
    <button class="tablinks" id='secondary'>Register</button>
</div>

<div id="Login" class="tabcontent">
    <form method="post" action="../../index.php">
        <?php $this->includeChild('csrf');?>
        <input name="login" type="text"/>Login
        <br/>
        <input name="passwd" type="password"/>Password
        <br/>
        <input name="submit" type="submit" value="OK"/>
    </form>
</div>

<div id="Register" class="tabcontent">
    <form method="post" action="../../index.php">
        <input name="email" type="email"/>Email
        <br/>
        <input name="login" type="text"/>Login
        <br/>
        <input name="passwd" type="password"/>Password
        <br/>
        <input name="conf_passwd" type="password"/>Confirm
        <br/>
        <input name="submit" type="submit" value="OK"/>
    </form>
</div>

<?php $this->includeChild('testBlade'); ?>
