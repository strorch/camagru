<?php

/**
 * @var $this View
 */

use core\View;

$this->setParent('header');
?>

<script src="/assets/js/settings.js?<?= time() ?>"></script>

<h5>Settings</h5>

<div>
    modify username
    <div>
        <input id="username-input" type="text" /> New username
        <input id="username-button" type="submit" value="OK"/>
    </div>
</div>

<div>
    modify email
    <div>
        <input id="email-input" type="text"  /> New email
        <input id="email-button" type="submit" value="OK"/>
    </div>
</div>

<div>
    modify password
    <div>
        <input id="password-input" type="text"  /> New email
        <input id="password-button" type="submit" value="OK"/>
    </div>
</div>

<div>
    Disable email after comment
    <input id="notifications-click" type="checkbox" >
</div>
