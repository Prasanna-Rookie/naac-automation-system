<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
} 
require '../../config.php';
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
	<link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
	<script type="text/javascript" src="../../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../Libraries/fontawesome-6.1.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="../../stylesheet/sidebar.css">

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 6 - AQAR Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
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
													<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
		                        					<span>Criterion VI - AQAR Report.</span>
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
								$cri_6_1_1_writeup = $cri_6_1_2_writeup = $cri_6_2_1_writeup = $cri_6_2_2_writeup = $cri_6_3_1_writeup = $cri_6_4_1_writeup = $cri_6_4_3_writeup = $cri_6_5_1_writeup = $cri_6_5_2_writeup = "Please updated Write Up for this Metric.";
								?>
								<h3 class="card-title" id="card-title">Key Indicator - 6.1 Institutional Vision and Leadership</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 6.1 Institutional Vision and Leadership</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 

                        					$sql_1 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.1.1'";
											$datas = $con->query($sql_1);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_1_1_writeup = $data['write_up'];
											    }
											}

											$sql_2 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.1.2'";
											$datas = $con->query($sql_2);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_1_2_writeup = $data['write_up'];
											    }
											}

                        					?>
                        					<tr>
                        						<td align="center"><b>6.1.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>The governance of the institution is reflective of an effective leadership in tune with the vision and mission of the Institution</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_1_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>6.1.2<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Effective leadership is reflected in various institutional practices such as decentralization and participative management</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_1_2_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>
                        					
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 6.2 Strategy Development and Deployment</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 6.2 Strategy Development and Deployment</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 
                        					$sql_3 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.2.1'";
											$datas = $con->query($sql_3);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_2_1_writeup = $data['write_up'];
											    }
											}

											$sql_4 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.2.2'";
											$datas = $con->query($sql_4);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_2_2_writeup = $data['write_up'];
											    }
											}

                        					$sql_5 = "SELECT choice FROM cri_6_choice WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_5);

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
											    	$option_1 = "B. Any three of the above";
											    }
											    elseif($dboption == "C")
											    {
											    	$option_1 = "C. Any two of the above";
											    }
											    elseif($dboption == "D")
											    {
											    	$option_1 = "D. Any one of the above";
											    }
											    else
											    {
											    	$option_1 = "E. None of the above";
											    }
											}
                        					?>
                        					
                        					<tr>
                        						<td align="center"><b>6.2.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>The institutional Strategic/ Perspective plan has been clearly articulated and implemented</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_2_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>6.2.2<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>The functioning of the various institutional bodies is effective and efficient as visible from the policies, administrative set-up, appointment and service rules, procedures, etc.</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_2_2_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>6.2.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Implementation of e-governance in areas of operation:</b><br>
													1. Administration<br>
													2. Finance and Accounts<br>
													3. Student Admission and Support<br>
													4. Examination<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 6.3 Faculty Empowerment Strategies</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 6.3 Faculty Empowerment Strategies</th>
				                            </tr>
                        				</thead>
                        				<tbody>
                        					<?php 
                        					$sql_6 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.3.1'";
											$datas = $con->query($sql_6);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_3_1_writeup = $data['write_up'];
											    }
											}
                        					?>
                        					<tr>
                        						<td align="center"><b>6.3.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>The institution has effective welfare measures for teaching and non-teaching staff and avenues for their career development/ progression</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_3_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>
                        					<?php
                        					$teacher_count = 0;
                        					$sql_7 = "SELECT COUNT(*) AS teacher_count FROM cri_6_3_2_financial_support WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_7);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $teacher_count = $data['teacher_count'];
											    }
											}  
                        					?>
                        					<tr>
                        						<td align="center"><b>6.3.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of teachers provided with financial support to attend conferences / workshops and towards payment of membership fee of professional bodies during the year</b></p>

                        							<p>Number of teachers provided with financial support : 

							                        <b><?php echo $teacher_count; ?></b></p>

                        						</td>
                        					</tr>
                        					<?php
                        					$training_programmes = 0;
                        					$sql_8 = "SELECT COUNT(*) AS training_programmes FROM cri_6_3_3_training_programmes WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_8);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $training_programmes = $data['training_programmes'];
											    }
											}  
                        					?>
                        					<tr>
                        						<td align="center"><b>6.3.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of professional development / administrative training programmes organized by the Institution for its teaching and non-teaching staff during the year</b></p>

                        							<p>Number of professional development / administrative training programmes organized : 

							                        <b><?php echo $training_programmes; ?></b></p>
                        						</td>
                        					</tr>
                        					<?php
                        					$fdp_count = 0;
                        					$sql_9 = "SELECT COUNT(*) AS fdp_count FROM cri_6_3_4_fdp WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_9);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $fdp_count = $data['fdp_count'];
											    }
											}  
                        					?>
                        					<tr>
                        						<td align="center"><b>6.3.4<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of teachers who have undergone online/ face-to-face Faculty Development Programmes during the year</b></p>

                        							<p>Number of teachers who have undergone online/ face-to-face Faculty Development Programmes : 

							                        <b><?php echo $fdp_count; ?></b></p>
                        						</td>
                        					</tr>
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator – 6.4 Financial Management and Resource Mobilization</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator – 6.4 Financial Management and Resource Mobilization</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 
                        					$sql_10 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.4.1'";
											$datas = $con->query($sql_10);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_4_1_writeup = $data['write_up'];
											    }
											}
                        					?>
                        					
                        					<tr>
                        						<td align="center"><b>6.4.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Institution conducts internal and external financial audits regularly</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_4_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>
                        					<?php
                        						$total_funds = 0;
	                        					$sql_11 = "SELECT SUM(funds) AS total_funds FROM cri_6_4_2_funds_non_government WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_11);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_funds = $data['total_funds'];
												    }
												}  
	                        					?>
                        					<tr>
                        						<td align="center"><b>6.4.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Funds / Grants received from non-government bodies, individuals, and philanthropists during the year (not covered in Criterion III and V) (INR in lakhs)</b></p>

                        							<p>Funds / Grants received from non-government bodies, individuals, and philanthropists : 

							                        <b><?php echo $total_funds; ?></b></p>
                        						</td>
                        					</tr>
                        					<?php 
                        					$sql_12 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.4.3'";
											$datas = $con->query($sql_12);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_4_3_writeup = $data['write_up'];
											    }
											}
                        					?>
                        					<tr>
                        						<td align="center"><b>6.4.3<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Institutional strategies for mobilisation of funds and the optimal utilisation of resources</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_4_3_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>
                        				</tbody>
									</table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 6.5 Internal Quality Assurance System</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 6.5 Internal Quality Assurance System</th>
				                            </tr>
                        				</thead>
                        				<tbody>
                        					<?php 
                        					$sql_12 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.5.1'";
											$datas = $con->query($sql_12);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_5_1_writeup = $data['write_up'];
											    }
											}
                        					?>
                        					<tr>
                        						<td align="center"><b>6.5.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Internal Quality Assurance Cell (IQAC) has contributed significantly for institutionalizing quality assurance strategies and processes visible in terms of incremental improvements made during the preceding year with regard to quality (incase of the First Cycle)</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_5_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<?php 
                        					$sql_12 = "SELECT write_up FROM cri_6_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 6.5.2'";
											$datas = $con->query($sql_12);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_6_5_2_writeup = $data['write_up'];
											    }
											}
                        					?>

                        					<tr>
                        						<td align="center"><b>6.5.2<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>The institution reviews its teaching-learning process, structures and methodologies of operation and learning outcomes at periodic intervals through its IQAC as per norms</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_6_5_2_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<?php 

                        					$sql_13 = "SELECT choice FROM cri_6_choice WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_13);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $dboption = $data['choice'];
											    }

											    if($dboption == "A")
											    {
											    	$option_2 = "A. Any 4 or all of the above";
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
                        						<td align="center"><b>6.4.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Quality assurance initiatives of the institution include:</b><br>1. Regular meeting of the IQAC<br>2. Feedback collected, analysed and used for improvement of the institution<br>3. Collaborative quality initiatives with other institution(s)<br>4. Participation in NIRF<br>5. Any other quality audit recognized by state, national or international agencies (such as ISO Certification)</p>

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