<?php


include 'uursyteem.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


</head>
<body class="bovenkant_uur">
  

  

   <h3 class="Dashboard">Dashboard</h3>

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
           <a href="uren.php"><h3 class="Teksturen">Uren Overzicht</h3></a>
           <div class="Inklok_wrapper"> <button onclick="InKlokken()" class="inklokken">Inklokken</button></div>
           <br>
           <p><?= $loginError ?></p>
           <br><br>
           <p><?= $tijdtekst.$tijdin ?></p>
           <br><br>
           <p><?= $klokuit.$tijdout ?></p>
           <br><br>
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

