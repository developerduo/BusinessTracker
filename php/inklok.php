<?php

$userlevel = $_SESSION['userlevel'];

if($userlevel < 3){
    header("Location: ./dashboard.php");
}else {
    include "uursyteem.php";
}
?>

<!DOCTYPE html>
<html lang="NL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
</head>

<body>

<h1 class="title">Klok in</h1>

<form method="POST">
    <div class="login_wrapper">
    <input type="password" name="pwd" placeholder="Code" class="klokininput">
    <button type="submit" name="klokin" class="klokininput">Klok in</button>
    <h1><?= $loginError ?></h1>
    </div>
</form>

</body>
</html>
