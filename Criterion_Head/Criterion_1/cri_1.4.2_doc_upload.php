<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
}

$academic_year = $academic_year_err = $fb_policy_err = $action_taken_err = "";
 
$upload_by = $_SESSION['criterion'];

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

	// Feedback Policy Validation	

	if (empty($_FILES['fb_policy']['name']))
	{
		$fb_policy_err = "Please Select PDF File.";
	}
	elseif($_FILES['fb_policy']['type'] != 'application/pdf')
	{
		$fb_policy_err = "Please Select PDF File.";
	}
	else
	{
		$fb_policy_pdf = $_FILES['fb_policy']['name'];
        $fb_policy_pdf_type = $_FILES['fb_policy']['type'];
        $fb_policy_pdf_size = $_FILES['fb_policy']['size'];
        $fb_policy_pdf_tem_loc = $_FILES['fb_policy']['tmp_name'];
        $fb_policy_file_name = time() . '_' . uniqid() . '.pdf';

        $fb_policy_upload_location = "../../Uploaded Documents/Criteria - 1/".$fb_policy_file_name;
	}

	// Action Taken Report Validation

	if (empty($_FILES['action_taken']['name']))
	{
		$action_taken_err = "Please Select PDF File.";
	}
	elseif($_FILES['action_taken']['type'] != 'application/pdf')
	{
		$action_taken_err = "Please Select PDF File.";
	}
	else
	{
		$action_taken_pdf = $_FILES['action_taken']['name'];
        $action_taken_pdf_type = $_FILES['action_taken']['type'];
        $action_taken_pdf_size = $_FILES['action_taken']['size'];
        $action_taken_pdf_tem_loc = $_FILES['action_taken']['tmp_name'];
        $action_taken_file_name = time() . '_' . uniqid() . '.pdf';
        
        $action_taken_upload_location = "../../Uploaded Documents/Criteria - 1/".$action_taken_file_name;
	}

	// Insert Data

	if(empty($academic_year_err) && empty($fb_policy_err) && empty($action_taken_err))
	{
		
		if(move_uploaded_file($fb_policy_pdf_tem_loc,$fb_policy_upload_location) && move_uploaded_file($action_taken_pdf_tem_loc,$action_taken_upload_location))
        {
        	$doc_type_1 = "Feedback Policy";
        	$doc_type_2 = "Action Taken Report";
        	$query_1 = "INSERT INTO cri_1_4_2_doc_upload (academic_year, upload_by, doc_type,doc_name) VALUES ('$academic_year', '$upload_by', '$doc_type_1','$fb_policy_file_name')";

        	$query_2 = "INSERT INTO cri_1_4_2_doc_upload (academic_year, upload_by, doc_type,doc_name) VALUES ('$academic_year', '$upload_by', '$doc_type_2','$action_taken_file_name')";

        	if(mysqli_query($con, $query_1) && mysqli_query($con, $query_2))
        	{
        		echo '<script language="javascript">';
        		echo'alert("Document Uploaded Successfully."); location.href="cri_1.4.2_doc_upload.php"';
        		echo '</script>';
        	}
        	else
        	{
        		echo '<script language="javascript">';
        		echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_1.4.2_doc_upload.php"';
        		echo '</script>';
        	}
        }
        else
        {
        	echo '<script language="javascript">';
        	echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_1.4.2_doc_upload.php"';
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
                            <li class="breadcrumb-item active" aria-current="page">Criteria 1.4.2</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-comments"></i>
                            <span>Criteria 1.4.2 - The feedback system of the Institution</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

	                        <div class = "card-body">
	                        	<ul class="nav nav-tabs">
	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link active" href="cri_1.4.2_doc_upload.php" id="active">Upload Document</a>
	                                </li>

	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link" href="cri_1.4.2_doc_view.php" id="non-active">View Document</a>
	                                </li>
	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link" href="cri_1.4.2_report.php" id="non-active">Report</a>
	                                </li>
                            	</ul>
	                        	<div class="container-fluid"><br>
	                        		<div class="row justify-content-center">
	                        			<div class="col-sm-6 col-sm-6">
	                        				<div class="card" style="border-top:2px solid #087ec2;">
	                        					<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        						<i class="fa-solid fa-upload fa-lg"></i>
	                        						<span>Criteria 1.4.2 - Document Upload</span>
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

	                        							<label for="fb_policy" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Feedback Policy</label>

	                        							<input name = "fb_policy" class="form-control <?php echo (!empty($fb_policy_err)) ? 'is-invalid' : ''; ?>" type="file" id="fb_policy">

	                        							<span class="invalid-feedback">
	                        								<?php echo $fb_policy_err; ?>
	                        							</span>
	                        						</div>
	                        					</div>
	                        				</div>
	                        			</div>
	                        			<div class="col-sm-6 col-sm-6">
	                        				<div class="card" style="border-top:2px solid #087ec2;">
	                        					<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        						<i class="fa-solid fa-upload fa-lg"></i>
	                        						<span>Criteria 1.4.2 - Document Upload</span>
	                        					</div>

	                        					<div class="card-body">

	                        						<div class="mb-3">
	                        							<label for="action_taken" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Action Taken Report</label>

	                        							<input name = "action_taken" class="form-control <?php echo (!empty($action_taken_err)) ? 'is-invalid' : ''; ?>" type="file" id="action_taken">

	                        							<span class="invalid-feedback">
	                        								<?php echo $action_taken_err; ?>
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