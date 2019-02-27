<?php

$time = date("H:i:s") ;
require_once('config.php');

session_start();

$loginError = '';


if(!isset($_COOKIE['username'])) {
    header("Location: ./login.php");
}



if(isset($_POST['klokin'])) {
    try{
    $username = $_COOKIE['username'];
    $password = md5($_POST['pwd']);
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE voornaam = '$username' AND password = :password");
    $stmt->bindParam(':password', $password);
   
    $stmt->execute();
    if($stmt->rowCount() > 0) {
        header("Location: ./uursysteem.php?LoggedIn");
        echo 'YOU MADE IT BOII';
    } else{
        $loginError = "Username or Password incorrect!";
    }

}
catch(exception $E) {
    echo 'Er ging iets fout';
}
}

echo $time;
echo $loginError;
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

   <div id="inklokscreen">
   <form method="POST" action=''> 
       <a onclick="Closebtn()" class="closebtn"><i class="fas fa-times"></i></a>
       <div class="boventekst">Inklokken</div>
       <div class="naaminklok"><?= $_COOKIE['username'] ?></div>
       <div class="passwdinklok_wrapper"><input type="password" name="pwd" class="passinklok" placeholder="Wachtwoord"></div>
       <button type="submit" name="klokin" class="submitinklok">Klok me in</button>
    </form>
</div>



<script src="../js/main.js"></script>
</body>
</html>