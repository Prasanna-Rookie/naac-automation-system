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

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
							<li class="breadcrumb-item active" aria-current="page">Criteria 4</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
                	<div class="card" style="border-top:2px solid #087ec2;">
                		<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        <i class="fa-solid fa-square-poll-vertical fa-lg"></i>
	                        <span>Criterion IV – Infrastructure and Learning Resources - Detailed Report.</span>
	                    </div>
                    	<div class="card-body">
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
		                        					<span>Criterion IV - AQAR Report.</span>
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
								$cri_4_1_1_writeup = $cri_4_4_2_writeup = $cri_4_3_1_writeup = $cri_4_2_1_writeup = "Please updated Write Up for this Metric.";
								?>

									<h3 class="card-title" id="card-title">Key Indicator - 4.1 Physical Facilities</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
												<th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 4.1 Physical Facilities</th>
											</thead>

											<tbody>
												<?php 

												$sql_1 = "SELECT write_up FROM cri_4_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 4.1.1'";
												$datas = $con->query($sql_1);
												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $cri_4_1_1_writeup = $data['write_up'];
												    }
												}
												?>
												<tr>
													<td align="center"><b>4.1.1<br>Q<sub>l</sub>M<b></td>
		                                        <td>
		                                        	<p><b>The Institution has adequate infrastructure and physical facilities for teachinglearning, viz., classrooms, laboratories, computing equipments, etc.</b></p>
		                                        	<table class="table table-bordered table-hover">
		                                                <tbody>
		                                                    <tr>
		                                                        <td><?php echo $cri_4_1_1_writeup; ?></td>
		                                                    </tr>
		                                                </tbody>
		                                            </table>
		                                        </td>
												</tr>
												<?php 

													$sql_2 = "SELECT write_up FROM cri_4_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 4.1.2'";
													$datas = $con->query($sql_2);
													if($datas->num_rows>0)
													{
														while ($data = $datas->fetch_assoc())
														{
															$cri_4_1_2_writeup = $data['write_up'];
														}
													}
													?>
												<tr>
													<td align="center"><b>4.1.2<br>Q<sub>l</sub>M<b></td>
			                                        <td>
			                                        	<p><b>The institution has adequate facilities for cultural activities, yoga, sports and games (indoor and outdoor) including gymnasium, yoga centre, auditorium etc.</b></p>
			                                        	<table class="table table-bordered table-hover">
			                                                <tbody>
			                                                    <tr>
			                                                        <td><?php echo $cri_4_1_2_writeup; ?></td>
			                                                    </tr>
			                                                </tbody>
			                                            </table>
			                                        </td>
												</tr>
												<?php 
													$sql_3 = "SELECT COUNT(*) as class_rooms from cri_4_1_3_classrooms_seminarhalls where academic_year = '$academic_year'";
													$datas = $con->query($sql_3);
													if($datas->num_rows > 0){
														while($data = $datas->fetch_assoc()){
															$tot_classroom = $data['class_rooms'];
														}
													}
													
												?>
												<tr>
													<td align="center"><b>4.1.3<br>Q<sub>n</sub>M</b> </td>
												<td>
													<p><b>Number of classrooms and seminar halls with ICT-enabled facilities.</b></p>

													<p><b>Number of classrooms and seminar halls with ICT-enabled facilities : </b> <?php echo $tot_classroom; ?></p>
															
												</td>
												</tr>
												<?php 
													$sql_3 = "SELECT  expenditure from cri_4_1_4_infrastructure_expenditure where academic_year = '$academic_year'";
													$datas = $con->query($sql_3);
													if($datas->num_rows > 0){
														while($data = $datas->fetch_assoc()){
															$Infra_expenditure = $data['expenditure'];
														}
													}
													
												?>
												<tr>
													<tr>
														<td align = "center"><b>4.1.4<br>Q<sub>n</sub>M</b></td>
													<td>
														<p><b>Expenditure for infrastructure augmentation, excluding salary, during the year (INR in Lakhs)</b></p>
														
														<p><b>Expenditure for infrastructure augmentation, excluding salary, during the year (INR in Lakhs): </b><?php echo $Infra_expenditure ?></p>
													</td>
													</tr>
												</tr>
											</tbody>
										</table>
									</div>

									<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

									<h3 class="card-title" id="card-title">Key Indicator - 4.2 Library as a Learning Resource</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
												<th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 4.2 Library as a Learning Resource</th>
											</thead>

											<tbody>
												<?php 

												$sql_1 = "SELECT write_up FROM cri_4_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 4.2.1'";
												$datas = $con->query($sql_1);
												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $cri_4_2_1_writeup = $data['write_up'];
												    }
												}
												?>
												<tr>
													<td align="center"><b>4.2.1<br>Q<sub>l</sub>M<b></td>
		                                        <td>
		                                        	<p><b>Library is automated using Integrated Library Management System (ILMS).</b></p>
		                                        	<table class="table table-bordered table-hover">
		                                                <tbody>
		                                                    <tr>
		                                                        <td><?php echo $cri_4_2_1_writeup; ?></td>
		                                                    </tr>
		                                                </tbody>
		                                            </table>
		                                        </td>
												</tr>
												<tr>

													<?php 

														$sql = "SELECT * FROM cri_4_2_2_options WHERE academic_year = '$academic_year'";
														$datas = $con->query($sql);
														if($datas->num_rows>0)
														{
															while ($data = $datas->fetch_assoc())
															{
																$option = $data['option'];
																if($data['option'] == "A")
																{
																	$access = "Any 4 or more of the above";
																}
																elseif($data['option'] == "B")
																{
																	$access = "Any 3 of the above";
																}
																elseif($data['option'] == "C")
																{
																	$access = "Any 2 of the above";
																}
																elseif($data['option'] == "D")
																{
																	$access = "Any 1 of the above";
																}
																else
																{
																	$access =  "None of the above";
																}
															}	
														}
														?>

													<td align="center"><b>4.2.2<br>Q<sub>n</sub>M<b></td>
													<td>
														<p><b>Institution has access to the following: 1. e-journals 2. e-ShodhSindhu 3. Shodhganga Membership 4. e-books 5. Databases 6. Remote access to e-resources.</b></p>

														<p><b>Institution has access to the following : </b> <?php echo "$option . $access";?></b>
													</td>
												</tr>
												<tr>
													<?php 
                            						$sql = "SELECT * FROM cri_4_2_4_library_usage WHERE academic_year = '$academic_year'";

	                            					$datas = $con->query($sql);
		                                            if($datas->num_rows>0)
		                                            {
		                                                $usage = 0;
		                                                while ($data = $datas->fetch_assoc()) 
		                                                {  
		                                                    $usage = $data['e_access'] + $data['teacher'] + $data['student'];
		                                                }
		                                            }
		                                            ?>
													<td align="center"><b>4.2.4<br>Q<sub>n</sub>M<b></td>
													<td>
														<p><b>Usage of library by teachers and students (footfalls and login data for online access).</b></p>

														<p><b>Number of teachers and students using the library per day : </b> <?php echo "$usage";?></b>
													</td>
												</tr>
											</tbody>
										</table>
									</div>

									<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

									<h3 class="card-title" id="card-title">Key Indicator – 4.3 IT Infrastructure</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
												<th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator – 4.3 IT Infrastructure</th>
											</thead>

											<tbody>
												<?php 

												$sql_1 = "SELECT write_up FROM cri_4_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 4.3.1'";
												$datas = $con->query($sql_1);
												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $cri_4_3_1_writeup = $data['write_up'];
												    }
												}
												?>
												<tr>
													<td align="center"><b>4.3.1<br>Q<sub>l</sub>M<b></td>
			                                        <td>
			                                        	<p><b>Institution has an IT policy covering Wi-Fi, cyber security, etc. and has allocated budget for updating its IT facilities.</b></p>
			                                        	<table class="table table-bordered table-hover">
			                                                <tbody>
			                                                    <tr>
			                                                        <td><?php echo $cri_4_3_1_writeup; ?></td>
			                                                    </tr>
			                                                </tbody>
			                                            </table>
			                                        </td>
												</tr>

												<tr>
													<td align="center"><b>4.3.2<br>Q<sub>n</sub>M<b></td>
													<td>
														<p><b>Student - Computer ratio</b></p>

														<?php 
			                            				$computer_count = 0;
			                            				$sql = "SELECT * FROM cri_4_3_2_computer_ratio WHERE academic_year = '$academic_year'";

			                            				$datas = $con->query($sql);
				                                        if($datas->num_rows>0)
				                                        {
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
															        // $tot_student = 64;
															    }
															}

															if($tot_student != 0)
	                                                	{
	                                                		$stu_com_ration = $tot_student / $computer_count;

	                                                		$stu_com_ration = number_format($stu_com_ration, 2);

	                                                		$stu_com_ration = $stu_com_ration. " : 1";
	                                                	}
	                                                	else
	                                                	{
	                                                		$stu_com_ration = "0 : 0";
	                                                	} 
	                                                    ?>
														<table class="table table-bordered table-hover">
	                                                    <thead style="background-color:#057EC5; color:#FFF;">
	                                                        <tr>
	                                                            <th style="text-align:center;">Number of Students</th>
	                                                            <th style="text-align:center;">Number of Computers</th>
	                                                        </tr>
	                                                    </thead>
	                                                    <tbody>
	                                                        <tr align="center">
	                                                            <td><?php echo $tot_student; ?></td>
	                                                            <td><?php echo $computer_count; ?></td>
	                                                        </tr>
	                                                    </tbody>
	                                                </table>

	                                                <p><b>Students Teachers Ratio :</b> <?php echo $stu_com_ration;?></b>
													</td>
												</tr>
												<tr>
													<td align="center"><b>4.3.3<br>Q<sub>n</sub>M<b></td>

														<?php 

														$sql = "SELECT * FROM cri_4_3_3_options WHERE academic_year = '$academic_year'";
														$datas = $con->query($sql);
														if($datas->num_rows>0)
														{
															while ($data = $datas->fetch_assoc())
															{
																$option = $data['option'];
																if($data['option'] == "A")
																{
																	$bandwidth = "≥50 Mbps";
																}
																elseif($data['option'] == "B")
																{
																	$bandwidth = "35 Mbps - 50 Mbps";
																}
																elseif($data['option'] == "C")
																{
																	$bandwidth = "20 Mbps - 35 Mbps";
																}
																elseif($data['option'] == "D")
																{
																	$bandwidth = "5 Mbps - 20 Mbps";
																}
																else
																{
																	$bandwidth =  "<5 Mbps";
																}
															}	
														}
														?>
													
													<td>
														<p><b>Bandwidth of internet connection in the Institution and the number of students on campus.</b></p>

														<p><b>Bandwidth of internet connection in the Institution :</b> <?php echo "$option . $bandwidth";?></b>
													</td>
												</tr>

												<tr>
													<td align="center"><b>4.3.4<br>Q<sub>n</sub>M<b></td>

														<?php 

														$sql = "SELECT * FROM cri_4_3_4_options WHERE academic_year = '$academic_year'";
														$datas = $con->query($sql);
														if($datas->num_rows>0)
														{
															while ($data = $datas->fetch_assoc())
															{
																$option = $data['option'];
																if($data['option'] == "A")
																{
																	$facilities = "All four of the above";
																}
																elseif($data['option'] == "B")
																{
																	$facilities = "Any three of the above";
																}
																elseif($data['option'] == "C")
																{
																	$facilities = "Any two of the above";
																}
																elseif($data['option'] == "D")
																{
																	$facilities = "Any one of the above";
																}
																else
																{
																	$facilities = "None of the above";
																}
															}	
														}
														?>
													
													<td>
														<p><b>Institution has facilities for E-content development.</b></p>

														<p><b>Bandwidth of internet connection in the Institution :</b> <?php echo "$option . $facilities";?></b>
													</td>
												</tr>

											</tbody>
										</table>
									</div>

									<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

									<h3 class="card-title" id="card-title">Key Indicator - 4.4 Maintenance of Campus Infrastructure</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
												<th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 4.4 Maintenance of Campus Infrastructure</th>
											</thead>
											<tbody>

												<?php 
												$expenditure = 0;
												$sql = "SELECT * FROM cri_4_1_4_infrastructure_expenditure WHERE academic_year = '$academic_year'";
												$datas = $con->query($sql);
	                                            if($datas->num_rows>0)
	                                            {
	                                            	while ($data = $datas->fetch_assoc()) 
	                                                {
	                                                	$expenditure = $data['expenditure'];
	                                                }
	                                            }
												?>
												<tr>
													<td align="center"><b>4.4.1<br>Q<sub>n</sub>M<b></td>

													<td>
		                                        	<p><b>Expenditure incurred on maintenance of physical and academic support facilities,excluding salary component, during the year (INR in lakhs).</b></p>

		                                        	<p>Expenditure incurred on maintenance of physical and academic support facilities : 

						                            <b><?php echo $expenditure; ?></b></p>
		                                        	</td>
												</tr>
												<tr>

													<?php 

													$sql_1 = "SELECT write_up FROM cri_4_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 4.4.2'";
													$datas = $con->query($sql_1);
													if($datas->num_rows>0)
													{
													    while ($data = $datas->fetch_assoc())
													    {
													        $cri_4_4_2_writeup = $data['write_up'];
													    }
													}
													?>

													<td align="center"><b>4.4.2<br>Q<sub>l</sub>M<b></td>
													<td>
														<p><b>There are established systems and procedures for maintaining and utilizing physical, academic and support facilities – classrooms, laboratory, library, sports complex, computers, etc.</b></p>
			                                        	<table class="table table-bordered table-hover">
			                                                <tbody>
			                                                    <tr>
			                                                        <td><?php echo $cri_4_4_2_writeup; ?></td>
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
                    </div>
                	</div>
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
