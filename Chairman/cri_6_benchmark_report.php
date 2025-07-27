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
	<title>Criterion - 6</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 6 - AQAR Benchmark Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen-to-square fa-lg"></i>
							<span>Criterion VI – Governance, Leadership and Management.</span>
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
		                        					<span>Criterion VI - AQAR Benchmark Report.</span>
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
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 6.2 Strategy Development and Deployment </th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_6_choice WHERE academic_year = '$academic_year' and metric = 'Metric 6.2.3'";
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
				                            		<td align="center"><b>6.2.3<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>Institution implements e-governance in its operations</b><br>
				                            			6.2.2.1 e-governance is implemented covering the following areas of operations:<br>
				                            			1. Administration including complaint management<br>
														2. Finance and Accounts<br>
														3. Student Admission and Support<br>
														4. Examinations
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
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 6.3 Faculty Empowerment Strategies</th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            		$sql = "SELECT * FROM cri_6_3_2_financial_support WHERE academic_year = '$academic_year'";

                            						$datas = $con->query($sql);
                            						$count = $datas->num_rows;
                            						if ($count >= 50) {
													    $count_mark = 4;
													} elseif ($count > 40 && $count <= 50) {
													    $count_mark = 3;
													} elseif ($count > 25 && $count <= 40) {
													    $count_mark = 2;
													} elseif ($count > 10 && $count <= 25) {
													    $count_mark = 1;
													} else {
													    $count_mark = 0;
													}

				                            		?>
				                            		<td align="center"><b>6.3.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Percentage of teachers provided financial support to attend conferences/workshops and towards membership fee of professional bodies during the last five years</td>
				                            		<td align="center">
				                            			<b><?php echo $count_mark;?></b><br>
				                            			<?php 
				                            				echo "$count";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=50)</td>
				                            		<td align="center">
				                            			<?php
				                            				$count_deficiencies = 4 - $count_mark;
				                            				$count_deficiencies = $count_deficiencies * 25;
				                            				echo $count_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<?php
				                            		$sql = "SELECT * FROM cri_6_3_4_fdp WHERE academic_year = '$academic_year'";

	                            					$datas = $con->query($sql);
		                                            $fdp_count = $datas->num_rows;

		                                            if ($fdp_count >= 50) {
													    $fdp_count_mark = 4;
													} elseif ($fdp_count > 40 && $fdp_count <= 50) {
													    $fdp_count_mark = 3;
													} elseif ($fdp_count > 25 && $fdp_count <= 40) {
													    $fdp_count_mark = 2;
													} elseif ($fdp_count > 10 && $fdp_count <= 25) {
													    $fdp_count_mark = 1;
													} else {
													    $fdp_count_mark = 0;
													}
				                            		?>
				                            		<td align="center"><b>6.3.3<br>Q<sub>n</sub>M<b></td>
				                            		<td>Percentage of teachers undergoing online/ face-to-face Faculty Development Programmes (FDPs)/ Management Development Programmes (MDPs) during the last five years</td>
				                            		<td align="center">
				                            			<b><?php echo $fdp_count_mark;?></b><br>
				                            			<?php 
				                            				echo "$fdp_count";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=50)</td>
				                            		<td align="center">
				                            			<?php
				                            				$fdp_count_deficiencies = 4 - $fdp_count_mark;
				                            				$fdp_count_deficiencies = $fdp_count_deficiencies * 25;
				                            				echo $fdp_count_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>
				                            	<tr>
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 6.5 Internal Quality Assurance System </th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_6_choice WHERE academic_year = '$academic_year' and metric = 'Metric 6.5.3'";
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
				                            		<td align="center"><b>6.5.3<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>Quality assurance initiatives of the institution include:</b><br>
				                            			1. Regular meeting of Internal Quality Assurance Cell (IQAC); quality improvement initiatives identified and implemented<br>
														2. Academic and Administrative Audit (AAA) and follow-up action taken<br>
														3. Collaborative quality initiatives with other institution(s)<br>
														4. Participation in NIRF and other recognized rankings<br>
														5. Any other quality audit recognized by state, national or international
														agencies<br>
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