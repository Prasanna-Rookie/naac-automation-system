<?php

session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
}

$academic_year = $academic_year_err = $course_name = $course_name_err = $course_code = $course_code_err = $time_offered = $time_offered_err = $duration = $duration_err = $stu_enrolled = $stu_enrolled_err = $stu_completed = $stu_completed_err = $file_err = "";

require '../../config.php';

if(isset($_POST['single_course']))        
{
    // Academic Year Validation

    if(empty(trim($_POST["academic_year"])))
    {
   	 	$academic_year_err = "Please Enter Academic Year.";
    }
    else
    {
        $academic_year = trim($_POST["academic_year"]);
    }

    // Course Name Validation

    if (empty(trim($_POST["course_name"]))) 
    {
        $course_name_err = " Please Select Course Name.";
    }
    else
    {
        $course_name=trim($_POST["course_name"]);     
    }
    // Course Code Validation

    if (empty(trim($_POST["course_code"]))) 
    {
        $course_code_err = " Please Select Course Code.";
    }
    else
    {
        $course_code = trim($_POST["course_code"]);     
    }

    // No.time offered Validation

    if (empty(trim($_POST["time_offered"]))) 
    {
        $time_offered_err = "Please Enter No. of times offered during the same year.";
    }
    elseif(!is_numeric(trim($_POST["time_offered"])))
    {
        $time_offered_err = "Invalid Format, Must Contain only Numbers.";
    }
    else
    {
        $time_offered=trim($_POST["time_offered"]);     
    }

    // No.time offered Validation

    if (empty(trim($_POST["duration"]))) 
    {
        $duration_err = "Please Enter Duration of the Course.";
    }
    elseif(!is_numeric(trim($_POST["duration"])))
    {
        $duration_err = "Invalid Format, Must Contain only Numbers.";
    }
    else
    {
        $duration=trim($_POST["duration"]);     
    }

    // Student Enrolled

    if (empty(trim($_POST["stu_enrolled"]))) 
    {
        $stu_enrolled_err = "Please Enter No. of Student Enrolled.";
    }
    elseif(!is_numeric(trim($_POST["stu_enrolled"])))
    {
        $stu_enrolled_err = "Invalid Format, Must Contain only Numbers.";
    }
    else
    {
        $stu_enrolled = trim($_POST["stu_enrolled"]);     
    }

    // Student Completed

    if (empty(trim($_POST["stu_completed"]))) 
    {
        $stu_completed_err = "Please Enter No. of Student Completed.";
    }
    elseif(!is_numeric(trim($_POST["stu_completed"])))
    {
        $stu_completed_err = "Invalid Format, Must Contain only Numbers.";
    }
    else
    {
        $stu_completed=trim($_POST["stu_completed"]);     
    }

    // PDF Validation      

    if (empty($_FILES['pdf']['name']))
    {
        $file_err = "Please Select PDF File.";
    }
    elseif($_FILES['pdf']['type'] != 'application/pdf')
    {
        $file_err = "Please Select PDF File.";
    }

    // Insert Data

    if(empty($aca_year_err) && empty($course_name_err) && empty($course_code_err) && empty($time_offered_err) && empty($duration_err) && empty($stu_enrolled_err) && empty($stu_completed_err) && empty($file_err))
    {
        $pdf = $_FILES['pdf']['name'];
        $pdf_type = $_FILES['pdf']['type'];
        $pdf_size = $_FILES['pdf']['size'];
        $pdf_tem_loc = $_FILES['pdf']['tmp_name'];
        $file_name = time() . '_' . uniqid() . '.pdf';
        $upload_location = "../../Uploaded Documents/Criteria - 1/".$file_name;

        if(move_uploaded_file($pdf_tem_loc,$upload_location))
        {
            $department = $_SESSION['department'];
            $query = "INSERT INTO cri_1_3_2_value_added_courses (academic_year, department, course_name, course_code, offered_time, duration, stu_enrolled, stu_completed, doc_name) VALUES ('$academic_year', '$department', '$course_name', '$course_code', '$time_offered', '$duration', '$stu_enrolled', '$stu_completed', '$file_name')";

            if(mysqli_query($con, $query))
            {
                echo '<script language="javascript">';
                echo'alert("Course Added Successfully."); location.href="cri_1.3.2_value_added_course.php"';
                echo '</script>';
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("Failed, Please Try Again."); location.href="cri_1.3.2_value_added_course.php"';
                echo '</script>';
            }
            mysqli_close($con);
        }
    }   

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
    <script type="text/javascript" src="../../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../Libraries/fontawesome-6.1.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="../../stylesheet/sidebar.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
    <title>Criterion - 1</title>
    <style type="text/css">
	   #active
        {
            font-weight: bold;
        }
        #non-active
        {
            color: dimgrey;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php
      require 'header.php';
    ?>
    <!-- Header End -->

    <!-- Side Bar -->

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- col-auto -->
            <div class="bg-color col-md-2 min-vh-100">
                <div class="bg-color">
                    <br>

                    <!-- Menu -->
                    
                       <div class="menu-bar">
                           <?php
                                require 'side_bar.php';
                            ?>
                        </div>
                
                    <!-- Menu End -->

                </div>
            </div>
            <div class="col py-3">

                <!-- Breadcrumb -->

                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Criteria 1.3</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span> Criteria 1.3.2 - Number of value-added courses for imparting transferable and life skills offered during year.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
	                        <ul class="nav nav-tabs">
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_1.3.2_value_added_course.php" id="active">Add Course</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.2_doc_view.php" id="non-active">View Document</a>
	                            </li>
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.2_pdf_report.php" id="non-active">PDF Report</a>
	                            </li>
	                        </ul>

	                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

                			<div class = "card-body">
                                <div class="container-fluid">
                                    
                                    <div class="row justify-content-center">

                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                    <span>Criteria 1.3.2 - Add Course</span>
                                                </div>
                                                
                                                	<div class="card-body">
                                    
                                                        <div class="mb-3">
															<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

															<select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

																<option value="">---Select Academic Year---</option>

																<?php
																$sql = "SELECT * FROM academic_year WHERE hide_status = 1 ORDER BY academic_year";
																$result = $con -> query($sql);

																while($row = $result -> fetch_assoc())
																{
																	?>
																	<option value="<?php echo $row['academic_year']; ?>"

																		<?php
																		if($academic_year == $row['academic_year'])
																		{
																			echo "selected";
																		} 
																		?>
																		>
																		<?php
																		echo $row['academic_year'];
																		?>
																	</option>
																	<?php
																}

																?>

															</select>
															<span class="invalid-feedback">
																<?php echo $academic_year_err; ?>
															</span>
														</div> 

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "course_name"> <span style="color: red">* </span>Name of the value added courses (with 30 or more contact hours)offered during last five years </label>

                                                            <input type="text" name="course_name" class="form-control <?php echo (!empty($course_name_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "course_name" value = "<?php echo $course_name; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $course_name_err; ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "course_code"> <span style="color: red">* </span>Course Code</label>

                                                            <input type="text" name="course_code" class="form-control <?php echo (!empty($course_code_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "course_code" value = "<?php echo $course_code; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $course_code_err; ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "time_offered"> <span style="color: red">* </span>No. of times offered during the same year</label>

                                                            <input type="text" name="time_offered" class="form-control <?php echo (!empty($time_offered_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "time_offered" value = "<?php echo $time_offered; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $time_offered_err; ?>
                                                            </div>
                                                        </div>
                                                	</div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                    <span>Criteria 1.1.3 - Add Course</span>
                                                </div>
                                                
                                                <div class="card-body">

                                                    

                                                    <div class="mb-3">
                                                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "duration"> <span style="color: red">* </span>Duration of Course</label>

                                                        <input type="text" name="duration" class="form-control <?php echo (!empty($duration_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "duration" value = "<?php echo $duration; ?>">

                                                        <div class="invalid-feedback">
                                                            <?php echo $duration_err; ?>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "stu_enrolled"> <span style="color: red">* </span>Number of students Enrolled in the year</label>

                                                        <input type="text" name="stu_enrolled" class="form-control <?php echo (!empty($stu_enrolled_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "stu_enrolled" value = "<?php echo $stu_enrolled; ?>">

                                                        <div class="invalid-feedback">
                                                            <?php echo $stu_enrolled_err; ?>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "stu_completed"> <span style="color: red">* </span>Number of Students Completing the course  in the year</label>

                                                        <input type="text" name="stu_completed" class="form-control <?php echo (!empty($stu_completed_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "stu_completed" value = "<?php echo $stu_completed; ?>">

                                                        <div class="invalid-feedback">
                                                            <?php echo $stu_completed_err; ?>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="file" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Document</label>
                                                        <input name = "pdf" class="form-control <?php echo (!empty($file_err)) ? 'is-invalid' : ''; ?>" type="file" id="file">

                                                        <span class="invalid-feedback">
                                                            <?php echo $file_err; ?>
                                                        </span>
                                                    </div>

                                                     <button type="submit" name = "single_course" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Bar End -->

    <!-- Footer -->
    <?php
        require 'footer.php';
    ?>
    <!-- Fotter End -->

</body>
</html>