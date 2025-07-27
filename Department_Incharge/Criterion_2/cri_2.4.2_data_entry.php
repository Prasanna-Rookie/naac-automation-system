<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $teacher_name = $teacher_name_err = $qualification = $qualification_err = $research_guide = $research_guide_err = $recognition_year = $recognition_year_err = $still_serving = $still_serving_err = "";
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

	if(empty(trim($_POST["teacher_name"])))
	{
		$teacher_name_err = "Please Enter Name of full-time teachers.";
	}
	else
	{
		$teacher_name = trim($_POST["teacher_name"]);
	}

	if(empty(trim($_POST["qualification"])))
	{
		$qualification_err = "Please Enter Qualification.";
	}
	else
	{
		$qualification = trim($_POST["qualification"]);
	}

	if(empty(trim($_POST["research_guide"])))
	{
		$research_guide_err = "Please Select Whether recognised as a research guide.";
	}
	else
	{
		$research_guide = trim($_POST["research_guide"]);
	}

	if(empty(trim($_POST["recognition_year"])))
	{
		$recognition_year_err = "Please Enter Year of recognition as a Research Guide.";
	}
	else
	{
		$recognition_year = trim($_POST["recognition_year"]);
	}

	if(empty(trim($_POST["still_serving"])))
	{
		$still_serving_err = "Please Enter teacher still serving the institution.";
	}
	else
	{
		$still_serving = trim($_POST["still_serving"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($teacher_name_err) && empty($qualification_err) && empty($research_guide_err) && empty($recognition_year_err) && empty($still_serving_err))
	{
		$query = "INSERT INTO cri_2_4_2_teachers (academic_year, upload_by_id, upload_by_name, teacher_name, qualification, research_guide, recognition_year, still_serving) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$teacher_name', '$qualification', '$research_guide', '$recognition_year', '$still_serving')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_2.4.2_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_2.4.2_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;

	$teacher_name = $qualification  = $research_guide  = $recognition_year  = $still_serving = "";

	if(empty(trim($_POST["teacher_name"])) || empty(trim($_POST["qualification"])) || empty(trim($_POST["research_guide"])) || empty(trim($_POST["recognition_year"])) || empty(trim($_POST["still_serving"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_2.4.2_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{

			$id = $_POST['id'];
			$teacher_name = $_POST['teacher_name'];
			$qualification = $_POST['qualification'];
			$research_guide = $_POST['research_guide'];
			$recognition_year = $_POST['recognition_year'];
			$still_serving = $_POST['still_serving'];

			$query = "UPDATE cri_2_4_2_teachers SET teacher_name = ?, qualification = ?, research_guide = ?, recognition_year = ?, still_serving = ? WHERE t_id = ?";
			$stmt = mysqli_prepare($con, $query);

			mysqli_stmt_bind_param($stmt, "sssssi", $teacher_name, $qualification, $research_guide, $recognition_year, $still_serving,  $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_2.4.2_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_2.4.2_data_entry.php"';
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
	<title>Criterion - 2</title>
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Full-Time Teachers</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "teacher_name"> <span style="color: red">* </span>Name of full-time teachers with PhD / D.M. / M.Ch. / D.N.B Super Specialty /DSc / DLitt during the year</label>

                            <input type="text" name="teacher_name" class="form-control " id="teacher_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "qualification"> <span style="color: red">* </span>Qualification (PhD / D.M. / M.Ch. / D.N.B Super Specialty /DSc / DLitt) and Year of obtaining</label>

                            <input type="text" name="qualification" class="form-control " id="qualification">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "research_guide"> <span style="color: red">* </span>Whether recognised as a research guide for PhD?</label>

                            <select name="research_guide" class="form-select" id="research_guide">

	                        	<option value="Yes">Yes</option>
	                        	<option value="No">No</option>
	                                
	                        </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "recognition_year"> <span style="color: red">* </span>Year of recognition as a Research Guide</label>

                            <input type="text" name="recognition_year" class="form-control " id="recognition_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "still_serving"> <span style="color: red">* </span>Is the teacher still serving the institution?/If not,when did he/she leave the institution?</label>

                            <input type="text" name="still_serving" class="form-control " id="still_serving">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 2.4</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-person-chalkboard fa-lg"></i>
							<span>Criteria 2.4.2 - Number of full-time teachers with PhD/ D.M. / M.Ch. / D.N.B Super-Specialty / DSc / DLitt during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_2.4.2_data_entry.php" id="active">Full-Time Teachers</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.4.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.4.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-person-chalkboard fa-lg"></i>
														<span>Criteria 2.4.2 - Full-Time Teachers</span>
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
															<label class="form-label" for = "teacher_name"> <span style="color: red">* </span>Name  of full-time teachers with PhD / D.M. / M.Ch. / D.N.B Super Specialty /DSc / DLitt during the year</label>

															<input 
															type="text" 
															name="teacher_name" 
															class="form-control <?php echo (!empty($teacher_name_err)) ? 'is-invalid' : ''; ?>"
															id = "teacher_name" 
															value = "<?php echo $teacher_name; ?>">

															<div class="invalid-feedback">
																<?php echo $teacher_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "qualification"> <span style="color: red">* </span>Qualification (PhD / D.M. / M.Ch. / D.N.B Super Specialty /DSc / DLitt) and Year of obtaining</label>

															<input 
															type="text" 
															name="qualification" 
															class="form-control <?php echo (!empty($qualification_err)) ? 'is-invalid' : ''; ?>"
															id = "qualification" 
															value = "<?php echo $qualification; ?>">

															<div class="invalid-feedback">
																<?php echo $qualification_err; ?>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-person-chalkboard fa-lg"></i>
														<span>Criteria 2.4.2 - Full-Time Teachers</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "research_guide"> <span style="color: red">* </span>Whether recognised as a research guide for PhD?</label>

															<select name="research_guide" class="form-select <?php echo (!empty($research_guide_err)) ? 'is-invalid' : ''; ?>" id="research_guide">

																<option value="">---Select---</option>
																<option value="Yes">Yes</option>
																<option value="No">No</option>

															</select>
															<span class="invalid-feedback">
																<?php echo $research_guide_err; ?>
															</span>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "recognition_year"> <span style="color: red">* </span>Year of recognition as a Research Guide</label>

															<input 
															type="text" 
															name="recognition_year" 
															class="form-control <?php echo (!empty($recognition_year_err)) ? 'is-invalid' : ''; ?>"
															id = "recognition_year" 
															value = "<?php echo $recognition_year; ?>">

															<div class="invalid-feedback">
																<?php echo $recognition_year_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "still_serving"> <span style="color: red">* </span>Is the teacher still serving the institution?/If not,when did he/she leave the institution?</label>

															<input 
															type="text" 
															name="still_serving" 
															class="form-control <?php echo (!empty($still_serving_err)) ? 'is-invalid' : ''; ?>"
															id = "still_serving" 
															value = "<?php echo $still_serving; ?>">

															<div class="invalid-feedback">
																<?php echo $still_serving_err; ?>
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
							$sql = "SELECT * FROM cri_2_4_2_teachers WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of full-time teachers with PhD / D.M. / M.Ch. / D.N.B Super Specialty /DSc / DLitt during the year</th>
												<th>Qualification (PhD / D.M. / M.Ch. / D.N.B Super Specialty /DSc / DLitt) and Year of obtaining</th>
												<th>Whether recognised as a research guide for PhD?</th>
												<th>Year of recognition as a Research Guide</th>
												<th>Is the teacher still serving the institution?/If not,when did he/she leave the institution?</th>
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
													<td><?php echo $data['teacher_name']; ?></td>
													<td><?php echo $data['qualification']; ?></td>
													<td><?php echo $data['research_guide']; ?></td>
													<td><?php echo $data['recognition_year']; ?></td>
													<td><?php echo $data['still_serving']; ?></td>													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["t_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#teacher_name').val(data[1]);
			$('#qualification').val(data[2]);
			$('#research_guide').val(data[3]);
			$('#recognition_year').val(data[4]);
			$('#still_serving').val(data[5]);
		});
	});
</script>

</body>
</html>