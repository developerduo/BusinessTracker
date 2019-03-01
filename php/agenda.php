<?php

if(!isset($_COOKIE['username'])) {
    header('Location: ./logout.php');
}

require_once 'config.php';
$ID = $_COOKIE['id'];

//Check week
$year = date("Y");
$ddate = date("Y-m-d");
$date = new DateTime($ddate);
$currentweeknummer = $date->format("W");
$weeknummer = $date->format("W");

if(isset($_POST['nextweek'])) {
    $weeknummer = $_POST['week'] + 1;
    if($weeknummer < 10) {
        $weeknummer = '0' . $weeknummer;
    }
}
if(isset($_POST['previousweek'])) {
    $weeknummer = $_POST['week'] - 1; 
    if($weeknummer < 10) {
    $weeknummer = '0' . $weeknummer;
    }
}

//Assign de datum aan de variables per dag dat hoord bij de week
$week_maandag = new DateTime();
$week_dinsdag = new DateTime();
$week_woensdag = new DateTime();
$week_donderdag = new DateTime();
$week_vrijdag = new DateTime();
$week_zaterdag = new DateTime();
$week_zondag = new DateTime();

$week_maandag->setISODate($year,$weeknummer);
$maandag = $week_maandag->format('d:m:Y');
$week_dinsdag->setISODate($year, $weeknummer);
$week_dinsdag->modify('+1 days');
$dinsdag = $week_dinsdag->format('d:m:Y');
$week_woensdag->setISODate($year, $weeknummer);
$week_woensdag->modify('+2 days');
$woensdag = $week_woensdag->format('d:m:Y');
$week_donderdag->setISODate($year, $weeknummer);
$week_donderdag->modify('+3 days');
$donderdag = $week_donderdag->format('d:m:Y');
$week_vrijdag->setISODate($year, $weeknummer);
$week_vrijdag->modify('+4 days');
$vrijdag = $week_vrijdag->format('d:m:Y');
$week_zaterdag->setISODate($year, $weeknummer);
$week_zaterdag->modify('+5 days');
$zatedag = $week_zaterdag->format('d:m:Y');
$week_zondag->setISODate($year, $weeknummer);
$week_zondag->modify('+6 days');
$zondag = $week_zondag->format('d:m:Y');

$maand = new DateTime();
$maand->setISODate($year, $weeknummer);
$maand = $maand->format('n');

switch($maand) {
    case 1:
        $maand = 'januari';
        break;
    case 2:
        $maand = 'februari';
        break;
    case 3:
        $maand = 'maart';
        break;
    case 4:
        $maand = 'april';
        break;
    case 5:
        $maand = 'mei';
        break;
    case 6: 
        $maand = 'juni';
        break;
    case 7: 
        $maand = 'juli';
        break;
    case 8:
        $maand = 'augustus';
        break;
    case 9:
        $maand = 'september';
        break;
    case 10: 
        $maand = 'oktober';
    case 11:
        $maand = 'november';
        break;
    case 12: 
        $maand = 'december';
        break;
}

?>



<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../css/main.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Agenda</title>
</head>
<body>
    <div class="agendaWrapper">
    <h1 id='agendaTitle'>Agenda</h1>

                <form action="" method='post'><input id='PreviousWeek' value="Vorige week" type="submit" name='previousweek'><input type="hidden" name='week' value='<?= $weeknummer ?>'></form>
                <label id='PreviousLabel' for="PreviousWeek"><i class="fas fa-chevron-left"></i></label>
                <form action="" method='post'><input id='NextWeek' value='Volgende week' type="submit" name='nextweek'><input type="hidden" name='week' value='<?= $weeknummer ?>'></form>
                <label id='NextLabel' for="NextWeek"><i class="fas fa-chevron-right"></i></label>
                <p><b>Maand: <?= $maand ?></b></p>

        <table align='left' class='agendaTable'>
            <thead>
                <tr>
                    <th align='left'>Week: <?= $weeknummer ?></th>
                </tr>
                <tr>
                    <th align='left'>Medewerkers:</th>
                    <th align='left'>Maandag</th>
                    <th align='left'>Dinsdag</th>
                    <th align='left'>Woensdag</th>
                    <th align='left'>Donderdag</th>
                    <th align='left'>Vrijdag</th>
                    <th align='left'>Zaterdag</th>
                    <th align='left'>Zondag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM users");
                $stmt->execute();

                function werkcheck($dag, $ID) {
                    include 'config.php';
                    $stmt = $conn->prepare("SELECT * FROM agenda WHERE datum = :datum AND user_ID = :ID");
                    $stmt->bindParam(':datum', $dag);
                    $stmt->bindParam(':ID', $ID);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($stmt->rowCount() > 0) {
                    $timevanafArray = explode(':', $result['vanaf']);
                    $timetotArray = explode(':', $result['tot']);
                    $vanaf = $timevanafArray[0] . ':' . $timevanafArray[1]; 
                    $tot = $timetotArray[0] . ':' . $timetotArray[1];
                    echo $result['naam'];
                    echo '<br>';
                    echo $vanaf . ' - ' . $tot;                                                                                                                                 
                    } 
                }
                
                while($row = $stmt->fetch()) { 
                    $ID = $row['ID'];  ?>
                <tr>
                    <td><?= $row['voornaam'] ?></td>
                    <td class='agendaBlok'><?php 
                    $result = werkcheck($maandag, $ID);  ?>
                    </td>
                    <td class='agendaBlok'><?php 
                    werkcheck($dinsdag, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($woensdag, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($donderdag, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($vrijdag, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($zatedag, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($zondag, $ID); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php 
        


?>      
       
    </div>
</body>
</html>