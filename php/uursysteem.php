<?php

require_once('config.php');

session_start();

$loginError = '';


if(!isset($_COOKIE['username'])) {
    header("Location: ./login.php");
}



if(isset($_POST['klokin'])) {
    try{
    $username = $_COOKIE['username'];
    $ID = $_COOKIE['id'];
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
        $check = $conn->prepare("SELECT * FROM hoursystem WHERE datum = :datum AND user_ID = :ID");
        $check->bindParam(':datum', $date);
        $check->bindParam(':ID', $ID);
        $check->execute(); 
        if($check->rowCount() > 0) {
            $row = $check->fetch(); 
            echo 'test1';
            echo $row['tijdout'];
            if($row['tijdout'] > '00:00:00') {
                $loginError = "Je bent vandaag al ingeklokt en uitgeklokt";
            } else {
        $update = $conn->prepare("UPDATE hoursystem SET tijdout = '$time' WHERE datum = :datum AND user_ID = :id");
        $update->bindParam(':datum', $date);
        $update->bindParam(':id', $ID);
        $update->execute();
        }
    } else{
        
        //User is nog niet ingeklokt
        $insert = $conn->prepare("INSERT INTO hoursystem (datum, user_ID, tijdin) VALUES (:datum, :id, :tijd);");
        $insert->bindParam(':datum', $date);
        $insert->bindParam(':id', $ID);
        $insert->bindParam(':tijd', $time);
        $result = $insert->execute(); 

    }
}


}
    }
catch(exception $E) {
    echo 'Er ging iets fout';
}
}



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Uur Systeem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


</head>
<body class="bovenkant_uur">
  
     
  
   <div class="Inklok_wrapper"> <button onclick="InKlokken()" class="inklokken">Inklokken</button></div>

   <a href="logout.php">Logout</a>

   <div id="inklokscreen">
   <form method="POST" action=''> 
       <a onclick="Closebtn()" class="closebtn"><i class="fas fa-times"></i></a>
       <div class="boventekst">Inklokken</div>
       <div class="naaminklok"><?= $_COOKIE['username'] ?></div>
       <div class="passwdinklok_wrapper"><input type="password" name="pwd" class="passinklok" placeholder="Wachtwoord"></div>
       <button type="submit" name="klokin" class="submitinklok">Klok me in</button>
       
    </form>
    
</div>
<p><?= $loginError ?></p>


<script src="../js/main.js"></script>
</body>
</html>