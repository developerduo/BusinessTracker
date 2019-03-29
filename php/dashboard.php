<?php


include 'uursyteem.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">


</head>
<body>

<header>
    <div id="username">
        <h3><?= $username ?></h3>
       <h4 onclick="Usersettings()" id="dropdown"> > </h4>
       <div id='Hidden'>
        <p><?= $ID ?></p>
       </div>
    </div>

    <div class="wrapper-text">
        <h3 class="header-brand-mobile">businesstracker</h3>
        <h3 class="header-brand-extra-mobile">dashboard</h3>
    </div>

    <div class="text-wrapper">
        <h3 class="header-brand">businesstracker</h3>
        <h3 class="header-brand-extra">dashboard</h3>
    </div>


</header>
<nav class="sidenav-border">


    <div class="rounds"><img src="../img/agenda.png" class="navside-img"></div><h3 class="rounds-text">Agenda</h3>
    <div class="rounds"><img src="../img/loon.png" class="navside-img"></div><h3 class="rounds-text">loon</h3>
    <div class="rounds"><img src="../img/uren.png" class="navside-img" alt="uren"></div><h3 class="rounds-text">uren</h3>


</nav>
<main>
   <div class="wrapper">
        <section class="index-banner">
            <div class="index-boxlink-square">
                <h3>Uren</h3>
                <?= $tijdin ?>
                <?= $tijdout ?>
                <?= $uren ?>
                <?= $decimal ?>
            </div>

            <div class="index-boxlink-square">
                <h3>loon</h3>
            </div>

            <div class="index-boxlink-square">
                <h3>agenda</h3>
            </div>

            <div class="index-boxlink-long">
                <h3>Grafiek</h3>
            </div>

        </section>
   </div>

</main>







<script src="../js/main.js"></script>
</body>
</html>

