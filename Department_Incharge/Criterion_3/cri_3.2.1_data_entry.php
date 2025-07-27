<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $principal_name = $principal_name_err = $principal_dept = $principal_dept_err = $agency_name = $agency_name_err = $agency_type = $agency_type_err = $fund = $fund_err = $month_year = $month_year_err = $duration = $duration_err = "";
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

	if(empty(trim($_POST["principal_name"])))
	{
		$principal_name_err = "Please Enter Name of the Principal Investigator/ Co-Investigator.";
	}
	else
	{
		$principal_name = trim($_POST["principal_name"]);
	}

	if(empty(trim($_POST["principal_dept"])))
	{
		$principal_dept_err = "Please Enter Department of the Principal Investigator/ Co-Investigator.";
	}
	else
	{
		$principal_dept = trim($_POST["principal_dept"]);
	}

	if(empty(trim($_POST["agency_name"])))
	{
		$agency_name_err = "Please Enter Name of the Funding Agency.";
	}
	else
	{
		$agency_name = trim($_POST["agency_name"]);
	}

	if(empty(trim($_POST["agency_type"])))
	{
		$agency_type_err = "Please Select Type.";
	}
	else
	{
		$agency_type = trim($_POST["agency_type"]);
	}

	if(empty(trim($_POST["fund"])))
	{
		$fund_err = "Please Enter Funds provided.";
	}
	elseif(!is_numeric(trim($_POST["fund"])))
	{
		$fund_err = "Please Enter Valid Input.";
	}
	else
	{
		$fund = trim($_POST["fund"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Month and Year of receiving.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Month and Year of receving the grant.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	if(empty(trim($_POST["duration"])))
	{
		$duration_err = "Please Enter Duration of the Project.";
	}
	else
	{
		$duration = trim($_POST["duration"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($principal_name_err) && empty($principal_dept_err) && empty($agency_name_err) && empty($agency_type_err) && empty($fund_err) && empty($month_year_err) && empty($duration_err))
	{
		$query = "INSERT INTO cri_3_2_1_grants_received (academic_year, upload_by_id, upload_by_name, principal_name, principal_dept, agency_name, type, fund, month_year, duration) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$principal_name', '$principal_dept', '$agency_name', '$agency_type', '$fund', '$month_year', '$duration')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.2.1_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.2.1_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;

	$principal_name = $principal_dept  = $agency_name  = $agency_type  = $fund = $month_year = $duration = "";
	if(empty(trim($_POST["principal_name"])) || empty(trim($_POST["principal_dept"])) || empty(trim($_POST["agency_name"])) || empty(trim($_POST["agency_type"])) || empty(trim($_POST["fund"])) || !is_numeric(trim($_POST["fund"])) || empty(trim($_POST["month_year"])) || empty(trim($_POST["duration"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.2.1_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{

			$id = $_POST['id'];
			$principal_name = $_POST['principal_name'];
			$principal_dept = $_POST['principal_dept'];
			$agency_name = $_POST['agency_name'];
			$agency_type = $_POST['agency_type'];

			$fund = $_POST['fund'];
			$month_year = $_POST['month_year'];
			$duration = $_POST['duration'];

			$query = "UPDATE cri_3_2_1_grants_received SET principal_name = ?, principal_dept = ?, agency_name = ?, type = ?, fund = ?, month_year = ?, duration = ? WHERE gr_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "sssssssi", $principal_name, $principal_dept, $agency_name, $agency_type, $fund, $month_year, $duration, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.2.1_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.2.1_data_entry.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Award/Fellowship</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "principal_name"> <span style="color: red">* </span>Name of the Principal Investigator/ Co-Investigator</label>

                            <input type="text" name="principal_name" class="form-control " id="principal_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "principal_dept"> <span style="color: red">* </span>Department of the Principal Investigator/ Co-Investigator</label>

                            <input type="text" name="principal_dept" class="form-control " id="principal_dept">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "agency_name"> <span style="color: red">* </span>Name of the Funding Agency</label>

                            <input type="text" name="agency_name" class="form-control " id="agency_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "agency_type"> <span style="color: red">* </span>Type (Government/Non-Government)</label>

                            <select name="agency_type" class="form-select" id="agency_type">

	                        	<option value="Government">Government</option>
	                        	<option value="Non-Government">Non-Government</option>
	                                
	                        </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "fund"> <span style="color: red">* </span>Funds provided (INR in lakhs)</label>

                            <input type="text" name="fund" class="form-control " id="fund">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month_year"> <span style="color: red">* </span>Month and Year of receving the grant</label>

                            <input type="text" name="month_year" class="form-control " id="month_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "duration"> <span style="color: red">* </span>Duration of the Project</label>

                            <input type="text" name="duration" class="form-control " id="duration">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.2</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-diagram-project fa-lg"></i>
							<span>Criteria 3.2.1 - Grants received from Government and Non-Governmental agencies for research projects, endowments, Chairs during the year (INR in Lakhs).</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.2.1_data_entry.php" id="active">Grants Received</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.2.1_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.2.1_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-diagram-project fa-lg"></i>
														<span>Criteria 3.2.1 - Grants Received</span>
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
															<label class="form-label" for = "principal_name"> <span style="color: red">* </span>Name of the Principal Investigator/ Co-Investigator</label>

															<input 
															type="text" 
															name="principal_name" 
															class="form-control <?php echo (!empty($principal_name_err)) ? 'is-invalid' : ''; ?>"
															id = "principal_name" 
															value = "<?php echo $principal_name; ?>">

															<div class="invalid-feedback">
																<?php echo $principal_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "principal_dept"> <span style="color: red">* </span>Department of the Principal Investigator/ Co-Investigator</label>

															<input 
															type="text" 
															name="principal_dept" 
															class="form-control <?php echo (!empty($principal_dept_err)) ? 'is-invalid' : ''; ?>"
															id = "principal_dept" 
															value = "<?php echo $principal_dept; ?>">

															<div class="invalid-feedback">
																<?php echo $principal_dept_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "agency_name"> <span style="color: red">* </span>Name of the Funding Agency </label>

															<input 
															type="text" 
															name="agency_name" 
															class="form-control <?php echo (!empty($agency_name_err)) ? 'is-invalid' : ''; ?>"
															id = "agency_name" 
															value = "<?php echo $agency_name; ?>">

															<div class="invalid-feedback">
																<?php echo $agency_name_err; ?>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-diagram-project fa-lg"></i>
														<span>Criteria 3.2.1 - Grants Received</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "agency_type"> <span style="color: red">* </span>Type (Government/Non-Government)</label>

															<select name="agency_type" class="form-select <?php echo (!empty($agency_type_err)) ? 'is-invalid' : ''; ?>" id="agency_type">

																<option value="">---Select Type---</option>
																<option value="Government">Government</option>
																<option value="Non-Government">Non-Government</option>

															</select>
															<span class="invalid-feedback">
																<?php echo $agency_type_err; ?>
															</span>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "fund"> <span style="color: red">* </span>Funds provided (INR in lakhs)</label>

															<input 
															type="text" 
															name="fund" 
															class="form-control <?php echo (!empty($fund_err)) ? 'is-invalid' : ''; ?>"
															id = "fund" 
															value = "<?php echo $fund; ?>">

															<div class="invalid-feedback">
																<?php echo $fund_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "month_year"> <span style="color: red">* </span>Month and Year of receving the grant</label>

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
															<label class="form-label" for = "duration"> <span style="color: red">* </span>Duration of the Project</label>

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

														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<?php
							$sql = "SELECT * FROM cri_3_2_1_grants_received WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the Principal Investigator/ Co-Investigator</th>
												<th>Department of the Principal Investigator/ Co-Investigator</th>
												<th>Name of the Funding Agency</th>
												<th>Type (Government/Non-Government)</th>
												<th>Funds provided (INR in lakhs)</th>
												<th>Month and Year of receving the grant</th>
												<th>Duration of the Project</th>
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
													<td><?php echo $data['principal_name']; ?></td>
													<td><?php echo $data['principal_dept']; ?></td>
													<td><?php echo $data['agency_name']; ?></td>
													<td><?php echo $data['type']; ?></td>
													<td><?php echo $data['fund']; ?></td>
													<td><?php echo $data['month_year']; ?></td>
													<td><?php echo $data['duration']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["gr_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#principal_name').val(data[1]);
			$('#principal_dept').val(data[2]);
			$('#agency_name').val(data[3]);
			$('#agency_type').val(data[4]);
			$('#fund').val(data[5]);
			$('#month_year').val(data[6]);
			$('#duration').val(data[7]);
		});
	});
</script>

</body>
</html>