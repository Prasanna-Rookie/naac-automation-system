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
							<li class="breadcrumb-item active" aria-current="page">Criteria 2 - AQAR Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
							<span>Criterion II – Teaching - Learning and Evaluation - AQAR Report.</span>
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
		                        					<span>Criterion II - AQAR Report.</span>
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
								$cri_2_2_1_writeup = $cri_2_3_1_writeup = $cri_2_3_2_writeup = $cri_2_3_4_writeup = $cri_2_6_1_writeup = $cri_2_6_2_writeup = "Please updated Write Up for this Metric.";
								$santioned_seats = $stu_count = 0;
								$sanctioned_posts = $full_time_teacher = 0;
								$total_duration = $average_duration = "0 Year 0 Month";

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

								$sql_2a = "SELECT *
											FROM cri_2_1_2_reserved_categories
											WHERE academic_year = '$academic_year'";
								$datas = $con->query($sql_2a);
								if($datas->num_rows>0)
								{
								    // $sc_category_tot = $st_category = $obc_category = $general_category = $others = 0;
								    $count_categories = 0;
								    while ($data = $datas->fetch_assoc())
								    {
								        $count_categories = $count_categories + $data['sc_category'] + $data['st_category'] + $data['obc_category'] + $data['general_category'] + $data['others'];
								    }
								}

								$sql_3 = "SELECT write_up FROM cri_2_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 2.2.1'";
								$datas = $con->query($sql_3);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_2_2_1_writeup = $data['write_up'];
								    }
								}

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

								$sql_6 = "SELECT write_up FROM cri_2_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 2.3.1'";
								$datas = $con->query($sql_6);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_2_3_1_writeup = $data['write_up'];
								    }
								}

								$sql_7 = "SELECT write_up FROM cri_2_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 2.3.2'";
								$datas = $con->query($sql_7);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_2_3_2_writeup = $data['write_up'];
								    }
								}

								$sql_8 = "SELECT write_up FROM cri_2_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 2.3.4'";
								$datas = $con->query($sql_8);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_2_3_4_writeup = $data['write_up'];
								    }
								}

								$sql_9 = "SELECT SUM(no_of_mentor) AS tot_mentors FROM cri_2_3_3_ratio WHERE academic_year = '$academic_year'";
								$datas = $con->query($sql_9);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $tot_mentors = $data['tot_mentors'];
								    }
								}

								$sql_10 = "SELECT cri.sanctioned_posts, COUNT(*) as full_time_teacher
								FROM cri_2_2_2_full_time_teacher AS cri_sd
								INNER JOIN programme_info AS pi
								ON pi.programme_code = cri_sd.department
								INNER JOIN cri_2_4_1_sanctioned_posts AS cri
								ON cri.programme_code = cri_sd.department AND cri.academic_year = cri_sd.academic_year
								WHERE cri_sd.academic_year = '$academic_year'
								GROUP BY cri_sd.department, cri_sd.academic_year
								ORDER BY pi.id";

								$datas = $con->query($sql_10);
								if($datas->num_rows>0)
								{
								    $sanctioned_posts = 0;
								    $full_time_teacher = 0;
								    while ($data = $datas->fetch_assoc())
								    {
								        $sanctioned_posts = $sanctioned_posts + $data['sanctioned_posts'];
								        $full_time_teacher = $full_time_teacher + $data['full_time_teacher'];
								    }
								}

								$experience_list = [];

								$sql_11 = "SELECT joining_date, leaving_date FROM cri_2_2_2_full_time_teacher WHERE academic_year = '$academic_year'";
								$datas = $con->query($sql_11);
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
								}
								$sql_12 = "SELECT COUNT(reg_no) AS appeared,
								            SUM(CASE WHEN result = 'PASS' THEN 1 ELSE 0 END) AS passed
								            FROM cri_2_6_3_pass_percentage WHERE academic_year = '$academic_year'";
								$datas = $con->query($sql_12);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $appeared = $data['appeared'];
								        $passed = $data['passed'];
								    }
								}
								$sql_13 = "SELECT write_up FROM cri_2_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 2.6.1'";
								$datas = $con->query($sql_13);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_2_6_1_writeup = $data['write_up'];
								    }
								}
								$sql_14 = "SELECT write_up FROM cri_2_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 2.6.2'";
								$datas = $con->query($sql_14);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_2_6_2_writeup = $data['write_up'];
								    }
								}

								$sql_15 = "SELECT COUNT(teacher_name) AS teacher_name FROM cri_2_4_2_teachers WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_15);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $teacher_phd = $data['teacher_name'];
								    }
								}
								?>
								<h3 class="card-title" id="card-title">Key Indicator - 2.1 Student Enrolment and Profile</h3>
								<div class="table-responsive">
                         			<table class="table table-bordered table-hover">
                          				<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 2.1 Student Enrolment and Profile</th>
				                            </tr>
                        				</thead>
				                        <tbody>
				                        	<tr>
				                          		<td align="center"><b>2.1.1<br>Q<sub>n</sub>M<b></td>
				                           		<td>
						                            <p><b>Enrolment of Students</b></p>
						                            <p>Number of students admitted (year-wise) during the year : 

						                            <b><?php echo $stu_count; ?></b></p>

						                            <p>Number of sanctioned seats (year-wise) during the year :

						                            <b><?php echo $santioned_seats; ?></b></p>

						                            <p><b>Enrolment Percentage : </b>
	                                                	<?php 

	                                                	if($santioned_seats != 0)
	                                                	{
	                                                		$enrollment_percentage = ($stu_count / $santioned_seats) * 100;
	                                                		echo $enrollment_percentage."%";
	                                                	}
	                                                	else
	                                                	{
	                                                		echo "0 %";
	                                                	}	                                          	 
	                                                	?>
	                                                </p>

						                        </td>
                            				</tr>

				                            <tr>
				                                <td align="center"><b>2.1.2<br>Q<sub>n</sub>M<b></td>
				                                    <td>
				                                        <p><b>Number of seats filled against reserved categories (SC, ST, OBC, Divyangjan, etc.) as per the reservation policy during the year (exclusive of supernumerary seats)</b><br>

				                                        <p>Number of seats filled against reserved categories : 

				                                        <b><?php echo $stu_com_count; ?></b></p>

				                                        <p><b>Seats filled Percentage : </b>
	                                                	<?php 

	                                                	if($count_categories != 0)
	                                                	{
	                                                		$seat_filled_percentage = ($stu_com_count / $count_categories) * 100;
	                                                		echo $seat_filled_percentage."%";
	                                                	}
	                                                	else
	                                                	{
	                                                		echo "0 %";
	                                                	}	                                          	 
	                                                	?>
	                                                </p>
				                                    </td>
				                                </tr>
				                        </tbody>
				                   	</table>
				                </div>
                        		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
                        		<h3 class="card-title" id="card-title">Key Indicator - 2.2 Catering to Student Diversity</h3>
                        		<div class="table-responsive">
                            		<table class="table table-bordered table-hover">
		                                <thead style="background-color:#057EC5; color:#FFF;">
		                                    <tr>
		                                        <th style="text-align:center;" width="20">Metric No.</th>
		                                        <th style="text-align:center;">Key Indicator - 2.2 Catering to Student Diversity</th>
		                                    </tr>
		                                </thead>
                                		<tbody>
	                                    	<tr>
		                                        <td align="center"><b>2.2.1<br>Q<sub>l</sub>M<b></td>
		                                        <td>
		                                            <p><b>The institution assesses students’ learning levels and organises special programmes for both slow and advanced learners</b></p>

		                                            <table class="table table-bordered table-hover">
		                                                <tbody>
		                                                    <tr>
		                                                        <td><?php echo $cri_2_2_1_writeup; ?></td>
		                                                    </tr>
		                                                </tbody>
		                                            </table>
		                                        </td>
	                                        </tr>

	                                        <tr>
	                                            <td align="center"><b>2.2.2<br>Q<sub>n</sub>M<b></td>
	                                            <td>
	                                                <p><b>Student – Teacher (full-time) ratio:</b><br>

	                                                <table class="table table-bordered table-hover">
	                                                    <thead style="background-color:#057EC5; color:#FFF;">
	                                                        <tr>
	                                                            <th style="text-align:center;">Number of Student</th>
	                                                            <th style="text-align:center;">Number of Teacher</th>
	                                                        </tr>
	                                                    </thead>
	                                                    <tbody>
	                                                        <tr align="center">
	                                                            <td><?php echo $tot_student; ?></td>
	                                                            <td><?php echo $tot_full_time_teacher; ?></td>
	                                                        </tr>
	                                                    </tbody>
	                                                </table>
	                                                <p><b>Students Teachers Ratio : </b>
	                                                	<?php 

	                                                	if($tot_full_time_teacher != 0)
	                                                	{
	                                                		$stu_tea_ratio = $tot_student / $tot_full_time_teacher;
	                                                		echo $stu_tea_ratio." : 1";
	                                                	}
	                                                	else
	                                                	{
	                                                		echo "0 : 0";
	                                                	}	                                          	 
	                                                	?>
	                                                </p>
	                                            </td>
	                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

                                <h3 class="card-title" id="card-title">Key Indicator - 2.3 Teaching - Learning Process</h3>
								<div class="table-responsive">
								    <table class="table table-bordered table-hover">
								        <thead style="background-color:#057EC5; color:#FFF;">
								            <tr>
								                <th style="text-align:center;" width="20">Metric No.</th>
								                <th style="text-align:center;">Key Indicator - 2.3 Teaching - Learning Process</th>
								            </tr>
								        </thead>
								        <tbody>
								            <tr>
								                <td align="center"><b>2.3.1<br>Q<sub>l</sub>M<b></td>
								                <td>
								                    <p><b>Student-centric methods such as experiential learning, participative learning and problem-solving methodologies are used for enhancing learning experiences</b></p>
								                    <table class="table table-bordered table-hover">
								                        <tbody>
								                            <tr>
								                                <td><?php echo $cri_2_3_1_writeup; ?></td>
								                            </tr>
								                        </tbody>
								                    </table>  
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.3.2<br>Q<sub>l</sub>M<b></td>
								                <td>
								                    <p><b>Teachers use ICT-enabled tools including online resources for effective teaching and learning</b></p>
								                    <table class="table table-bordered table-hover">
								                        <tbody>
								                            <tr>
								                                <td><?php echo $cri_2_3_2_writeup; ?></td>   
								                            </tr>
								                        </tbody>
								                    </table>  
								                </td>
								            </tr>

								            <tr>
								                <td align="center"><b>2.3.3<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Ratio of students to mentor for academic and other related issues</b><br>

								                    <p>Number of mentors :

								                    <b><?php echo $tot_mentors; ?></b></p></p>
								                    <p><b>Mentor Mentee Ratio : </b>
								                    <?php 
								                    if($tot_mentors != 0)
								                    {
								                    	$mentor_ratio = $tot_student / $tot_mentors;
								                    	echo "1 : ".$mentor_ratio;
								                    }
								                    else
								                    {
								                    	echo "0 : 0";
								                    }
								                    
								                    ?>
								                	</p>
								                </td>
								            </tr>

								            <tr>
								                <td align="center"><b>2.3.4<br>Q<sub>l</sub>M<b></td>
								                <td>
								                    <p><b>Preparation and adherence to Academic Calendar and Teaching Plans by the institution</b></p>

								                    <table class="table table-bordered table-hover">
								                        <tbody>
								                            <tr>
								                                <td><?php echo $cri_2_3_4_writeup; ?></td>    
								                            </tr>
								                        </tbody>
								                    </table>  
								                </td>
								            </tr>
								        </tbody>
								    </table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 2.4 Teacher Profile and Quality</h3>
								<div class="table-responsive">
								    <table class="table table-bordered table-hover">
								        <thead style="background-color:#057EC5; color:#FFF;">
								            <tr>
								                <th style="text-align:center;" width="20">Metric No.</th>
								                <th style="text-align:center;">Key Indicator - 2.4 Teacher Profile and Quality</th>
								            </tr>
								        </thead>
								        <tbody>
								            <tr>
								                <td align="center"><b>2.4.1<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Number of full-time teachers against sanctioned posts during the year</b>
								                    <p>Number of full-time teachers : 
								                    <b><?php echo $full_time_teacher; ?></b></p>

								                    <p>Number of sanctioned posts : 
								                    <b><?php echo $sanctioned_posts; ?></b></p>

								                    <p><b>Percentage of Full Time Teacher : </b>

								                     <?php 

								                     	if($sanctioned_posts != 0)
								                     	{
								                     		$percentage = ($full_time_teacher / $sanctioned_posts) * 100;
								                     		echo $percentage . "%";
								                     	}

								                     	else
								                     	{
								                     		echo "0 %";
								                     	}

								                     ?>

								                     </p>
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.4.2<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Number of full-time teachers with PhD/ D.M. / M.Ch. / D.N.B Super-Specialty /DSc / DLitt during the year</b><br>
								                    <p>Number of full-time teachers with PhD/ D.M. / M.Ch. / D.N.B Super-Specialty /DSc / DLitt : 
								                    <b><?php echo $teacher_phd; ?></b></p>
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.4.3<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Total teaching experience of full-time teachers in the same institution</b><br>
								                    <p>Total Teaching Experience : <b>
								                    	<?php 
								                    		echo $total_duration; 
								                    	?>
								                    </b></p>
								                    <p><b>Average Teaching Experience : </b>
								                    	<?php 
								                    		echo $average_duration; 
								                    	?>
								                    </p>

								                </td>
								            </tr>
								        </tbody>
								    </table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 2.5 Evaluation Process and Reforms</h3>
								<div class="table-responsive">
								    <table class="table table-bordered table-hover">
								        <thead style="background-color:#057EC5; color:#FFF;">
								            <tr>
								                <th style="text-align:center;" width="20">Metric No.</th>
								                <th style="text-align:center;">Key Indicator - 2.5 Evaluation Process and Reforms</th>
								            </tr>
								        </thead>
								        <tbody>
								            <tr>
								                <td align="center"><b>2.5.1<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Number of days from the date of last semester-end/ year- end examination till the declaration of results during the year</b><br>   
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.5.2<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Number of students’ complaints/grievances against evaluation against the total number who appeared in the examinations during the year</b><br>
								                    
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.5.3<br>Q<sub>l</sub>M<b></td>
								                <td>
								                    <p><b>IT integration and reforms in the examination procedures and processes including Continuous Internal Assessment (CIA) have brought in considerable improvement in the Examination Management System (EMS) of the Institution</b><br>

								                    <table class="table table-bordered table-hover">
								                        <tbody>
								                            <tr>
								                                <td>Please updated Write Up for this Metric.</td>  
								                            </tr>
								                        </tbody>
								                    </table>
								                    
								                </td>
								            </tr>
								        </tbody>
								    </table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 2.6 Student Performance and Learning Outcomes</h3>
								<div class="table-responsive">
								    <table class="table table-bordered table-hover">
								        <thead style="background-color:#057EC5; color:#FFF;">
								            <tr>
								                <th style="text-align:center;" width="20">Metric No.</th>
								                <th style="text-align:center;">Key Indicator - 2.6 Student Performance and Learning Outcomes</th>
								            </tr>
								        </thead>
								        <tbody>
								            <tr>
								                <td align="center"><b>2.6.1<br>Q<sub>l</sub>M<b></td>
								                <td>
								                    <p><b>Programme Outcomes and Course Outcomes for all Programmes offered by the institution are stated and displayed on the website and communicated to teachers and students</b><br>

								                    <table class="table table-bordered table-hover">
								                        <tbody>
								                            <tr>
								                                <td><?php echo $cri_2_6_1_writeup; ?></td>    
								                            </tr>
								                        </tbody>
								                    </table>
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.6.2<br>Q<sub>l</sub>M<b></td>
								                <td>
								                    <p><b>Attainment of Programme Outcomes and Course Outcomes as evaluated by the institution</b><br>

								                    <table class="table table-bordered table-hover">
								                        <tbody>
								                            <tr>
								                                <td><?php echo $cri_2_6_2_writeup; ?></td>    
								                            </tr>
								                        </tbody>
								                    </table> 
								                </td>
								            </tr>
								            <tr>
								                <td align="center"><b>2.6.3<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Pass Percentage of students</b></p>

								                    <p>Total number of final year students who passed in the examinations conducted by Institution :

								                    <b><?php echo $passed; ?></b></p>

								                    <p>Total number of final year students who appeared for the examinations :

								                    <b><?php echo $appeared; ?></b></p>
								                    <p><b>Pass Percentage : </b>
								                     <?php 
								                     if($appeared != 0)
								                     {
								                     	$pass_percentage = ($passed / $appeared) * 100;
								                     	echo $pass_percentage . " %";
								                     }
								                     else
								                     {
								                     	echo "0 %";
								                     }
								                       
								                  	?></p> 
								                </td>
								            </tr>
								        </tbody>
								    </table>
								</div>
								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

								<h3 class="card-title" id="card-title">Key Indicator - 2.7 Student Satisfaction Survey</h3>
								<div class="table-responsive">
								    <table class="table table-bordered table-hover">
								        <thead style="background-color:#057EC5; color:#FFF;">
								            <tr>
								                <th style="text-align:center;" width="20">Metric No.</th>
								                <th style="text-align:center;">Key Indicator - 2.7 Student Satisfaction Survey</th>
								            </tr>
								        </thead>
								        <tbody>
								            <tr>
								                <td align="center"><b>2.7.1<br>Q<sub>n</sub>M<b></td>
								                <td>
								                    <p><b>Student Satisfaction Survey (SSS) on overall institutional performance (Institution may design its own questionnaire)</b><br><br>

								                    Results and details need to be provided as a weblink.</p>
								                    
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