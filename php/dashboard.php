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


</head>
<body class="background">



      <nav class="topnav">

          <h3 class="top_dash">Businesstracker
              <h3 class="top_name">Dashboard</h3>
          </h3>

          <a onclick="Schermpje()"><div class="username_scherm">
             <h3 class="username"><?= $_COOKIE['username']?></h3>
          </div></a>
          <div id="schermpje" >

          </div>

      </nav>



      <nav class="sidenav">

          <div class="dashboard">
              <h3 class="text_dash">Dashboard</h3>
                <img src="../img/agenda.png" class="imgdash">
          </div>
          <div class="uren">
               <img src="../img/uren.png" class="imguren">
              <h3 class="text_uren">Uren</h3>
          </div>
          <div class="loon">
              <img src="../img/loon.png" class="imgloon">
              <h3 class="text_loon">Loon</h3>
          </div>




      </nav>

      <div class="scherm1"></div>
      <div class="scherm2"></div>
      <div class="scherm3"></div>
      <div class="scherm4"></div>


<script src="../js/main.js"></script>
</body>
</html>

