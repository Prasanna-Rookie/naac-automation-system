<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $description = $description_err = $area = $area_err = "";
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

	// Area Validation

	if(empty(trim($_POST["area"])))
	{
		$area_err = "Please Select Quality Assurance Initiatives.";
	}
	else
	{
		$area = trim($_POST["area"]);
	}

	// Description Validation

	if(empty(trim($_POST["description"])))
	{
		$description_err = "Please Enter Description.";
	}
	else
	{
		$description = trim($_POST["description"]);
	}

	
	if(empty($academic_year_err) && empty($area_err) && empty($description_err))
	{
		$query = "INSERT INTO cri_6_5_3_initiatives (academic_year, upload_by_id, upload_by_name, area, initiatives) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$area', '$description')";

		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_6.5.3_initiatives.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_6.5.3_initiatives.php"';
			echo '</script>';
		}
	}
}

if(isset($_POST['update']))
{
	$err = 0;
	$description = $area = "";

	if(empty(trim($_POST["description"])) || empty(trim($_POST["area"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_6.5.3_initiatives.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$area = $_POST['area'];
			$description = $_POST['description'];

			$query = "UPDATE cri_6_5_3_initiatives SET area = ?, initiatives = ? WHERE qai_id = ?";

			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "ssi", $area, $description, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_6.5.3_initiatives.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_6.5.3_initiatives.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Quality Assurance Initiatives</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
	                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="area"><span style="color: red">* </span>Quality Assurance Initiatives</label>

	                        <select name="area" class="form-select" id="area">

	                        	<option value="A">Regular Meetings of the IQAC held on</option>
								<option value="B">Conferences/Seminars/Workshops on quality conducted</option>
								<option value="C">Academic Administrative Audit (AAA) and initiation of follow-up action</option>
								<option value="D">Participation in NIRF along with Status </option>
								<option value="E">ISO Certification - Nature and validity period</option>
								<option value="F">NBA or any other certification received with programme specifications</option>
								<option value="G">Collaborative quality initiatives with other institution(s) (Provide the name of the institution and activity)</option>
								<option value="H">Orientation programme on quality issues for teachers and students organised by the institution, Date (From -To) (DD-MM-YYYY)</option>
	                                
	                        </select>
                    	</div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "description"> <span style="color: red">* </span>Description</label>

                            <input type="text" name="description" class="form-control " id="description">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 6.5</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-lg fa-solid fa-hammer fa-lg"></i>
							<span>Criteria 6.5.3 - Quality assurance initiatives of the institution include: 1. Regular meeting of the IQAC, 2. Feedback collected, analysed and used for improvement of the institution, 3. Collaborative quality initiatives with other institution(s), 4. Participation in NIRF & 5. Any other quality audit recognized by state, national or international agencies (such as ISO Certification).</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_6.5.3_initiatives.php" id="active">Quality Assurance Initiatives</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.5.3_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.5.3_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-lg fa-solid fa-hammer fa-lg"></i>
														<span>Criteria 6.5.3 - Quality Assurance Initiatives</span>
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
															<label class="form-label" for="area"><span style="color: red">* </span>Quality Assurance Initiatives</label>

															<select name="area" class="form-select <?php echo (!empty($area_err)) ? 'is-invalid' : ''; ?>" id="area">

																<option value="">---Select Quality Assurance Initiatives---</option>
																<option value="A">Regular Meetings of the IQAC held on</option>
																<option value="B">Conferences/Seminars/Workshops on quality conducted</option>
																<option value="C">Academic Administrative Audit (AAA) and initiation of follow-up action</option>
																<option value="D">Participation in NIRF along with Status </option>
																<option value="E">ISO Certification - Nature and validity period</option>
																<option value="F">NBA or any other certification received with programme specifications</option>
																<option value="G">Collaborative quality initiatives with other institution(s) (Provide the name of the institution and activity)</option>
																<option value="H">Orientation programme on quality issues for teachers and students organised by the institution, Date (From -To) (DD-MM-YYYY)</option>

															</select>
															<span class="invalid-feedback">
																<?php echo $area_err; ?>
															</span>
														</div>	

														<div class="mb-3">
	                                                        <label class="form-label" for = "description"> <span style="color: red">* </span>Description</label>

	                                                        <input 
	                                                            type="text" 
	                                                            name="description" 
	                                                            class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"
	                                                            id = "description" 
	                                                            value = "<?php echo $description; ?>">

	                                                        <div class="invalid-feedback">
	                                                            <?php echo $description_err; ?>
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

							$sql = "SELECT * FROM cri_6_5_3_initiatives WHERE upload_by_id = '$upload_by_id'";
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
												<th>Quality Assurance Initiatives</th>
												<th>Description</th>
												<th>Update</th>
											</tr>
										</thead>
										<tbody class="row_position">
											<?php
											while ($data = $datas->fetch_assoc()) 
											{
												$qai_area = "";
												if($data['area'] == "A")
												{
													$qai_area = "Regular Meetings of the IQAC held on";
												}
												elseif($data['area'] == "B")
												{
													$qai_area = "Conferences/Seminars/Workshops on quality conducted";
												}
												elseif($data['area'] == "C") 
												{
													$qai_area = "Academic Administrative Audit (AAA) and initiation of follow-up action";
												}
												elseif($data['area'] == "D") 
												{
													$qai_area = "Participation in NIRF along with Status";
												}
												elseif($data['area'] == "E") 
												{
													$qai_area = "ISO Certification - Nature and validity period";
												}
												elseif($data['area'] == "F") 
												{
													$qai_area = "NBA or any other certification received with programme specifications";
												}
												elseif($data['area'] == "G") 
												{
													$qai_area = "Collaborative quality initiatives with other institution(s) (Provide the name of the institution and activity)";
												}
												else
												{
													$qai_area = "Orientation programme on quality issues for teachers and students organised by the institution, Date (From -To) (DD-MM-YYYY)";
												}
												?>
												<tr style="text-align:center;">
													<td><?php echo $data['academic_year']; ?></td>
													<td hidden><?php echo $data['area']; ?></td>
													<td><?php echo $qai_area; ?></td>
													<td><?php echo $data['initiatives']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["qai_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#area').val(data[1]);
			$('#description').val(data[3]);
		});
	});
</script>

</body>

</html>
