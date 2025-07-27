<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
$name = $name_err = $academic_year = $academic_year_err = $id_number = $id_number_err = $email = $email_err = $gender = $gender_err = $designation = $designation_err = $joining_date = $joining_date_err = $leaving_date = $leaving_date_err = $pan = $pan_err = $appointment =  $appointment_err = "";
require '../../config.php';
$upload_by = $_SESSION['department'];
if($_SERVER["REQUEST_METHOD"] == "POST")
{

	if(empty(trim($_POST["academic_year"])))
    {
        $academic_year_err = "Please Select Academic Year.";
    }
    else
    {
    	$academic_year = trim($_POST["academic_year"]);
    }

	if(empty(trim($_POST["name"])))
    {
        $name_err = "Please Enter Name.";
    }
    else
    {
    	$name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["id_number"])))
    {
        $id_number_err = "Please Enter ID number/ Aadhar number.";
    }
    else
    {
    	$id_number = trim($_POST["id_number"]);
    }

    if(empty(trim($_POST["pan"])))
    {
        $pan_err = "Please Enter PAN number.";
    }
    else
    {
    	$pan = trim($_POST["pan"]);
    }
    if (empty(trim($_POST["email"]))) 
    {
        $email_err = "Please enter a Email.";
    }
    elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL))
    {
    	$email_err = "Invalid Email.";
    }
    else
    {
    	$email = trim($_POST["email"]);
    }
    if(empty(trim($_POST["appointment"])))
    {
        $appointment_err = "Please Select Nature of Appointment.";
    }
    else
    {
    	$appointment = trim($_POST["appointment"]);
    }
    if(empty(trim($_POST["gender"])))
    {
        $gender_err = "Please Select Gender.";
    }
    else
    {
    	$gender = trim($_POST["gender"]);
    }

    if(empty(trim($_POST["designation"])))
    {
        $designation_err = "Please Enter Designation.";
    }
    else
    {
    	$designation = trim($_POST["designation"]);
    }
    if(empty(trim($_POST["joining_date"])))
    {
        $joining_date_err = "Please Enter Joining Date.";
    }
    else
    {
    	$joining_date = trim($_POST["joining_date"]);
    }

    if(empty(trim($_POST["leaving_date"])))
    {
        $leaving_date = "-";
    }
    else
    {
    	$leaving_date = trim($_POST["leaving_date"]);
    }

    if(empty($academic_year_err) && empty($name_err) && empty($id_number_err) && empty($pan_err) && empty($email_err) && empty($appointment_err) && empty($gender_err) && empty($designation_err) && empty($joining_date_err))
    {
    	
    	$query = "INSERT INTO cri_2_2_2_full_time_teacher (academic_year, department, name, id_number, email, gender, designation, pan, appointment, joining_date, leaving_date) VALUES ('$academic_year', '$upload_by','$name','$id_number','$email','$gender','$designation','$pan','$appointment','$joining_date','$leaving_date')";

	    if(mysqli_query($con, $query))
	    {
	        echo '<script language="javascript">';
	        echo'alert("Updated Successfully."); location.href="cri_2.2.2_full_time_teacher.php"';
	        echo '</script>';
	    }
	    else
	    {
	        echo '<script language="javascript">';
	        echo'alert("Failed, Please Try Again."); location.href="cri_2.2.2_full_time_teacher.php"';
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
									<a class="nav-link active" href="cri_2.2.2_full_time_teacher.php" id="active">Add Teacher</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_edit_full_time_teacher.php" id="non-active">Edit Teacher</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_add_student.php" id="non-active">Add Student</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_doc_upload.php" id="non-active">Document Upload</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-pen fa-lg"></i>
														<span>Criteria 2.2.2 - Add Teacher</span>
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
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "name"> <span style="color: red">* </span>Name of the Teacher</label>

				                                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "name" value = "<?php echo $name; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $name_err; ?>
				                                            </div>
				                                        </div>

				                                        <div class="mb-3">
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "id_number"> <span style="color: red">* </span>ID number/ Aadhar number</label>

				                                            <input type="text" name="id_number" class="form-control <?php echo (!empty($id_number_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "id_number" value = "<?php echo $id_number; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $id_number_err; ?>
				                                            </div>
				                                        </div>

				                                        <div class="mb-3">
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "pan"> <span style="color: red">* </span>PAN number</label>

				                                            <input type="text" name="pan" class="form-control <?php echo (!empty($pan_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "pan" value = "<?php echo $pan; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $pan_err; ?>
				                                            </div>
				                                        </div>

				                                        <div class="mb-3">
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "email"> <span style="color: red">* </span>Email ID</label>

				                                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "email" value = "<?php echo $email; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $email_err; ?>
				                                            </div>
				                                        </div>
													</div>
												</div>
											</div>

											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-pen fa-lg"></i>
														<span>Criteria 2.2.2 - Add Teacher</span>
													</div>
													<div class="card-body">

														<div class="mb-3">
                                                            <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="appointment"><span style="color: red">* </span>Nature of Appointment</label>

                                                            <select name="appointment" class="form-select <?php echo (!empty($appointment_err)) ? 'is-invalid' : ''; ?>" id="appointment">

                                                                <option value="">---Select Nature of Appointment---</option>

                                                                <option value="Sanctioned Post" 
                                                                <?php 
                                                                    if($appointment == 'Sanctioned Post') 
                                                                    { 
                                                                
                                                                        echo "selected"; 
                                                                    } 
                                                                ?>

                                                                >Sanctioned Post</option>

                                                                <option value="Temporary"

                                                                <?php 
                                                                    if($appointment == 'Temporary')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Temporary</option>

                                                                <option value="Permanent"

                                                                <?php 
                                                                    if($appointment == 'Permanent')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Permanent</option>
                                                            </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $appointment_err; ?>
                                                            </span>
                                                        </div>

														<div class="mb-3">
                                                            <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="gender"><span style="color: red">* </span>Gender</label>

                                                            <select name="gender" class="form-select <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" id="gender">

                                                                <option value="">---Select Gender---</option>

                                                                <option value="Male" 
                                                                <?php 
                                                                    if($gender == 'Male') 
                                                                    { 
                                                                
                                                                        echo "selected"; 
                                                                    } 
                                                                ?>

                                                                >Male</option>

                                                                <option value="Female"

                                                                <?php 
                                                                    if($gender == 'Female')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Female</option>
                                                            </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $gender_err; ?>
                                                            </span>
                                                        </div>

                                                        <div class="mb-3">
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "designation"> <span style="color: red">* </span>Designation</label>

				                                            <input type="text" name="designation" class="form-control <?php echo (!empty($designation_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "designation" value = "<?php echo $designation; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $designation_err; ?>
				                                            </div>
				                                        </div>

				                                        <div class="mb-3">
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "joining_date"> <span style="color: red">* </span>Date of Joining</label>

				                                            <input type="date" name="joining_date" class="form-control <?php echo (!empty($joining_date_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "joining_date" value = "<?php echo $joining_date; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $joining_date_err; ?>
				                                            </div>
				                                        </div>

				                                        <div class="mb-3">
				                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "leaving_date">Date of Leaving</label>

				                                            <input type="date" name="leaving_date" class="form-control <?php echo (!empty($leaving_date_err)) ? 'is-invalid' : ''; ?>"
				                                            id = "leaving_date" value = "<?php echo $leaving_date; ?>">

				                                            <div class="invalid-feedback">
				                                                <?php echo $leaving_date_err; ?>
				                                            </div>
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
