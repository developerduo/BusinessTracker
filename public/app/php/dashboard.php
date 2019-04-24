<?php
session_start();
if($_SESSION['userlevel'] == 3){
    header("Location: ./inklok.php");
}

include 'uursyteem.php';
include '../includes/config.php';

$ID = $_SESSION['ID'];
$totaletijd = $conn->prepare("SELECT * FROM hoursystem WHERE datum = :datum AND user_ID = :id ");
$totaletijd->bindParam(':datum', $date);
$totaletijd->bindParam(':id', $ID);
$totaletijd->execute();
$row2 = $totaletijd->fetch();
$tijdin = $row2['tijdin'];
$tijdout = $row2['tijdout'];
$uren = '';
$decimal = '';
$klokuit = '';
$tijdgewerkt = '';
$en = '';
$tijdtekst = '';
$tussentekst = '';
$tekstinklok = '';
$tekstuitklok = '';
$tekst = '';
$tussendecimal = '';

if($tijdin != '00:00:00'){
    $tekstinklok = 'Inkloktijd: '.$tijdin;
}else{
    $tekstinklok = '';
}
if($tijdout == '00:00:00' ){
    $uren = '';
    $decimal = '';
    $tijdout = '';
    $tekstinklok = 'Inkloktijd: '.$tijdin;
    $tekstuitklok = '';
}
elseif($tijdout > '00:00:00'){
    $uren = ( strtotime($tijdout) - strtotime($tijdin)  ) / 60 / 60;
    list($whole, $decimal) = explode('.', $uren);
    $decimal = 0 . '.'.$decimal;
    $decimal = $decimal * 60;
    $decimal = round($decimal , 0);
    $uren = $whole;
    $klokuit = 'Uitkloktijd: ';
    $tijdgewerkt = 'Werktijd: ';
    $en = " en ";
    $tekst = 'Je hebt vandaag '.$uren.' uren en '.$decimal.' minuten gewerkt';
    $tekstinklok = 'Inkloktijd: '.$tijdin;
    $tekstuitklok = 'Uitkloktijd: '.$tijdout;
}

$username = $_SESSION["username"];



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../resources/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">


</head>
<body>

<header>
    <div id="username">
        <h3><?= $username ?></h3>
       <h4 onclick="Usersettings()" id="dropdown"> > </h4>
       <div id='Hidden'>
           <div class="profilesettings">
               <img src="../../resources/img/profile.png">
               <div class="profile">Profile</div>
           </div>
           <a href="./logout.php" id="logout">Logout</a>
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


    <div class="rounds"><img src="../../resources/img/agenda.png" class="navside-img"></div><h3 class="rounds-text"><a href="agenda.php">Agenda</a></h3>
    <div class="rounds"><img src="../../resources/img/loon.png" class="navside-img"></div><h3 class="rounds-text">loon</h3>
    <div class="rounds"><img src="../../resources/img/uren.png" class="navside-img" alt="uren"></div><h3 class="rounds-text">uren</h3>


</nav>
<main>
   <div class="wrapper">
        <section class="DashboardWrapper">
            <div class="UrenBlok blok">
                <h3>Uren</h3>
                <h1>Inkloktijd: <?= $tijdin ?></h1>
                <h1>Uitkloktijd: <?= $tijdout ?></h1>
                <h1><?= $tekst ?></h1>
            </div>

            <div class="loonBlok blok">
                <h3>loon</h3>
               
            </div>

            <div class="agendaBlok blok">
                <h3>agenda</h3>
           
            </div>

            <div class="agendaGrafiekBlok">
                <h3>Grafiek</h3>
            </div>

        </section>
   </div>

</main>








<script src="../../resources/js/main.js"></script>
</body>
</html>

