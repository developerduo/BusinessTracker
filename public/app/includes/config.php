<?php

$host = 'stablemedia.nl:3306';
$username = 'Damian';
$password = '@Root101';
$db = 'businesstracker';    
$conn = NULL;

try{
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
} 
catch(PDOException $E) {
    $error = $E->getMessage();
}