<?php

$host = 'localhost:3306';
$username = 'luis';
$password = 'villa';
$database = 'luis';



// Create connection

$mysqli = new mysqli($host, $username, $password, $database);

if($mysqli->connect_errno) {
    die ("Connection failed: " . mysqli_connect_error());
}

