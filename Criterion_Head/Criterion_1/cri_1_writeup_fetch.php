<?php
require '../../config.php';

$academic_year = $_POST['academic_year'];
$criteria = $_POST['criteria'];

$sql = "SELECT id, write_up FROM cri_1_write_up WHERE academic_year = '$academic_year' and criteria = '$criteria'";

$result = mysqli_query($con,$sql);

$output = array();
while($row = mysqli_fetch_assoc($result)) 
{   
	$output['id'] = $row['id'];
	$output['write_up'] = $row['write_up'];
}
echo json_encode($output);
?>