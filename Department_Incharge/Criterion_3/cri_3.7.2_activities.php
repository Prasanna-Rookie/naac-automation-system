<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $name = $name_err = $activities = $activities_err = $no_of_students = $no_of_students_err = "";
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

	if(empty(trim($_POST["name"])))
	{
		$name_err = "Please Select Name of the institution/ industry/ corporate house.";
	}
	else
	{
		$name = trim($_POST["name"]);
	}

	if(empty(trim($_POST["activities"])))
	{
		$activities_err = "Please Enter List of activities under each MOU.";
	}
	else
	{
		$activities = trim($_POST["activities"]);
	}

	if(empty(trim($_POST["no_of_students"])))
	{
		$no_of_students_err = "Please Enter Number of students/teachers who benefitted from MoUs.";
	}
	else
	{
		$no_of_students = trim($_POST["no_of_students"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($name_err) && empty($activities_err) && empty($no_of_students_err))
	{
		$query = "INSERT INTO cri_3_7_2_mou_activities (academic_year, upload_by_id, upload_by_name, name, activities, no_of_students) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$name', '$activities', '$no_of_students')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.7.2_activities.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.7.2_activities.php"';
			echo '</script>';
		}
		
	}
}

if(isset($_POST['update']))
{
	$err = 0;
	$name = $activities = $no_of_students = "";
	if(empty(trim($_POST["activities"])) || empty(trim($_POST["no_of_students"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.7.2_activities.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$activities = $_POST['activities'];
			$no_of_students = $_POST['no_of_students'];

			$query = "UPDATE cri_3_7_2_mou_activities SET activities = ?, no_of_students = ? WHERE md_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "ssi", $activities, $no_of_students, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.7.2_activities.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.7.2_activities.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Activities</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "activities"> <span style="color: red">* </span>List of activities under each MOU</label>

                            <input type="text" name="activities" class="form-control " id="activities">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "no_of_students"> <span style="color: red">* </span>Number of students/teachers who benefitted from MoUs</label>

                            <input type="text" name="no_of_students" class="form-control " id="no_of_students">
                        </div>

                        <input type="hidden" name="id" id="id" value="0">
                        <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">

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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.7</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-handshake fa-lg"></i>
							<span>Criteria 3.7.2 - Number of functional MoUs with institutions of national and/or international importance, other universities, industries, corporate houses, etc. during the year (only functional MoUs with ongoing activities to be considered).</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.2_mou_details.php" id="non-active">MoUs</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.7.2_activities.php" id="active">Activities </a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-handshake fa-lg"></i>
														<span>Criteria 3.7.2 - Activities</span>
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
															<label class="form-label" for = "name"> <span style="color: red">* </span>Name of the institution/ industry/ corporate house</label>

															<select name="name" class="form-select <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" id="name">

																<option value="">---Select---</option>

																<?php
																$sql = "SELECT * FROM cri_3_7_2_mou_details";
																$result = $con -> query($sql);

																while($row = $result -> fetch_assoc())
																{
																	?>
																	<option value="<?php echo $row['name']; ?>"

																		<?php
																		if($name == $row['name'])
																		{
																			echo "selected";
																		} 
																		?>
																		>
																		<?php
																		echo $row['name'];
																		?>
																	</option>
																	<?php
																}

																?>

															</select>
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
														<i class="fa-solid fa-handshake fa-lg"></i>
														<span>Criteria 3.7.2 - Activities</span>
													</div>
													<div class="card-body">
														
														<div class="mb-3">
															<label class="form-label" for = "activities"> <span style="color: red">* </span>List of activities under each MOU</label>

															<input 
															type="text" 
															name="activities" 
															class="form-control <?php echo (!empty($activities_err)) ? 'is-invalid' : ''; ?>"
															id = "activities" 
															value = "<?php echo $activities; ?>">

															<div class="invalid-feedback">
																<?php echo $activities_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "no_of_students"> <span style="color: red">* </span>Number of students/teachers who benefitted from MoUs</label>

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
							$sql = "SELECT * FROM cri_3_7_2_mou_activities WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the institution/ industry/ corporate house</th>
												<th>List of activities under each MOU</th>
												<th>Number of students/teachers who benefitted from MoUs</th>
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
													<td><?php echo $data['name']; ?></td>
													<td><?php echo $data['activities']; ?></td>
													<td><?php echo $data['no_of_students']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["md_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#name').val(data[1]);
			$('#activities').val(data[2]);
			$('#no_of_students').val(data[3]);
		});
	});
</script>

</body>

</html>