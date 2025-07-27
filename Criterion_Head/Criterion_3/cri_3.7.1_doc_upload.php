<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $description = $description_err = $pdf_file_err = "";
$upload_by_name = $_SESSION['name'];
$upload_by_id = $_SESSION['cri_id'];

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

	// Description Validation

	if(empty(trim($_POST["description"])))
	{
		$description_err = "Please Enter Document Description.";
	}
	elseif(strlen(trim($_POST["description"])) >= 50)
    {
    	$description_err = "The maximum Length of the description is lessthan 50 Characters."; 
    }
	else
	{
		$description = trim($_POST["description"]);
	}

	// PDF File

	if (empty($_FILES['pdf_file']['name']))
	{
		$pdf_file_err = "Please Select PDF File.";
	}
	elseif($_FILES['pdf_file']['type'] != 'application/pdf')
	{
		$pdf_file_err = "Please Select PDF File.";
	}
	else
	{
		$pdf_file_pdf = $_FILES['pdf_file']['name'];
        $pdf_file_pdf_type = $_FILES['pdf_file']['type'];
        $pdf_file_pdf_size = $_FILES['pdf_file']['size'];
        $pdf_file_pdf_tem_loc = $_FILES['pdf_file']['tmp_name'];
        $pdf_file_name = time() . '_' . uniqid() . '.pdf';

        $pdf_file_upload_location = "../../Uploaded Documents/Criteria - 3/".$pdf_file_name;
	}

	// Insert
	if(empty($academic_year_err) && empty($description_err) && empty($pdf_file_err))
	{
		$criteria = "Metric 3.7.1";
		if(move_uploaded_file($pdf_file_pdf_tem_loc, $pdf_file_upload_location))
		{
			$query = "INSERT INTO cri_3_doc_upload (academic_year, criteria, description, upload_by_id, upload_by_name, doc_name) VALUES ('$academic_year', '$criteria', '$description', '$upload_by_id', '$upload_by_name','$pdf_file_name')";
			if(mysqli_query($con, $query))
			{
				echo '<script language="javascript">';
        		echo'alert("Document Uploaded Successfully."); location.href="cri_3.7.1_doc_upload.php"';
        		echo '</script>';
			}
			else
			{
				echo '<script language="javascript">';
	        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_3.7.1_doc_upload.php"';
	        	echo '</script>';
			}
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
	<title>Criterion - 3</title>
	<style type="text/css">
		#active
		{
			font-weight: bold;
		}
		#non-active
		{
			color: dimgrey;
		}
		label
		{
			font-size: 17px; 
			color:dimgrey; 
			font-weight: bold;
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.7</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-handshake fa-lg"></i>
							<span>Criteria 3.7.1 - Number of collaborative activities during the year for research/ faculty exchange/ student exchange/ internship/ on-the-job training/ project work.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.1_excel_report.php" id="non-active">Excel Report</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.7.1_doc_upload.php" id="active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.1_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<div class = "card-body">
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
													<i class="fa-solid fa-upload fa-lg"></i>
	                        						<span>Criteria 3.7.1 - Upload Document</span>
												</div>
												<div class="card-body">
													<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

														<div class="mb-3">
															<label class="form-label" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

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
	                                                        <label class="form-label" for = "description"> <span style="color: red">* </span>Description</label>

	                                                        <input 
	                                                            type="text" 
	                                                            name="description" 
	                                                            class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"
	                                                            id = "description" 
	                                                            value = "<?php echo $description; ?>">

	                                                        <div class="invalid-feedback">
	                                                            <?php echo $description_err; ?>
	                                                        </div>
	                                                    </div>

	                                                    <div class="mb-3">
															<label for="pdf_file" class="form-label"> <span style="color: red">* </span>Document</label>

															<input name = "pdf_file" class="form-control <?php echo (!empty($pdf_file_err)) ? 'is-invalid' : ''; ?>" type="file" id="pdf_file">

															<span class="invalid-feedback">
																<?php echo $pdf_file_err; ?>
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
