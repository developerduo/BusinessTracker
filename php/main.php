<?php

if(!isset($_COOKIE['username'])) {
    header("Location: ./index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../css/main.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<header class='dashboardHeader'>
    <h1 class='text'>Dashboard</h1>
    <h2 class='text'>Albert Heijn</h2>
    <div class="userWrapper">
    <i class="far fa-user-circle"></i>
        <p>Jurrie</p>
        <a onclick='accountMenu()'><i id='arrowDown' class="fas fa-angle-down"></i></a>
        <a onclick='accountMenu()'><i id='arrowUp' class="fas fa-angle-up"></i></a>
    </div>
    <div id='userMenu' class="userMenu">
    </div>
</header>
<body class='dashboardBody'>
<nav class='dashboardSidebar'>

    <a><div class="agendaKop">
        <img src="../img/agenda.png" alt="">
        <p class='text'>Agenda</p>
    </div></a>
    <a><div class="inklokKop">
        <img src="../img/inklokken.png" alt="">
        <p class='text'>Inklokken</p>
    </div></a>
    <a><div class="loonKop">
        <img src="../img/money-bag.png" alt="">
        <p class='text'>Loon</p>
    </div></a>
</nav>
    <div class="inklokWrapper">

    </div>
    <div class="urenWrapper">

    </div>
    <div class="loonWrapper">

    </div>
    <script src='../js/main.js  '></script>
</body>
</html>