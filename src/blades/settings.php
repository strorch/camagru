<?php

/**
 * @var $this View
 */

use core\View;

$this->setParent('header');
// TODO: settings page
?>

<script src="/assets/js/settings.js?<?= time() ?>"></script>

<h5>Settings</h5>

<div>
    modify username
    <form method="post" action="/changeUsername">
        <?php $this->includeChild('csrf');?>
        <input type="text"  /> New username
        <input type="submit" value="OK"/>
    </form>
</div>

<div>
    modify email
    <form method="post" action="/changeEmail">
        <?php $this->includeChild('csrf');?>
        <input type="text"  /> New email
        <input type="submit" value="OK"/>
    </form>
</div>

<div>
    modify password
    <form method="post" action="/changePassword">
        <?php $this->includeChild('csrf');?>
        <input type="text"  /> New password
        <input type="submit" value="OK"/>
    </form>
</div>

<div>
    Disable email after comment
    <input type="checkbox" >
</div>
