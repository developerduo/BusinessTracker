<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'businesstracker';

try{
    $conn = new PDO("mysql:host=$host;dbname=dbnaam", $username, $password);
    

}