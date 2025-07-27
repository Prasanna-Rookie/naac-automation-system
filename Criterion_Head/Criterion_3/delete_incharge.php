<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
} 
require '../../config.php';
$sql="DELETE FROM department_incharge WHERE id = ".$_POST["id"];
$con->query($sql);
?>