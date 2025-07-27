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
	<title>Criterion - 7</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 7 - AQAR Benchmark Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen-to-square fa-lg"></i>
							<span>Criterion VII – Institutional Values and Best Practices.</span>
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
		                        					<span>Criterion VII - AQAR Benchmark Report.</span>
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
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 7.1 Institutional Values and Social Responsibilities</th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_7_options WHERE academic_year = '$academic_year' and criteria = 'criteria 7.1.2'";
				                            			$res = $con->query($sql);
				                            			if($res->num_rows>0)
														{
															while ($data = $res->fetch_assoc()) 
															{
																$option = $data['choice'];
															}
														}

														if($option == "A")
														{
															$option_mark = 4;
														}
														elseif($option == "B")
														{
															$option_mark = 3;
														}
														elseif($option == "C")
														{
															$option_mark = 2;
														}
														elseif($option == "D")
														{
															$option_mark = 1;
														}
														else
														{
															$option_mark = 0;
														}
				                            		?>
				                            		<td align="center"><b>7.1.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>The Institution has facilities for alternate sources of energy and energy conservation measures </b>
				                            		</td>
				                            		<td align="center">
				                            			<b><?php echo $option_mark;?></b><br>
				                            			<?php 
				                            				echo "$option";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>A</td>
				                            		<td align="center">
				                            			<?php
				                            				$option_deficiencies = 4 - $option_mark;
				                            				$option_deficiencies = $option_deficiencies * 25;
				                            				echo $option_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_7_options WHERE academic_year = '$academic_year' and criteria = 'criteria 7.1.4'";
				                            			$res = $con->query($sql);
				                            			if($res->num_rows>0)
														{
															while ($data = $res->fetch_assoc()) 
															{
																$option = $data['choice'];
															}
														}

														if($option == "A")
														{
															$option_mark = 4;
														}
														elseif($option == "B")
														{
															$option_mark = 3;
														}
														elseif($option == "C")
														{
															$option_mark = 2;
														}
														elseif($option == "D")
														{
															$option_mark = 1;
														}
														else
														{
															$option_mark = 0;
														}
				                            		?>
				                            		<td align="center"><b>7.1.4<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>Water conservation facilities available in the Institution</b>
				                            		</td>
				                            		<td align="center">
				                            			<b><?php echo $option_mark;?></b><br>
				                            			<?php 
				                            				echo "$option";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>A</td>
				                            		<td align="center">
				                            			<?php
				                            				$option_deficiencies = 4 - $option_mark;
				                            				$option_deficiencies = $option_deficiencies * 25;
				                            				echo $option_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_7_options WHERE academic_year = '$academic_year' and criteria = 'criteria 7.1.6'";
				                            			$res = $con->query($sql);
				                            			if($res->num_rows>0)
														{
															while ($data = $res->fetch_assoc()) 
															{
																$option = $data['choice'];
															}
														}

														if($option == "A")
														{
															$option_mark = 4;
														}
														elseif($option == "B")
														{
															$option_mark = 3;
														}
														elseif($option == "C")
														{
															$option_mark = 2;
														}
														elseif($option == "D")
														{
															$option_mark = 1;
														}
														else
														{
															$option_mark = 0;
														}
				                            		?>
				                            		<td align="center"><b>7.1.6<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>Quality audits on environment and energy are regularly undertaken by the institution</b>
				                            		</td>
				                            		<td align="center">
				                            			<b><?php echo $option_mark;?></b><br>
				                            			<?php 
				                            				echo "$option";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>A</td>
				                            		<td align="center">
				                            			<?php
				                            				$option_deficiencies = 4 - $option_mark;
				                            				$option_deficiencies = $option_deficiencies * 25;
				                            				echo $option_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_7_options WHERE academic_year = '$academic_year' and criteria = 'criteria 7.1.10'";
				                            			$res = $con->query($sql);
				                            			if($res->num_rows>0)
														{
															while ($data = $res->fetch_assoc()) 
															{
																$option = $data['choice'];
															}
														}

														if($option == "A")
														{
															$option_mark = 4;
														}
														elseif($option == "B")
														{
															$option_mark = 3;
														}
														elseif($option == "C")
														{
															$option_mark = 2;
														}
														elseif($option == "D")
														{
															$option_mark = 1;
														}
														else
														{
															$option_mark = 0;
														}
				                            		?>
				                            		<td align="center"><b>7.1.10<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>The Institution has a prescribed code of conduct for students, teachers,administrators and other staff and conducts periodic programmes in this regard.</b>
				                            		</td>
				                            		<td align="center">
				                            			<b><?php echo $option_mark;?></b><br>
				                            			<?php 
				                            				echo "$option";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>A</td>
				                            		<td align="center">
				                            			<?php
				                            				$option_deficiencies = 4 - $option_mark;
				                            				$option_deficiencies = $option_deficiencies * 25;
				                            				echo $option_deficiencies . " %";
				                            			?>
				                            		</td>
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