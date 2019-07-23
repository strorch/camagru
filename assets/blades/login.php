<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>camagru</title>
    <link rel="stylesheet" href="/assets/css/front_page.css">

    <script src="/assets/js/login_tabs.js"></script>
</head>
<body>
    <div id="head">
        <p>login page</p>
        <div id="create_block"></div>
        <a href="/">camagru</a>
    </div>
    <br/>
    <div class="tab">
        <button class="tablinks" id='default'>Login</button>
        <button class="tablinks" id='secondary'>Register</button>
    </div>

    <div id="Login" class="tabcontent">
        <?php
            session_start();
            if(isset($_SESSION['error']) === true)
                echo "<h1>try again</h1>";
            session_unset();
        ?>
        <form method="post" action="login_action">
            <input name="login" type="text"/>Login
            <br/>
            <input name="passwd" type="password"/>Password
            <br/>
            <input name="submit" type="submit" value="OK"/>
        </form>
    </div>

    <div id="Register" class="tabcontent">
        <form method="post" action="register_action">
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
</body>
</html>
