<?php
session_start();
require_once('../includes/config.php');

if(!isset($_SESSION['username'])) {
    header('Location: ./logout.php');
}

$ID = $_SESSION['ID'];


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
$maandag = $week_maandag->format('d-m-Y');
$week_dinsdag->setISODate($year, $weeknummer);
$week_dinsdag->modify('+1 days');
$dinsdag = $week_dinsdag->format('d-m-Y');
$week_woensdag->setISODate($year, $weeknummer);
$week_woensdag->modify('+2 days');
$woensdag = $week_woensdag->format('d-m-Y');
$week_donderdag->setISODate($year, $weeknummer);
$week_donderdag->modify('+3 days');
$donderdag = $week_donderdag->format('d-m-Y');
$week_vrijdag->setISODate($year, $weeknummer);
$week_vrijdag->modify('+4 days');
$vrijdag = $week_vrijdag->format('d-m-Y');
$week_zaterdag->setISODate($year, $weeknummer);
$week_zaterdag->modify('+5 days');
$zaterdag = $week_zaterdag->format('d-m-Y');
$week_zondag->setISODate($year, $weeknummer);
$week_zondag->modify('+6 days');
$zondag = $week_zondag->format('d-m-Y');

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

if(isset($_POST['naarVandaag'])) {
    $ddate = date("Y-m-d");
    $date = new DateTime($ddate);
    $weeknummer = $date->format("W");
}

if(isset($_POST['vrijvragen'])) {
        $datum = $_POST['datum'];
        $sql = $conn->prepare("SELECT * FROM agenda WHERE datum = :datum AND user_ID = :ID");
        $sql->bindParam(':datum', $datum);
        $sql->bindParam(':ID', $ID);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $agenda_ID = $row['ID'];
            $sql = $conn->prepare("INSERT INTO vrijvragingen (agenda_ID) VALUES ('$agenda_ID')");
            $sql->execute();
            if($sql) {
                header("Location: ./agenda.php?vrijgevraagd");
            }
            
        }
}
if(isset($_POST['overnemen'])) {
    $user_ID = $_POST['user_ID'];
    $agenda_ID = $_POST['agenda_ID'];
    $vrijvraging_ID = $_POST['vrijvraging_ID'];

    $sql = $conn->prepare("UPDATE agenda SET user_ID = :ID WHERE user_ID = :user_ID AND ID = :agenda_ID");
    $sql->bindParam(':ID', $ID);
    $sql->bindParam(':user_ID', $user_ID);
    $sql->bindParam(':agenda_ID', $agenda_ID);
    $sql->execute();
    if($sql) {
        $sql = $conn->prepare("DELETE FROM vrijvragingen WHERE ID = :ID");
        $sql->bindParam(":ID", $vrijvraging_ID);
        $sql->execute();
        if($sql) {
            header("Location: ./agenda.php?overgenomen");
        }
    } 
}

?>



<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../../resources/css/main.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Agenda</title>
</head>
<body>
    <nav class='agendaNav'>
        <p>Agenda</p>
        <ul>
            <li><a href='#'>Home</a></li>
            <li><a href='#'>Loon</a></li>
        </ul>
    </nav>
    <div class="agendaWrapper">
                

                <div class="topBar">
                <div class="nextWeek">

                <form action="" method='post'><input id='PreviousWeek' value="Vorige week" type="submit" name='previousweek'><input type="hidden" name='week' value='<?= $weeknummer ?>'></form>
                <label id='PreviousLabel' for="PreviousWeek"><i class="fas fa-chevron-left"></i></label>

                <form action="" method='post'><input id='NextWeek' value='Volgende week' type="submit" name='nextweek'><input type="hidden" name='week' value='<?= $weeknummer ?>'></form>
                <label id='NextLabel' for="NextWeek"><i class="fas fa-chevron-right"></i></label>
                </div>
                
                <?php
                $eersteDagArray = explode('-', $maandag);
                $eersteDag = $eersteDagArray['0'];

                $tweedeDagArray = explode('-', $dinsdag);
                $tweedeDag = $tweedeDagArray['0'];

                $derdeDagArray = explode('-', $woensdag);
                $derdeDag = $derdeDagArray['0'];

                $vierdeDagArray = explode('-', $donderdag);
                $vierdeDag = $vierdeDagArray['0'];

                $vijfdeDagArray = explode('-', $vrijdag);
                $vijfdeDag = $vijfdeDagArray['0'];

                $zesdeDagArray = explode('-', $zaterdag);
                $zesdeDag = $zesdeDagArray['0'];

                $laatsteDagArray = explode('-', $zondag);
                $laatsteDag = $laatsteDagArray['0'];
        
                ?>
                <form  action="" method='post'>
                    <input class='naarVandaag' type="submit" value='Vandaag' name='naarVandaag'>
                </form>
                <p class='WeekIndicatie'><?= $maand ?> <?= $eersteDag ?> - <?= $maand ?> <?= $laatsteDag ?></p>
                <p class='weekNummer'>Week: <?= $weeknummer ?></p>
                </div>

        <table align='left' class='agendaTable'>    
            <thead>
                <tr>
                    <th align='left'>Medewerkers:</th>
                    <th align='left'>Ma <?= $eersteDag ?></th>
                    <th align='left'>Di <?= $tweedeDag?></th>
                    <th align='left'>Wo <?= $derdeDag?></th>
                    <th align='left'>Do <?= $vierdeDag ?></th>
                    <th align='left'>Vr <?= $vijfdeDag ?></th>
                    <th align='left'>Za <?= $zesdeDag ?></th>
                    <th align='left'>Zo <?= $laatsteDag ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare('SELECT * FROM users WHERE ID = :ID');
                $stmt->bindParam(':ID', $ID);
                $stmt->execute();

                $query = $conn->prepare("SELECT * FROM users WHERE NOT ID = :ID ORDER BY achternaam");
                $query->bindParam(':ID', $ID);
                $query->execute();

                function werkcheck($dag, $user_ID, $ID) {
                    require 'config.php';
                    $stmt = $conn->prepare("SELECT * FROM agenda WHERE datum = :datum AND user_ID = :ID");
                    $stmt->bindParam(':datum', $dag);
                    $stmt->bindParam(':ID', $user_ID);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($stmt->rowCount() > 0) {
                    $timevanafArray = explode(':', $result['vanaf']);
                    $timetotArray = explode(':', $result['tot']);
                    $vanaf = $timevanafArray[0] . ':' . $timevanafArray[1]; 
                    $tot = $timetotArray[0] . ':' . $timetotArray[1];
                    echo "<div class='werkBlok'>";
                    echo "<span>" . $result['naam'] . "</span>";
                    echo '<br>';
                    echo "<span>" . $vanaf . ' - ' . $tot . "</span>";   
                    if($user_ID == $ID) {
                    echo "<form action='' method='POST'><input type='submit' name='vrijvragen' value='Vrij vragen'><input type='hidden' name='datum' value='".$result['datum']."'></form>";
                    }
                    echo '</div>';                                                                                                                              
                    } 
                }
                
                while($row = $stmt->fetch()) { 
                    $user_ID = $row['ID'];  ?>
                <tr>
                    <td><?= $row['voornaam'] ?></td>
                    <td class='agendaBlok'><?php 
                    $result = werkcheck($maandag, $user_ID, $ID);  ?>
                    </td>
                    <td class='agendaBlok'><?php 
                    werkcheck($dinsdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($woensdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($donderdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($vrijdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($zaterdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($zondag, $user_ID, $ID); ?></td>
                </tr>
            <?php } ?>
            <?php
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
                    $user_ID = $row['ID'];  ?>
                <tr>
                    <td><?= $row['voornaam'] ?></td>
                    <td class='agendaBlok'><?php 
                    $result = werkcheck($maandag, $user_ID, $ID);  ?>
                    </td>
                    <td class='agendaBlok'><?php 
                    werkcheck($dinsdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($woensdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($donderdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($vrijdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($zaterdag, $user_ID, $ID); ?></td>
                    <td class='agendaBlok'><?php 
                    werkcheck($zondag, $user_ID, $ID); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <table class='vrijvraagTable'>
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Naam</th>
                    <th>Vrijvrager</th>
                    <th>Overnemen</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                        $sql = $conn->prepare("SELECT * FROM vrijvragingen JOIN agenda ON vrijvragingen.agenda_ID = agenda.ID");
                        $sql->execute();
                        if($sql->rowCount() > 0) {
                            while($row = $sql->fetch(PDO::FETCH_ASSOC)) :
                                $query = $conn->prepare("SELECT ID FROM vrijvragingen WHERE agenda_ID = :agenda_ID");
                                $query->bindParam(':agenda_ID', $row['ID']);
                                $query->execute();
                                $vrijvragingenRow = $query->fetch(PDO::FETCH_ASSOC);
                        
                                $sql = $conn->prepare("SELECT * FROM users WHERE ID = :id");
                                $sql->bindParam(':id', $row['user_ID']);
                                $sql->execute();
                                $userRow = $sql->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <tr>
                                    <td><?= $row['datum'] ?></td>
                                    <td><?= $row['naam'] ?></td>
                                    <td><?= $userRow['voornaam'] ?></td>
                                    <td><form action="" method="post">
                                    <input type="submit" value='overnemen' name='overnemen'>
                                    <input type="hidden" value="<?= $row['agenda_ID'] ?>" name='agenda_ID'>
                                    <input type="hidden" value="<?= $userRow['ID'] ?>" name='user_ID'>
                                    <input type="hidden" value="<?= $vrijvragingenRow['ID'] ?>" name="vrijvraging_ID">
                                    </form></td>
                                </tr>
                        <?php endwhile;
                        }

                    
                    ?>
            
                </tbody>
        
        </table>

       
    </div>
</body>
</html>