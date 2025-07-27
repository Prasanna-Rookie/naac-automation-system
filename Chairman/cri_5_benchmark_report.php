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
	<link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
	<script type="text/javascript" src="../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../Libraries/fontawesome-6.1.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet/sidebar.css">

	<link rel="icon" type="image/x-icon" href="../images/psna_logo.png">
	<title>Criterion - 5</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 5 - AQAR Benchmark Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen-to-square fa-lg"></i>
							<span>Criterion V - Student Support and Progression.</span>
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
		                        					<span>Criterion V - Student Support and Progression.</span>
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
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 5.1 Student Support</th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_5_choice WHERE academic_year = '$academic_year' and metric = 'Metric 5.1.3'";
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
				                            		<td align="center"><b>5.1.3<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>Following capacity development and skills enhancement activities are organised for improving students’ capability</b>
				                            			<br>
				                            			1. Soft skills<br>
														2. Language and communication skills<br>
														3. Life skills (Yoga, physical fitness, health and hygiene, selfemployment and entrepreneurial skills)<br>
														4. Awareness of trends in technology<br>

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
				                            			$sql = "SELECT * FROM cri_5_choice WHERE academic_year = '$academic_year' and metric = 'Metric 5.1.5'";
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
				                            		<td align="center"><b>5.1.5<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>The institution adopts the following for redressal of student grievances including sexual harassment and ragging cases</b>
				                            			<br>
				                            			1. Implementation of guidelines of statutory/regulatory bodies<br>
														2. Organisation wide awareness and undertakings on policies with zero
														tolerance<br>
														3. Mechanisms for submission of online/offline students’ grievances<br>
														4. Timely redressal of the grievances through appropriate committees<br>

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
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 5.3 Student Participation and Activities</th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            		$sql = "SELECT * FROM cri_5_3_1_awards_medals WHERE academic_year = '$academic_year'";

                            						$datas = $con->query($sql);
                            						$count = $datas->num_rows;
                            						if ($count >= 10) {
													    $count_mark = 4;
													} elseif ($count > 8 && $count <= 10) {
													    $count_mark = 3;
													} elseif ($count > 4 && $count <= 8) {
													    $count_mark = 2;
													} elseif ($count >= 1 && $count <= 4) {
													    $count_mark = 1;
													} else {
													    $count_mark = 0;
													}

				                            		?>
				                            		<td align="center"><b>5.3.1<br>Q<sub>n</sub>M<b></td>
				                            		<td>Number of awards/medals for outstanding performance in sports/cultural activities at inter-university / state /national / international events during the years</td>
				                            		<td align="center">
				                            			<b><?php echo $count_mark;?></b><br>
				                            			<?php 
				                            				echo "$count";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=10)</td>
				                            		<td align="center">
				                            			<?php
				                            				$count_deficiencies = 4 - $count_mark;
				                            				$count_deficiencies = $count_deficiencies * 25;
				                            				echo $count_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>
				                            	<tr>
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 5.4 Alumni Engagement</th>
				                            	</tr>
				                            	<tr>
				                            		<?php 
				                            			$sql = "SELECT * FROM cri_5_choice WHERE academic_year = '$academic_year' and metric = 'Metric 5.4.2'";
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
				                            		<td align="center"><b>5.4.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>
				                            			<b>Alumni contribution during the last five years (INR in lakhs) to the institution through registered Alumni association:</b><br>
				                            			A. ≥ 15 Lakhs<br>
														B. 10 Lakhs - 15 Lakhs<br>
														C. 5 Lakhs - 10 Lakhs Choose any one<br>
														D. 2 Lakhs - 5 Lakhs<br>
														E. <2 Lakhs<br>
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