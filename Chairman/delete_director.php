<?php
session_start();
if(!isset($_SESSION['chairman_id']))
{
    header("location: ../index.php");
    exit;
} 
include "../config.php";
$sql="DELETE FROM iqac_director WHERE director_id=".$_POST["id"];
$con->query($sql);
?>