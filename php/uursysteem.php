<?php

/*
if(isset($_COOKIE['username'])){
    header('Location: ./index.html');
} 
*/

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
       <a onclick="Closebtn()" class="closebtn"><i class="fas fa-times"></i></a>
       <div class="boventekst">Inklokken</div>
       <div class="naaminklok"></div>
       <div class="passwdinklok_wrapper"><input type="password" name="passwdinklok" class="passinklok" placeholder="Wachtwoord"></div>


</div>



<script src="../js/main.js"></script>
</body>
</html>