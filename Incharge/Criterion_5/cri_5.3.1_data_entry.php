<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $awards_name = $awards_name_err = $team_individual = $team_individual_err = $student_name = $student_name_err = $level = $level_err = $event_name = $event_name_err = $month_year = $month_year_err = "";
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

	if(empty(trim($_POST["awards_name"])))
	{
		$awards_name_err = "Please Enter Name of the award/ medal.";
	}
	else
	{
		$awards_name = trim($_POST["awards_name"]);
	}

	if(empty(trim($_POST["team_individual"])))
	{
		$team_individual_err = "Please Select Team / Individual.";
	}
	else
	{
		$team_individual = trim($_POST["team_individual"]);
	}

	if(empty(trim($_POST["student_name"])))
	{
		$student_name_err = "Please Enter Name of the student.";
	}
	else
	{
		$student_name = trim($_POST["student_name"]);
	}

	if(empty(trim($_POST["level"])))
	{
		$level_err = "Please Select Event.";
	}
	else
	{
		$level = trim($_POST["level"]);
	}

	if(empty(trim($_POST["event_name"])))
	{
		$event_name_err = "Please Name of the event.";
	}
	else
	{
		$event_name = trim($_POST["event_name"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Month Year.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($awards_name_err) && empty($team_individual_err) && empty($student_name_err) && empty($level_err) && empty($event_name_err) && empty($month_year_err))
	{
		$query = "INSERT INTO cri_5_3_1_awards_medals (academic_year, upload_by_id, upload_by_name, awards_name, team_individual, student_name, level, event_name, month_year) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name', '$awards_name', '$team_individual', '$student_name', '$level', '$event_name', '$month_year')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_5.3.1_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_5.3.1_data_entry.php"';
			echo '</script>';
		}
	}
}
if(isset($_POST['update']))
{
	$err = 0;

	$awards_name = $team_individual = $student_name = $level = $event_name = "";
	if(empty(trim($_POST["awards_name"])) || empty(trim($_POST["team_individual"])) || empty(trim($_POST["student_name"])) || empty(trim($_POST["level"])) || empty(trim($_POST["event_name"])) || empty(trim($_POST["month_year"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_5.3.1_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$awards_name = $_POST['awards_name'];
			$team_individual = $_POST['team_individual'];
			$student_name = $_POST['student_name'];
			$level = $_POST['level'];
			$event_name = $_POST['event_name'];
			$month_year = $_POST['month_year'];

			$query = "UPDATE cri_5_3_1_awards_medals SET awards_name = ?, team_individual = ?, student_name = ?, level = ?, event_name = ?, month_year = ? WHERE am_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "ssssssi", $awards_name, $team_individual, $student_name, $level, $event_name, $month_year, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_5.3.1_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_5.3.1_data_entry.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Awards and Medals</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "awards_name"> <span style="color: red">* </span>Name of the award/ medal</label>

                            <input type="text" name="awards_name" class="form-control " id="awards_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="team_individual"><span style="color: red">* </span>Team / Individual</label>

	                        <select name="team_individual" class="form-select" id="team_individual">

	                            <option value="">---Select Option---</option>
	                            <option value="Team">Team</option>
	                            <option value="Individual">Individual</option>
	                                                                
	                        </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "student_name"> <span style="color: red">* </span>Name of the student</label>

                            <input type="text" name="student_name" class="form-control " id="student_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="level"><span style="color: red">* </span>Event</label>

	                        <select name="level" class="form-select" id="level">

	                            <option value="">---Select Option---</option>
	                            <option value="Inter-university">Inter-university</option>
	                            <option value="State">State</option>
	                            <option value="National">National</option>
	                            <option value="International">International</option>
	                        </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "event_name"> <span style="color: red">* </span>Name of the event</label>

                            <input type="text" name="event_name" class="form-control " id="event_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month_year"> <span style="color: red">* </span>Month and Year</label>

                            <input type="text" name="month_year" class="form-control " id="month_year">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 5.3</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-medal fa-lg"></i>
							<span>Criteria 5.3.1 - Number of awards/medals for outstanding performance in sports and/or cultural activities at inter-university / state /national / international events (award for a team event should be counted as one) during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_5.3.1_data_entry.php" id="active">Awards and Medals</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.3.1_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.3.1_doc_view.php" id="non-active">View Document</a>
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
														<span>Criteria 5.3.1 - Awards and Medals</span>
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
															<label class="form-label" for = "awards_name"> <span style="color: red">* </span>Name of the award/ medal</label>

															<input 
															type="text" 
															name="awards_name" 
															class="form-control <?php echo (!empty($awards_name_err)) ? 'is-invalid' : ''; ?>"
															id = "awards_name" 
															value = "<?php echo $awards_name; ?>">

															<div class="invalid-feedback">
																<?php echo $awards_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
                                                        	<label class="form-label" for="team_individual"><span style="color: red">* </span>Team / Individual</label>

	                                                        <select name="team_individual" class="form-select <?php echo (!empty($team_individual_err)) ? 'is-invalid' : ''; ?>" id="team_individual">

	                                                            <option value="">---Select Option---</option>
	                                                            <option value="Team">Team</option>
	                                                            <option value="Individual">Individual</option>
	                                                                
	                                                        </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $team_individual_err; ?>
                                                            </span>
                                                        </div>

														<div class="mb-3">
															<label class="form-label" for = "student_name"> <span style="color: red">* </span>Name of the student</label>

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
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-graduation-cap fa-lg"></i>
														<span>Criteria 5.3.1 - Awards and Medals</span>
													</div>
													<div class="card-body">

														<div class="mb-3">
                                                        	<label class="form-label" for="level"><span style="color: red">* </span>Event</label>

	                                                        <select name="level" class="form-select <?php echo (!empty($level_err)) ? 'is-invalid' : ''; ?>" id="level">

	                                                            <option value="">---Select Option---</option>
	                                                            <option value="Inter-university">Inter-university</option>
	                                                            <option value="State">State</option>
	                                                            <option value="National">National</option>
	                                                            <option value="International">International</option>
	                                                                
	                                                        </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $level_err; ?>
                                                            </span>
                                                        </div>

														<div class="mb-3">
															<label class="form-label" for = "event_name"> <span style="color: red">* </span>Name of the event</label>

															<input 
															type="text" 
															name="event_name" 
															class="form-control <?php echo (!empty($event_name_err)) ? 'is-invalid' : ''; ?>"
															id = "event_name" 
															value = "<?php echo $event_name; ?>">

															<div class="invalid-feedback">
																<?php echo $event_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "month_year"> <span style="color: red">* </span>Month and Year</label>

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
														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<?php
							$sql = "SELECT * FROM cri_5_3_1_awards_medals WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the award/ medal</th>
												<th>Team / Individual</th>
												<th>Name of the student</th>
												<th>Inter-university / State / National / International</th>
												<td>Name of the event</td>
												<td>Month and Year</td>
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
													<td><?php echo $data['awards_name']; ?></td>
													<td><?php echo $data['team_individual']; ?></td>
													<td><?php echo $data['student_name']; ?></td>
													<td><?php echo $data['level']; ?></td>
													<td><?php echo $data['event_name']; ?></td>
													<td><?php echo $data['month_year']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["am_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#awards_name').val(data[1]);
			$('#team_individual').val(data[2]);
			$('#student_name').val(data[3]);
			$('#level').val(data[4]);
			$('#event_name').val(data[5]);
			$('#month_year').val(data[6]);
		});
	});
</script>

</body>

</html>
