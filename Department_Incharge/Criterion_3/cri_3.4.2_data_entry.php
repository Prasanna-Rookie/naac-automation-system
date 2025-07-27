<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $scholar_name = $scholar_name_err = $registration_year = $registration_year_err = $title = $title_err = $teacher_name = $teacher_name_err = "";
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
		$teacher_name_err = "Please Enter Name of the Teacher.";
	}
	else
	{
		$teacher_name = trim($_POST["teacher_name"]);
	}

	if(empty(trim($_POST["scholar_name"])))
	{
		$scholar_name_err = "Please Enter Name of the scholar.";
	}
	else
	{
		$scholar_name = trim($_POST["scholar_name"]);
	}

	if(empty(trim($_POST["registration_year"])))
	{
		$registration_year_err = "Please Enter Month and Year of registration of the scholar.";
	}
	else
	{
		$registration_year = trim($_POST["registration_year"]);
	}

	if(empty(trim($_POST["title"])))
	{
		$title_err = "Please Enter PhD Scholar's Title of the Thesis.";
	}
	else
	{
		$title = trim($_POST["title"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($scholar_name_err) && empty($teacher_name_err) && empty($registration_year_err) && empty($title_err))
	{
		$query = "INSERT INTO cri_3_4_2_scholar (academic_year, upload_by_id, upload_by_name, teacher_name, scholar_name, registration_year, title) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name', '$teacher_name','$scholar_name', '$registration_year', '$title')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.4.2_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.4.2_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$teacher_name = $scholar_name = $registration_year = $title = "";
	if(empty(trim($_POST["teacher_name"])) || empty(trim($_POST["scholar_name"])) || empty(trim($_POST["registration_year"])) || empty(trim($_POST["title"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.4.2_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$teacher_name = $_POST['teacher_name'];
			$scholar_name = $_POST['scholar_name'];
			$registration_year = $_POST['registration_year'];
			$title = $_POST['title'];

			$query = "UPDATE cri_3_4_2_scholar SET teacher_name = ?, scholar_name = ?, registration_year = ?, title = ? WHERE s_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "ssssi", $teacher_name, $scholar_name, $registration_year, $title, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.4.2_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.4.2_data_entry.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>PhD candidates</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "teacher_name"> <span style="color: red">* </span>Name of the PhD Guide</label>

                            <select name="teacher_name" class="form-select" id="teacher_name">

							<?php
								$sql = "SELECT * FROM cri_2_4_2_teachers WHERE research_guide = 'Yes'";
								$result = $con -> query($sql);

								while($row = $result -> fetch_assoc())
								{
							?>
								<option value="<?php echo $row['teacher_name']; ?>">
							<?php
								echo $row['teacher_name'];
							?>
								</option>
							<?php
							}

							?>

							</select>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "scholar_name"> <span style="color: red">* </span>Name of the scholar</label>

                            <input type="text" name="scholar_name" class="form-control " id="scholar_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "registration_year"> <span style="color: red">* </span>Month and Year of registration of the scholar</label>

                            <input type="text" name="registration_year" class="form-control " id="registration_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "title"> <span style="color: red">* </span>PhD Scholar's Title of the Thesis</label>

                            <input type="text" name="title" class="form-control " id="title">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.4</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-trophy fa-lg"></i>
							<span>Criteria 3.4.2 - Number of PhD candidates registered per teacher (as per the data given with regard to recognized PhD guides/ supervisors provided in Metric No. 3.2.3) during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.4.2_data_entry.php" id="active">PhD candidates</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.4.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.4.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-trophy fa-lg"></i>
														<span>Criteria 3.4.2 - PhD candidates</span>
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
															<label class="form-label" for = "teacher_name"> <span style="color: red">* </span>Name of the PhD Guide</label>

															<select name="teacher_name" class="form-select <?php echo (!empty($teacher_name_err)) ? 'is-invalid' : ''; ?>" id="teacher_name">

																<option value="">---Select PhD Guide---</option>

																<?php
																$sql = "SELECT * FROM cri_2_4_2_teachers WHERE research_guide = 'Yes'";
																$result = $con -> query($sql);

																while($row = $result -> fetch_assoc())
																{
																	?>
																	<option value="<?php echo $row['teacher_name']; ?>"

																		<?php
																		if($teacher_name == $row['teacher_name'])
																		{
																			echo "selected";
																		} 
																		?>
																		>
																		<?php
																		echo $row['teacher_name'];
																		?>
																	</option>
																	<?php
																}

																?>

															</select>
															<div class="invalid-feedback">
																<?php echo $teacher_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "scholar_name"> <span style="color: red">* </span>Name of the scholar</label>

															<input 
															type="text" 
															name="scholar_name" 
															class="form-control <?php echo (!empty($scholar_name_err)) ? 'is-invalid' : ''; ?>"
															id = "scholar_name" 
															value = "<?php echo $scholar_name; ?>">

															<div class="invalid-feedback">
																<?php echo $scholar_name_err; ?>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-trophy fa-lg"></i>
														<span>Criteria 3.4.2 - PhD candidates</span>
													</div>
													<div class="card-body">

														<div class="mb-3">
															<label class="form-label" for = "registration_year"> <span style="color: red">* </span>Month and Year of registration of the scholar</label>

															<input 
															type="text" 
															name="registration_year" 
															class="form-control <?php echo (!empty($registration_year_err)) ? 'is-invalid' : ''; ?>"
															id = "registration_year" 
															value = "<?php echo $registration_year; ?>">

															<div class="invalid-feedback">
																<?php echo $registration_year_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "title"> <span style="color: red">* </span>PhD Scholar's Title of the Thesis</label>

															<input 
															type="text" 
															name="title" 
															class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"
															id = "title" 
															value = "<?php echo $title; ?>">

															<div class="invalid-feedback">
																<?php echo $title_err; ?>
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
							$sql = "SELECT * FROM cri_3_4_2_scholar WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the PhD Guide</th>
												<th>Name of the scholar</th>
												<th>Month and Year of registration of the scholar</th>
												<th>PhD Scholar's Title of the Thesis</th>
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
													<td><?php echo $data['scholar_name']; ?></td>
													<td><?php echo $data['registration_year']; ?></td>
													<td><?php echo $data['title']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["s_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#scholar_name').val(data[2]);
			$('#registration_year').val(data[3]);
			$('#title').val(data[4]);
		});
	});
</script>

</body>

</html>
