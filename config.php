<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "naac";

// Create Database Connection

$con = mysqli_connect($server_name, $user_name, $password, $database_name);

// Check Database Connection

if(!$con)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?> 