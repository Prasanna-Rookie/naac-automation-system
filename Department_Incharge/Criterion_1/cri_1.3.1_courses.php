<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$upload_by = $_SESSION['department'];

$academic_year = $academic_year_err = $course_code = $course_code_err = $course_name = $course_name_err  = $course_type = $course_type_err = $file_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Academic Year Validation

    if(empty(trim($_POST["academic_year"])))
	{
		$academic_year_err = "Please Select Academic Year.";
	}
	else
	{
		$academic_year = trim($_POST["academic_year"]);
	}

    // Course Name Validation

    if (empty(trim($_POST["course_name"]))) 
    {
        $course_name_err = "Please Enter Course Name.";
    }
    else
    {
        $course_name = trim($_POST["course_name"]);     
    }

    // Course Code Validation

    if (empty(trim($_POST["course_code"]))) 
    {
        $course_code_err = "Please Enter Course Code.";
    }
    else
    {
        $course_code = trim($_POST["course_code"]);     
    }

    // Course Type Validation

    if (empty(trim($_POST["course_type"]))) 
    {
        $course_type_err = " Please Enter Course Type.";
    }
    else
    {
        $course_type = trim($_POST["course_type"]);     
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

    if(empty($academic_year_err) && empty($course_name_err) && empty($course_code_err) && empty($category_err) && empty($file_err))
    {

        $pdf = $_FILES['pdf']['name'];
        $pdf_type = $_FILES['pdf']['type'];
        $pdf_size = $_FILES['pdf']['size'];
        $pdf_tem_loc = $_FILES['pdf']['tmp_name'];
        $file_name = time() . '_' . uniqid() . '.pdf';
        $upload_location = "../../Uploaded Documents/Criteria - 1/".$file_name;
        if(move_uploaded_file($pdf_tem_loc,$upload_location))

            $query = "INSERT INTO cri_1_3_1_courses (programme_code, academic_year, course_code, course_name, course_type, doc_name) VALUES ('$upload_by', '$academic_year','$course_code', '$course_name', '$course_type', '$file_name')"; 

            if(mysqli_query($con, $query))
            {
                echo '<script language="javascript">';
                echo'alert("Document Uploaded Successfully."); location.href="cri_1.3.1_courses.php"';
                echo '</script>';
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_1.3.1_courses.php"';
                echo '</script>';
            }
            mysqli_close($con);
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

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criteria - 1</title>
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
							<span>Criteria 1.3.1 - Institution integrates crosscutting issues relevant to Professional Ethics ,Gender, Human Values ,Environment and Sustainability into the Curriculum.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_1.3.1_courses.php" id="active">Relevant to Courses</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_courses_doc_view.php" id="non-active">View Document (Courses)</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_events.php" id="non-active">Relevant to Events</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_events_doc_view.php" id="non-active">View Document (Events)</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_pdf_report.php" id="non-active">PDF Report</a>
                                </li>

							</ul><br>

	                       	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

                            <div class = "card-body">
                                <div class="container-fluid">
                                    <div class="row justify-content-center">

                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-upload fa-lg"></i>
                                                    <span>Criteria 1.3.1 - Upload Document</span>
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
                                                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "course_code"> <span style="color: red">* </span>Course Code</label>

                                                        <input type="text" name="course_code" class="form-control <?php echo (!empty($course_code_err)) ? 'is-invalid' : ''; ?>" id = "course_code" value = "<?php echo $course_code; ?>">

                                                        <div class="invalid-feedback">
                                                            <?php echo $course_code_err; ?>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "course_name"> <span style="color: red">* </span>Course Name</label>

                                                        <input type="text" name="course_name" class="form-control <?php echo (!empty($course_name_err)) ? 'is-invalid' : ''; ?>" id = "course_name" value = "<?php echo $course_name; ?>">

                                                        <div class="invalid-feedback">
                                                                <?php echo $course_name_err; ?>
                                                        </div>
                                                    </div>       
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-upload fa-lg"></i>
                                                    <span>Criteria 1.3.1 - Upload Document</span>
                                                </div>
                                                
                                                <div class="card-body">

                                                    <div class="mb-3">
														<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "course_type"> <span style="color: red">* </span>Relevant to Course</label>

														<input type="text" name="course_type" class="form-control <?php echo (!empty($course_type_err)) ? 'is-invalid' : ''; ?>" id = "course_type" value = "<?php echo $course_type; ?>">

														<div class="invalid-feedback">
															<?php echo $course_type_err; ?>
														</div>
													</div> 

                                                    <div class="mb-3">
                                                        <label for="file" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Document</label>
                                                        <input name = "pdf" class="form-control <?php echo (!empty($file_err)) ? 'is-invalid' : ''; ?>" type="file" id="file">

                                                        <span class="invalid-feedback">
                                                            <?php echo $file_err; ?>
                                                        </span>
                                                    </div>

                                                    <button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
							
                            </div>  
						</div> 
						<!-- Card Body End -->
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
