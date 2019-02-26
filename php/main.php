<?php 
session_start();

if(!isset($_COOKIE['username'])) {
    header('Location: ./logout.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BusinessTracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->


</head>
<body onscroll="OnScroll()">
    <header class="bovenkant" >
            <nav id="top">
                <div class="scroll" id="scroll">
                    
                    <ul>
                        <a onclick=''><li id="color1">BusinessTracker</li></a>
                        <a onclick=''><li id="color2">About the Team</li></a>
                        <a onclick=''><li id="color3">Contact</li></a>
                    </ul>

                   <a href="login.php"> <button type="button" name="loginbtn" class="loginbtn" id="loginbtn">Login</button></a>
                    
                </div> 
            </nav>
        
            <h3 class="bg-text">BusinessTracker</h3>
          
        
        
        
        

    </header>

    <div class="midden" id='midden'>

    

       

    </div>

    <div class="onderkant" id="bottom">

    </div>



    <script src="../js/main.js"></script>
</body>
</html>