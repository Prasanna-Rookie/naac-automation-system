<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$upload_by = $_SESSION['department'];
$academic_year = $academic_year_err = $type = $type_err = $organizer = $organizer_err = $resource_person = $resource_person_err = $topic = $topic_err = $days = $days_err = $sdate = $sdate_err = $edate = $edate_err = $pdf_file_err = "";
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
	if(empty(trim($_POST["type"])))
	{
		$type_err = "Please Enter Type of Program.";
	}
	else
	{
		$type = trim($_POST["type"]);
	}
	if(empty(trim($_POST["organizer"])))
	{
		$organizer_err = "Please Enter Organizer.";
	}
	else
	{
		$organizer = trim($_POST["organizer"]);
	}
	if(empty(trim($_POST["resource_person"])))
	{
		$resource_person_err = "Please Enter Resource Person.";
	}
	else
	{
		$resource_person = trim($_POST["resource_person"]);
	}
	if(empty(trim($_POST["topic"])))
	{
		$topic_err = "Please Enter Topic.";
	}
	else
	{
		$topic = trim($_POST["topic"]);
	}
	if(empty(trim($_POST["days"])))
	{
		$days_err = "Please Enter No. of Days.";
	}
	else
	{
		$days = trim($_POST["days"]);
	}
	if(empty(trim($_POST["sdate"])))
	{
		$sdate_err = "Please Enter Starting Date.";
	}
	else
	{
		$sdate = trim($_POST["sdate"]);
	}
	if(empty(trim($_POST["edate"])))
	{
		$edate = "-";
	}
	else
	{
		$edate = trim($_POST["edate"]);
	}
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

        $pdf_file_upload_location = "../../Uploaded Documents/Criteria - 2/".$pdf_file_name;
	}

	//Insert

	if(empty($academic_year_err) && empty($pdf_file_err) && empty($type_err) && empty($organizer_err) && empty($resource_person_err) && empty($topic_err) && empty($days_err) && empty($sdate_err))
	{
		if(move_uploaded_file($pdf_file_pdf_tem_loc, $pdf_file_upload_location))
		{
			$query = "INSERT INTO cri_2_2_1_spc_programmes (academic_year, department, type, organizer, resource_person, topic, days, sdate, edate, doc_name) VALUES ('$academic_year', '$upload_by', '$type', '$organizer', '$resource_person', '$topic', '$days', '$sdate', '$edate', '$pdf_file_upload_location')";
			if(mysqli_query($con, $query))
			{
				echo '<script language="javascript">';
        		echo'alert("Uploaded Successfully."); location.href="cri_2.2.1_spc_programmes.php"';
        		echo '</script>';
			}
			else
			{
				echo '<script language="javascript">';
	        	echo'alert("Upload Failed, Please Try Again."); location.href="cri_2.2.1_spc_programmes.php"';
	        	echo '</script>';
			}
		}
		else
		{
			echo '<script language="javascript">';
        	echo'alert("Upload Failed, Please Try Again."); location.href="cri_2.2.1_spc_programmes.php"';
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
							<span>Criteria 2.2.1 - The institution assesses students’ learning levels and organises special programmes for both slow and advanced learners.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_2.2.1_spc_programmes.php" id="active">Special Programmes</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.1_doc_upload.php" id="non-active">Document Upload</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.1_spc_prog_doc_view.php" id="non-active">View Document (Special Programmes)</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.1_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

                    <div class = "card-body">
                        <div class="container-fluid"><br>
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-sm-6">
                                    <div class="card" style="border-top:2px solid #087ec2;">
                                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                            <i class="fa-solid fa-graduation-cap fa-lg"></i>
                                            <span>Criteria 2.2.1 - Special Programmes</span>
                                        </div>

                                        <div class="card-body">
                                           
                                            <div class="mb-3">
                                                <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                                                <select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

                                                       <option value="">---Select Academic Year---</option>

                                                       <?php
                                                       $sql = "SELECT * FROM academic_year WHERE hide_status = 1 ORDER BY academic_year ";
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
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "type"> <span style="color: red">* </span>Type of Program</label>

                                            	<input type="text" name="type" class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>"	id = "type" value = "<?php echo $type; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $type_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "organizer"> <span style="color: red">* </span>Organizer</label>

                                            	<input type="text" name="organizer" class="form-control <?php echo (!empty($organizer_err)) ? 'is-invalid' : ''; ?>"	id = "organizer" value = "<?php echo $organizer; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $organizer_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "resource_person"> <span style="color: red">* </span>Resource Person</label>

                                            	<input type="text" name="resource_person" class="form-control <?php echo (!empty($resource_person_err)) ? 'is-invalid' : ''; ?>"	id = "resource_person" value = "<?php echo $resource_person; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $resource_person_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "topic"> <span style="color: red">* </span>Topic</label>

                                            	<input type="text" name="topic" class="form-control <?php echo (!empty($topic_err)) ? 'is-invalid' : ''; ?>"	id = "topic" value = "<?php echo $topic; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $topic_err; ?>
	                                            </div>
                                        	</div>

                                		</div>
                            		</div>
                        		</div>

		                        <div class="col-sm-6 col-sm-6">
			                        <div class="card" style="border-top:2px solid #087ec2;">
			                        	<div class="card-header" style="color:#087ec2; font-weight:bold;">
			                        		<i class="fa-solid fa-graduation-cap fa-lg"></i>
		                                            <span>Criteria 2.2.1 - Special Programmes</span>
			                        	</div>
			                        	<div class="card-body">

                                        	

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "days"> <span style="color: red">* </span>No. of Days</label>

                                            	<input type="number" name="days" class="form-control <?php echo (!empty($days_err)) ? 'is-invalid' : ''; ?>"	id = "days" value = "<?php echo $days; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $days_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "sdate"> <span style="color: red">* </span>Starting Date</label>

                                            	<input type="date" name="sdate" class="form-control <?php echo (!empty($sdate_err)) ? 'is-invalid' : ''; ?>"	id = "sdate" value = "<?php echo $sdate; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $sdate_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "edate">Ending Date</label>

                                            	<input type="date" name="edate" class="form-control <?php echo (!empty($edate_err)) ? 'is-invalid' : ''; ?>"	id = "edate" value = "<?php echo $edate; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $edate_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
												<label for="pdf_file" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Upload</label>

												<input name = "pdf_file" class="form-control <?php echo (!empty($pdf_file_err)) ? 'is-invalid' : ''; ?>" type="file" id="pdf_file">

												<span class="invalid-feedback">
													<?php echo $pdf_file_err; ?>
												</span>
											</div>

			                        		<button type="submit" class="btn btn-success" style="float: right;" name="insert"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

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
