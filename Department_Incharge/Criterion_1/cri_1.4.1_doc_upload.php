<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
}

$academic_year = $academic_year_err = $stu_sample_err = $tea_sample_err = $emp_sample_err = $alu_sample_err = "";
 
$upload_by = $_SESSION['department'];

require '../../config.php';

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

	// Student Sample Form Validation	

	if (empty($_FILES['stu_sample']['name']))
	{
		$stu_sample_err = "Please Select PDF File.";
	}
	elseif($_FILES['stu_sample']['type'] != 'application/pdf')
	{
		$stu_sample_err = "Please Select PDF File.";
	}
	else
	{
		$stu_pdf = $_FILES['stu_sample']['name'];
        $stu_pdf_type = $_FILES['stu_sample']['type'];
        $stu_pdf_size = $_FILES['stu_sample']['size'];
        $stu_pdf_tem_loc = $_FILES['stu_sample']['tmp_name'];
        $stu_file_name = time() . '_' . uniqid() . '.pdf';

        $stu_upload_location = "../../Uploaded Documents/Criterion - 1/".$stu_file_name;
	}

	// Teacher Sample Form Validation

	if (empty($_FILES['tea_sample']['name']))
	{
		$tea_sample_err = "Please Select PDF File.";
	}
	elseif($_FILES['tea_sample']['type'] != 'application/pdf')
	{
		$tea_sample_err = "Please Select PDF File.";
	}
	else
	{
		$tea_pdf = $_FILES['tea_sample']['name'];
        $tea_pdf_type = $_FILES['tea_sample']['type'];
        $tea_pdf_size = $_FILES['tea_sample']['size'];
        $tea_pdf_tem_loc = $_FILES['tea_sample']['tmp_name'];
        $tea_file_name = time() . '_' . uniqid() . '.pdf';
        
        $tea_upload_location = "../../Uploaded Documents/Criterion - 1/".$tea_file_name;
	}

	// Employers Sample Form Validation

	if (empty($_FILES['emp_sample']['name']))
	{
		$emp_sample_err = "Please Select PDF File.";
	}
	elseif($_FILES['emp_sample']['type'] != 'application/pdf')
	{
		$emp_sample_err = "Please Select PDF File.";
	}
	else
	{
		$emp_pdf = $_FILES['emp_sample']['name'];
        $emp_pdf_type = $_FILES['emp_sample']['type'];
        $emp_pdf_size = $_FILES['emp_sample']['size'];
        $emp_pdf_tem_loc = $_FILES['emp_sample']['tmp_name'];
        $emp_file_name = time() . '_' . uniqid() . '.pdf';
        
        $emp_upload_location = "../../Uploaded Documents/Criterion - 1/".$emp_file_name;
	}

	// Alumni Sample Form Validation

	if (empty($_FILES['alu_sample']['name']))
	{
		$alu_sample_err = "Please Select PDF File.";
	}
	elseif($_FILES['alu_sample']['type'] != 'application/pdf')
	{
		$alu_sample_err = "Please Select PDF File.";
	}
	else
	{
		$alu_pdf = $_FILES['alu_sample']['name'];
        $alu_pdf_type = $_FILES['alu_sample']['type'];
        $alu_pdf_size = $_FILES['alu_sample']['size'];
        $alu_pdf_tem_loc = $_FILES['alu_sample']['tmp_name'];
        $alu_file_name = time() . '_' . uniqid() . '.pdf';
        
        $alu_upload_location = "../../Uploaded Documents/Criterion - 1/".$alu_file_name;
	}

	// Insert Data

	if(empty($academic_year_err) && empty($stu_sample_err) && empty($tea_sample_err) && empty($emp_sample_err) && empty($alu_sample_err))
	{
		if(move_uploaded_file($stu_pdf_tem_loc,$stu_upload_location) && move_uploaded_file($tea_pdf_tem_loc,$tea_upload_location) && move_uploaded_file($emp_pdf_tem_loc,$emp_upload_location) && move_uploaded_file($alu_pdf_tem_loc,$alu_upload_location))
        {
        	$query = "INSERT INTO cri_1_4_1_doc_upload (academic_year, upload_by, stu_sample, tea_sample, emp_sample, alu_sample) VALUES ('$academic_year', '$upload_by', '$stu_file_name', '$tea_file_name', '$emp_file_name', '$alu_file_name')";

        	if(mysqli_query($con, $query))
        	{
        		echo '<script language="javascript">';
        		echo'alert("Document Uploaded Successfully."); location.href="cri_1.4.1_doc_upload.php"';
        		echo '</script>';
        	}
        	else
        	{
        		echo '<script language="javascript">';
        		echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_1.4.1_doc_upload.php"';
        		echo '</script>';
        	}
        }
        else
        {
        	echo '<script language="javascript">';
        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_1.4.1_doc_upload.php"';
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
                            <li class="breadcrumb-item active" aria-current="page">Criteria 1.4.1</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-comments"></i>
                            <span>Criteria 1.4.1 - Structured feedback and review of the syllabus (Semester-wise / Year-wise) is obtained from 1) Students 2) Teachers 3) Employers and 4) Alumni.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

	                        <div class = "card-body">
	                        	<ul class="nav nav-tabs">
	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link active" href="cri_1.4.1_doc_upload.php" id="active">Upload Document</a>
	                                </li>

	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link" href="cri_1.4.1_doc_view.php" id="non-active">View Document</a>
	                                </li>
	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link" href="cri_1.4.1_report.php" id="non-active">Report</a>
	                                </li>
                            	</ul>
	                        	<div class="container-fluid"><br>
	                        		<div class="row justify-content-center">
	                        			<div class="col-sm-6 col-sm-6">
	                        				<div class="card" style="border-top:2px solid #087ec2;">
	                        					<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        						<i class="fa-solid fa-upload fa-lg"></i>
	                        						<span>Criteria 1.4.1 - Document Upload</span>
	                        					</div>

	                        					<div class="card-body">

	                        						<div class="mb-3">
	                        							<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

	                        							<select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

	                        								<option value="">---Select Document Type---</option>

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

	                        							<label for="stu_sample" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Student Feedback Sample</label>

	                        							<input name = "stu_sample" class="form-control <?php echo (!empty($stu_sample_err)) ? 'is-invalid' : ''; ?>" type="file" id="stu_sample">

	                        							<span class="invalid-feedback">
	                        								<?php echo $stu_sample_err; ?>
	                        							</span>
	                        						</div>

	                        						<div class="mb-3">
	                        							<label for="tea_sample" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Teacher Feedback Sample</label>

	                        							<input name = "tea_sample" class="form-control <?php echo (!empty($tea_sample_err)) ? 'is-invalid' : ''; ?>" type="file" id="tea_sample">

	                        							<span class="invalid-feedback">
	                        								<?php echo $tea_sample_err; ?>
	                        							</span>
	                        						</div>
	                        					</div>
	                        				</div>
	                        			</div>
	                        			<div class="col-sm-6 col-sm-6">
	                        				<div class="card" style="border-top:2px solid #087ec2;">
	                        					<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        						<i class="fa-solid fa-upload fa-lg"></i>
	                        						<span>Criteria 1.4.1 - Document Upload</span>
	                        					</div>

	                        					<div class="card-body">

	                        						<div class="mb-3">
	                        							<label for="emp_sample" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Employers Feedback Sample</label>

	                        							<input name = "emp_sample" class="form-control <?php echo (!empty($emp_sample_err)) ? 'is-invalid' : ''; ?>" type="file" id="emp_sample">

	                        							<span class="invalid-feedback">
	                        								<?php echo $emp_sample_err; ?>
	                        							</span>
	                        						</div>

	                        						<div class="mb-3">
	                        							<label for="alu_sample" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Alumni Feedback Sample</label>

	                        							<input name = "alu_sample" class="form-control <?php echo (!empty($alu_sample_err)) ? 'is-invalid' : ''; ?>" type="file" id="alu_sample">

	                        							<span class="invalid-feedback">
	                        								<?php echo $alu_sample_err; ?>
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