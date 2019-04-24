<?php
require_once('../includes/config.php');
session_start();
 
$loginError = '';

if(isset($_SESSION['username'])) {
    header("Location: ./dashboard.php");
}

if(isset($_POST['submitLogin'])) {

    try{
    $email = $_POST['email'];
    $password = md5($_POST['pwd']);
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
   
    $stmt->execute();
    if($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $firstname = $row['voornaam'];
        $id = $row['ID'];
        $userlevel = $row['userlevel'];
        $_SESSION['username'] = $firstname;
        $_SESSION['ID'] = $id;
        $_SESSION['userlevel'] = $userlevel;
        if($userlevel == 3){
            header("Location: ./inklok.php");
        }else {
            header("Location: ./dashboard.php");
        }
    } else{
        $loginError = "Username or Password incorrect!";
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
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../resources/css/main.css">
</head>

<body class="bovenkant">
 
 <form action method="POST" class="login_wrapper">
     <h1>Login</h1>
  <input type="text" name="email" placeholder="Gebruikersnaam" class="input">
  <input type="password" name="pwd" placeholder="Wachtwoord" class="input">
  <input type="submit"  name="submitLogin" class="input" id="submit_btn" value="Login">
  <p id='loginError'><?= $loginError ?></p>
</form>



    <script src="../../resources/js/main.js"></script>
</body>

</html>