<?php

    if ($_POST["login"] === "" || $_POST["passwd"] === "")
        header("Location: ../index.php");
