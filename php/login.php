<?php
require_once('config.php');
session_start();

$loginError = '';

if(isset($_COOKIE['username'])) {
    header("Location: ./main.php");
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
        header("Location: ./main.php?LoggedIn");
        $row = $stmt->fetch();
        $firstname = $row['voornaam'];
        $id = $row['ID'];
        setcookie("username", $firstname, time()+3600);
        setcookie("id", $id, time()+3600);
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
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
</head>

<body class="bovenkant">
 
 <form action method="POST" class="login_wrapper">
     <h1>Login</h1>
  <input type="text" name="email" placeholder="Gebruikersnaam" class="input">
  <input type="password" name="pwd" placeholder="Wachtwoord" class="input">
  <input type="submit" name="submitLogin" class="input" id="submit_btn" value="Login">
  <p id='loginError'><?= $loginError ?></p>
</form>



    <script src="main.js"></script>
</body>

</html>