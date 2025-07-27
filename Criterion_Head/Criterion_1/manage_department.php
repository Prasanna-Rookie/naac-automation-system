<?php
    session_start();
    if(!isset($_SESSION['cri_id']))
     {
         header("location: ../../index.php");
         exit;
     }

    require '../../config.php';
    $programme_code = $programme_code_err = $programme_name = $programme_name_err = $intro_year = $intro_year_err = $cbcs_status = $cbcs_status_err = $intro_year_cbcs = $intro_year_cbcs_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Programme Code Validate

		if (empty(trim($_POST["programme_code"]))) 
    	{
        	$programme_code_err = "Please Enter Programme Code.";
    	}
    	else
    	{
    		$sql = "SELECT id FROM programme_info WHERE programme_code = ?";

			if($stmt = mysqli_prepare($con, $sql))
			{
				mysqli_stmt_bind_param($stmt, "s", $param_programme_code);
				
				$param_programme_code = trim($_POST["programme_code"]);

				if(mysqli_stmt_execute($stmt))
				{
					mysqli_stmt_store_result($stmt);

					if(mysqli_stmt_num_rows($stmt) == 1)
					{
						$programme_code_err = "Programme Code is Already Taken.";
					} 
					else
					{
						$programme_code = trim($_POST["programme_code"]);
					}
				}
			}     
    	}

    	// Programme Name Validate

		if (empty(trim($_POST["programme_name"]))) 
    	{
        	$programme_name_err = "Please Enter Programme Name.";
    	}
    	else
    	{
        	$programme_name = trim($_POST["programme_name"]);     
    	}

    	// Intro Year Validate

		if (empty(trim($_POST["intro_year"]))) 
    	{
        	$intro_year_err = "Please Enter Year of Introduction.";
    	}
    	else
    	{
        	$intro_year = trim($_POST["intro_year"]);     
    	}

    	// Status of Implementation

		if (empty(trim($_POST["cbcs_status"]))) 
    	{
        	$cbcs_status_err = "Please Select Status.";
    	}
    	else
    	{
        	$cbcs_status = trim($_POST["cbcs_status"]);     
    	}

    	// Implementation Year Validate

		if (empty(trim($_POST["intro_year_cbcs"]))) 
    	{
        	$intro_year_cbcs_err = "Please Enter Year of Implementation.";
    	}
    	else
    	{
        	$intro_year_cbcs = trim($_POST["intro_year_cbcs"]);     
    	}

    	if(empty($programme_code_err) && empty($programme_name_err) && empty($intro_year_err) && empty($cbcs_status_err) && empty($intro_year_cbcs_err))
    	{
    		$query = "INSERT INTO programme_info (programme_code, programme_name, intro_year, cbcs_status, cbcs_imple_year) VALUES ('$programme_code', '$programme_name', '$intro_year', '$cbcs_status', '$intro_year_cbcs')";

			if(mysqli_query($con, $query))
	        {
	            echo '<script language="javascript">';
	            echo'alert("Programme Added Successfully."); location.href="manage_department.php"';
	            echo '</script>';
	        }
	        else
	        {
	            echo '<script language="javascript">';
	           	echo'alert("Failed, Please Try Again."); location.href="manage_department.php"';
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
                            <li class="breadcrumb-item active" aria-current="page">Programmes</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-building-columns"></i>
                            <span> Manage Programmes </span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
                        	<ul class="nav nav-tabs">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="manage_department.php" id="active">New Programmes</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="edit_department.php" id="non-active">Edit Programmes</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="ep_1.1_report.php" id="non-active">Report</a>
                                </li>
                            </ul>

                        	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
	                        	<div class = "card-body">
	                                <div class="container-fluid"><br>
	                                    <div class="row justify-content-center">

	                                        <div class="col-sm-6 col-sm-6">
	                                            <div class="card" style="border-top:2px solid #087ec2;">
	                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
	                                                    <i class="fa-solid fa-building-columns"></i>
	                                                    <span>Add New Programmes</span>
	                                                </div>
	                                                
	                                                <div class="card-body">
	         											<div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "programme_code"> <span style="color: red">* </span>Programme Code</label>

                                                            <input type="text" name="programme_code" class="form-control <?php echo (!empty($programme_code_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "programme_code" value = "<?php echo $programme_code; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $programme_code_err; ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "programme_name"> <span style="color: red">* </span>Programme Name</label>

                                                            <input type="text" name="programme_name" class="form-control <?php echo (!empty($programme_name_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "programme_name" value = "<?php echo $programme_name; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $programme_name_err; ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "intro_year"> <span style="color: red">* </span>Year of Introduction</label>

                                                            <input type="text" name="intro_year" class="form-control <?php echo (!empty($intro_year_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "intro_year" value = "<?php echo $intro_year; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $intro_year_err; ?>
                                                            </div>
                                                        </div>
	                                                </div>
	                                            </div>
	                                        </div>

	                                        <div class="col-sm-6 col-sm-6">
	                                            <div class="card" style="border-top:2px solid #087ec2;">
	                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
	                                                    <i class="fa-solid fa-building-columns"></i>
	                                                    <span>Add New Programmes</span>
	                                                </div>
	                                                
	                                                <div class="card-body">

	                                                	<div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "intro_year_cbcs"> <span style="color: red">* </span>Status of Implementation of CBCS / Elective Course System</label>

                                                            <select name="cbcs_status" class="form-select <?php echo (!empty($cbcs_status_err)) ? 'is-invalid' : ''; ?>" id="cbcs_status">

                                                            <option value="">---Select Status of CBCS---</option>

                                                            <option value="Yes" 
                                                        
                                                            <?php 
                                                            if($cbcs_status == 'Yes') 
                                                            { 
                                                                
                                                                echo "selected"; 
                                                            } 
                                                            ?>

                                                       		>Yes</option>

                                                        	<option value="No"

                                                        	<?php 
                                                        	if($cbcs_status == 'No')
                                                        	{
                                                            
                                                            	echo "selected";
                                                        	}
                                                        	?>

                                                        	>No</option>

                                                    	</select>

                                                            <div class="invalid-feedback">
                                                                <?php echo $cbcs_status_err; ?>
                                                            </div>
                                                        </div>

	                                                	<div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "intro_year_cbcs"> <span style="color: red">* </span>Year of Implementation of CBCS / Elective Course System</label>

                                                            <input type="text" name="intro_year_cbcs" class="form-control <?php echo (!empty($intro_year_cbcs_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "intro_year_cbcs" value = "<?php echo $intro_year_cbcs; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $intro_year_cbcs_err; ?>
                                                            </div>
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
    </div>

    <!-- Side Bar End -->

    <!-- Footer -->
    <?php
        require 'footer.php';
    ?>
    <!-- Fotter End -->

</body>
</html>