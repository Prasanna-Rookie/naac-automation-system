<?php
session_start();
if(!isset($_SESSION['dir_id']))
{
    header("location: ../index.php");
    exit;
} 
include "../config.php";
$sql="DELETE FROM criterion_head WHERE criterion_id=".$_POST["id"];
$con->query($sql);
?>