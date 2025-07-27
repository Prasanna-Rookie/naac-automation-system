<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $activity = $activity_err = $collaborating_agency = $collaborating_agency_err = $participant = $participant_err = $duration = $duration_err = $activity_nature = $activity_nature_err = "";

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

	if(empty(trim($_POST["activity"])))
	{
		$activity_err = "Please Enter Title of the collaborative activity.";
	}
	else
	{
		$activity = trim($_POST["activity"]);
	}

	if(empty(trim($_POST["collaborating_agency"])))
	{
		$collaborating_agency_err = "Please Select Name of the collaborating agency with contact details.";
	}
	else
	{
		$collaborating_agency = trim($_POST["collaborating_agency"]);
	}

	if(empty(trim($_POST["participant"])))
	{
		$participant_err = "Please Enter Name of the participant.";
	}
	else
	{
		$participant = trim($_POST["participant"]);
	}

	if(empty(trim($_POST["duration"])))
	{
		$duration_err = "Please Enter Duration.";
	}
	else
	{
		$duration = trim($_POST["duration"]);
	}

	if(empty(trim($_POST["activity_nature"])))
	{
		$activity_nature_err = "Please Enter Nature of the activity.";
	}
	else
	{
		$activity_nature = trim($_POST["activity_nature"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($activity_err) && empty($collaborating_agency_err) && empty($participant_err) && empty($duration_err) && empty($activity_nature_err))
	{
		$query = "INSERT INTO cri_3_7_1_collaborating_agency_student (academic_year, upload_by_id, upload_by_name, activity, collaborating_agency, participant, duration, activity_nature) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name', '$activity', '$collaborating_agency', '$participant', '$duration', '$activity_nature')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.7.1_stdents.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.7.1_stdents.php"';
			echo '</script>';
		}
		
	}
}

if(isset($_POST['update']))
{
	$err = 0;
	$activity = $collaborating_agency = $participant = $duration = $activity_nature = "";
	if(empty(trim($_POST["activity"])) || empty(trim($_POST["collaborating_agency"])) || empty(trim($_POST["participant"])) || empty(trim($_POST["duration"])) || empty(trim($_POST["activity_nature"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.7.1_stdents.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$activity = $_POST['activity'];
			$collaborating_agency = $_POST['collaborating_agency'];
			$participant = $_POST['participant'];
			$duration = $_POST['duration'];
			$activity_nature = $_POST['activity_nature'];

			$query = "UPDATE cri_3_7_1_collaborating_agency_student SET activity = ?, collaborating_agency = ?, participant = ?, duration = ?, activity_nature = ?  WHERE cas_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "sssssi", $activity, $collaborating_agency, $participant, $duration, $activity_nature, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.7.1_stdents.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.7.1_stdents.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Collaborating Agency</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "activity"> <span style="color: red">* </span>Title of the collaborative activity</label>

                            <input type="text" name="activity" class="form-control " id="activity">
                        </div>

                        <div class="mb-3">
							<label class="form-label" for = "collaborating_agency"> <span style="color: red">* </span>Name of the collaborating agency with contact details</label>

							<select name="collaborating_agency" class="form-select <?php echo (!empty($collaborating_agency_err)) ? 'is-invalid' : ''; ?>" id="collaborating_agency">

							<?php 
								$sql = "SELECT * FROM cri_3_7_1_collaborating_agency ORDER BY ca_id";
            					$result = mysqli_query($con,$sql);
            					while($row = mysqli_fetch_assoc($result)) {?>
            					<option value="<?php echo $row['collaborating_agency'] ?>"><?php echo $row['collaborating_agency'] ?></option>
            				<?php }?>

							</select>
															
						</div>

						<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "participant"> <span style="color: red">* </span>Name of the participant</label>

                            <input type="text" name="participant" class="form-control " id="participant">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "duration"> <span style="color: red">* </span>Duration</label>

                            <input type="text" name="duration" class="form-control " id="duration">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "activity_nature"> <span style="color: red">* </span>Nature of the activity</label>

                            <input type="text" name="activity_nature" class="form-control " id="activity_nature">
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
							<span>Criteria 3.7.1 - Number of collaborative activities during the year for research/ faculty exchange/ student exchange/ internship/ on-the-job training/ project work.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.1_collaborating_agency.php" id="non-active">Collaborating Agency</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.7.1_stdents.php" id="active">Students</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.1_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.1_doc_view.php" id="non-active">View Document</a>
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
														<span>Criteria 3.7.1 - Collaborating Agency</span>
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
															<label class="form-label" for = "activity"> <span style="color: red">* </span>Title of the collaborative activity</label>

															<input 
															type="text" 
															name="activity" 
															class="form-control <?php echo (!empty($activity_err)) ? 'is-invalid' : ''; ?>"
															id = "activity" 
															value = "<?php echo $activity; ?>">

															<div class="invalid-feedback">
																<?php echo $activity_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "collaborating_agency"> <span style="color: red">* </span>Name of the collaborating agency with contact details</label>

															<select name="collaborating_agency" class="form-select <?php echo (!empty($collaborating_agency_err)) ? 'is-invalid' : ''; ?>" id="collaborating_agency">

																<option value="">---Select Collaborating Agency---</option>

																<?php
																$sql = "SELECT * FROM cri_3_7_1_collaborating_agency ORDER BY ca_id";
																$result = $con -> query($sql);

																while($row = $result -> fetch_assoc())
																{
																	?>
																	<option value="<?php echo $row['collaborating_agency']; ?>"

																		<?php
																		if($collaborating_agency == $row['collaborating_agency'])
																		{
																			echo "selected";
																		} 
																		?>
																		>
																		<?php
																		echo $row['collaborating_agency'];
																		?>
																	</option>
																	<?php
																}

																?>

															</select>
															<span class="invalid-feedback">
																<?php echo $collaborating_agency_err; ?>
															</span>
														</div>
													</div>
												</div>
											</div>

											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-handshake fa-lg"></i>
														<span>Criteria 3.7.1 - Collaborating Agency</span>
													</div>
													<div class="card-body">

														<div class="mb-3">
															<label class="form-label" for = "participant"> <span style="color: red">* </span>Name of the participant </label>

															<input 
															type="text" 
															name="participant" 
															class="form-control <?php echo (!empty($participant_err)) ? 'is-invalid' : ''; ?>"
															id = "participant" 
															value = "<?php echo $participant; ?>">

															<div class="invalid-feedback">
																<?php echo $participant_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "duration"> <span style="color: red">* </span>Duration</label>

															<input 
															type="text" 
															name="duration" 
															class="form-control <?php echo (!empty($duration_err)) ? 'is-invalid' : ''; ?>"
															id = "duration" 
															value = "<?php echo $duration; ?>">

															<div class="invalid-feedback">
																<?php echo $duration_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "activity_nature"> <span style="color: red">* </span>Nature of the activity</label>

															<input 
															type="text" 
															name="activity_nature" 
															class="form-control <?php echo (!empty($activity_nature_err)) ? 'is-invalid' : ''; ?>"
															id = "activity_nature" 
															value = "<?php echo $activity_nature; ?>">

															<div class="invalid-feedback">
																<?php echo $activity_nature_err; ?>
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
							$sql = "SELECT * FROM cri_3_7_1_collaborating_agency_student WHERE upload_by_id = '$upload_by_id'";
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
												<th>Title of the collaborative activity</th>
												<th>Name of the collaborating agency with contact details</th>
												<th>Name of the participant</th>
												<th>Duration</th>
												<th>Nature of the activity</th>
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
													<td><?php echo $data['activity']; ?></td>
													<td><?php echo $data['collaborating_agency']; ?></td>
													<td><?php echo $data['participant']; ?></td>
													<td><?php echo $data['duration']; ?></td>
													<td><?php echo $data['activity_nature']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["cas_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#activity').val(data[1]);
			$('#collaborating_agency').val(data[2]);
			$('#participant').val(data[3]);
			$('#duration').val(data[4]);
			$('#activity_nature').val(data[5]);
		});
	});
</script>

</body>

</html>
