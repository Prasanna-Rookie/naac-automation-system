<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $teacher_name = $teacher_name_err = $title = $title_err = $from_date = $from_date_err = $to_date = $to_date_err = "";
$upload_by_name = $_SESSION['name'];
$upload_by_id = $_SESSION['inc_id'];

if($_SERVER["REQUEST_METHOD"] == "POST")
{

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
		$teacher_name_err = "Name of Teacher who attended the programme.";
	}
	else
	{
		$teacher_name = trim($_POST["teacher_name"]);
	}


	if(empty(trim($_POST["title"])))
	{
		$title_err = "Title of the programme.";
	}
	else
	{
		$title = trim($_POST["title"]);
	}

	if(empty(trim($_POST["from_date"])))
	{
		$from_date_err = "Please Enter From Date.";
	}
	else
	{
		$from_date = trim($_POST["from_date"]);
	}

	
	if(empty($academic_year_err) && empty($teacher_name_err) && empty($title_err) && empty($no_participants_err) && empty($from_date_err))
	{

		$to_date = trim($_POST["to_date"]);
		$query = "INSERT INTO cri_6_3_4_fdp (academic_year,upload_by_id,upload_by_name, teacher_name, title, from_date, to_date) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name', '$teacher_name', '$title', '$from_date', '$to_date')";

		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_6.3.4_form.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_6.3.4_form.php"';
			echo '</script>';
		}
	}
}

if(isset($_POST['update']))
{
	$err = 0;
 	$teacher_name = $title = $from_date = "";

	if(empty(trim($_POST["teacher_name"])) || empty(trim($_POST["title"])) || empty(trim($_POST["from_date"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_6.3.3_form.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$teacher_name = $_POST['teacher_name'];
			$title = $_POST['title'];
			$from_date = $_POST['from_date'];
			$to_date = $_POST['to_date'];

			$query = "UPDATE cri_6_3_4_fdp SET teacher_name = ?, title = ?,  from_date = ?, to_date = ? WHERE fdp_id = ?";

			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "ssssi", $teacher_name, $title, $from_date, $to_date, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_6.3.4_form.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_6.3.4_form.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit fa-lg"></i><spam>Faculty Development Programmes</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
	                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="teacher_name"><span style="color: red">* </span>Name of Teacher who attended the programme</label>

	                        <input type="text" name="teacher_name" class="form-control " id="teacher_name">
                    	</div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "title"> <span style="color: red">* </span> Title of the programme</label>

                            <input type="text" name="title" class="form-control " id="title">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "from_date"> <span style="color: red">* </span>From Date</label>

                            <input type="date" name="from_date" class="form-control " id="from_date">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "to_date">To Date</label>

                            <input type="date" name="to_date" class="form-control " id="to_date">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 6.3</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fas fa-chalkboard-teacher fa-lg"></i>
							<span>Criteria 6.3.4 - Number of teachers who have undergone online/ face-to-face Faculty Development Programmes during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_6.3.4_form.php" id="active">Faculty Development Programmes</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.3.4_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.3.4_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fas fa-chalkboard-teacher fa-lg"></i>
														<span>Criteria 6.3.4 - Faculty Development Programmes</span>
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
															<label class="form-label" for = "teacher_name"> <span style="color: red">* </span>Name of Teacher who attended the programme</label>

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
															<label class="form-label" for = "title"> <span style="color: red">* </span>Title of the programme</label>

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
														
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fas fa-chalkboard-teacher fa-lg"></i>
														<span>Criteria 6.3.4 - Faculty Development Programmes</span>
													</div>
													<div class="card-body">

														<div class="mb-3">
															<label class="form-label" for = "from_date"> <span style="color: red">* </span>From Date</label>

															<input 
															type="date" 
															name="from_date" 
															class="form-control <?php echo (!empty($from_date_err)) ? 'is-invalid' : ''; ?>"
															id = "from_date" 
															value = "<?php echo $from_date; ?>">

															<div class="invalid-feedback">
																<?php echo $from_date_err; ?>
															</div>
														</div>
														<div class="mb-3">
															<label class="form-label" for = "to_date">To Date</label>

															<input 
															type="date" 
															name="to_date" 
															class="form-control <?php echo (!empty($to_date_err)) ? 'is-invalid' : ''; ?>"
															id = "to_date" 
															value = "<?php echo $to_date; ?>">

															<div class="invalid-feedback">
																<?php echo $to_date_err; ?>
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

							$sql = "SELECT * FROM cri_6_3_4_fdp WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of Teacher who attended the programme</th>
												<th>Title of the programme</th>
												<th>From Date</th>
												<th>To Date</th>
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
													<td><?php echo $data['title']; ?></td>
													<td><?php echo $data['from_date']; ?></td>
													<td><?php echo $data['to_date']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["fdp_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#teacher_name').val(data[1]);
			$('#title').val(data[2]);
			$('#from_date').val(data[3]);
			$('#to_date').val(data[4]);
		});
	});
</script>

</body>

</html>
