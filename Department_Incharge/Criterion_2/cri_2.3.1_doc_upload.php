<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $exp_learning_err = $par_learning_err = $pro_solving_err = "";
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

	if (empty($_FILES['exp_learning']['name']))
	{
		$exp_learning_err = "Please Select PDF File.";
	}
	elseif($_FILES['exp_learning']['type'] != 'application/pdf')
	{
		$exp_learning_err = "Please Select PDF File.";
	}
	else
	{
		$exp_learning_pdf = $_FILES['exp_learning']['name'];
        $exp_learning_pdf_type = $_FILES['exp_learning']['type'];
        $exp_learning_pdf_size = $_FILES['exp_learning']['size'];
        $exp_learning_pdf_tem_loc = $_FILES['exp_learning']['tmp_name'];
        $exp_learning_name = time() . '_' . uniqid() . '.pdf';

        $exp_learning_upload_location = "../../Uploaded Documents/Criteria - 2/".$exp_learning_name;
	}

	if (empty($_FILES['par_learning']['name']))
	{
		$par_learning_err = "Please Select PDF File.";
	}
	elseif($_FILES['par_learning']['type'] != 'application/pdf')
	{
		$par_learning_err = "Please Select PDF File.";
	}
	else
	{
		$par_learning_pdf = $_FILES['par_learning']['name'];
        $par_learning_pdf_type = $_FILES['par_learning']['type'];
        $par_learning_pdf_size = $_FILES['par_learning']['size'];
        $par_learning_pdf_tem_loc = $_FILES['par_learning']['tmp_name'];
        $par_learning_name = time() . '_' . uniqid() . '.pdf';

        $par_learning_upload_location = "../../Uploaded Documents/Criteria - 2/".$par_learning_name;
	}

	if (empty($_FILES['pro_solving']['name']))
	{
		$pro_solving_err = "Please Select PDF File.";
	}
	elseif($_FILES['pro_solving']['type'] != 'application/pdf')
	{
		$pro_solving_err = "Please Select PDF File.";
	}
	else
	{
		$pro_solving_pdf = $_FILES['pro_solving']['name'];
        $pro_solving_pdf_type = $_FILES['pro_solving']['type'];
        $pro_solving_pdf_size = $_FILES['pro_solving']['size'];
        $pro_solving_pdf_tem_loc = $_FILES['pro_solving']['tmp_name'];
        $pro_solving_name = time() . '_' . uniqid() . '.pdf';

        $pro_solving_upload_location = "../../Uploaded Documents/Criteria - 2/".$par_learning_name;
	}

	// Insert
	if(empty($academic_year_err) && empty($exp_learning_err) && empty($par_learning_err) && empty($pro_solving_err))
	{
		if(move_uploaded_file($exp_learning_pdf_tem_loc, $exp_learning_upload_location) && move_uploaded_file($par_learning_pdf_tem_loc, $par_learning_upload_location) && move_uploaded_file($pro_solving_pdf_tem_loc, $pro_solving_upload_location))
		{
			$query = "INSERT INTO cri_2_3_1_doc_upload (academic_year, upload_by, exp_learning, par_learning,pro_solving) VALUES ('$academic_year', '$upload_by', '$exp_learning_name', '$par_learning_name', '$pro_solving_name')";
			if(mysqli_query($con, $query))
			{
				echo '<script language="javascript">';
        		echo'alert("Document Uploaded Successfully."); location.href="cri_2.3.1_doc_upload.php"';
        		echo '</script>';
			}
			else
			{
				echo '<script language="javascript">';
	        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_2.3.1_doc_upload.php"';
	        	echo '</script>';
			}
		}
		else
		{
			echo '<script language="javascript">';
        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_2.3.1_doc_upload.php"';
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

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
							<i class="fa-solid fa-chalkboard-user fa-lg"></i>
							<span>Criteria 2.3.1 - Student-centric methods such as experiential learning, participative learning and problem-solving methodologies are used for enhancing learning experiences.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_2.3.1_doc_upload.php" id="active">Document Upload</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.3.1_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul><br>

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
															<label for="exp_learning" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Experiential Learning</label>

															<input name = "exp_learning" class="form-control <?php echo (!empty($exp_learning_err)) ? 'is-invalid' : ''; ?>" type="file" id="exp_learning">

															<span class="invalid-feedback">
																<?php echo $exp_learning_err; ?>
															</span>
														</div>

														<div class="mb-3">
															<label for="par_learning" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Participative Learning</label>

															<input name = "par_learning" class="form-control <?php echo (!empty($par_learning_err)) ? 'is-invalid' : ''; ?>" type="file" id="par_learning">

															<span class="invalid-feedback">
																<?php echo $par_learning_err; ?>
															</span>
														</div>

														<div class="mb-3">
															<label for="pro_solving" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Problem-Solving Methodologies</label>

															<input name = "pro_solving" class="form-control <?php echo (!empty($pro_solving_err)) ? 'is-invalid' : ''; ?>" type="file" id="pro_solving">

															<span class="invalid-feedback">
																<?php echo $pro_solving_err; ?>
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
