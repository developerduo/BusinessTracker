<?php 

if(isset($_POST['acceptCookie'])) {
    setcookie("cookies", "true", time()+3600*24*365);
    header('Location: ./index.php?Geaccepteerd');   
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BusinessTracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../resources/css/main.css">
    <link rel='icon' href='../img/businesstracker logo test.png'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body onscroll="OnScroll()" onload='cookieCheck()'>
    <header class="navbar">
            <nav id="top">
                <div class="scroll" id="scroll">
                    <ul>
                        <a onclick='Totop()'><li id="color1">Home</li></a>
                        <a onclick='Tomid()'><li id="color2">Over ons</li></a>
                        <a onclick='Tobottom()'><li id="color3">Contact</li></a>
                    </ul>

                   <a href="../php/login.php"> <button type="button" name="loginbtn" class="loginbtn" id="loginbtn">Login</button></a>
                    
                </div> 
            </nav>
            <div class="introText">
                <p><b>Keep track of your business!</b></p><br>
                <p>Culpa sunt irure occaecat pariatur culpa ex mollit est exercitation ex non. Laborum est proident ullamco occaecat esse 
                    ullamco et et est magna qui minim. Esse consectetur ipsum consequat enim ut ad officia 
                    consequat eu deserunt duis velit. Sit ex elit fugiat magna proident magna enim nisi nulla consectetur. Occaecat ipsum 
                    qui sunt sint. Tempor ullamco et amet quis Lorem exercitation duis nostrud sunt aliqua.</p><br>
                <p class='optiesTitel'>Waar kan je de Business Tracker voor gebruiken?</p>
                <ul class="opties">
                    <li>Werkuren Bijhouden</li>
                    <li>Werknemers kunnen zichzelf inklokken</li>
                    <li>Elke werknemer een eigen login</li>
                    <li>Automatisch loon berekenen</li>
                </ul>
            </div>
            <div class="sidebar">
                <img src="../../resources/img/businesstrackerManagePicture.png" alt="">
            </div>
    </header>

    <div class="midden" id='midden'>    
        <h1 class='abouttheteamTitle'>Over ons</h1>
    </div>

    <div class="onderkant" id="bottom">
        <h1>Contact</h1>
    </div>
    <?php if(!isset($_COOKIE['cookies'])) : ?>
    <div class='cookieCheck' id='cookieCheck'>
        <p>Wij maken gebruik van cookies</p>
        <form id='cookieBtn' action="" method="POST">
            <input onclick='closeCookie()' type="submit" value="Accepteren" name='acceptCookie'>
        </form>
    </div>
<?php endif; ?>
  
</body>
<script src="../js/main.js"></script>
</html>