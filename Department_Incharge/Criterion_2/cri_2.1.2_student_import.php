<?php 
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
}
require '../../config.php';

$academic_year = ""; 

$department = $_SESSION['department'];

$error = 0;

if(isset($_POST['import']))        
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

    // CSV File

    $csvMimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv');
	if(empty($_FILES['csv_file']['name']))
	{
		$error++;
    	echo '<script language="javascript">';
	    echo'alert("Please Select CSV File."); location.href="cri_2.1.2_student_community.php"';
	    echo '</script>';
	}
	elseif (!in_array(pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION), array('csv'))) 
	{
		$error++;
    	echo '<script language="javascript">';
	    echo'alert("Please Select CSV File."); location.href="cri_2.1.2_student_community.php"';
	    echo '</script>';
	}

	// Register Number Validation
	if(is_uploaded_file($_FILES['csv_file']['tmp_name']))
	{
		$csvfile = fopen($_FILES['csv_file']['tmp_name'], 'r');
		fgetcsv($csvfile);
		while (($line = fgetcsv($csvfile)) !== FALSE)
		{
			$vreg_no = $line[0];
			$query = "SELECT reg_no FROM cri_2_1_1_student_details WHERE reg_no = '$vreg_no'";
	    	$result = mysqli_query($con, $query);

		    $count = mysqli_num_rows($result);
		    if($count === 0)
		    {
		    	$error++;
    			echo '<script language="javascript">';
	    		echo'alert("Student Register Number not Match."); location.href="cri_2.1.2_student_community.php"';
	    		echo '</script>';
		    }
		}
		fclose($csvfile);
	}

	// community Validation
	if(is_uploaded_file($_FILES['csv_file']['tmp_name']))
	{
		$community_list = array("MBC", "BCM", "BC", "DNC", "SC", "SCA", "ST", "OC");
		$csvfile = fopen($_FILES['csv_file']['tmp_name'], 'r');
		fgetcsv($csvfile);
		while (($line = fgetcsv($csvfile)) !== FALSE)
		{
			$vcommunity = strtoupper($line[2]);

			if(!in_array($vcommunity, $community_list))
			{
				$error++;
    			echo '<script language="javascript">';
	    		echo'alert("Community not Match."); location.href="cri_2.1.2_student_community.php"';
	    		echo '</script>';
			}	
		}
		fclose($csvfile);
	}

	if ($error == 0) 
	{
		if(is_uploaded_file($_FILES['csv_file']['tmp_name']))
		{

			$csvfile = fopen($_FILES['csv_file']['tmp_name'], 'r');
			fgetcsv($csvfile);
			while (($line = fgetcsv($csvfile)) !== FALSE)
			{
				$reg_no = $line[0];
				$community = strtoupper($line[2]);
				$query = "UPDATE cri_2_1_1_student_details SET community = '$community' WHERE reg_no = '$reg_no'";
		        $result = mysqli_query($con, $query);
		        if($result)
		        {
		            echo '<script language="javascript">';
	    			echo'alert("Updated Successfully."); location.href="cri_2.1.2_student_community.php"';
	    			echo '</script>';
		        }
			}
			fclose($csvfile);
		}
	}
}
?>