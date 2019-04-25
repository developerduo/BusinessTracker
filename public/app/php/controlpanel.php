<?php

session_start();
if(!isset($_SESSION['username'])) {
    header('Location: ./login.php');
} if($_SESSION['userlevel'] < 2) {
    header('Location: ./dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Panel</title>
</head>
<body>
    
</body>
</html>