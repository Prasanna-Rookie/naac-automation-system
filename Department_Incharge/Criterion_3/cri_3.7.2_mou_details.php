<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $name = $name_err = $month_year = $month_year_err = $duration = $duration_err = "";
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
		$name_err = "Please Enter Name of the institution/ industry/ corporate house.";
	}
	else
	{
		$name = trim($_POST["name"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Month and Year of signing MoU.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	if(empty(trim($_POST["duration"])))
	{
		$duration_err = "Please Enter Duration.";
	}
	else
	{
		$duration = trim($_POST["duration"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($name_err) && empty($month_year_err) && empty($duration_err))
	{
		$query = "INSERT INTO cri_3_7_2_mou_details (academic_year, upload_by_id, upload_by_name, name, month_year, duration) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$name', '$month_year', '$duration')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.7.2_mou_details.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.7.2_mou_details.php"';
			echo '</script>';
		}
		
	}
}

if(isset($_POST['update']))
{
	$err = 0;
	$name = $month_year = $duration = "";
	if(empty(trim($_POST["name"])) || empty(trim($_POST["month_year"])) || empty(trim($_POST["duration"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.7.2_mou_details.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$name = $_POST['name'];
			$month_year = $_POST['month_year'];
			$duration = $_POST['duration'];

			$query = "UPDATE cri_3_7_2_mou_details SET name = ?, month_year = ?, duration = ? WHERE md_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "sssi", $name, $month_year, $duration, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.7.2_mou_details.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.7.2_mou_details.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>MoUs</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "name"> <span style="color: red">* </span>Name of the institution/ industry/ corporate house</label>

                            <input type="text" name="name" class="form-control " id="name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month_year"> <span style="color: red">* </span>Month and Year of signing MoU</label>

                            <input type="text" name="month_year" class="form-control " id="month_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "duration"> <span style="color: red">* </span>Duration</label>

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
									<a class="nav-link active" href="cri_3.7.2_mou_details.php" id="active">MoUs</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.7.2_activities.php" id="non-active">Activities </a>
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
														<span>Criteria 3.7.2 - MoUs</span>
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
														<i class="fa-solid fa-handshake fa-lg"></i>
														<span>Criteria 3.7.2 - MoUs</span>
													</div>
													<div class="card-body">
														
														<div class="mb-3">
															<label class="form-label" for = "month_year"> <span style="color: red">* </span>Month and Year of signing MoU</label>

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

														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<?php
							$sql = "SELECT * FROM cri_3_7_2_mou_details WHERE upload_by_id = '$upload_by_id'";
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
												<th>Month and Year of signing MoU</th>
												<th>Duration</th>
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
													<td><?php echo $data['month_year']; ?></td>
													<td><?php echo $data['duration']; ?></td>
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
			$('#month_year').val(data[2]);
			$('#duration').val(data[3]);
		});
	});
</script>

</body>

</html>