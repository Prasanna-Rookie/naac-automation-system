<?php
session_start();
if(!isset($_SESSION['chairman_id']))
{
	header("location: ../index.php");
	exit;
} 
require '../config.php';
$academic_year = $academic_year_err = "";
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
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
	<script type="text/javascript" src="../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../Libraries/fontawesome-6.1.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet/sidebar.css">

	<link rel="icon" type="image/x-icon" href="../images/psna_logo.png">
	<title>Criterion - 4</title>
	<style type="text/css">
		#card-title
		{
			border-bottom: 1px dotted #000000; 
			padding-bottom: 5px; 
			margin-bottom:20px;
			margin-top: 10px; 
			color:#057EC5; 
			font-size:20px;
		}
		p
		{
			font-size: 18px;
		}
		td,th 
		{
			vertical-align: middle;
		}
	</style>
</head>
<body>

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
							<li class="breadcrumb-item active" aria-current="page">Criteria 4 - AQAR Benchmark Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen-to-square fa-lg"></i>
							<span>Criterion IV – Infrastructure and Learning Resources - AQAR Benchmark Report.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->
						<div class = "card-body">

							<?php
							if(empty($academic_year))
							{
								?>
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
													<i class="fa-solid fa-pen-to-square fa-lg"></i>
		                        					<span>Criterion IV - AQAR Benchmark Report.</span>
												</div>
												<div class="card-body">
													<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
														<div class="mb-3">
															<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

															<select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

																<option value="">---Select Academic Year---</option>

																<?php
																	$sql = "SELECT * FROM academic_year ORDER BY academic_year";
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
														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Generate</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							else
							{
								?>
									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
												<tr>
					                                <th style="text-align:center;" width="20">Metric No.</th>
					                                <th style="text-align:center;">Description</th>
					                                <th style="text-align:center;">Marks Obtained in AQAR</th>
					                                <th style="text-align:center;">Benchmark</th>
													<th style="text-align:center;">Deficiencies</th>
				                            	</tr>
											</thead>
											<tbody>
												<tr>
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 4.1 Physical Facilities</th>
				                            	</tr>
				                            	
				                            	<tr>
				                            		<?php

				                            		$expenditure = $expenditure_mark = $expenditure_deficiencies = $stu_com_ration_deficiencies = 0;

				                            		$sql = "SELECT * FROM cri_4_1_4_infrastructure_expenditure WHERE academic_year = '$academic_year'";
				                            		$datas = $con->query($sql);
		                                            if($datas->num_rows>0)
		                                            {
		                                            	while ($data = $datas->fetch_assoc()) 
	                                                	{
	                                                		$expenditure = $data['expenditure'];
	                                                	}
		                                            }

		                                            if ($expenditure >= 35) {
												        $expenditure_mark = 4;
												    } elseif ($expenditure >= 25 && $expenditure < 35) {
												        $expenditure_mark = 3;
												    } elseif ($expenditure >= 15 && $expenditure < 25) {
												        $expenditure_mark = 2;
												    } elseif ($expenditure >= 5 && $expenditure < 15) {
												        $expenditure_mark = 1;
												    } else {
												        $expenditure_mark = 0;
												    }

				                            		?>
				                            		<td align="center"><b>4.1.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Expenditure for infrastructure augmentation, excluding salary, during the year (INR in Lakhs)</td>
				                            		<td align="center">
				                            			<b><?php echo $expenditure_mark;?></b><br>
				                            			<?php 
				                            				echo "$expenditure";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=35)</td>
				                            		<td align="center">
				                            			<?php
				                            				$expenditure_deficiencies = 4 - $expenditure_mark;
				                            				$expenditure_deficiencies = $expenditure_deficiencies * 25;
				                            				echo $expenditure_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 4.2 Library as a Learning Resource</th>
				                            	</tr>
				                            	
				                            	<tr>
				                            		<?php

				                            		 // PHP Code

				                            		?>
				                            		<td align="center"><b>4.2.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Expenditure on purchase of books/ e-books and subscription to journals/e-journals during the year (INR in lakhs)</td>
				                            		<td></td>
				                            		<td align="center">4<br>(>=10)</td>
				                            		<td></td>
				                            	</tr>

				                            	<tr>
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator – 4.3 IT Infrastructure</th>
				                            	</tr>
				                            	
				                            	<tr>
				                            		<?php

				                            		$computer_count = $tot_student = $stu_com_ration_mark =  0;
                            						$sql = "SELECT * FROM cri_4_3_2_computer_ratio WHERE academic_year = '$academic_year'";
                            						$datas = $con->query($sql);
		                                            if($datas->num_rows>0)
		                                            {
		                                                $i = 0;
		                                                while ($data = $datas->fetch_assoc()) 
		                                                { 
		                                                    $computer_count = $computer_count + $data['computer_count'];
		                                                }
		                                            }

		                                             $sql_1 = "SELECT COUNT(*) as student FROM cri_2_2_2_student_details WHERE academic_year = '$academic_year'";

		                                            $datas = $con->query($sql_1);
													if($datas->num_rows>0)
													{
														while ($data = $datas->fetch_assoc())
														{
															$tot_student = $data['student'];
														}
													}

													if($tot_student != 0)
													{
														$stu_com_ration = $tot_student / $computer_count;

														$stu_com_ration = number_format($stu_com_ration, 2);

														$stu_com_rat = $stu_com_ration. " : 1";
													}
													else
													{
														$stu_com_rat = "0 : 0";
													}

													if ($stu_com_ration <= 5) {
												        $stu_com_ration_mark = 4;
												    } elseif ($stu_com_ration > 5 && $stu_com_ration <= 10) {
												        $stu_com_ration_mark = 3;
												    } elseif ($stu_com_ration > 10 && $stu_com_ration <= 15) {
												        $stu_com_ration_mark = 2;
												    } elseif ($stu_com_ration > 15 && $stu_com_ration <= 25) {
												        $stu_com_ration_mark = 1;
												    } else {
												        $stu_com_ration_mark = 0;
												    }

				                            		?>
				                            		<td align="center"><b>4.3.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Student - Computer ratio</td>
				                            		<td align="center">
				                            			<b><?php echo $stu_com_ration_mark;?></b><br>
				                            			<?php 
				                            				echo "$stu_com_rat";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(<=5:1)</td>
				                            		<td align="center">
				                            			<?php
				                            				$stu_com_ration_deficiencies = 4 - $stu_com_ration_mark;
				                            				$stu_com_ration_deficiencies = $stu_com_ration_deficiencies * 25;
				                            				echo $stu_com_ration_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 4.4 Maintenance of Campus Infrastructure </th>
				                            	</tr>
				                            	
				                            	<tr>
				                            		<?php

				                            		 // PHP Code

				                            		?>
				                            		<td align="center"><b>4.4.1<br>Q<sub>n</sub>M<b></td>
				                            		<td>Expenditure incurred on maintenance of physical and academic support facilities, excluding salary component, during the year (INR in lakhs)</td>
				                            		<td></td>
				                            		<td align="center">4<br>(>=30%)</td>
				                            		<td></td>
				                            	</tr>

											</tbody>
										</table>
									</div>


								<?php
							}
							?>
							
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
</body>
</html>