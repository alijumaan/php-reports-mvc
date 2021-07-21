<?php

$server_name = "localhost";
$user_name = "root";
$password = "password";
$dbname = "reports";

$conn = new mysqli($server_name, $user_name, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_errno);
}