<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $agencies_name = $agencies_name_err = $purpose = $purpose_err = $funds = $funds_err = $month = $month_err = "";
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

	// Agencies Name Validation

	if(empty(trim($_POST["agencies_name"])))
	{
		$agencies_name_err = "Please Enter Name of the non-government funding agencies/ individuals/ philanthropists.";
	}
	else
	{
		$agencies_name = trim($_POST["agencies_name"]);
	}

	// Purposr Validation

	if(empty(trim($_POST["purpose"])))
	{
		$purpose_err = "Please Enter Purpose of the Grant.";
	}
	else
	{
		$purpose = trim($_POST["purpose"]);
	}

	// Funds Validation

	if(empty(trim($_POST["funds"])))
	{
		$funds_err = "Please Enter Funds/ Grants received (in INR lakhs).";
	}
	else
	{
		$funds = trim($_POST["funds"]);
	}

	// Month and Year Validation

	if(empty(trim($_POST["month"])))
	{
		$month_err = "Please Enter Month and Year.";
	}
	else
	{
		$month = trim($_POST["month"]);
	}

	
	if(empty($academic_year_err) && empty($agencies_name_err) && empty($funds_err) && empty($purpose_err) && empty($month_err))
	{
		$query = "INSERT INTO cri_6_4_2_funds_non_government (academic_year, upload_by_id, upload_by_name, agencies_name, purpose, funds, month) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$agencies_name', '$purpose', '$funds', '$month')";

		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_6.4.2_form.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_6.4.2_form.php"';
			echo '</script>';
		}
	}
}

if(isset($_POST['update']))
{
	$err = 0;
 	$agencies_name = $purpose = $funds = $month = "";

	if(empty(trim($_POST["agencies_name"])) || empty(trim($_POST["purpose"])) || empty(trim($_POST["funds"])) || empty(trim($_POST["month"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_6.4.2_form.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$agencies_name = $_POST['agencies_name'];
			$purpose = $_POST['purpose'];
			$funds = $_POST['funds'];
			$month = $_POST['month'];

			$query = "UPDATE cri_6_4_2_funds_non_government SET funds = ?, purpose = ?, agencies_name = ?, month = ? WHERE fng_id = ?";

			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "ssssi", $funds, $purpose, $agencies_name, $month, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_6.4.2_form.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_6.4.2_form.php"';
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

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 6</title>
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit fa-lg"></i><spam>Funds / Grants received</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
	                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="agencies_name"><span style="color: red">* </span>Name of the non-government funding agencies/ individuals/ philanthropists</label>

	                        <input type="text" name="agencies_name" class="form-control " id="agencies_name">
                    	</div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "purpose"> <span style="color: red">* </span>Purpose of the Grant</label>

                            <input type="text" name="purpose" class="form-control " id="purpose">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "funds"> <span style="color: red">* </span>Funds/ Grants received (in INR lakhs)</label>

                            <input type="text" name="funds" class="form-control " id="funds">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month"> <span style="color: red">* </span>Month and Year</label>

                            <input type="text" name="month" class="form-control " id="month">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 6.4</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-indian-rupee-sign fa-lg"></i>
							<span>Criteria 6.4.2 - Funds / Grants received from non-government bodies, individuals, and philanthropists during the year (not covered in Criterion III and V) (INR in lakhs)</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_6.4.2_form.php" id="active">Funds / Grants received</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.4.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.4.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-indian-rupee-sign fa-lg"></i>
														<span>Criteria 6.4.2 - Funds / Grants received</span>
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
															<label class="form-label" for = "agencies_name"> <span style="color: red">* </span>Name of the non-government funding agencies/ individuals/ philanthropists</label>

															<input 
															type="text" 
															name="agencies_name" 
															class="form-control <?php echo (!empty($agencies_name_err)) ? 'is-invalid' : ''; ?>"
															id = "agencies_name" 
															value = "<?php echo $agencies_name; ?>">

															<div class="invalid-feedback">
																<?php echo $agencies_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "purpose"> <span style="color: red">* </span>Purpose of the Grant</label>

															<input 
															type="text" 
															name="purpose" 
															class="form-control <?php echo (!empty($purpose_err)) ? 'is-invalid' : ''; ?>"
															id = "purpose" 
															value = "<?php echo $purpose; ?>">

															<div class="invalid-feedback">
																<?php echo $purpose_err; ?>
															</div>
														</div>
														
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-indian-rupee-sign fa-lg"></i>
														<span>Criteria 6.4.2 - Funds / Grants received</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "funds"> <span style="color: red">* </span>Funds/ Grants received (in INR lakhs)</label>

															<input 
															type="text" 
															name="funds" 
															class="form-control <?php echo (!empty($funds_err)) ? 'is-invalid' : ''; ?>"
															id = "funds" 
															value = "<?php echo $funds; ?>">

															<div class="invalid-feedback">
																<?php echo $funds_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "month"> <span style="color: red">* </span>Month and Year</label>

															<input 
															type="text" 
															name="month" 
															class="form-control <?php echo (!empty($month_err)) ? 'is-invalid' : ''; ?>"
															id = "month" 
															value = "<?php echo $month; ?>">

															<div class="invalid-feedback">
																<?php echo $month_err; ?>
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

							$sql = "SELECT * FROM cri_6_4_2_funds_non_government WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the non-government funding agencies</th>
												<th>Purpose of the Grant</th>
												<th>Funds/ Grants received (in INR lakhs)</th>
												<th>Month and Year</th>
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
													<td><?php echo $data['agencies_name']; ?></td>
													<td><?php echo $data['purpose']; ?></td>
													<td><?php echo $data['funds']; ?></td>
													<td><?php echo $data['month']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["fng_id"]}><i class = 'fa fa-edit'></i></button></td>";
													?>
												</tr>
												<?php
											}
											?>
										</table>
									</div>
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
			$('#agencies_name').val(data[1]);
			$('#purpose').val(data[2]);
			$('#funds').val(data[3]);
			$('#month').val(data[4]);
		});
	});
</script>

</body>

</html>
