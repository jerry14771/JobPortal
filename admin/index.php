<?php

include '../config.php';
if (!(isset($_SESSION['admin_id']))) {
    header("location:login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Welcome Admin


    <a href="logout.php">logout</a>
</body>

</html>