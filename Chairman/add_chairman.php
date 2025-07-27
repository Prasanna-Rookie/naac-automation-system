<?php
session_start();
if(!isset($_SESSION['chairman_id']))
 {
     header("location: ../index.php");
     exit;
 } 
require '../config.php';
$email = $email_err = $name = $tname = $name_err = $password = $password_err = $cpassword = $cpassword_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST")   	
{
	
	// Validate email
	if (empty(trim($_POST["email"]))) 
	{
		$email_err = "Please enter a Email.";
	} 
	else 
	{
		$temail = trim($_POST["email"]);
		if (!filter_var($temail, FILTER_VALIDATE_EMAIL)) 
		{
			$email_err = "Invalid email format.";
		}
		else
		{
			$sql = "SELECT chairman_id FROM iqac_chairman WHERE chairman_email = ?";

			if($stmt = mysqli_prepare($con, $sql))
			{
				mysqli_stmt_bind_param($stmt, "s", $param_email);
				$param_email = trim($_POST["email"]);

				if(mysqli_stmt_execute($stmt))
				{
					mysqli_stmt_store_result($stmt);

					if(mysqli_stmt_num_rows($stmt) == 1)
					{
						$email_err = "This Email ID is already taken.";
					} 
					else
					{
						$email = trim($_POST["email"]);
					}
				}
			}
		}
	}
	
	//Validate name
	if(empty(trim($_POST["name"])))
	{
		$name_err = "Please enter a Name.";
	}

	else
	{
		$tname=trim($_POST["name"]);
	} 
	if(!preg_match("/^[a-zA-Z-'. ]*$/",$tname))
	{
		$name_err = "Only letters, white space and dots are allowed.";
	} 
	
	else
	{
		$name = trim($_POST["name"]);
	}

	// Validate password
	if(empty(trim($_POST["password"])))
	{
		$password_err = "Please enter a Password.";     
	} 
	elseif(strlen(trim($_POST["password"])) < 8)
	{
		$password_err = "Password must have atleast 8 characters.";
	}
	elseif(!preg_match('@[0-9]@',trim($_POST["password"])))
	{
		$password_err = "Password must contain at least one number.";
	}
	elseif(!preg_match('@[A-Z]@',trim($_POST["password"])))
	{
		$password_err = "Password must contain at least one upper case letter.";
	}
	elseif(!preg_match('@[a-z]@',trim($_POST["password"])))
	{
		$password_err = "Password must contain at least one lower case letter.";
	} 
	elseif(!preg_match('@[^\w]@',trim($_POST["password"])))
	{
		$password_err = "Password must contain special character.";
	}  
	else
	{
		$password = trim($_POST["password"]);
		
	}

	// Validate confirm password
	if(empty(trim($_POST["cpassword"])))
	{
		$cpassword_err = "Please enter a Confirm Password.";     
	} 
	else
	{
		$cpassword = trim($_POST["cpassword"]);
		if(empty($password_err) && ($password != $cpassword))
		{
			$cpassword_err = "Password does not match.";
		}
	}

	if(empty($name_err) && empty($email_err) && empty($password_err) && empty($cpassword_err))
	{
		$hash_password = password_hash($password, PASSWORD_DEFAULT);
		$query = "insert into iqac_chairman (chairman_name, chairman_email, chairman_password) values ('$name', '$email', '$hash_password')";

		if(mysqli_query($con, $query))
        {
            echo '<script language="javascript">';
            echo'alert("IQAC Chairman Added Successfully."); location.href="add_chairman.php"';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
           	echo'alert("Failed, Please Try Again."); location.href="add_chairman.php"';
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
    <title>IQAC Chairman</title>

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
                            <li class="breadcrumb-item active" aria-current="page">IQAC Chairman</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-user-gear"></i>
                            <span>IQAC chairman</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
                        	<ul class="nav nav-tabs">
	                    		<li class="nav-item" role="presentation">
	                        		<a class="nav-link active" href="add_chairman.php" id="active">Add IQAC Chairman</a>
	                    		</li>

	                    		<li class="nav-item" role="presentation">
	                        		<a class="nav-link" href="manage_chairman.php" id="non-active">Manage IQAC Chairman</a>
	                    		</li>
	                		</ul>

	                		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off">

	                            <div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
		                            				<i class="fa-solid fa-user-plus fa-lg"></i>
		                            				<span>Add New IQAC Chairman</span>
		                        				</div>	
		                        				<div class="card-body">

		                        					<div class="mb-3">
		                                    			<label class="form-label" for = "email"> <span style="color: red">* </span>Email ID</label>

		                                				<input 
		                                					type="text" 
		                                					name="email" 
		                                					class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
		                                 					id = "email" 
		                                 					value = "<?php echo $email; ?>" placeholder = "example@gmail.com">

		                                				<div class="invalid-feedback">
		                                        			<?php echo $email_err; ?>
		                                				</div>
		                                			</div>

		                                			<div class="mb-3">
		                                    			<label class="form-label" for = "name"> <span style="color: red">* </span>Name</label>

		                                				<input 
		                                					type="text" 
		                                					name="name" 
		                                					class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
		                                 					id = "name" 
		                                 					value = "<?php echo $name; ?>">

		                                				<div class="invalid-feedback">
		                                        				<?php echo $name_err; ?>
		                                				</div>
		                                			</div>	
		                        				</div>
		                        			</div>
		                        		</div>

		                        		<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
		                            				<i class="fa-solid fa-user-plus fa-lg"></i>
		                            				<span>Add New IQAC Chairman</span>
		                        				</div>	
		                        				<div class="card-body">

		                        					<div class="mb-3">
		                                    			<label class="form-label" for = "password"> <span style="color: red">* </span>Password</label>

		                                				<input 
		                                					type="password" 
		                                					name="password" 
		                                					class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
		                                 					id = "password" 
		                                 					value = "<?php echo $password; ?>">

		                                				<div class="invalid-feedback">
		                                        			<?php echo $password_err; ?>
		                                				</div>
		                                				</div>

		                                				<div class="mb-3">
		                                    			<label class="form-label" for = "cpassword"> <span style="color: red">* </span>Confirm Password</label>

		                                				<input 
		                                					type="password" 
		                                					name="cpassword" 
		                                					class="form-control <?php echo (!empty($cpassword_err)) ? 'is-invalid' : ''; ?>"
		                                 					id = "cpassword" 
		                                					value = "<?php echo $cpassword; ?>">

		                                				<div class="invalid-feedback">
		                                        				<?php echo $cpassword_err; ?>
		                                				</div>
		                                			</div>

		                                			<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

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