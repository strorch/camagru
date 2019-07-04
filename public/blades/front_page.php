<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEMAGRU</title>
    <link rel="stylesheet" href="./public/css/front_page.css">
</head>
<body>
<div id="head">
    <p>front page</p>
    <?php
        session_start();
        if (isset($_SESSION['name']))
            echo 'Hello '.$_SESSION['name'];
        else
            echo '<a href="/login">Sign up</a>';
    ?>
    <a href="/">MEMAGRU</a>
</div>

<div class="main">
    <h1>hello tupa sraka</h1>
    <?php
        $posts = new Posts();
        foreach ($posts::$posts as $post)
        {
            echo $post['user'].'<br/>';
            echo '<img src="data:image/jpg;base64,'.$post['pict'].'" height="200px" width="200px"/><br/><br/>';
        }
    ?>
</div>

</body>
</html>