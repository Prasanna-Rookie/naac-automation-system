<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $seminar_name = $seminar_name_err = $participants = $participants_err = $from_date = $from_date_err = $to_date = $to_date_err = "";
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

	if(empty(trim($_POST["seminar_name"])))
	{
		$seminar_name_err = "Please Enter Name of the Workshop/ Seminar.";
	}
	else
	{
		$seminar_name = trim($_POST["seminar_name"]);
	}

	if(empty(trim($_POST["participants"])))
	{
		$participants_err = "Please Enter Number of Participants.";
	}
	else
	{
		$participants = trim($_POST["participants"]);
	}

	if(empty(trim($_POST["from_date"])))
	{
		$from_date_err = "Please Enter From Date.";
	}
	else
	{
		$from_date = trim($_POST["from_date"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($seminar_name_err) && empty($participants_err) && empty($from_date_err))
	{
		$to_date = trim($_POST["to_date"]);
		$query = "INSERT INTO cri_3_3_2_workshops_seminars (academic_year, upload_by_id, upload_by_name, seminar_name, participants, from_date, to_date) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$seminar_name', '$participants', '$from_date', '$to_date')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.3.2_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.3.2_data_entry.php"';
			echo '</script>';
		}
		
	}
}

if(isset($_POST['update']))
{
	$err = 0;
	$seminar_name = $participants = $from_date = $to_date = "";
	if(empty(trim($_POST["seminar_name"])) || empty(trim($_POST["participants"])) ||  empty(trim($_POST["from_date"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.3.2_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$seminar_name = $_POST['seminar_name'];
			$participants = $_POST['participants'];
			$from_date = $_POST['from_date'];
			$to_date = $_POST['to_date'];

			$query = "UPDATE cri_3_3_2_workshops_seminars SET seminar_name = ?, participants = ?, from_date = ?,to_date = ?  WHERE ws_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "ssssi", $seminar_name, $participants, $from_date, $to_date, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.3.2_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.3.2_data_entry.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Workshops/Seminars</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "seminar_name"> <span style="color: red">* </span>Name of the Workshop/ Seminar</label>

                            <input type="text" name="seminar_name" class="form-control " id="seminar_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "participants"> <span style="color: red">* </span>Number of Participants</label>

                            <input type="number" name="participants" class="form-control " id="participants">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.3</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-seedling fa-lg"></i>
							<span>Criteria 3.3.2 - Number of workshops/seminars conducted on Research Methodology, Intellectual Property Rights (IPR), Entrepreneurship and Skill Development during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.3.2_data_entry.php" id="active">Workshops/Seminars</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.3.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.3.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-seedling fa-lg"></i>
														<span>Criteria 3.3.2 - Workshops/Seminars</span>
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
															<label class="form-label" for = "seminar_name"> <span style="color: red">* </span>Name of the Workshop/ Seminar</label>

															<input 
															type="text" 
															name="seminar_name" 
															class="form-control <?php echo (!empty($seminar_name_err)) ? 'is-invalid' : ''; ?>"
															id = "seminar_name" 
															value = "<?php echo $seminar_name; ?>">

															<div class="invalid-feedback">
																<?php echo $seminar_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "participants"> <span style="color: red">* </span>Number of Participants</label>

															<input 
															type="number" 
															name="participants" 
															class="form-control <?php echo (!empty($participants_err)) ? 'is-invalid' : ''; ?>"
															id = "participants" 
															value = "<?php echo $participants; ?>">

															<div class="invalid-feedback">
																<?php echo $participants_err; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-seedling fa-lg"></i>
														<span>Criteria 3.3.2 - Workshops/Seminars</span>
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
							$sql = "SELECT * FROM cri_3_3_2_workshops_seminars WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the Workshop/ Seminar</th>
												<th>Number of Participants</th>
												<th>From Date</th>
												<th>From Date</th>
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
													<td><?php echo $data['seminar_name']; ?></td>
													<td><?php echo $data['participants']; ?></td>
													<td><?php echo $data['from_date']; ?></td>
													<td><?php echo $data['to_date']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["ws_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#seminar_name').val(data[1]);
			$('#participants').val(data[2]);
			$('#from_date').val(data[3]);
			$('#to_date').val(data[4]);
		});
	});
</script>

</body>

</html>
