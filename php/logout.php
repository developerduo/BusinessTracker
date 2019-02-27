<?php
setcookie("username", $firstname, time()+0);
header("Location: ./index.php");   
