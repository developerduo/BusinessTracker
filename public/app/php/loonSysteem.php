<?php
session_start();

$ID = $_SESSION['ID'];

$maand = date('m');
$urenArray = [];

include '../includes/config.php';

$selectAgenda = $conn->prepare("SELECT * FROM agenda WHERE datum LIKE '%-$maand-%' AND user_ID = $ID");
$selectAgenda->execute();
if($selectAgenda->rowCount() > 0) {
    while($row = $selectAgenda->fetch(PDO::FETCH_ASSOC)) {
        $tot = strtotime($row['tot']);
        $vanaf = strtotime($row['vanaf']);
        $difference = round(abs($tot - $vanaf) / 3600,2);
        array_push($urenArray, $difference);  
    }
    $uren =  array_sum($urenArray);
    echo "Uren: " . $uren . "<br>"; 

    $selectUser = $conn->prepare("SELECT * FROM users WHERE ID = :ID");
    $selectUser->bindParam(':ID', $ID);
    $selectUser->execute();
    while($row = $selectUser->fetch(PDO::FETCH_ASSOC)) {
        $uurloon = $row['uurloon'];
        $uurloon = floatval($uurloon);
        $betalen = $uren * $uurloon;
        echo "Te betalen: " . $betalen;
    }
}
