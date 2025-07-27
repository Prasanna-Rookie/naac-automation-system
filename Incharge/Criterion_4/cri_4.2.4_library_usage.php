<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $method = $method_err = $e_access = $e_access_err = $teacher = $teacher_err = $student = $student_err = "";
$upload_by_name = $_SESSION['name'];
$upload_by_id = $_SESSION['inc_id'];
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Academic Year Validation

	if(empty(trim($_POST["academic_year"])))
	{
		$academic_year_err = "Please Select Academic Year.";
	}
	else
	{
		$academic_year_t = $_POST["academic_year"];
       	$query = "SELECT * FROM cri_4_2_4_library_usage WHERE academic_year = '$academic_year_t'";
       	$result = mysqli_query($con, $query);

       	$count = mysqli_num_rows($result);
       	if($count == 1)
       	{
       		$academic_year_err = "Record Already Exists.";
       	}
       	else
       	{
       		$academic_year = trim($_POST["academic_year"]);
       	}
	}
	// Method

	if(empty(trim($_POST["method"])))
	{
		$method_err = "Please Enter Method of Computing the per day usage of library.";
	}
	else
	{
		$method = trim($_POST["method"]);
	}
	// E - Access

	if(empty(trim($_POST["e_access"])))
	{
		$e_access_err = "Please Enter Number of users using the library through E-access.";
	}
	else
	{
		$e_access = trim($_POST["e_access"]);
	}

	// Teacher

	if(empty(trim($_POST["teacher"])))
	{
		$teacher_err = "Please Enter Number of teachers accessing the library.";
	}
	else
	{
		$teacher = trim($_POST["teacher"]);
	}

	// Student

	if(empty(trim($_POST["student"])))
	{
		$student_err = "Please Enter Number of students accessing the library.";
	}
	else
	{
		$student = trim($_POST["student"]);
	}
	if(empty($academic_year_err) && empty($method_err) && empty($e_access_err) && empty($teacher_err) && empty($student_err))
	{
		$query = "INSERT INTO cri_4_2_4_library_usage (academic_year, upload_by_id, upload_by_name, method, e_access, teacher, student) VALUES (?, ?, ?, ?, ?, ?, ?)";
		    
		    // Prepare the statement
		    $stmt = mysqli_prepare($con, $query);
		    
		    // Bind parameters
		    mysqli_stmt_bind_param($stmt, "sissiii", $academic_year, $upload_by_id, $upload_by_name, $method, $e_access, $teacher, $student);
		    
		    // Execute the statement
		    if(mysqli_stmt_execute($stmt)) 
		    {
		        echo '<script language="javascript">';
		        echo 'alert("Update Successfully."); location.href="cri_4.2.4_library_usage.php"';
		        echo '</script>';
		    } 
		    else 
		    {
		        echo '<script language="javascript">';
		        echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.2.4_library_usage.php"';
		        echo '</script>'; 
		    }

		    // Close statement
		    mysqli_stmt_close($stmt);
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$academic_year = $method = $e_access = $teacher = $student = "";

	if(empty(trim($_POST["method"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Method of Computing the per day usage of library."); location.href="cri_4.2.4_library_usage.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["e_access"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Number of users using the library through E-access per day."); location.href="cri_4.2.4_library_usage.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["teacher"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Number of teachers accessing the library per day."); location.href="cri_4.2.4_library_usage.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["student"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Number of students accessing the library per day."); location.href="cri_4.2.4_library_usage.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$e_access = $_POST['e_access'];
			$method = $_POST['method'];
			$teacher = $_POST['teacher'];
			$student = $_POST['student'];

			// Prepare the SQL statement
			$query = "UPDATE cri_4_2_4_library_usage SET method = ?, e_access = ?, teacher = ?, student = ? WHERE user_id = ?";
			    
			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "siiii", $method, $e_access, $teacher, $student, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_4.2.4_library_usage.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.2.4_library_usage.php"';
			    echo '</script>'; 
			}

			// Close statement
			mysqli_stmt_close($stmt);
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 4</title>
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

	<!-- Model -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
        <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Usage of library by teachers and students.</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "method"> <span style="color: red">* </span>Method of Computing the per day usage of library</label>

	                        <input type="text" name="method" class="form-control" id = "method">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "e_access"> <span style="color: red">* </span>Number of users using the library through E-access per day</label>

	                        <input type="number" name="e_access" class="form-control" id = "e_access">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "teacher"> <span style="color: red">* </span>Number of teachers accessing the library per day</label>

	                        <input type="number" name="teacher" class="form-control" id = "teacher">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "student"> <span style="color: red">* </span>Number of students accessing the library per day</label>

	                        <input type="number" name="student" class="form-control" id = "student">

	                    </div>

                        <input type="hidden" name="id" id="id" value="0">
                        <!-- Academic Year Hidden Input Field -->
						<input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>">

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="update"><i class = 'fa fa-edit'></i>&nbsp; Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Model End -->

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
							<li class="breadcrumb-item active" aria-current="page">Criteria 4.2</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-book-bookmark fa-lg"></i>
							<span>Criteria 4.2.4 - Usage of library by teachers and students (footfalls and login data for online access).</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_4.2.4_library_usage.php" id="active">Library Usage</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.2.4_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.2.4_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-book-bookmark fa-lg"></i>
														<span>Criteria 4.2.4 - Usage of library by teachers and students</span>
													</div>
													<div class="card-body">
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
															<label class="form-label" for = "method"> <span style="color: red">* </span>Method of Computing the per day usage of library</label>
															<input 
															type="text" 
															name="method" 
															class="form-control <?php echo (!empty($method_err)) ? 'is-invalid' : ''; ?>"
															id = "method" 
															value = "<?php echo $method; ?>">

															<div class="invalid-feedback">
																<?php echo $method_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "e_access"> <span style="color: red">* </span>Number of users using the library through E-access per day</label>
															<input 
															type="number" 
															name="e_access" 
															class="form-control <?php echo (!empty($e_access_err)) ? 'is-invalid' : ''; ?>"
															id = "e_access" 
															value = "<?php echo $e_access; ?>">

															<div class="invalid-feedback">
																<?php echo $e_access_err; ?>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-book-bookmark fa-lg"></i>
														<span>Criteria 4.2.4 - Usage of library by teachers and students</span>
													</div>
													<div class="card-body">
														
														<div class="mb-3">
															<label class="form-label" for = "teacher"> <span style="color: red">* </span>Number of teachers accessing the library per day</label>

															<input 
															type="number" 
															name="teacher" 
															class="form-control <?php echo (!empty($teacher_err)) ? 'is-invalid' : ''; ?>"
															id = "teacher" 
															value = "<?php echo $teacher; ?>">

															<div class="invalid-feedback">
																<?php echo $teacher_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "student"> <span style="color: red">* </span>Number of students accessing the library per day</label>

															<input 
															type="number" 
															name="student" 
															class="form-control <?php echo (!empty($student_err)) ? 'is-invalid' : ''; ?>"
															id = "student" 
															value = "<?php echo $student; ?>">

															<div class="invalid-feedback">
																<?php echo $student_err; ?>
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

							<?php
							$sql = "SELECT * FROM cri_4_2_4_library_usage WHERE upload_by_id = '$upload_by_id'";
							$datas = $con->query($sql);
							if($datas->num_rows>0)
				            {
				            	?>
				            		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
				            		<div class="table-responsive">
				            			<table class="table table-bordered" id="table">
		                        			<thead style="background-color:#057EC5; color:#FFF;">
		                        				<tr align="center">
					                                <th>Academic Year</th>
					                                <th>Method of Computing the per day usage of library</th>
					                                <th>Number of users using the library through E-access per day</th>
					                                <th>Number of teachers accessing the library per day</th>
					                                <th>Number of students accessing the library per day</th>
					                                <th>Update</th>
					                            </tr>
		                        			</thead>
		                        			<tbody class="row_position">
		                        				<?php
						                            while ($data = $datas->fetch_assoc()) 
						                            {
						                            	?>
						                            	<tr style="text-align:center;">
						                                    <td><?php echo $data['academic_year']; ?></td>
						                                    <td><?php echo $data['method']; ?></td>
						                                    <td><?php echo $data['e_access']; ?></td>
						                                    <td><?php echo $data['teacher']; ?></td>
						                                    <td><?php echo $data['student']; ?></td>
						                                    <?php
						                                    echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["user_id"]}><i class = 'fa fa-edit'></i></button></td>";
						                                    ?>
						                                </tr>
						                            	<?php 
						                            }
						                        ?>
		                        			</tbody>
		                        		</table>
				            		</div>
				            	<?php
				            }
				            ?>
							
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

<script type="text/javascript">

    $(document).ready(function(){
        $('.edit').on('click',function(){
            $('#editpopup').modal('show');
            var row=$(this);
            var id=$(this).attr("data-id");
            $("#id").val(id);
            var name=row.closest('tr');
            var data = name.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#academic_year').val(data[0]);
            $('#method').val(data[1]);
            $('#e_access').val(data[2]);
            $('#teacher').val(data[3]);
            $('#student').val(data[4]);
        });
    });

</script>

</body>

</html>
