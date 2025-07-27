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
	    echo'alert("Please Select Academic Year."); location.href="cri_2.2.2_add_student.php"';
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
	    echo'alert("Please Select CSV File."); location.href="cri_2.2.2_add_student.php"';
	    echo '</script>';
	}
	elseif (!in_array(pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION), array('csv'))) 
	{
		$error++;
    	echo '<script language="javascript">';
	    echo'alert("Please Select CSV File."); location.href="cri_2.2.2_add_student.php"';
	    echo '</script>';
	}

	// community Validation
	if(is_uploaded_file($_FILES['csv_file']['tmp_name']))
	{
		$year_list = array(1,2,3,4);
		$csvfile = fopen($_FILES['csv_file']['tmp_name'], 'r');
		fgetcsv($csvfile);
		while (($line = fgetcsv($csvfile)) !== FALSE)
		{
			$vyear = strtoupper($line[2]);

			if(!in_array($vyear, $year_list))
			{
				$error++;
    			echo '<script language="javascript">';
	    		echo'alert("Year not Match."); location.href="cri_2.2.2_add_student.php"';
	    		echo '</script>';
			}	
		}
		fclose($csvfile);
	}

    if($error == 0)
    {
    	if(is_uploaded_file($_FILES['csv_file']['tmp_name']))
		{
			$csvfile = fopen($_FILES['csv_file']['tmp_name'], 'r');
			fgetcsv($csvfile);
			while (($line = fgetcsv($csvfile)) !== FALSE)
			{
				$reg_no = $line[0];
				$name = $line[1];
				$year = $line[2];

				$query = "SELECT reg_no FROM cri_2_2_2_student_details WHERE reg_no = '$reg_no'";
	    		$result = mysqli_query($con, $query);

		        $count = mysqli_num_rows($result);
		        if($count === 1)
		        {
		        	$ureg_no = $line[0];
		            $query = "UPDATE cri_2_2_2_student_details SET name = '$name', year = '$year' WHERE reg_no = '$ureg_no'";
		            $result = mysqli_query($con, $query);
		            if($result)
		            {
		            	echo '<script language="javascript">';
	    				echo'alert("Student Added Successfully."); location.href="cri_2.2.2_add_student.php"';
	    				echo '</script>';
		            }
		        }
		        else
		        {
		            $query = "INSERT INTO cri_2_2_2_student_details (reg_no, academic_year, programme_code, name, year) VALUES ('$reg_no', '$academic_year', '$department', '$name', '$year')";
		            $result = mysqli_query($con, $query);
		            if($result)
		            {
		            	echo '<script language="javascript">';
	    				echo'alert("Student Added Successfully."); location.href="cri_2.2.2_add_student.php"';
	    				echo '</script>';
		            }
		        }
			}
		}
    }
}
?>