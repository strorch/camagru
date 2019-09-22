<?php

/**
 * @var $this View
 */

use core\View;

$this->setParent('header');
?>

<script src="/assets/js/settings.js?<?= time() ?>"></script>

<div class="center-settings z-depth-2">

    <div style="text-align: center">
        <h5>Settings</h5>
    </div>

    <div class="row">
        <div class="col s7 offset-s3">

            <div class="col">
                <div class="row s12">
                    Modify username:
                </div>
                <div class="row s12">
                    <div class="row">
                        <div class="col s6">
                            <input id="username-input" type="text" />
                            <label for="username-input">New username</label>
                        </div>
                        <div class="col s2">
                            <input class="waves-effect waves-light btn" id="username-button" type="submit" value="OK"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row s12">
                    Modify email:
                </div>
                <div class="row s12">
                    <div class="row">
                        <div class="col s6">
                            <input id="email-input" type="text"  />
                            <label for="email-input">New email</label>
                        </div>
                        <div class="col s2">
                            <input class="waves-effect waves-light btn" id="email-button" type="submit" value="OK"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row s12">
                    Modify password:
                </div>
                <div class="row s12">
                    <div class="row">
                        <div class="col s6">
                            <input id="password-input" type="text" />
                            <label for="password-input">New password</label>
                        </div>
                        <div class="col s2">
                            <input class="waves-effect waves-light btn" id="password-button" type="submit" value="OK"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <p>
                    <label>
                        <input id="notifications-click" type="checkbox" <?php if ($_SESSION['notifications']): ?> checked <?php endif ?> />
                        <span>Notifications by email after comment</span>
                    </label>
                </p>
            </div>
        </div>
    </div>

</div>
