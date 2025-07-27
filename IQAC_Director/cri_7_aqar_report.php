<?php
session_start();
if(!isset($_SESSION['dir_id']))
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 7 - AQAR Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
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
													<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
		                        					<span>Criterion VII - AQAR Report.</span>
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
								$cri_7_1_1_writeup  = $cri_7_1_3_writeup = $cri_7_1_8_writeup = $cri_7_1_9_writeup = $cri_7_1_11_writeup = $cri_7_3_1_writeup  = "Please updated Write Up for this Metric.";
								?>
								<h3 class="card-title" id="card-title">Key Indicator - 7.1 Institutional Values and Social Responsibilities</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 7.1 Institutional Values and Social Responsibilities</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 

                        					$sql_1 = "SELECT write_up FROM cri_7_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 7.1.1'";
											$datas = $con->query($sql_1);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_7_1_1_writeup = $data['write_up'];
											    }
											}

											$sql_2 = "SELECT choice FROM cri_7_options WHERE academic_year = '$academic_year' AND criteria = 'criteria 7.1.2'";

											$datas = $con->query($sql_2);

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

											$sql_3 = "SELECT write_up FROM cri_7_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 7.1.3'";
											$datas = $con->query($sql_1);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_7_1_1_writeup = $data['write_up'];
											    }
											}

											$sql_4 = "SELECT choice FROM cri_7_options WHERE academic_year = '$academic_year' AND criteria = 'criteria 7.1.4'";

											$datas = $con->query($sql_4);

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

											$sql_5 = "SELECT choice FROM cri_7_options WHERE academic_year = '$academic_year' AND criteria = 'criteria 7.1.5'";

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

											$sql_6 = "SELECT choice FROM cri_7_options WHERE academic_year = '$academic_year' AND criteria = 'criteria 7.1.6'";

											$datas = $con->query($sql_6);

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

											$sql_7 = "SELECT choice FROM cri_7_options WHERE academic_year = '$academic_year' AND criteria = 'criteria 7.1.7'";

											$datas = $con->query($sql_7);

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

											$sql_8 = "SELECT write_up FROM cri_7_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 7.1.8'";
											$datas = $con->query($sql_8);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_7_1_8_writeup = $data['write_up'];
											    }
											}

											$sql_9 = "SELECT write_up FROM cri_7_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 7.1.9'";
											$datas = $con->query($sql_9);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_7_1_9_writeup = $data['write_up'];
											    }
											}

											$sql_10 = "SELECT choice FROM cri_7_options WHERE academic_year = '$academic_year' AND criteria = 'criteria 7.1.10'";

											$datas = $con->query($sql_10);

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

											$sql_11 = "SELECT write_up FROM cri_7_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 7.1.11'";
											$datas = $con->query($sql_11);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_7_1_11_writeup = $data['write_up'];
											    }
											}

                        					?>
                        					<tr>
                        						<td align="center"><b>7.1.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Measures initiated by the institution for the promotion of gender equity during the year:</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_7_1_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                                            <tr>
                        						<td align="center"><b>7.1.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>The Institution has facilities for alternate sources of energy and energy conservation:</b><br>
													1. Solar energy 
                                                    2. Biogas plant
                                                    3. Wheeling to the Grid 
                                                    4. Sensor-based energy conservation
                                                    5. Use of LED bulbs/ power-efficient equipment<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>
                        					
											<tr>
                        						<td align="center"><b>7.1.3<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Describe the facilities in the institution for the management of the following types of 
													degradable and non-degradable waste:</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_7_1_3_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>
											
											<tr>
                        						<td align="center"><b>7.1.4<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Water conservation facilities available in the institution:</b><br>
													1. Rainwater harvesting 
													2. Borewell /Open well recharge
													3. Construction of tanks and bunds
													4. Waste water recycling 
													5. Maintenance of water bodies and distribution system in the campus<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>
											<tr>
                        						<td align="center"><b>7.1.5<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Green campus initiatives include:</b><br>
													1. Restricted entry of automobiles 
													2. Use of bicycles/ Battery-powered vehicles 
													3. Pedestrian-friendly pathways 
													4. Ban on use of plastic
													5. Landscaping<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>

											<tr>
                        						<td align="center"><b>7.1.6<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Quality audits on environment and energy undertaken by the institution:</b><br>
													1.Green audit 
													2. Energy audit 
													3.Environment audit
													4.Clean and green campus recognitions/awards 
													5. Beyond the campus environmental promotional activities
													<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>

											<tr>
                        						<td align="center"><b>7.1.7<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>The Institution has a Divyangjan-friendly and barrier-free environment:</b><br>
													1. Ramps/lifts for easy access to classrooms and centres
													2. Divyangjan -friendly washrooms 
													3. Signage including tactile path lights, display boards and signposts 
													4. Assistive technology and facilities for persons with Divyangjan accessible 
													website, screen-reading software, mechanized equipment, etc.
													5. Provision for enquiry and information: Human assistance, reader, scribe, soft 
													copies of reading materials, screen reading, etc.
													<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>

											<tr>
                        						<td align="center"><b>7.1.8<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Describe the Institutional efforts/initiatives in providing an inclusive environment i.e. 
													tolerance and harmony towards cultural, regional, linguistic, communal, social-economic and other diversities.</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_7_1_8_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

											<tr>
                        						<td align="center"><b>7.1.9<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Sensitization of students and employees of the institution to constitutional obligations: 
													values, rights, duties and responsibilities of citizens:</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_7_1_9_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>


											<tr>
                        						<td align="center"><b>7.1.10<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>The institution has a prescribed code of conduct for students, teachers, administrators 
													and other staff and conducts periodic sensitization programmes in this regard:</b><br>
													1. The Code of Conduct is displayed on the website 
													2. There is a committee to monitor adherence to the Code of Conduct
													3. Institution organizes professional ethics programmes for students, 
													teachers, administrators and other staff
													4. Annual awareness programmes on the Code of Conduct are organized
													<br>
													</p>

													<p>Options : 

							                        <b><?php echo $option_1; ?></b></p>
                        						</td>
                        					</tr>

											<tr>
                        						<td align="center"><b>7.1.11<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Institution celebrates / organizes national and international commemorative days, 
													events and festivals:</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_7_1_11_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>


                        				</tbody>
									</table>
								</div>

	<!-- end of file -->
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 7.3 Institutional Distinctiveness</h3>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 7.3 Institutional Distinctiveness</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<?php 
                        					$sql_12 = "SELECT write_up FROM cri_7_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 7.3.1'";
											$datas = $con->query($sql_12);
											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $cri_7_3_1_writeup = $data['write_up'];
											    }
											}

                        					?>
                        					
                        					<tr>
                        						<td align="center"><b>7.3.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Highlight the performance of the institution in an area distinct to its priority and 
													thrust</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_7_3_1_writeup; ?></td>
			                                               </tr>
			                                            </tbody>
			                                        </table>
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