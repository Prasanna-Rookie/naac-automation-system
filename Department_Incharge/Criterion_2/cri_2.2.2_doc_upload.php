<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $teacher_list_err = $student_list_err = "";
$upload_by = $_SESSION['department'];

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

	// PDF File

	if (empty($_FILES['teacher_list']['name']))
	{
		$teacher_list_err = "Please Select PDF File.";
	}
	elseif($_FILES['teacher_list']['type'] != 'application/pdf')
	{
		$teacher_list_err = "Please Select PDF File.";
	}
	else
	{
		$teacher_list_pdf = $_FILES['teacher_list']['name'];
        $teacher_list_pdf_type = $_FILES['teacher_list']['type'];
        $teacher_list_pdf_size = $_FILES['teacher_list']['size'];
        $teacher_list_pdf_tem_loc = $_FILES['teacher_list']['tmp_name'];
        $teacher_list_name = time() . '_' . uniqid() . '.pdf';

        $teacher_list_upload_location = "../../Uploaded Documents/Criteria - 2/".$teacher_list_name;
	}

	if (empty($_FILES['teacher_list']['name']))
	{
		$teacher_list_err = "Please Select PDF File.";
	}
	elseif($_FILES['teacher_list']['type'] != 'application/pdf')
	{
		$teacher_list_err = "Please Select PDF File.";
	}
	else
	{
		$student_list_pdf = $_FILES['student_list']['name'];
        $student_list_pdf_type = $_FILES['student_list']['type'];
        $student_list_pdf_size = $_FILES['student_list']['size'];
        $student_list_pdf_tem_loc = $_FILES['student_list']['tmp_name'];
        $student_list_name = time() . '_' . uniqid() . '.pdf';

        $student_list_upload_location = "../../Uploaded Documents/Criteria - 2/".$student_list_name;
	}

	// Insert
	if(empty($academic_year_err) && empty($teacher_list_err) && empty($student_list_err))
	{
		if(move_uploaded_file($teacher_list_pdf_tem_loc, $teacher_list_upload_location) && move_uploaded_file($student_list_pdf_tem_loc, $student_list_upload_location))
		{
			$query = "INSERT INTO cri_2_2_2_doc_upload (academic_year, upload_by, teacher_list, student_list) VALUES ('$academic_year', '$upload_by', '$teacher_list_name', '$student_list_name')";
			if(mysqli_query($con, $query))
			{
				echo '<script language="javascript">';
        		echo'alert("Document Uploaded Successfully."); location.href="cri_2.2.2_doc_upload.php"';
        		echo '</script>';
			}
			else
			{
				echo '<script language="javascript">';
	        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_2.2.2_doc_upload.php"';
	        	echo '</script>';
			}
		}
		else
		{
			echo '<script language="javascript">';
        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_2.2.2_doc_upload.php"';
        	echo '</script>';

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

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 2</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 2.2</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen"></i>
							<span>Criteria 2.2.2 - Student – Teacher (full-time) ratio.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_full_time_teacher.php" id="non-active">Add Teacher</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_edit_full_time_teacher.php" id="non-active">Edit Teacher</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_add_student.php" id="non-active">Add Student</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_2.2.2_doc_upload.php" id="active">Document Upload</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_doc_view.php" id="non-active">View Document</a>
								</li>
							</ul>

							<div class = "card-body">
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
													<i class="fa-solid fa-upload fa-lg"></i>
	                        						<span>Criteria 2.2.2 - Document Upload</span>
												</div>

												<div class="card-body">
													<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

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
															<label for="teacher_list" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Teacher List</label>

															<input name = "teacher_list" class="form-control <?php echo (!empty($teacher_list_err)) ? 'is-invalid' : ''; ?>" type="file" id="teacher_list">

															<span class="invalid-feedback">
																<?php echo $teacher_list_err; ?>
															</span>
														</div>

														<div class="mb-3">
															<label for="student_list" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Student List</label>

															<input name = "student_list" class="form-control <?php echo (!empty($student_list_err)) ? 'is-invalid' : ''; ?>" type="file" id="student_list">

															<span class="invalid-feedback">
																<?php echo $student_list_err; ?>
															</span>
														</div>

														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>
													</form>

												</div>
											</div>

										</div>
									</div>
								</div>
							</div>							
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
