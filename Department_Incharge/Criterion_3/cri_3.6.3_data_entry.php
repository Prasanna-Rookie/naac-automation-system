<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $activity_name = $activity_name_err = $organising_unit = $organising_unit_err = $scheme_name = $scheme_name_err = $month_year = $month_year_err = $no_of_students = $no_of_students_err = "";
$upload_by_name = $_SESSION['name'];
$upload_by_id = $_SESSION['dci_id'];

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

	if(empty(trim($_POST["activity_name"])))
	{
		$activity_name_err = "Please Enter Name of the Activity.";
	}
	else
	{
		$activity_name = trim($_POST["activity_name"]);
	}

	if(empty(trim($_POST["organising_unit"])))
	{
		$organising_unit_err = "Please Enter Organising Unit/ Agency/ Collaborating Agency.";
	}
	else
	{
		$organising_unit = trim($_POST["organising_unit"]);
	}

	if(empty(trim($_POST["scheme_name"])))
	{
		$scheme_name_err = "Please Enter Name of the Scheme.";
	}
	else
	{
		$scheme_name = trim($_POST["scheme_name"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Month and Year of the activity.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	if(empty(trim($_POST["no_of_students"])))
	{
		$no_of_students_err = "Please Enter Number of students who participated in such activities.";
	}
	else
	{
		$no_of_students = trim($_POST["no_of_students"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($activity_name_err) && empty($organising_unit_err) && empty($scheme_name_err) && empty($month_year_err) && empty($no_of_students_err))
	{
		$query = "INSERT INTO cri_3_6_3_extension_activities (academic_year, upload_by_id, upload_by_name, activity_name, organising_unit, scheme_name, month_year, no_of_students) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$activity_name', '$organising_unit', '$scheme_name','$month_year', '$no_of_students')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.6.3_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.6.3_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$activity_name = $organising_unit = $scheme_name = $month_year = $no_of_students = "";
	if(empty(trim($_POST["activity_name"])) || empty(trim($_POST["organising_unit"])) || empty(trim($_POST["scheme_name"])) || empty(trim($_POST["month_year"])) || empty(trim($_POST["no_of_students"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.6.3_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$activity_name = $_POST['activity_name'];
			$organising_unit = $_POST['organising_unit'];
			$scheme_name = $_POST['scheme_name'];
			$month_year = $_POST['month_year'];
			$no_of_students = $_POST['no_of_students'];

			$query = "UPDATE cri_3_6_3_extension_activities SET activity_name = ?, organising_unit = ?, scheme_name = ?, month_year = ?, no_of_students = ? WHERE ea_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "sssssi", $activity_name, $organising_unit, $scheme_name, $month_year, $no_of_students, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.6.3_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.6.3_data_entry.php"';
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

<!-- Model -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
        <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Extension Activity</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "activity_name"> <span style="color: red">* </span>Name of the Activity</label>

                            <input type="text" name="activity_name" class="form-control " id="activity_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "organising_unit"> <span style="color: red">* </span>Organising Unit/ Agency/ Collaborating Agency</label>

                            <input type="text" name="organising_unit" class="form-control " id="organising_unit">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "scheme_name"> <span style="color: red">* </span>Name of the Scheme</label>

                            <input type="text" name="scheme_name" class="form-control " id="scheme_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month_year"> <span style="color: red">* </span>Month and Year of the activity</label>

                            <input type="text" name="month_year" class="form-control " id="month_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "no_of_students"> <span style="color: red">* </span>Number of students who participated in such activities</label>

                            <input type="text" name="no_of_students" class="form-control " id="no_of_students">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.6</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-award fa-lg"></i>
							<span>Criteria 3.6.3 - Number of extension and outreach programmes conducted by the institution through NSS/NCC during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.6.3_data_entry.php" id="active">Extension Activity</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.6.3_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.6.3_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-award fa-lg"></i>
														<span>Criteria 3.6.3 - Extension Activity</span>
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
															<label class="form-label" for = "activity_name"> <span style="color: red">* </span>Name of the Activity</label>

															<input 
															type="text" 
															name="activity_name" 
															class="form-control <?php echo (!empty($activity_name_err)) ? 'is-invalid' : ''; ?>"
															id = "activity_name" 
															value = "<?php echo $activity_name; ?>">

															<div class="invalid-feedback">
																<?php echo $activity_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "organising_unit"> <span style="color: red">* </span>Organising Unit/ Agency/ Collaborating Agency</label>

															<input 
															type="text" 
															name="organising_unit" 
															class="form-control <?php echo (!empty($organising_unit_err)) ? 'is-invalid' : ''; ?>"
															id = "organising_unit" 
															value = "<?php echo $organising_unit; ?>">

															<div class="invalid-feedback">
																<?php echo $organising_unit_err; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-award fa-lg"></i>
														<span>Criteria 3.6.3 - Extension Activity</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "scheme_name"> <span style="color: red">* </span>Name of the Scheme</label>

															<input 
															type="text" 
															name="scheme_name" 
															class="form-control <?php echo (!empty($scheme_name_err)) ? 'is-invalid' : ''; ?>"
															id = "scheme_name" 
															value = "<?php echo $scheme_name; ?>">

															<div class="invalid-feedback">
																<?php echo $scheme_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "month_year"> <span style="color: red">* </span>Month and Year of the activity</label>

															<input 
															type="text" 
															name="month_year" 
															class="form-control <?php echo (!empty($month_year_err)) ? 'is-invalid' : ''; ?>"
															id = "month_year" 
															value = "<?php echo $month_year; ?>">

															<div class="invalid-feedback">
																<?php echo $month_year_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "no_of_students"> <span style="color: red">* </span>Number of students who participated in such activities</label>

															<input 
															type="text" 
															name="no_of_students" 
															class="form-control <?php echo (!empty($no_of_students_err)) ? 'is-invalid' : ''; ?>"
															id = "no_of_students" 
															value = "<?php echo $no_of_students; ?>">

															<div class="invalid-feedback">
																<?php echo $no_of_students_err; ?>
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
							$sql = "SELECT * FROM cri_3_6_3_extension_activities WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the Activity</th>
												<th>Organising Unit/ Agency/ Collaborating Agency</th>
												<th>Name of the Scheme</th>
												<th>Month and Year of the activity</th>
												<th>Number of students who participated in such activities</th>
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
													<td><?php echo $data['activity_name']; ?></td>
													<td><?php echo $data['organising_unit']; ?></td>
													<td><?php echo $data['scheme_name']; ?></td>
													<td><?php echo $data['month_year']; ?></td>
													<td><?php echo $data['no_of_students']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["ea_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#activity_name').val(data[1]);
			$('#organising_unit').val(data[2]);
			$('#scheme_name').val(data[3]);
			$('#month_year').val(data[4]);
			$('#no_of_students').val(data[5]);
		});
	});
</script>

</body>
</html>
