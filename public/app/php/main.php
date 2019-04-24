<?php

if(!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <a href='logout.php'>Logout</a>
    <a href='uursysteem.php'>uursysteem</a>
</body>
</html>