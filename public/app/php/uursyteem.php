<?php
require_once('../includes/config.php');
$loginError = '';

$date = date("d:m:Y");
$time = date("H:i:s") ;
$uren = '';
$decimal = '';
$uur = '';
$minuten = '';
$whole = '';
if(!isset($_SESSION['username'])) {
    header("Location: ./login.php");
}
if(isset($_POST['klokin'])) {
    try{
        $code = ($_POST['pwd']);
        $date = date("d:m:Y");
        $time = date("H:i:s") ;
        //Check of wachtwoord klopt
        $wachtwoordcheck = $conn->prepare("SELECT * FROM users WHERE code = :code");
        $wachtwoordcheck->bindParam(':code', $code);
        $wachtwoordcheck->execute();
        $user = $wachtwoordcheck->fetch();
        $ID = $user['ID'];
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



?>


