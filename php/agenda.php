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
$weeknummer = $date->format("W");

//Assign de datum aan de variables per dag dat hoord bij de week
$week_maandag = new DateTime();
$week_dinsdag = new DateTime();
$week_woensdag = new DateTime();
$week_donderdag = new DateTime();
$week_vrijdag = new DateTime();
$week_zaterdag = new DateTime();
$week_zondag = new DateTime();
$maand = new DateTime();
$maand->setISODate($year, $weeknummer);
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


?>



<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>
</head>
<body>
    <div class="agendaWrapper">
        <table align='left' class='agendaTable'>
            <thead>
                <tr>
                    <th align='left'>Week: <?= $weeknummer ?></th>
                </tr>
                <tr>
                    <th>Medewerkers:</th>
                    <th>Maandag</th>
                    <th>Dinsdag</th>
                    <th>Woensdag</th>
                    <th>Donderdag</th>
                    <th>Vrijdag</th>
                    <th>Zaterdag</th>
                    <th>Zondag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM users");
                $stmt->execute();

                function werkcheck($dag, $ID) {
                    include 'config.php';
                    echo $dag;
                    $stmt = $conn->prepare("SELECT * FROM agenda WHERE datum = :dag AND user_ID = :ID");
                    $stmt->bindParam(':dag', $dag);
                    $stmt->bindParam(':ID', $ID);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    global $result;
                }
                while($row = $stmt->fetch()) { 
                    $ID = $row['ID']; ?>
                <tr>
                    <td><?= $row['voornaam'] ?></td>
                    <td><?php 
                    werkcheck($maandag, $ID);  ?>
                    <?= $result['naam'] ?></td>
                    <td><?php 
                    werkcheck($dinsdag, $ID); ?>
                    <?= $result['naam'] ?></td>
                    <td><?php 
                    werkcheck($woensdag, $ID); ?>
                    <?= $result['naam'] ?></td>
                    <td><?php 
                    werkcheck($donderdag, $ID); ?>
                    <?= $result['naam'] ?></td>
                    <td><?php 
                    werkcheck($vrijdag, $ID); ?>
                    <?= $result['naam'] ?></td>
                    <td><?php 
                    werkcheck($zatedag, $ID); ?>
                    <?= $result['naam'] ?></td>
                    <td><?php 
                    werkcheck($zondag, $ID); ?>
                    <?= $result['naam'] ?></td>
                </tr>
                
            <?php } ?>
                


            </tbody>
        </table>
    </div>
</body>
</html>