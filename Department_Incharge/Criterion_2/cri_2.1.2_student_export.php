<?php 
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
}
require '../../config.php';

$academic_year = $academic_year_err = ""; 

$department = $_SESSION['department'];

$error = 0;

if(isset($_POST['export']))        
{
	// Academic Year Validation

    if(empty(trim($_POST["academic_year"])))
    {
    	$error++;
    	echo '<script language="javascript">';
	    echo'alert("Please Select Academic Year."); location.href="cri_2.1.2_student_community.php"';
	    echo '</script>';
	}
        
    else
    {
    	$academic_year = trim($_POST["academic_year"]);
    }

    if($error == 0)
    {
    	header('Content-Type: text/csv; charset = utf-8');
		header('Content-Disposition: attachment; filename = Student_Community.csv');
		$output = fopen("php://output", "w");
		fputcsv($output, array('Reg.No.', 'Name', 'Community'));
		$query = "SELECT reg_no, name,community from cri_2_1_1_student_details WHERE programme_code = '$department' AND academic_year = '$academic_year' ORDER BY reg_no";
		
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_assoc($result))
		{
			fputcsv($output, $row);
		}
		fclose($output);
    }
}
?>