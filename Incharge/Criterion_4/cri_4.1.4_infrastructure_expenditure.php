<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $budget_allocated = $budget_allocated_err = $expenditure = $expenditure_err = $tot_expenditure = $tot_expenditure_err = $maintenace_aca_fac = $maintenace_aca_fac_err = $maintenance_phy_fac = $maintenance_phy_fac_err = "";
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
		$academic_year_t = $_POST["academic_year"];
       	$query = "SELECT * FROM cri_4_1_4_infrastructure_expenditure WHERE academic_year = '$academic_year_t'";
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

	// Budget Allocated Validation

	if(empty(trim($_POST["budget_allocated"])))
	{
		$budget_allocated_err = "Please Enter Budget Allocated.";
	}
	elseif (!is_numeric(trim($_POST["budget_allocated"]))) 
	{
    	$budget_allocated_err = "Please Enter a valid number for Budget Allocated.";
	}
	else
	{
		$budget_allocated = trim($_POST["budget_allocated"]);
	}

	// Expenditure Validation

	if(empty(trim($_POST["expenditure"])))
	{
		$expenditure_err = "Please Enter Expenditure.";
	}
	elseif (!is_numeric(trim($_POST["expenditure"]))) 
	{
    	$expenditure_err = "Please Enter a valid number for Expenditure.";
	}
	else
	{
		$expenditure = trim($_POST["expenditure"]);
	}

	// Total Expenditure Validation

	if(empty(trim($_POST["tot_expenditure"])))
	{
		$tot_expenditure_err = "Please Enter Total Expenditure.";
	}
	elseif (!is_numeric(trim($_POST["tot_expenditure"]))) 
	{
    	$tot_expenditure_err = "Please Enter a valid number for Total Expenditure.";
	}
	else
	{
		$tot_expenditure = trim($_POST["tot_expenditure"]);
	}

	// Expenditure on maintenace of academic facilities Validation

	if(empty(trim($_POST["maintenace_aca_fac"])))
	{
		$maintenace_aca_fac_err = "Please Enter Expenditure on maintenace of academic facilities.";
	}
	elseif (!is_numeric(trim($_POST["maintenace_aca_fac"]))) 
	{
    	$maintenace_aca_fac_err = "Please Enter a valid number for Expenditure on maintenace of academic facilities.";
	}
	else
	{
		$maintenace_aca_fac = trim($_POST["maintenace_aca_fac"]);
	}

	// Expenditure on maintenace of academic physical facilities

	if(empty(trim($_POST["maintenance_phy_fac"])))
	{
		$maintenance_phy_fac_err = "Please Enter Expenditure on maintenance of physical facilities.";
	}
	elseif (!is_numeric(trim($_POST["maintenance_phy_fac"]))) 
	{
    	$maintenance_phy_fac_err = "Please Enter a valid number for Expenditure on maintenance of physical facilities.";
	}
	else
	{
		$maintenance_phy_fac = trim($_POST["maintenance_phy_fac"]);
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
	if(empty($academic_year_err) && empty($budget_allocated_err) && empty($expenditure_err) && empty($tot_expenditure_err) && empty($maintenace_aca_fac_err) && empty($maintenance_phy_fac_err))
	{
		if(move_uploaded_file($pdf_file_pdf_tem_loc, $pdf_file_upload_location))
		{
			// Prepare the SQL statement
		    $query = "INSERT INTO cri_4_1_4_infrastructure_expenditure (academic_year, upload_by_id, upload_by_name, budget_allocated, expenditure, tot_expenditure, maintenace_aca_fac, maintenance_phy_fac, doc_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    
		    // Prepare the statement
		    $stmt = mysqli_prepare($con, $query);
		    
		    // Bind parameters
		    mysqli_stmt_bind_param($stmt, "sisddddds", $academic_year, $upload_by_id, $upload_by_name, $budget_allocated, $expenditure, $tot_expenditure, $maintenace_aca_fac, $maintenance_phy_fac, $pdf_file_name);
		    
		    // Execute the statement
		    if(mysqli_stmt_execute($stmt)) 
		    {
		        echo '<script language="javascript">';
		        echo 'alert("Update Successfully."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
		        echo '</script>';
		    } 
		    else 
		    {
		        echo '<script language="javascript">';
		        echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
		        echo '</script>'; 
		    }

		    // Close statement
		    mysqli_stmt_close($stmt);
		}
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$academic_year = $budget_allocated = $expenditure = $tot_expenditure = $maintenace_aca_fac = $maintenance_phy_fac = "";

	if(empty(trim($_POST["budget_allocated"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Budget Allocated."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["expenditure"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Expenditure."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["tot_expenditure"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Total Expenditure."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["maintenace_aca_fac"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Expenditure on maintenace of academic facilities."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
        echo '</script>';
	}
	elseif(empty(trim($_POST["maintenance_phy_fac"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Enter Expenditure on maintenance of physical facilities."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
        echo '</script>';
	}
	elseif(!is_numeric(trim($_POST["budget_allocated"])) || !is_numeric(trim($_POST["expenditure"])) || !is_numeric(trim($_POST["tot_expenditure"])) || !is_numeric(trim($_POST["maintenace_aca_fac"])) || !is_numeric(trim($_POST["maintenance_phy_fac"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Invalid Data."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$budget_allocated = $_POST['budget_allocated'];
			$expenditure = $_POST['expenditure'];
			$tot_expenditure = $_POST['tot_expenditure'];
			$maintenace_aca_fac = $_POST['maintenace_aca_fac'];
			$maintenance_phy_fac = $_POST['maintenance_phy_fac'];

			// Prepare the SQL statement
			$query = "UPDATE cri_4_1_4_infrastructure_expenditure SET budget_allocated = ?, expenditure = ?, tot_expenditure = ?, maintenace_aca_fac = ?, maintenance_phy_fac = ? WHERE exp_id = ?";
			    
			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "dddddi", $budget_allocated, $expenditure, $tot_expenditure, $maintenace_aca_fac, $maintenance_phy_fac, $id);

			// Execute the statement
			if(mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_4.1.4_infrastructure_expenditure.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Expenditure for Infrastructure Augmentation.</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "budget_allocated"> <span style="color: red">* </span>Budget allocated for infrastructure augmentation</label>

	                        <input type="text" name="budget_allocated" class="form-control" id = "budget_allocated">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "expenditure"> <span style="color: red">* </span>Expenditure for infrastructure augmentation</label>

	                        <input type="text" name="expenditure" class="form-control" id = "expenditure">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "tot_expenditure"> <span style="color: red">* </span>Total expenditure excluding Salary</label>

	                        <input type="text" name="tot_expenditure" class="form-control" id = "tot_expenditure">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "maintenace_aca_fac"> <span style="color: red">* </span>Expenditure on maintenace of academic facilities</label>

	                        <input type="text" name="maintenace_aca_fac" class="form-control" id = "maintenace_aca_fac">

	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label" for = "maintenance_phy_fac"> <span style="color: red">* </span>Expenditure on maintenance of physical facilities</label>

	                        <input type="text" name="maintenance_phy_fac" class="form-control" id = "maintenance_phy_fac">

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
							<span>Criteria 4.1.4 - Expenditure for infrastructure augmentation, excluding salary, during the year (INR in Lakhs).</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_4.1.4_infrastructure_expenditure.php" id="active">Expenditure for infrastructure</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.1.4_doc_view.php" id="non-active">View Document</a>
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
														<span>Criteria 4.1.4 - Expenditure for Infrastructure Augmentation</span>
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
															<label class="form-label" for = "budget_allocated"> <span style="color: red">* </span>Budget allocated for infrastructure augmentation</label>
															<input 
															type="text" 
															name="budget_allocated" 
															class="form-control <?php echo (!empty($budget_allocated_err)) ? 'is-invalid' : ''; ?>"
															id = "budget_allocated" 
															value = "<?php echo $budget_allocated; ?>">

															<div class="invalid-feedback">
																<?php echo $budget_allocated_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "expenditure"> <span style="color: red">* </span>Expenditure for infrastructure augmentation</label>
															<input 
															type="text" 
															name="expenditure" 
															class="form-control <?php echo (!empty($expenditure_err)) ? 'is-invalid' : ''; ?>"
															id = "expenditure" 
															value = "<?php echo $expenditure; ?>">

															<div class="invalid-feedback">
																<?php echo $expenditure_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "tot_expenditure"> <span style="color: red">* </span>Total expenditure excluding Salary</label>
															<input 
															type="text" 
															name="tot_expenditure" 
															class="form-control <?php echo (!empty($tot_expenditure_err)) ? 'is-invalid' : ''; ?>"
															id = "tot_expenditure" 
															value = "<?php echo $tot_expenditure; ?>">

															<div class="invalid-feedback">
																<?php echo $tot_expenditure_err; ?>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-building-columns fa-lg"></i>
														<span>Criteria 4.1.4 - Expenditure for Infrastructure Augmentation</span>
													</div>
													<div class="card-body">
														
														<div class="mb-3">
															<label class="form-label" for = "maintenace_aca_fac"> <span style="color: red">* </span>Expenditure on maintenace of academic facilities</label>

															<input 
															type="text" 
															name="maintenace_aca_fac" 
															class="form-control <?php echo (!empty($maintenace_aca_fac_err)) ? 'is-invalid' : ''; ?>"
															id = "maintenace_aca_fac" 
															value = "<?php echo $maintenace_aca_fac; ?>">

															<div class="invalid-feedback">
																<?php echo $maintenace_aca_fac_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "maintenance_phy_fac"> <span style="color: red">* </span>Expenditure on maintenance of physical facilities</label>
															<input 
															type="text" 
															name="maintenance_phy_fac" 
															class="form-control <?php echo (!empty($maintenance_phy_fac_err)) ? 'is-invalid' : ''; ?>"
															id = "maintenance_phy_fac" 
															value = "<?php echo $maintenance_phy_fac; ?>">

															<div class="invalid-feedback">
																<?php echo $maintenance_phy_fac_err; ?>
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
							$sql = "SELECT * FROM cri_4_1_4_infrastructure_expenditure WHERE upload_by_id = '$upload_by_id'";
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
					                                <th>Budget allocated for infrastructure augmentation</th>
					                                <th>Expenditure for infrastructure augmentation</th>
					                                <th>Total expenditure excluding Salary</th>
					                                <th>Expenditure on maintenace of academic facilities</th>
					                                <th>Expenditure on maintenance of physical facilities</th>
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
					                                    <td><?php echo $data['budget_allocated']; ?></td>
					                                    <td><?php echo $data['expenditure']; ?></td>
					                                    <td><?php echo $data['tot_expenditure']; ?></td>
					                                    <td><?php echo $data['maintenace_aca_fac']; ?></td>
					                                    <td><?php echo $data['maintenance_phy_fac']; ?></td>
					                                    <?php
					                                    echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["exp_id"]}><i class = 'fa fa-edit'></i></button></td>";

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
            $('#budget_allocated').val(data[1]);
            $('#expenditure').val(data[2]);
            $('#tot_expenditure').val(data[3]);
            $('#maintenace_aca_fac').val(data[4]);
            $('#maintenance_phy_fac').val(data[5]);
        });
    });

</script>

</body>

</html>
