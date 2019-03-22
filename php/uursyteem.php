<?php
require_once('config.php');
session_start();
$loginError = '';

$username = $_COOKIE['username'];
$ID = $_COOKIE['id'];
$date = date("d:m:Y");
$time = date("H:i:s") ;
$uren = '';
$decimal = '';
$uur = '';
$minuten = '';
$whole = '';
if(!isset($_COOKIE['username'])) {
    header("Location: ./login.php");
}
if(isset($_POST['klokin'])) {
    try{
        $password = md5($_POST['pwd']);
        $date = date("d:m:Y");
        $time = date("H:i:s") ;
        //Check of wachtwoord klopt
        $wachtwoordcheck = $conn->prepare("SELECT * FROM users WHERE voornaam = :username AND password = :password");
        $wachtwoordcheck->bindParam(':username', $username);
        $wachtwoordcheck->bindParam(':password', $password);
        $wachtwoordcheck->execute();
        if($wachtwoordcheck->rowCount() > 0) {
            //Check of hij al is ingeklokt
            $stmt = $conn->prepare("SELECT * FROM hoursystem WHERE datum = :datum AND user_ID = :ID");
            $stmt->bindParam(':datum', $date);
            $stmt->bindParam(':ID', $ID);
            $stmt->execute();
            $row = $stmt->fetch();
            //Dit doet hij als hij als is ingeklokt
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
                $check = $conn->prepare("SELECT * FROM hoursystem WHERE datum = :datum AND user_ID = :id");
                $check->bindParam(':datum', $date);
                $check->bindParam(':id', $ID);
                $check->execute();
                // Hij checkt of je al je bent ingeklokt en uitgeklokt
                if($check->rowCount() > 0){
                    $row = $check->fetch();
                    if($row['tijdout'] > '00:00:00'){
                        header('Location: ?aluitgeklokt');
                    }else{
                        $update = $conn->prepare("UPDATE hoursystem SET tijdout = '$time' WHERE datum = :datum AND user_ID = :id");
                        $update->bindParam(':datum', $date);
                        $update->bindParam(':id', $ID);
                        $update->execute();
                        header('Location: ?uitgeklokt');}
                } } else{

                //User is nog niet ingeklokt
                $insert = $conn->prepare("INSERT INTO hoursystem (datum, user_ID, tijdin) VALUES (:datum, :id, :tijd);");
                $insert->bindParam(':datum', $date);
                $insert->bindParam(':id', $ID);
                $insert->bindParam(':tijd', $time);
                $result = $insert->execute();
                header('Location: ?ingeklokt');
            }
        }else{
            $loginError = 'Je wachtwoord is verkeerd';
        }
    }
    catch(exception $E) {
        echo 'Er ging iets fout';
    }
}

if(isset($_GET['aluitgeklokt'])){
    $loginError = 'Je bent vandaag al ingeklokt en uitgeklokt';
}

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
$tussendecimal = '';
if($tijdin > '00:00:00'){
    $tijdtekst = 'Inkloktijd: ';
}




if($tijdout == '00:00:00' ){
    $uren = '';
    $decimal = '';
    $tijdout = '';

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




    if($decimal > 1 ){
        $tussendecimal = 'minuten';
    }else{
        $tussendecimal = 'minuut';
        $decimal = 1;
    }
    $tussentekst = 'uur';

}


?>


