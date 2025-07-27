<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $department = $department_err = $room_no = $room_no_err = $ict_facility = $ict_facility_err = $pdf_file_err = "";
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
	// Department Validation

	if(empty(trim($_POST["department"])))
	{
		$department_err = "Please Select Department.";
	}
	else
	{
		$department = trim($_POST["department"]);
	}

	// Room No. or Name Validation

	if(empty(trim($_POST["room_no"])))
	{
		$room_no_err = "Please Enter Room number or Name.";
	}
	else
	{
		$room_no = trim($_POST["room_no"]);
	}

	// ICT Facility Validation

	if(empty(trim($_POST["ict_facility"])))
	{
		$ict_facility_err = "Please Enter Type of ICT facility provided.";
	}
	else
	{
		$ict_facility = trim($_POST["ict_facility"]);
	}
	// PDF File

	if (empty($_FILES['pdf_file']['name']))
	{
		$pdf_file_err = "Please Select PDF File.";
	}
	elseif($_FILES['pdf_file']['type'] != 'application/pdf')
	{
		$pdf_file_err = "Please Select PDF File.";
	}
	else
	{
		$pdf_file_pdf = $_FILES['pdf_file']['name'];
        $pdf_file_pdf_type = $_FILES['pdf_file']['type'];
        $pdf_file_pdf_size = $_FILES['pdf_file']['size'];
        $pdf_file_pdf_tem_loc = $_FILES['pdf_file']['tmp_name'];
        $pdf_file_name = time() . '_' . uniqid() . '.pdf';

        $pdf_file_upload_location = "../../Uploaded Documents/Criteria - 4/".$pdf_file_name;
	}

	// Insert
	if(empty($academic_year_err) && empty($department_err) && empty($room_no_err) && empty($ict_facility_err) && empty($pdf_file_err)) 
	{
		if(move_uploaded_file($pdf_file_pdf_tem_loc, $pdf_file_upload_location))
		{
			// Prepare the SQL statement
		    $query = "INSERT INTO cri_4_1_3_classrooms_seminarhalls (academic_year, department, upload_by_id, upload_by_name, room_no, ict_facility, doc_name) VALUES (?, ?, ?, ?, ?, ?, ?)";
		    
		    // Prepare the statement
		    $stmt = mysqli_prepare($con, $query);
		    
		    // Bind parameters
		    mysqli_stmt_bind_param($stmt, "ssissss", $academic_year, $department, $upload_by_id, $upload_by_name, $room_no, $ict_facility, $pdf_file_name);
		    
		    // Execute the statement
		    if(mysqli_stmt_execute($stmt)) 
		    {
		        echo '<script language="javascript">';
		        echo 'alert("Update Successfully."); location.href="cri_4.1.3_ict_classrooms.php"';
		        echo '</script>';
		    } else 
		    {
		        echo '<script language="javascript">';
		        echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.1.3_ict_classrooms.php"';
		        echo '</script>';
		    }

		    // Close statement
		    mysqli_stmt_close($stmt);
		}
	}	
}
$err = 0;
$department = $room_no = $ict_facility = "";

if(isset($_POST['update']))
{
	// Department Validation

	if(empty(trim($_POST["department"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Select Department."); location.href="cri_4.1.3_ict_classrooms.php"';
        echo '</script>';
	} 
	elseif(empty(trim($_POST["room_no"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Room number or Name."); location.href="cri_4.1.3_ict_classrooms.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["ict_facility"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Type of ICT facility provided."); location.href="cri_4.1.3_ict_classrooms.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$department = trim($_POST["department"]);
			$room_no = trim($_POST["room_no"]);
			$ict_facility = trim($_POST["ict_facility"]);

			$query = "UPDATE cri_4_1_3_classrooms_seminarhalls SET department = ?, room_no = ?, ict_facility = ? WHERE class_id = ?";
    
			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "sssi", $department, $room_no, $ict_facility, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_4.1.3_ict_classrooms.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.1.3_ict_classrooms.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit ICT-enabled Classrooms and Seminar halls.</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
	                    	<label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="form-label" for="department"><span style="color: red">* </span>Department</label>

	                    	<select name="department" class="form-select" id="department">

	                    		<?php
	                    		$sql = "SELECT programme_name,programme_code FROM programme_info";
	                    		$result = $con -> query($sql);

	                    		while($row = $result -> fetch_assoc())
	                    		{
	                    			?>
	                    			<option value="<?php echo $row['programme_code']; ?>">
	                    				<?php
	                    				echo $row['programme_name'];
	                    				?>
	                    			</option>
	                    			<?php
	                    		}

	                    		?>
	                    	</select>
	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "room_no"> <span style="color: red">* </span>Room number or Name</label>

	                        <input type="text" name="room_no" class="form-control" id = "room_no">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "ict_facility"> <span style="color: red">* </span>Type of ICT facility provided</label>

	                        <input type="text" name="ict_facility" class="form-control" id = "ict_facility">

	                    </div>

                        <input type="hidden" name="id" id="id" value="0">

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
							<li class="breadcrumb-item active" aria-current="page">Criteria 4.1</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-building-columns fa-lg"></i>
							<span>Criteria 4.1.3 - Number of classrooms and seminar halls with ICT-enabled facilities.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_4.1.3_ict_classrooms.php" id="active">Classrooms and Seminar Halls</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.1.3_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-building-columns fa-lg"></i>
														<span>Criteria 4.1.3 - ICT-enabled Classrooms and Seminar halls</span>
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
                                                        	<label class="form-label" for="department"><span style="color: red">* </span>Department</label>

	                                                        <select name="department" class="form-select <?php echo (!empty($department_err)) ? 'is-invalid' : ''; ?>" id="department">

	                                                            <option value="">---Select Department---</option>
	                                                                <?php
	                                                                    $sql = "SELECT programme_name,programme_code FROM programme_info";
	                                                                    $result = $con -> query($sql);

	                                                                    while($row = $result -> fetch_assoc())
	                                                                    {
	                                                                        ?>
	                                                                            <option value="<?php echo $row['programme_code']; ?>"

	                                                                                <?php
	                                                                                    if($department == $row['programme_code'])
	                                                                                    {
	                                                                                        echo "selected";
	                                                                                    } 
	                                                                                ?>
	                                                                                >
	                                                                                <?php
	                                                                                    echo $row['programme_name'];
	                                                                                ?>
	                                                                            </option>
	                                                                        <?php
	                                                                    }
	                                                                                                               
	                                                                ?>
	                                                        </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $department_err; ?>
                                                            </span>
                                                        </div>

                                                        <div class="mb-3">
															<label class="form-label" for = "room_no"> <span style="color: red">* </span>Room number or Name</label>
															<input 
															type="text" 
															name="room_no" 
															class="form-control <?php echo (!empty($room_no_err)) ? 'is-invalid' : ''; ?>"
															id = "room_no" 
															value = "<?php echo $room_no; ?>">

															<div class="invalid-feedback">
																<?php echo $room_no_err; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-building-columns fa-lg"></i>
														<span>Criteria 4.1.3 - ICT-enabled Classrooms and Seminar halls</span>
													</div>
													<div class="card-body">
														
														<div class="mb-3">
															<label class="form-label" for = "ict_facility"> <span style="color: red">* </span>Type of ICT facility provided</label>

															<input 
															type="text" 
															name="ict_facility" 
															class="form-control <?php echo (!empty($ict_facility_err)) ? 'is-invalid' : ''; ?>"
															id = "ict_facility" 
															value = "<?php echo $ict_facility; ?>">

															<div class="invalid-feedback">
																<?php echo $ict_facility_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label for="pdf_file" class="form-label"> <span style="color: red">* </span>Document</label>

															<input name = "pdf_file" class="form-control <?php echo (!empty($pdf_file_err)) ? 'is-invalid' : ''; ?>" type="file" id="pdf_file">

															<span class="invalid-feedback">
																<?php echo $pdf_file_err; ?>
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

							$sql = "SELECT csh.class_id, csh.academic_year, csh.room_no, csh.ict_facility, csh.department, pi.programme_name FROM cri_4_1_3_classrooms_seminarhalls AS csh INNER JOIN programme_info as pi ON csh.department = pi.programme_code WHERE csh.upload_by_id = '$upload_by_id' ORDER BY csh.class_id";
							$datas = $con->query($sql);

				            if($datas->num_rows>0)
				            {
				            	?>

				            		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

									<div class="table-responsive">
										<table class="table table-bordered" id="table">
		                        			<thead style="background-color:#057EC5; color:#FFF;">
		                        				<tr align="center">
					                                <th>Sl.No</th>
					                                <th>Academic Year</th>
					                                <th style = 'display:none;'>Department</th>
					                                <th>Department</th>
					                                <th>Room number or Name</th>
					                                <th>Type of ICT facility provided</th>
					                                <th>Update</th>
					                            </tr>
		                        			</thead>
		                        			<tbody class="row_position">
		                        				<?php

						                            $i=0;
						                            while ($data = $datas->fetch_assoc()) 
						                            { 
						                                $i++;
						                        ?>

						                        	<tr style="text-align:center;" id="<?php echo $data['id']?>">
					                                    <th><?php echo $i ?></th>
					                                    <td><?php echo $data['academic_year']; ?></td>
					                                    <td style = 'display:none;'><?php echo $data['department']; ?></td>
					                                    <td><?php echo $data['programme_name']; ?></td>
					                                    <td><?php echo $data['room_no']; ?></td>
					                                    <td><?php echo $data['ict_facility']; ?></td>
					                                    <?php
					                                    echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["class_id"]}><i class = 'fa fa-edit'></i></button></td>";

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
            $('#department').val(data[1]);
            $('#room_no').val(data[3]);
            $('#ict_facility').val(data[4]);
        });
    });

</script>

</body>

</html>
