<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $student_name = $student_name_err = $programme = $programme_err = $institution_joined = $institution_joined_err = $programme_admitted = $programme_admitted_err = "";
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
		$academic_year = trim($_POST["academic_year"]);
	}

	if(empty(trim($_POST["student_name"])))
	{
		$student_name_err = "Please Enter Name of student enrolled for higher education.";
	}
	else
	{
		$student_name = trim($_POST["student_name"]);
	}

	if(empty(trim($_POST["programme"])))
	{
		$programme_err = "Please Enter Programme completed.";
	}
	else
	{
		$programme = trim($_POST["programme"]);
	}

	if(empty(trim($_POST["institution_joined"])))
	{
		$institution_joined_err = "Please Enter Name of institution joined.";
	}
	else
	{
		$institution_joined = trim($_POST["institution_joined"]);
	}

	if(empty(trim($_POST["programme_admitted"])))
	{
		$programme_admitted_err = "Please Enter Name of programme admitted to.";
	}
	else
	{
		$programme_admitted = trim($_POST["programme_admitted"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($student_name_err) && empty($programme_err) && empty($institution_joined_err) && empty($programme_admitted_err))
	{
		$query = "INSERT INTO cri_5_2_2_higher_education (academic_year, upload_by_id, upload_by_name, student_name, programme, institution_joined, programme_admitted) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name', '$student_name', '$programme', '$institution_joined', '$programme_admitted')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_5.2.2_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_5.2.2_data_entry.php"';
			echo '</script>';
		}

		$error_message = mysqli_error($query);
		echo($error_message);
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$student_name = $programme = $institution_joined = $programme_admitted = "";
	if(empty(trim($_POST["student_name"])) || empty(trim($_POST["programme"])) || empty(trim($_POST["institution_joined"])) || empty(trim($_POST["programme_admitted"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_5.2.2_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$student_name = $_POST['student_name'];
			$programme = $_POST['programme'];
			$institution_joined = $_POST['institution_joined'];
			$programme_admitted = $_POST['programme_admitted'];

			$query = "UPDATE cri_5_2_2_higher_education SET student_name = ?, programme = ?, institution_joined = ?, programme_admitted = ? WHERE he_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "ssssi", $student_name, $programme, $institution_joined, $programme_admitted, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_5.2.2_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_5.2.2_data_entry.php"';
			    echo '</script>'; 
			}
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

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 5</title>
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Higher Education</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "student_name"> <span style="color: red">* </span>Name of student enrolled for higher education</label>

                            <input type="text" name="student_name" class="form-control " id="student_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "programme"> <span style="color: red">* </span>Programme completed</label>

                            <input type="text" name="programme" class="form-control " id="programme">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "institution_joined"> <span style="color: red">* </span>Name of institution joined</label>

                            <input type="text" name="institution_joined" class="form-control " id="institution_joined">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "programme_admitted"> <span style="color: red">* </span>Name of programme admitted to</label>

                            <input type="text" name="programme_admitted" class="form-control " id="programme_admitted">
                        </div>

                        <input type="hidden" name="id" id="id" value="0">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 5.2</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-graduation-cap fa-lg"></i>
							<span>Criteria 5.2.2 - Number of outgoing students progressing to higher education during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_5.2.2_data_entry.php" id="active">Higher Education</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.2.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.2.2_doc_view.php" id="non-active">View Document</a>
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
														<span>Criteria 5.2.2 - Higher Education</span>
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
															<label class="form-label" for = "student_name"> <span style="color: red">* </span>Name of student enrolled for higher education</label>

															<input 
															type="text" 
															name="student_name" 
															class="form-control <?php echo (!empty($student_name_err)) ? 'is-invalid' : ''; ?>"
															id = "student_name" 
															value = "<?php echo $student_name; ?>">

															<div class="invalid-feedback">
																<?php echo $student_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "programme"> <span style="color: red">* </span>Programme completed  </label>

															<input 
															type="text" 
															name="programme" 
															class="form-control <?php echo (!empty($programme_err)) ? 'is-invalid' : ''; ?>"
															id = "programme" 
															value = "<?php echo $programme; ?>">

															<div class="invalid-feedback">
																<?php echo $programme_err; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-graduation-cap fa-lg"></i>
														<span>Criteria 5.2.2 - Higher Education</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "institution_joined"> <span style="color: red">* </span>Name of institution joined</label>

															<input 
															type="text" 
															name="institution_joined" 
															class="form-control <?php echo (!empty($institution_joined_err)) ? 'is-invalid' : ''; ?>"
															id = "institution_joined" 
															value = "<?php echo $institution_joined; ?>">

															<div class="invalid-feedback">
																<?php echo $institution_joined_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "programme_admitted"> <span style="color: red">* </span>Name of programme admitted to</label>

															<input 
															type="text" 
															name="programme_admitted" 
															class="form-control <?php echo (!empty($programme_admitted_err)) ? 'is-invalid' : ''; ?>"
															id = "programme_admitted" 
															value = "<?php echo $programme_admitted; ?>">

															<div class="invalid-feedback">
																<?php echo $programme_admitted_err; ?>
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
							$sql = "SELECT * FROM cri_5_2_2_higher_education WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of student enrolled for higher education</th>
												<th>Programme completed</th>
												<th>Name of institution joined</th>
												<th>Name of programme admitted to</th>
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
													<td><?php echo $data['student_name']; ?></td>
													<td><?php echo $data['programme']; ?></td>
													<td><?php echo $data['institution_joined']; ?></td>
													<td><?php echo $data['programme_admitted']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["he_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#student_name').val(data[1]);
			$('#programme').val(data[2]);
			$('#institution_joined').val(data[3]);
			$('#programme_admitted').val(data[4]);
		});
	});
</script>

</body>

</html>
