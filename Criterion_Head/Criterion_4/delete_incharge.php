<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
} 
require '../../config.php';
$sql="DELETE FROM incharge WHERE inc_id = ".$_POST["id"];
$con->query($sql);
?>