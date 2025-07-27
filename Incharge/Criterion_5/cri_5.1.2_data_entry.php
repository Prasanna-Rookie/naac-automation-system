<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $scheme_name = $scheme_name_err = $no_students = $no_students_err = $amount = $amount_err = "";
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

	if(empty(trim($_POST["scheme_name"])))
	{
		$scheme_name_err = "Please Enter Name of the scheme.";
	}
	else
	{
		$scheme_name = trim($_POST["scheme_name"]);
	}

	if(empty(trim($_POST["no_students"])))
	{
		$no_students_err = "Please Enter Number of students receiving scholarships and freeships provided by the Government.";
	}
	elseif(!is_numeric(trim($_POST["no_students"])))
	{
		$no_students_err = "Please Enter Valid Input.";
	}
	else
	{
		$no_students = trim($_POST["no_students"]);
	}

	if(empty(trim($_POST["amount"])))
	{
		$amount_err = "Please Enter Amount.";
	}
	elseif(!is_numeric(trim($_POST["amount"])))
	{
		$no_students_err = "Please Enter Valid Input.";
	}
	else
	{
		$amount = trim($_POST["amount"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($scheme_name_err) && empty($no_students_err) && empty($amount_err))
	{
		$type = "Institution";
		$query = "INSERT INTO cri_5_1_1_scholarships (academic_year, upload_by_id, upload_by_name, type,scheme_name, no_students, amount) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name', '$type','$scheme_name', '$no_students', '$amount')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_5.1.2_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_5.1.2_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$scheme_name = $no_students = $amount = "";
	if(empty(trim($_POST["scheme_name"])) || empty(trim($_POST["no_students"])) || !is_numeric(trim($_POST["no_students"])) || empty(trim($_POST["amount"])) || !is_numeric(trim($_POST["amount"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_5.1.2_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$scheme_name = $_POST['scheme_name'];
			$no_students = $_POST['no_students'];
			$amount = $_POST['amount'];

			$query = "UPDATE cri_5_1_1_scholarships SET scheme_name = ?, no_students = ?, amount = ? WHERE s_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "sdsi", $scheme_name, $no_students, $amount, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_5.1.2_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_5.1.2_data_entry.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Scholarships and Freeships</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "scheme_name"> <span style="color: red">* </span>Name of the scheme</label>

                            <input type="text" name="scheme_name" class="form-control " id="scheme_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "no_students"> <span style="color: red">* </span>Number of students receiving scholarships and freeships provided by the institution</label>

                            <input type="text" name="no_students" class="form-control " id="no_students">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "amount"> <span style="color: red">* </span>Amount</label>

                            <input type="text" name="amount" class="form-control " id="amount">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 5.1</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-graduation-cap fa-lg"></i>
							<span>Criteria 5.1.2 - Number of students benefitted by scholarships and freeships provided by the institution and non-government agencies during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_5.1.2_data_entry.php" id="active">Institution</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.1.2_data_entry_a.php" id="non-active">Non-Government</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.1.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_5.1.2_doc_view.php" id="non-active">View Document</a>
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
														<span>Criteria 5.1.2 - Scholarships and Freeships</span>
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
															<label class="form-label" for = "scheme_name"> <span style="color: red">* </span>Name of the scheme</label>

															<input 
															type="text" 
															name="scheme_name" 
															class="form-control <?php echo (!empty($scheme_name_err)) ? 'is-invalid' : ''; ?>"
															id = "scheme_name" 
															value = "<?php echo $scheme_name; ?>">

															<div class="invalid-feedback">
																<?php echo $scheme_name_err; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-graduation-cap fa-lg"></i>
														<span>Criteria 5.1.2 - Scholarships and Freeships</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "no_students"> <span style="color: red">* </span>Number of students receiving scholarships and freeships provided by the institution</label>

															<input 
															type="text" 
															name="no_students" 
															class="form-control <?php echo (!empty($no_students_err)) ? 'is-invalid' : ''; ?>"
															id = "no_students" 
															value = "<?php echo $no_students; ?>">

															<div class="invalid-feedback">
																<?php echo $no_students_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "amount"> <span style="color: red">* </span>Amount</label>

															<input 
															type="text" 
															name="amount" 
															class="form-control <?php echo (!empty($amount_err)) ? 'is-invalid' : ''; ?>"
															id = "amount" 
															value = "<?php echo $amount; ?>">

															<div class="invalid-feedback">
																<?php echo $amount_err; ?>
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
							$sql = "SELECT * FROM cri_5_1_1_scholarships WHERE upload_by_id = '$upload_by_id' and type = 'Institution'";
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
												<th>Name of the scheme</th>
												<th>Number of students receiving scholarships and freeships provided by the institution</th>
												<th>Amount</th>
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
													<td><?php echo $data['scheme_name']; ?></td>
													<td><?php echo $data['no_students']; ?></td>
													<td><?php echo $data['amount']; ?></td>
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
			$('#scheme_name').val(data[1]);
			$('#no_students').val(data[2]);
			$('#amount').val(data[3]);
		});
	});
</script>

</body>

</html>
