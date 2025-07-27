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
							<li class="breadcrumb-item active" aria-current="page">Criteria 5 - AQAR Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
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
													<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
		                        					<span>Criterion V - AQAR Report.</span>
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
								<h3 class="card-title" id="card-title">Key Indicator - 5.1 Student Support</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 5.1 Student Support</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 

                        					$total_students_gov = 0;

                        					$sql_1 = "SELECT SUM(no_students) AS total_students FROM cri_5_1_1_scholarships WHERE academic_year = '$academic_year' and type = 'Government'";
											$datas = $con->query($sql_1);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_students_gov = $data['total_students'];
											    }
											}

                        					?>
                        					<tr>
                        						<td align="center"><b>5.1.1<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of students benefitted by scholarships and freeships provided by the Government during the year</b></p>

                        							<p>Number of students benefitted by scholarships and freeships : 

							                        <b><?php echo $total_students_gov; ?></b></p>
                        						</td>
                        					</tr>

                        					<?php

                        					$total_students_non_gov = 0;

                        					$sql_2 = "SELECT SUM(no_students) AS total_students FROM cri_5_1_1_scholarships WHERE academic_year = '$academic_year' and type != 'Government'";
											$datas = $con->query($sql_2);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_students_non_gov = $data['total_students'];
											    }
											}

                        					?>

                        					<tr>
                        						<td align="center"><b>5.1.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of students benefitted by scholarships and freeships provided by the institution and non-government agencies during the year</b></p>

                        							<p>Number of students benefitted by scholarships and freeships : 

							                        <b><?php echo $total_students_non_gov; ?></b></p>
                        						</td>
                        					</tr>

                        					<?php 

                        					$option_1 = "";

                        					$sql_3 = "SELECT choice FROM cri_5_choice WHERE academic_year = '$academic_year' and metric = 'Metric 5.1.3'";

											$datas = $con->query($sql_3);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $dboption = $data['choice'];
											    }

											    if($dboption == "A")
											    {
											    	$option_1 = "A. All of the above";
											    }
											    elseif($dboption == "B")
											    {
											    	$option_1 = "B. Any 3 of the above";
											    }
											    elseif($dboption == "C")
											    {
											    	$option_1 = "C. Any 2 of the above";
											    }
											    elseif($dboption == "D")
											    {
											    	$option_1 = "D. Any 1 of the above";
											    }
											    else
											    {
											    	$option_1 = "E. None of the above";
											    }
											}

                        					?>

                        					<tr>
                        						<td align="center"><b>5.1.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>The following Capacity Development and Skill Enhancement activities are organised for improving students’ capabilities:</b><br>
													1. Soft Skills<br>
													2. Language and Communication Skills<br>
													3. Life Skills (Yoga, Physical fitness, Health and Hygiene)<br>
													4. Awareness of Trends in Technology<br>
													</p>

													<p>Option : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>

                        					<?php

                        					$total_students_benefitted = 0;

                        					$sql_4 = "SELECT SUM(no_students) AS total_students FROM cri_5_1_3_capacity_development WHERE academic_year = '$academic_year'";
											$datas = $con->query($sql_4);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_students_benefitted = $data['total_students'];
											    }
											}

                        					?>

                        					<tr>
                        						<td align="center"><b>5.1.4<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of students benefitted from guidance/coaching for competitive examinations and career counselling offered by the institution during the year</b></p>

                        							<p>Number of students benefitted from guidance/coaching for competitive examinations and career counselling offered : 

							                        <b><?php echo $total_students_benefitted; ?></b></p>
                        						</td>
                        					</tr>

                        					<?php 

                        					$option_2 = "";

                        					$sql_5 = "SELECT choice FROM cri_5_choice WHERE academic_year = '$academic_year' and metric = 'Metric 5.1.5'";

											$datas = $con->query($sql_5);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $dboption = $data['choice'];
											    }

											    if($dboption == "A")
											    {
											    	$option_2 = "A. All of the above";
											    }
											    elseif($dboption == "B")
											    {
											    	$option_2 = "B. Any 3 of the above";
											    }
											    elseif($dboption == "C")
											    {
											    	$option_2 = "C. Any 2 of the above";
											    }
											    elseif($dboption == "D")
											    {
											    	$option_2 = "D. Any 1 of the above";
											    }
											    else
											    {
											    	$option_2 = "E. None of the above";
											    }
											}

                        					?>

                        					<tr>
                        						<td align="center"><b>5.1.5<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>The institution adopts the following mechanism for redressal of students’ grievances, including sexual harassment and ragging:</b><br>
													1. Implementation of guidelines of statutory/regulatory bodies<br>
													2. Creating awareness and implementation of policies with zero tolerance<br>
													3. Mechanism for submission of online/offline students’ grievances<br>
													4. Timely redressal of grievances through appropriate committees<br>
													</p>

													<p>Option : 

							                        <b><?php echo $option_2; ?></b></p>
                        						</td>
                        					</tr>
                        					
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 5.2 Student Progression</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 5.2 Student Progression</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 
                        					$placement_count = 0;
                        					$sql_6 = "SELECT COUNT(*) AS placement_count FROM cri_5_1_5_placement WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_6);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $placement_count = $data['placement_count'];
											    }
											} 
                        					?>
                        					
                        					<tr>
                        						<td align="center"><b>5.2.1<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of outgoing students who got placement during the year</b></p>

                        							<p>Number of outgoing students who got placement : 

							                        <b><?php echo $placement_count; ?></b></p>
                        						</td>
                        					</tr>

                        					<?php 
                        					$higher_education_count = 0;
                        					$sql_7 = "SELECT COUNT(*) AS higher_education_count FROM cri_5_2_2_higher_education WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_7);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $higher_education_count = $data['higher_education_count'];
											    }
											} 
                        					?>

                        					<tr>
                        						<td align="center"><b>5.2.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of outgoing students progressing to higher education during the year</b></p>

                        							<p>Number of outgoing students progressing to higher education : 

							                        <b><?php echo $higher_education_count; ?></b></p>
                        						</td>
                        					</tr>

                        					<?php 
                        					$qualified_count = 0;
                        					$sql_8 = "SELECT COUNT(*) AS qualified_count FROM cri_5_2_3_examinations WHERE academic_year = '$academic_year' and selected_appeared = 'Appeared & Selected / Qualified'";

											$datas = $con->query($sql_8);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $qualified_count = $data['qualified_count'];
											    }
											} 
                        					?>

                        					<tr>
                        						<td align="center"><b>5.2.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of students qualifying in state/ national/ international level examinations during the year</b></p>

													<p>Number of students qualifying in state/ national/ international level examinations : 

							                        <b><?php echo $qualified_count; ?></b></p>
                        						</td>
                        					</tr>
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 5.3 Student Participation and Activities</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 5.3 Student Participation and Activities</th>
				                            </tr>
                        				</thead>
                        				<tbody>
                        					<?php 
                        					$awards_count = 0;
                        					$sql_9 = "SELECT COUNT(*) AS awards_count FROM cri_5_3_1_awards_medals WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_9);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $awards_count = $data['awards_count'];
											    }
											} 
                        					?>
                        					<tr>
                        						<td align="center"><b>5.3.1<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of awards/medals for outstanding performance in sports and/or cultural activities at inter-university / state /national / international events (award for a team event should be counted as one) during the year</b></p>

                        							<p>Number of awards/medals : 

							                        <b><?php echo $awards_count; ?></b></p>
                        						</td>
                        					</tr>
                        					<?php 

                        					$cri_5_3_2_writeup = "Please updated Write Up for this Metric.";
                        					$sql_10 = "SELECT write_up FROM cri_5_write_up WHERE academic_year = '$academic_year' AND criteria = 'Metric 5.3.2'";
											$datas = $con->query($sql_10);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_5_3_2_writeup = $data['write_up'];
											    }
											}
                        					?>
                        					<tr>
                        						<td align="center"><b>5.3.2<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Presence of an active Student Council and representation of students in academic and administrative bodies/committees of the institution</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_5_3_2_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>

                        						</td>
                        					</tr>
                        					<?php
                        					$cultural_count = 0;
                        					$sql_11 = "SELECT COUNT(*) AS cultural_count FROM cri_5_3_3_events WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_11);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cultural_count = $data['cultural_count'];
											    }
											}  
                        					?>
                        					<tr>
                        						<td align="center"><b>5.3.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of sports and cultural events / competitions organised by the institution</b></p>

                        							<p>Number of sports and cultural events / competitions organised : 

							                        <b><?php echo $cultural_count; ?></b></p>
                        						</td>
                        					</tr>
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 5.4 Alumni Engagement</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 5.4 Alumni Engagement</th>
				                            </tr>
                        				</thead>
                        				<tbody>
                        					<?php 
                        					$cri_5_4_1_writeup = "Please updated Write Up for this Metric.";
                        					$sql_12 = "SELECT write_up FROM cri_5_write_up WHERE academic_year = '$academic_year' AND criteria = 'Metric 5.4.1'";
											$datas = $con->query($sql_12);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_5_4_1_writeup = $data['write_up'];
											    }
											}
                        					?>
                        					<tr>
                        						<td align="center"><b>5.4.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>The Alumni Association and its Chapters (registered and functional) contribute significantly to the development of the institution through financial and other support services</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_5_4_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<?php 

                        					$sql_13 = "SELECT choice FROM cri_5_choice WHERE academic_year = '$academic_year' and metric = 'Metric 5.4.1'";

											$datas = $con->query($sql_13);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $dboption = $data['choice'];
											    }

											    if($dboption == "A")
											    {
											    	$option_2 = "A. ≥ 15 Lakhs";
											    }
											    elseif($dboption == "B")
											    {
											    	$option_2 = "B. 10 Lakhs - 15 Lakhs";
											    }
											    elseif($dboption == "C")
											    {
											    	$option_2 = "C. 5 Lakhs - 10 Lakhs";
											    }
											    elseif($dboption == "D")
											    {
											    	$option_2 = "D. 2 Lakhs - 5 Lakhs";
											    }
											    else
											    {
											    	$option_2 = "E. <2 Lakhs";
											    }
											}
                        					?>

                        					<tr>
                        						<td align="center"><b>5.4.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Alumni’s financial contribution during the year:</b><br>
                        							A. ≥ 15 Lakhs<br>
													B. 10 Lakhs - 15 Lakhs<br>
													C. 5 Lakhs - 10 Lakhs Choose any one<br>
													D. 2 Lakhs - 5 Lakhs<br>
													E. <2 Lakhs<br>
                        							</p>

                        							<p>Options : 

							                        <b><?php echo $option_2; ?></b></p>
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