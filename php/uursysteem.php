
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
                header('Location: ./uursysteem.php?aluitgeklokt');
            }else{
        $update = $conn->prepare("UPDATE hoursystem SET tijdout = '$time' WHERE datum = :datum AND user_ID = :id");
        $update->bindParam(':datum', $date);
        $update->bindParam(':id', $ID);
        $update->execute();
        header('Location: ./uursysteem.php?uitgeklokt');}
    } } else{
        
        //User is nog niet ingeklokt
        $insert = $conn->prepare("INSERT INTO hoursystem (datum, user_ID, tijdin) VALUES (:datum, :id, :tijd);");
        $insert->bindParam(':datum', $date);
        $insert->bindParam(':id', $ID);
        $insert->bindParam(':tijd', $time);
        $result = $insert->execute();
        header('Location: ./uursysteem.php?ingeklokt');
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
        $tijdtekst = 'Je bent zolaat ingeklokt: ';
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
        $klokuit = 'Je bent zolaat uitgeklokt: ';
        $tijdgewerkt = 'Je hebt zolang gewerkt: ';
        $en = " en ";




        if($decimal > 1 ){
            $tussendecimal = 'minuten';
        }else{
            $tussendecimal = 'minuut';
        }
        $tussentekst = 'uur';

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
  

  

   <h3 class="Dashboard">Dashboard Uren</h3>

   <!--<a href="logout.php">Logout</a> -->

   <div id="inklokscreen">
   <form method="POST" action=''> 
       <a onclick="Closebtn()" class="closebtn"><i class="fas fa-times"></i></a>
       <div class="boventekst">Inklokken</div>
       <div class="naaminklok"><?= $_COOKIE['username'] ?></div>
       <div class="passwdinklok_wrapper"><input type="password" name="pwd" class="passinklok" placeholder="Wachtwoord"></div>
       <button type="submit" name="klokin" class="submitinklok">Klok me in</button>
    </form>
</div>

 <!-- <p><?= $loginError ?></p>
<p><?= $tijdin ?></p>
<p><?= $tijdout ?></p>
<p><?= $uren . ' ' .$tussentekst . ' en ' . $decimal . ' ' . $tussendecimal ?> </p> -->

   <div class="urenscherm">
       <div class="urenschermpje">
           <h3 class="Teksturen">Uren Overzicht</h3>
           <div class="Inklok_wrapper"> <button onclick="InKlokken()" class="inklokken">Inklokken</button></div>
           <br>
           <p><?= $loginError ?></p>
           <br>
           <p><?= $tijdtekst.$tijdin ?></p>
           <br>
           <p><?= $klokuit.$tijdout ?></p>
           <br>
        <p><?= $tijdgewerkt.$uren . ' ' .$tussentekst . $en . $decimal . ' ' . $tussendecimal ?> </p>

       </div>
       <div class="urenschermpje">

       </div>
       <div class="urenschermpje">

       </div>
       <div class="urenschermpje">

       </div>
   </div>



<script src="../js/main.js"></script>
</body>
</html>

