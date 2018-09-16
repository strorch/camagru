<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEMAGRU</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
    <div id="head">
        <p>login page</p>
        <div id="create_block"></div>
        <a href="/">MEMAGRU</a>
    </div>
    <br/>
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Login')" id='default'>Login</button>
        <button class="tablinks" onclick="openCity(event, 'Register')">Register</button>
    </div>

    <div id="Login" class="tabcontent">
        <form method="post" action="./login_action">
            <input name="login" type="text"/>Login
            <br/>
            <input name="passwd" type="password"/>Password
            <br/>
            <input name="submit" type="submit" value="OK"/>
        </form>
    </div>

    <div id="Register" class="tabcontent">
        <form method="post" action="./register_action">
            <input name="email" type="email"/>Email
            <br/>
            <input name="login" type="text"/>Login
            <br/>
            <input name="passwd" type="password"/>Password
            <br/>
            <input name="conf_passwd" type="conf_password"/>Confirm
            <br/>
            <input name="submit" type="submit" value="OK"/>
        </form>
    </div>

    <script src="./public/js/login_tabs.js"></script>
</body>
</html>