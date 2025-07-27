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
	<title>Criterion - 2</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 2 - AQAR Benchmark Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen-to-square fa-lg"></i>
							<span>Criterion II – Teaching - Learning and Evaluation - AQAR Benchmark Report.</span>
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
		                        					<span>Criterion II - AQAR Benchmark Report.</span>
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
				                            		<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 2.1 Student Enrolment and Profile</th>
				                            	</tr>

				                            	<tr>

				                            		<?php 

									                $santioned_seats = $stu_count = 0;

													$sql_1 = "SELECT cri.santioned_seats, COUNT(*) as stu_count 
																FROM cri_2_1_1_student_details AS cri_sd
																INNER JOIN programme_info AS pi
																ON pi.programme_code = cri_sd.programme_code
																INNER JOIN cri_2_1_1_sanctioned_seats AS cri
																ON cri.programme_code = cri_sd.programme_code AND cri.academic_year = cri_sd.academic_year
																WHERE cri_sd.academic_year = '$academic_year'
																GROUP BY cri_sd.programme_code, cri_sd.academic_year
																ORDER BY pi.id";
													$datas = $con->query($sql_1);
													if($datas->num_rows>0)
													{
													    $santioned_seats = 0;
													    $stu_count = 0;
													    while ($data = $datas->fetch_assoc())
													    {
													        $santioned_seats = $santioned_seats + $data['santioned_seats'];
													        $stu_count = $stu_count + $data['stu_count'];
													    }
													}
													if($santioned_seats != 0)
						                            {
						                                $enrollment_percentage = ($stu_count / $santioned_seats) * 100;
						                            }
						                            else
						                            {
						                                $enrollment_percentage = 0;
						                            }

						                            $enrol_mark = $enrol_deficiencies = 0;

						                            if ($enrollment_percentage >= 90) 
						                            {
													    $enrol_mark = 4;
													} 
													elseif ($enrollment_percentage >= 80 && $enrollment_percentage < 90) 
													{
													    $enrol_mark = 3;
													} 
													elseif ($enrollment_percentage >= 70 && $enrollment_percentage < 80) 
													{
													    $enrol_mark = 2;
													} 
													elseif ($enrollment_percentage >= 50 && $enrollment_percentage < 70) 
													{
													    $enrol_mark = 1;
													} 
													else 
													{
													    $enrol_mark = 0;
													}

				                            		?>
				                            		<td align="center"><b>2.1.1<br>Q<sub>n</sub>M<b></td>
				                            		<td>Enrolment percentage</td>
				                            		<td align="center">
				                            			<b><?php echo $enrol_mark;?></b><br>
				                            			<?php 
				                            				$enrollment_percentage = number_format($enrollment_percentage, 2);
				                            				echo $enrollment_percentage. " %";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=90)</td>
				                            		<td align="center">
				                            			<?php
				                            				$enrol_deficiencies = 4 - $enrol_mark;
				                            				$enrol_deficiencies = $enrol_deficiencies * 25;
				                            				echo $enrol_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>

				                            		<?php 

				                            		$sql_2 = "SELECT
																SUM(CASE WHEN community = 'SC' THEN 1 ELSE 0 END) AS stu_sc,
																SUM(CASE WHEN community = 'ST' THEN 1 ELSE 0 END) AS stu_st,
																SUM(CASE WHEN community IN ('BC', 'MBC') THEN 1 ELSE 0 END) AS stu_obc,
																SUM(CASE WHEN community = 'OC' THEN 1 ELSE 0 END) AS stu_oc
																FROM cri_2_1_1_student_details
																WHERE academic_year = '$academic_year'";

													$datas = $con->query($sql_2);
													if($datas->num_rows>0)
													{
													    $stu_com_count = 0;
													    while ($data = $datas->fetch_assoc())
													    {
													        $stu_com_count = $stu_com_count + $data['stu_sc'] + $data['stu_st'] + $data['stu_obc'] + $data['stu_oc'];
													    }
													}

													$count_categories = 0;

													$sql_3 = "SELECT *
																FROM cri_2_1_2_reserved_categories
																WHERE academic_year = '$academic_year'";
													$datas = $con->query($sql_3);
													if($datas->num_rows>0)
													{
													    while ($data = $datas->fetch_assoc())
													    {
													        $count_categories = $count_categories + $data['sc_category'] + $data['st_category'] + $data['obc_category'] + $data['general_category'] + $data['others'];
													    }
													}

													if($count_categories != 0)
	                                               	{
	                                                	$seat_filled_percentage = ($stu_com_count / $count_categories) * 100;
	                                                }
	                                                else
	                                                {
	                                                	$seat_filled_percentage = 0;
	                                                }

	                                                $recerved_mark = $recerved_deficiencies = 0;

						                            if ($seat_filled_percentage >= 80) 
						                            {
													    $recerved_mark = 4;
													} 
													elseif ($seat_filled_percentage >= 70 && $seat_filled_percentage < 80) 
													{
													    $recerved_mark = 3;
													} 
													elseif ($seat_filled_percentage >= 50 && $seat_filled_percentage < 70) 
													{
													    $recerved_mark = 2;
													} 
													elseif ($seat_filled_percentage >= 40 && $seat_filled_percentage < 50) 
													{
													    $recerved_mark = 1;
													} 
													else 
													{
													    $recerved_mark = 0;
													}
				                            		?>
				                            		<td align="center"><b>2.1.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Percentage of seats filled against reserved categories (SC, ST, OBC etc.) asper applicable reservation policy</td>
				                            		<td align="center">
				                            			<b><?php echo $recerved_mark;?></b><br>
				                            			<?php 
				                            				$seat_filled_percentage = number_format($seat_filled_percentage, 2);
				                            				echo $seat_filled_percentage. " %";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=80)</td>
				                            		<td align="center">
				                            			<?php
				                            				$recerved_deficiencies = 4 - $recerved_mark;
				                            				$recerved_deficiencies = $recerved_deficiencies * 25;
				                            				echo $recerved_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>
				                            	<tr>
				                            		<th colspan="5" style="text-align:center;background-color:#057EC5; color:#FFF;">Key Indicator - 2.2 Catering to Student Diversity</th>
				                            	</tr>

				                            	<tr>
				                            		<?php 
				                            		$sql_4 = "SELECT COUNT(*) as full_time_teacher FROM cri_2_2_2_full_time_teacher WHERE academic_year = '$academic_year'";

													$datas = $con->query($sql_4);
													if($datas->num_rows>0)
													{
													    while ($data = $datas->fetch_assoc())
													    {
													        $tot_full_time_teacher = $data['full_time_teacher'];
													    }
													}
													$sql_5 = "SELECT COUNT(*) as student FROM cri_2_2_2_student_details WHERE academic_year = '$academic_year'";

													$datas = $con->query($sql_5);
													if($datas->num_rows>0)
													{
													    while ($data = $datas->fetch_assoc())
													    {
													        $tot_student = $data['student'];
													    }
													}

													if($tot_full_time_teacher != 0)
													{
													    $stu_tea_ratio = $tot_student / $tot_full_time_teacher;
													}
													else
													{
													    $stu_tea_ratio = 0;
													}

													$stu_tea_mark = $stu_tea_deficiencies = 0;

													if ($stu_tea_ratio >= 60) 
													{
													    $stu_tea_mark = 0;
													} 
													elseif ($stu_tea_ratio >= 50 && $stu_tea_ratio < 60) 
													{
													    $stu_tea_mark = 1;
													} 
													elseif ($stu_tea_ratio >= 30 && $stu_tea_ratio < 50) 
													{
													    $stu_tea_mark = 2;
													} 
													elseif ($stu_tea_ratio >= 20 && $stu_tea_ratio < 30) 
													{
													    $stu_tea_mark = 3;
													} 
													else 
													{
													    $stu_tea_mark = 4;
													}
				                            		?>
				                            		<td align="center"><b>2.2.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Student - Full time teacher ratio</td>

				                            		<td align="center">
				                            			<b><?php echo $stu_tea_mark;?></b><br>
				                            			<?php 
				                            				$stu_tea_ratio = number_format($stu_tea_ratio, 2);
				                            				echo $stu_tea_ratio . " : 1";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(< 20:1)</td>
				                            		<td align="center">
				                            			<?php

				                            				$stu_tea_deficiencies = 4 - $stu_tea_mark;
				                            				$stu_tea_deficiencies = $stu_tea_deficiencies * 25;
				                            				echo $stu_tea_deficiencies . " %";
				                            			?>
				                            		</td>
				                            		
				                            	</tr>

				                            	<tr>
				                            		<th colspan="5" style="text-align:center;background-color:#057EC5; color:#FFF;">Key Indicator - 2.4 Teacher Profile and Quality</th>
				                            	</tr>
				                            	<tr>

				                            		<?php 

				                            		$sanctioned_posts = $average_duration = 0;

				                            		$sql_6 = "SELECT cri.sanctioned_posts, COUNT(*) as full_time_teacher
													FROM cri_2_2_2_full_time_teacher AS cri_sd
													INNER JOIN programme_info AS pi
													ON pi.programme_code = cri_sd.department
													INNER JOIN cri_2_4_1_sanctioned_posts AS cri
													ON cri.programme_code = cri_sd.department AND cri.academic_year = cri_sd.academic_year
													WHERE cri_sd.academic_year = '$academic_year'
													GROUP BY cri_sd.department, cri_sd.academic_year
													ORDER BY pi.id";

													$datas = $con->query($sql_6);
													if($datas->num_rows>0)
													{
													    $full_time_teacher = 0;
													    while ($data = $datas->fetch_assoc())
													    {
													        $sanctioned_posts = $sanctioned_posts + $data['sanctioned_posts'];
													        $full_time_teacher = $full_time_teacher + $data['full_time_teacher'];
													    }
													}

													if($sanctioned_posts != 0)
													{
													    $percentage_full_time_teacher = ($full_time_teacher / $sanctioned_posts) * 100;
													}

													else
													{
													    $percentage_full_time_teacher = 0;
													}

													$full_time_teacher_mark = $full_time_teacher_deficiencies = 0;

													if ($percentage_full_time_teacher >= 80) 
													{
													    $full_time_teacher_mark = 4;
													} 
													elseif ($percentage_full_time_teacher >= 70 && $percentage_full_time_teacher < 80) 
													{
													    $full_time_teacher_mark = 3;
													} 
													elseif ($percentage_full_time_teacher >= 50 && $percentage_full_time_teacher < 70) 
													{
													    $full_time_teacher_mark = 2;
													} 
													elseif ($percentage_full_time_teacher >= 40 && $percentage_full_time_teacher < 50) 
													{
													    $full_time_teacher_mark = 1;
													} 
													else 
													{
													    $full_time_teacher_mark = 0;
													}
				                            		?>
				                            		<td align="center"><b>2.4.1<br>Q<sub>n</sub>M<b></td>
				                            		<td>Percentage of full time teachers against sanctioned posts</td>
				                            		<td align="center">
				                            			<b><?php echo $full_time_teacher_mark;?></b><br>
				                            			<?php 
				                            				$percentage_full_time_teacher = number_format($percentage_full_time_teacher, 2);
				                            				echo $percentage_full_time_teacher . " %";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=90)</td>
				                            		<td align="center">
				                            			<?php

				                            				$full_time_teacher_deficiencies = 4 - $full_time_teacher_mark;
				                            				$full_time_teacher_deficiencies = $full_time_teacher_deficiencies * 25;
				                            				echo $full_time_teacher_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>
				                            	<tr>
				                            		<td align="center"><b>2.4.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Percentage of full time teachers with Ph.D. /D.Sc. / D.Litt. / L.L.D</td>
				                            		<td></td>
				                            		<td align="center">4<br>(>=70)</td>
				                            		<td></td>
				                            	</tr>

				                            	<tr>

				                            		<?php 

				                            		$experience_list = [];
				                            		$average_year = 0;

													$sql_7 = "SELECT joining_date, leaving_date FROM cri_2_2_2_full_time_teacher WHERE academic_year = '$academic_year'";
													$datas = $con->query($sql_7);
													if($datas->num_rows>0)
													{
													   while ($data = $datas->fetch_assoc())
													    {
													        $jdate = $data['joining_date'];
													        $jdate = new DateTime($jdate);
													        $jdate = $jdate->format('d-m-Y');

													        $joining_date = $jdate;

													        if($data['leaving_date'] == '-')
													        {
													            $current_date = date("d-m-Y");
													        }

													        else
													        {
													            $ldate = $data['leaving_date'];
													            $ldate = new DateTime($ldate);
													            $ldate = $ldate->format('d-m-Y');
													            $current_date = $ldate;
													        }

													        // Convert dates to DateTime objects
													        $joining_date_obj = date_create_from_format('d-m-Y', $joining_date);
													        $current_date_obj = date_create_from_format('d-m-Y', $current_date);

													        // Calculate the difference
													        $interval = date_diff($joining_date_obj, $current_date_obj);

													        // Format the output
													        $experience = sprintf("%02dYear %02dMonths", $interval->y, $interval->m);

													        array_push($experience_list, $experience);
													    } 
													}
													if(count($experience_list) != 0)
													{

													    // Function to convert the duration into months
													    function durationToMonths($duration) 
													    {
													        sscanf($duration, "%dYears %dMonths", $years, $months);
													        return $years * 12 + $months;
													    }
													    
													    // Function to convert months back to duration format
													    function monthsToDuration($months) 
													    {
													        $years = floor($months / 12);
													        $remainingMonths = $months % 12;
													        return sprintf("%dYears %02dMonths", $years, $remainingMonths);
													    }

													    $total_months = 0;

													    // Convert each experience to months and sum up
													    foreach ($experience_list as $experience) 
													    {
													        $total_months += durationToMonths($experience);
													    }

													    // Calculate total duration
													    $total_duration = monthsToDuration($total_months);

													    // Calculate average in months
													    $average_months = $total_months / count($experience_list);

													    // Convert average back to duration format
													    $average_duration = monthsToDuration($average_months);

													    // Extract years from the average duration
													    $average_year = 0;
													    sscanf($average_duration, "%dYears", $average_year);
													}


													$average_year_mark =  0;

													if ($average_year >= 15) 
													{
													    $average_year_mark = 4;
													} 
													elseif ($average_year >= 12 && $average_year < 15) 
													{
													    $average_year_mark = 3;
													} 
													elseif ($average_year >= 9 && $average_year < 12) 
													{
													    $average_year_mark = 2;
													} 
													elseif ($average_year >= 6 && $average_year < 9) 
													{
													    $average_year_mark = 1;
													} 
													else 
													{
													    $average_year_mark = 0;
													}
				                            		?>
				                            		<td align="center"><b>2.4.3<br>Q<sub>n</sub>M<b></td>
				                            		<td>Average teaching experience of full time teachers</td>
				                            		<td align="center">
				                            			<b><?php echo $average_year_mark;?></b><br>
				                            			<?php
				                            				echo $average_duration;
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=15)</td>
				                            		<td align="center">
				                            			<?php

				                            				$average_duration_deficiencies = 4 - $average_year_mark;
				                            				$average_duration_deficiencies = $average_duration_deficiencies * 25;
				                            				echo $average_duration_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<td align="center"><b>2.4.4<br>Q<sub>n</sub>M<b></td>
				                            		<td>Average teaching experience of full time teachers in the same institution</td>
				                            		<td align="center">
				                            			<b><?php echo $average_year_mark;?></b><br>
				                            			<?php
				                            				echo $average_duration;
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=15)</td>
				                            		<td align="center">
				                            			<?php

				                            				$average_duration_deficiencies = 4 - $average_year_mark;
				                            				$average_duration_deficiencies = $average_duration_deficiencies * 25;
				                            				echo $average_duration_deficiencies . " %";
				                            			?>
				                            		</td>
				                            	</tr>

				                            	<tr>
				                            		<th colspan="5" style="text-align:center;background-color:#057EC5; color:#FFF;">Key Indicator - 2.5 Evaluation Process and Reforms</th>
				                            	</tr>

				                            	<tr>
				                            		<td align="center"><b>2.5.1<br>Q<sub>n</sub>M<b></td>
				                            		<td>Average number of days from the date of last semester-end/ year- end examination till the last date of declaration of results</td>
				                            		<td></td>
				                            		<td align="center">4<br>(<20)</td>
				                            		<td></td>
				                            	</tr>

				                            	<tr>
				                            		<td align="center"><b>2.5.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Percentage of student complaints/grievances about evaluation against total number appeared in the examinations</td>
				                            		<td></td>
				                            		<td align="center">4<br>(<1)</td>
				                            		<td></td>
				                            	</tr>

				                            	<tr>
				                            		<th colspan="5" style="text-align:center;background-color:#057EC5; color:#FFF;">Key Indicator - 2.6 Student Performance and Learning Outcomes</th>
				                            	</tr>

				                            	<tr>

				                            		<?php 
				                            			$sql_8 = "SELECT COUNT(reg_no) AS appeared,
														SUM(CASE WHEN result = 'PASS' THEN 1 ELSE 0 END) AS passed
														FROM cri_2_6_3_pass_percentage WHERE academic_year = '$academic_year'";
														$datas = $con->query($sql_8);
														if($datas->num_rows>0)
														{
														    while ($data = $datas->fetch_assoc())
														    {
														        $appeared = $data['appeared'];
														        $passed = $data['passed'];
														    }
														}

														if($appeared != 0)
														{
														    $pass_percentage = ($passed / $appeared) * 100;
														}
														else
														{
														    $pass_percentage = 0;
														}

														$average_pass_mark =  0;

														if ($pass_percentage >= 90) 
														{
														    $average_pass_mark = 4;
														} 
														elseif ($pass_percentage >= 80 && $pass_percentage < 90) 
														{
														    $average_pass_mark = 3;
														} 
														elseif ($pass_percentage >= 70 && $pass_percentage < 80) 
														{
														    $average_pass_mark = 2;
														} 
														elseif ($pass_percentage >= 60 && $pass_percentage < 70) 
														{
														    $average_pass_mark = 1;
														} 
														else 
														{
														    $average_pass_mark = 0;
														}
				                            		?>
				                            		<td align="center"><b>2.6.2<br>Q<sub>n</sub>M<b></td>
				                            		<td>Pass percentage of students</td>
				                            		<td align="center">
				                            			<b><?php echo $average_pass_mark;?></b><br>
				                            			<?php
				                            				echo $pass_percentage . " %";
				                            			?>
				                            		</td>
				                            		<td align="center">4<br>(>=90)</td>
				                            		<td align="center">
				                            			<?php
				                            				$pass_percentage_deficiencies = 4 - $average_pass_mark;
				                            				$pass_percentage_deficiencies = $pass_percentage_deficiencies * 25;
				                            				echo $pass_percentage_deficiencies . " %";
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