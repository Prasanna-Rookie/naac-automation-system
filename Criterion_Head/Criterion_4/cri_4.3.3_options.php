<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $bandwidth = $bandwidth_err = "";

$upload_by_name = $_SESSION['name'];
$upload_by_id = $_SESSION['cri_id'];

// echo "$upload_by_id";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Academic Year Validation

	if(empty(trim($_POST["academic_year"])))
	{
		$academic_year_err = "Please Select Academic Year.";
	}
	else
	{
		$academic_year_t = $_POST["academic_year"];
       	$query = "SELECT * FROM cri_4_3_3_options WHERE academic_year = '$academic_year_t'";
       	$result = mysqli_query($con, $query);

       	$count = mysqli_num_rows($result);
       	if($count == 1)
       	{
       		$academic_year_err = "Record Already Exists.";
       	}
       	else
       	{
       		$academic_year = trim($_POST["academic_year"]);
       	}
	}

	// Bandwidth Validation

	if(empty(trim($_POST["bandwidth"])))
	{
		$bandwidth_err = "Please Select Bandwidth.";
	}
	else
	{
		$bandwidth = trim($_POST["bandwidth"]);
	}

	if(empty($academic_year_err) && empty($bandwidth_err))
	{
		$query = "INSERT INTO cri_4_3_3_options (academic_year, upload_by_id, upload_by_name, option) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$bandwidth')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
        	echo'alert("Uploaded Successfully."); location.href="cri_4.3.3_options.php"';
        	echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
	        echo'alert("Document Upload Failed, Please Try Again."); location.href="cri_4.3.3_options.php"';
	        echo '</script>';
		}
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$academic_year = $bandwidth = "";
	if(empty(trim($_POST["bandwidth"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Budget Allocated."); location.href="cri_4.3.3_options.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$bandwidth = $_POST['bandwidth'];

			$query = "UPDATE cri_4_3_3_options SET option = ? WHERE option_id = ?";
			    
			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "si", $bandwidth, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_4.3.3_options.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.3.3_options.php"';
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 4</title>
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
		td,th 
		{
			vertical-align: middle;
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Bandwidth of internet connection.</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="bandwidth"><span style="color: red">* </span>Bandwidth of internet connection</label>

                        <select name="bandwidth" class="form-select" id="bandwidth">

                        	<option value="">---Select Bandwidth---</option>
                        	<option value="A">A. ≥50 Mbps</option>
                        	<option value="B">B. 35 Mbps - 50 Mbps</option>
                        	<option value="C">C. 20 Mbps - 35 Mbps</option>
                        	<option value="D">D. 5 Mbps - 20 Mbps</option>
                        	<option value="E">E. <5 Mbps</option>
                                
                        </select>
                    </div>

                        <input type="hidden" name="id" id="id" value="0">
                        <!-- Academic Year Hidden Input Field -->
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 4.3</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-wifi fa-lg"></i>
							<span>Criteria 4.3.3 - Bandwidth of internet connection in the Institution and the number of students on campus.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_4.3.3_options.php" id="active">Options</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.3.3_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.3.3_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-wifi fa-lg"></i>
														<span>Criteria 4.3.3 - Bandwidth of internet connection</span>
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
                                                        	<label class="form-label" for="bandwidth"><span style="color: red">* </span>Bandwidth of internet connection</label>

	                                                        <select name="bandwidth" class="form-select <?php echo (!empty($bandwidth_err)) ? 'is-invalid' : ''; ?>" id="bandwidth">

	                                                            <option value="">---Select Bandwidth---</option>
	                                                            <option value="A">A. ≥50 Mbps</option>
	                                                            <option value="B">B. 35 Mbps - 50 Mbps</option>
	                                                            <option value="C">C. 20 Mbps - 35 Mbps</option>
	                                                            <option value="D">D. 5 Mbps - 20 Mbps</option>
	                                                            <option value="E">E. <5 Mbps</option>
	                                                                
	                                                        </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $bandwidth_err; ?>
                                                            </span>
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

							$sql = "SELECT * FROM cri_4_3_3_options WHERE upload_by_id = '$upload_by_id'";
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
												<th>Option</th>
												<th>Bandwidth of internet connection</th>
												<th>Update</th>
											</tr>
										</thead>
										<tbody class="row_position">
											<?php
											while ($data = $datas->fetch_assoc()) 
											{
												if($data['option'] == "A")
												{
													$option = "≥50 Mbps";
												}
												elseif($data['option'] == "B")
												{
													$option = "35 Mbps - 50 Mbps";
												}
												elseif($data['option'] == "C")
												{
													$option = "20 Mbps - 35 Mbps";
												}
												elseif($data['option'] == "D")
												{
													$option = "5 Mbps - 20 Mbps";
												}
												else
												{
													$option = "<5 Mbps";
												}

												?>
												<tr style="text-align:center;">
													<td><?php echo $data['academic_year']; ?></td>
													<td><?php echo $data['option']; ?></td>
													<td><?php echo $option; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["option_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
            $('#bandwidth').val(data[1]);
        });
    });

</script>

</body>

</html>