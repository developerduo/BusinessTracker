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
    <link rel="stylesheet" href="../../resources/css/controlpanel.css">
    <title>Control Panel</title>
</head>
<body>
    <nav class='navBar'>
        <h2>Control<br>Panel</h2>
        <ul class='list'>
            <li class='listKop'>Gebruikers</li>
            <li class='listKop'>Inplannen</li>
            <li class='listKop'>Uitbetalen</li>
            <li class='listKop'>Instellingen</li>
        </ul>
    </nav>
</body>
</html>