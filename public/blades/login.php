<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEMAGRU</title>
    <style>

        #head {
            border: solid 2px black;
            min-height: inherit;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }


        .block_post {
            border: solid 1px red;
        }

        #create_block {
        }
    </style>
</head>
<body>
    <div id="head">
        <p>login page</p>
        <div id="create_block"></div>
    </div>
    <form method="post" action="./login_action">
        <input name="login" type="text"/>
        <input name="passwd" type="password"/>
        <input name="submit" type="submit" value="OK"/>
    </form>

    <script src="./public/js/fill_column.js"></script>
</body>
</html>