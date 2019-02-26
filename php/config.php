<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'businesstracker';

try{
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    if($conn) {
    echo "Connected successfully";
    }
} 
catch(PDOException $E) {
    echo $E->getMessage();
}