<?php
session_start();
if(!isset($_SESSION['dir_id']))
{
    header("location: ../index.php");
    exit;
} 
include "../config.php";
$sql = "UPDATE academic_year SET hide_status = 0 WHERE id = ".$_POST["id"];
$con->query($sql);
?>