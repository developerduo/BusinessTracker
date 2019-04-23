<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'businesstracker';    
$conn = NULL;

try{
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
} 
catch(PDOException $E) {
    $error = $E->getMessage();
}