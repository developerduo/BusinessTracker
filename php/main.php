<?php

if(!isset($_COOKIE['username'])) {
    header("Location: ./index.html");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
    <link rel='stylesheet' href='../css/main.css'>
    <title>Dashboard</title>
</head>
<header class='DashboardHeader'>
    <h1>Dashboard</h1>
</header>
<body class='MainBody'>
    <br>
    <br>
    <br>
    <br>
    <br>    
    <a href="agenda.php">Agenda</a>
    <a href="logout.php">Logout</a>
=======
    <title>Dashboard</title>
</head>
<body>
    <a href='logout.php'>Logout</a>
    <a href='uursysteem.php'>uursysteem</a>
>>>>>>> 1a9793417743588646b8cece75644e29d69efd18
</body>
</html>