<?php
session_start();
if(!isset($_SESSION['dir_id']))
{
    header("location: ../index.php");
    exit;
} 

require '../config.php';
$aca_year = $aca_year_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")   	
{
	// Academic Year Validation

	if(empty(trim($_POST["academic_year"])))
	{
		$aca_year_err = "Please Enter Academic Year.";
	}
	elseif(strlen(trim($_POST["academic_year"])) != 9) 
	{
		$aca_year_err = "Please Enter Valid Academic Year.";
	}
	elseif (!preg_match('/^[0-9]{4}\-[0-9]{4}$/',trim($_POST["academic_year"]))) 
	{
		$aca_year_err = "Please Enter Valid Academic Year.";
	}
	else
	{
		$sql = "SELECT id FROM academic_year WHERE academic_year = ?";

		if($stmt = mysqli_prepare($con, $sql))
		{
			mysqli_stmt_bind_param($stmt, "s", $param_academic_year);
			$param_academic_year = trim($_POST["academic_year"]);

			if(mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1)
				{
					$aca_year_err = "This Academic Year is already taken.";
				} 
				else
				{
					$aca_year = trim($_POST["academic_year"]);
				}
			}
		}
	}
	if(empty($aca_year_err))
	{
        $hide_status = 1;
		$query = "INSERT INTO academic_year (academic_year, hide_status) VALUES ('$aca_year', $hide_status)";

		if(mysqli_query($con, $query))
        {
            echo '<script language="javascript">';
            echo'alert("Academic Year Added Successfully."); location.href="add_academic_year.php"';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
           	echo'alert("Failed, Please Try Again."); location.href="add_academic_year.php"';
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
    <link rel="stylesheet" type="text/css" href="../Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
    <script type="text/javascript" src="../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Libraries/fontawesome-6.1.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="../stylesheet/sidebar.css">

    <link rel="icon" type="image/x-icon" href="../images/psna_logo.png">
    <title>IQAC Director</title>

    <style type="text/css">
        #active
        {
            font-weight: bold;
        }
        #non-active
        {
            color: dimgrey;
        }
        .form-label
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
                            <li class="breadcrumb-item active" aria-current="page">Academic Year</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Academic Year</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
                        	<ul class="nav nav-tabs">
	                    		<li class="nav-item" role="presentation">
	                        		<a class="nav-link active" href="add_academic_year.php" id="active">Add Academic Year</a>
	                    		</li>

	                    		<li class="nav-item" role="presentation">
	                        		<a class="nav-link" href="manage_academic_year.php" id="non-active">Manage Academic Year</a>
	                    		</li>
	                		</ul>

	                		<div class = "card-body">
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                            					<i class="fa-solid fa-calendar-days"></i>
	                            					<span>Add New Academic Year</span>
	                        					</div>
	                        					
	                        					<div class="card-body">
	                        						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
	                                
		                                				<div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                                                            <input type="text" name="academic_year" class="form-control <?php echo (!empty($aca_year_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "academic_year" value = "<?php echo $aca_year; ?>" placeholder = "Ex : 2023-2024">

                                                            <div class="invalid-feedback">
                                                                <?php echo $aca_year_err; ?>
                                                            </div>
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