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
	<title>Criterion - 3</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3 - AQAR Benchmark Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen-to-square fa-lg"></i>
							<span>Criterion III – Research, Innovations and Extension - AQAR Benchmark Report.</span>
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
		                        					<span>Criterion III - AQAR Benchmark Report.</span>
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
				                            	<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 3.1 Promotion of Research and Facilities</th>
				                            </tr>

				                            <?php 

				                            $total_seed_money = $seed_money_mark = $seed_money_deficiencies = 0;

				                            $sql_1 = "SELECT SUM(seed_money) AS total_seed_money FROM cri_3_1_2_seed_money WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_1);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_seed_money = $data['total_seed_money'];
											    }
											}

											if ($total_seed_money >= 20) {
											    $seed_money_mark = 4;
											} elseif ($total_seed_money >= 10 && $total_seed_money < 20) {
											    $seed_money_mark = 3;
											} elseif ($total_seed_money >= 5 && $total_seed_money < 10) {
											    $seed_money_mark = 2;
											} elseif ($total_seed_money >= 1 && $total_seed_money < 5) {
											    $seed_money_mark = 1;
											} else {
											    $seed_money_mark = 0;
											}

				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.1.2<br>Q<sub>n</sub>M<b></td>
				                            	<td>The institution provides seed money to its teachers for research </td>
				                            	<td align="center">
				                            		<b><?php echo $seed_money_mark;?></b><br>
				                            		<?php echo $total_seed_money;?>
				                            	</td>
				                            	<td align="center">4<br>(>=20)</td>
				                            	<td align="center">
				                            		<?php
				                            			$seed_money_deficiencies = 4 - $seed_money_mark;
				                            			$seed_money_deficiencies = $seed_money_deficiencies * 25;
				                            			echo $seed_money_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php 

				                            $total_teachers = $total_teachers_mark = 0;

				                            $sql_2 = "SELECT COUNT(*) AS total_teachers FROM `cri_3_1_3_award_fellowship` WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_2);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_teachers = $data['total_teachers'];
											    }
											}

											if ($total_teachers >= 5) {
											    $total_teachers_mark = 4;
											} elseif ($total_teachers >= 4 && $total_teachers < 5) {
											    $total_teachers_mark = 3;
											} elseif ($total_teachers >= 2 && $total_teachers < 4) {
											    $total_teachers_mark = 2;
											} elseif ($total_teachers > 0 && $total_teachers < 2) {
											    $total_teachers_mark = 1;
											} else {
											    $total_teachers_mark = 0;
											}
				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.1.3<br>Q<sub>n</sub>M<b></td>
				                            	<td>Percentage of teachers receiving national/ international fellowship/financial support by various agencies for advanced studies/ research during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $total_teachers_mark;?></b><br>
				                            		<?php echo $total_teachers;?>	
				                            	</td>
				                            	<td align="center">4<br>(>=5)</td>
				                            	<td align="center">
				                            		<?php
				                            			$total_teachers_deficiencies = 4 - $total_teachers_mark;
				                            			$total_teachers_deficiencies = $total_teachers_deficiencies * 25;
				                            			echo $total_teachers_deficiencies . " %";
				                            		?>	
				                            	</td>
				                            </tr>
				                            <tr>
				                            	<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator – 3.2 Resource Mobilization for Research</th>
				                            </tr>

				                            <?php 

				                            $total_fund = $total_fund_mark = 0;

				                            $sql_3 = "SELECT SUM(fund) AS total_fund FROM cri_3_2_1_grants_received WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_3);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_fund = $data['total_fund'];
											    }
											}

											if ($total_fund >= 50) {
											    $total_fund_mark = 4;
											} elseif ($total_fund >= 40 && $total_fund < 50) {
											    $total_fund_mark = 3;
											} elseif ($total_fund >= 20 && $total_fund < 40) {
											    $total_fund_mark = 2;
											} elseif ($total_fund >= 10 && $total_fund < 20) {
											    $total_fund_mark = 1;
											} else {
											    $total_fund_mark = 0;
											}

				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.2.1<br>Q<sub>n</sub>M<b></td>
				                            	<td>Research funding received by the institution and its faculties through Government and non-government sources such as industry, corporate houses, international bodies for research project, endowment research chairs during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $total_fund_mark;?></b><br>
				                            		<?php echo $total_fund;?>
				                            	</td>
				                            	<td align="center">4<br>(>=50)</td>
				                            	<td align="center">
				                            		<?php
				                            			$total_fund_deficiencies = 4 - $total_fund_mark;
				                            			$total_fund_deficiencies = $total_fund_deficiencies * 25;
				                            			echo $total_fund_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php 
				                            $total_research_projects = $total_research_mark = 0;
				                            $sql_4 = "SELECT COUNT(*) AS total_research_projects FROM cri_3_2_1_grants_received WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_4);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_research_projects = $data['total_research_projects'];
											    }
											}

											if ($total_research_projects >= 30) {
											    $total_research_mark = 4;
											} elseif ($total_research_projects >= 20 && $total_research_projects < 30) {
											    $total_research_mark = 3;
											} elseif ($total_research_projects >= 10 && $total_research_projects < 20) {
											    $total_research_mark = 2;
											} elseif ($total_research_projects >= 5 && $total_research_projects < 10) {
											    $total_research_mark = 1;
											} elseif ($total_research_projects < 5) {
											    $total_research_mark = 0;
											}

				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.2.2<br>Q<sub>n</sub>M<b></td>
				                            	<td>Percentage of teachers having research projects during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $total_research_mark;?></b><br>
				                            		<?php echo $total_research_projects;?>
				                            	</td>
				                            	<td align="center">4<br>(>=30)</td>
				                            	<td align="center">
				                            		<?php
				                            			$total_research_projects_deficiencies = 4 - $total_research_mark;
				                            			$total_research_projects_deficiencies = $total_research_projects_deficiencies * 25;
				                            			echo $total_research_projects_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php 

				                            $total_research_guide = $total_research_guide_mark = 0;

				                            $sql_5 = "SELECT COUNT(*) AS total_research_guide FROM cri_2_4_2_teachers WHERE academic_year = '$academic_year' AND research_guide = 'Yes'";

											$datas = $con->query($sql_5);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_research_guide = $data['total_research_guide'];
											    }
											}

											if ($total_research_guide >= 30) {
											    $total_research_guide_mark = 4;
											} elseif ($total_research_guide >= 20 && $total_research_guide < 30) {
											    $total_research_guide_mark = 3;
											} elseif ($total_research_guide >= 10 && $total_research_guide < 20) {
											    $total_research_guide_mark = 2;
											} elseif ($total_research_guide >= 5 && $total_research_guide < 10) {
											    $total_research_guide_mark = 1;
											} else {
											    $total_research_guide_mark = 0;
											}

				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.2.3<br>Q<sub>n</sub>M<b></td>
				                            	<td>Percentage of teachers recognised as research guides as in the latest completed academic year</td>
				                            	<td align="center">
				                            		<b><?php echo $total_research_guide_mark;?></b><br>
				                            		<?php echo $total_research_guide;?>
				                            	</td>
				                            	<td align="center">4<br>(>=30)</td>
				                            	<td align="center">
				                            		<?php
				                            			$total_research_guide_deficiencies = 4 - $total_research_guide_mark;
				                            			$total_research_guide_deficiencies = $total_research_guide_deficiencies * 25;
				                            			echo $total_research_guide_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                             <tr>
				                            	<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicators - 3.4 Research Publications and Awards</th>
				                            </tr>

				                            <?php 
				                            $dboption = $dboption_mark = 0;

				                            $sql_6 = "SELECT choice FROM cri_3_choice WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_6);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $dboption = $data['choice'];
											    }
											}

											if ($dboption == 'A') {
											    $option_mark = 4;
											} elseif ($dboption == 'B') {
											    $option_mark = 3;
											} elseif ($dboption == 'C') {
											    $option_mark = 2;
											} elseif ($dboption == 'D') {
											    $option_mark = 1;
											} else {
											    $option_mark = 0;
											}

				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.3.1<br>Q<sub>n</sub>M<b></td>
				                            	<td><b>The Institution ensures implementation of its stated Code of Ethics for research</b><br>
				                            		The institution has a stated Code of Ethics for research and the implementation of which is ensured through the following:<br>
													1. Inclusion of research ethics in the research methodology course work<br>
													2. Presence of institutional Ethics committee (Animal, Chemical, Bioethics etc.)<br>
													3. Plagiarism check through software<br>
													4. Research Advisory Committee
				                            	</td>
				                            	<td align="center">
				                            		<b><?php echo $option_mark;?></b><br>
				                            		<?php echo $dboption;?>
				                            	</td>
				                            	<td align="center">4<br>(A)</td>
				                            	<td align="center">
				                            		<?php
				                            			$dboption_deficiencies = 4 - $option_mark;
				                            			$dboption_deficiencies = $dboption_deficiencies * 25;
				                            			echo $dboption_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php 

				                            $total_student = $total_student_mark = 0;
				                            $sql_7 = "SELECT COUNT(*) AS total_student FROM cri_3_4_2_scholar WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_7);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_student = $data['total_student'];
											    }
											} 

											if ($total_student >= 6) {
											    $total_student_mark = 4;
											} elseif ($total_student >= 4 && $total_student < 6) {
											    $total_student_mark = 3;
											} elseif ($total_student >= 2 && $total_student < 4) {
											    $total_student_mark = 2;
											} elseif ($total_student >= 1 && $total_student < 2) {
											    $total_student_mark = 1;
											} else {
											    $total_student_mark = 0;
											}
				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.3.2<br>Q<sub>n</sub>M<b></td>
				                            	<td>Number of candidates registered for Ph.D per teacher (as per the data given w.r.t recognized Ph.D guides/ supervisors provided at 3.2.3 metric) during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $total_student_mark;?></b><br>
				                            		<?php echo $total_student;?>
				                            	</td>
				                            	<td align="center">4<br>(>=6)</td>
				                            	<td align="center">
				                            		<?php
				                            			$total_student_deficiencies = 4 - $total_student_mark;
				                            			$total_student_deficiencies = $total_student_deficiencies * 25;
				                            			echo $total_student_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php 

				                            $sql_8 = "SELECT COUNT(*) AS care_Journals FROM cri_3_4_3_research_paper WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_8);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $care_Journals = $data['care_Journals'];
											    }
											}

											if ($care_Journals >= 5) {
											    $care_Journals_mark = 4;
											} elseif ($care_Journals >= 3 && $care_Journals < 5) {
											    $care_Journals_mark = 3;
											} elseif ($care_Journals >= 2 && $care_Journals < 3) {
											    $care_Journals_mark = 2;
											} elseif ($care_Journals >= 1 && $care_Journals < 2) {
											    $care_Journals_mark = 1;
											} else {
											    $care_Journals_mark = 0;
											}

				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.3.3<br>Q<sub>n</sub>M<b></td>
				                            	<td>Number of research papers published per teacher in the Journals as notified on UGC CARE list during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $care_Journals_mark;?></b><br>
				                            		<?php echo $care_Journals;?>
				                            	</td>
				                            	<td align="center">4<br>(>=5)</td>
				                            	<td align="center">
				                            		<?php
				                            			$care_Journals_deficiencies = 4 - $care_Journals_mark;
				                            			$care_Journals_deficiencies = $care_Journals_deficiencies * 25;
				                            			echo $care_Journals_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php 
				                            	$sql_9 = "SELECT COUNT(*) AS total_books FROM cri_3_4_4_edited_books WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_9);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_books = $data['total_books'];
												    }
												} 

												if ($total_books >= 8) {
												    $total_books_mark = 4;
												} elseif ($total_books >= 5 && $total_books < 8) {
												    $total_books_mark = 3;
												} elseif ($total_books >= 3 && $total_books < 5) {
												    $total_books_mark = 2;
												} elseif ($total_books >= 1 && $total_books < 3) {
												    $total_books_mark = 1;
												} else {
												    $total_books_mark = 0;
												}
				                            ?>

				                            <tr>
				                            	<td align="center"><b>3.3.4<br>Q<sub>n</sub>M<b></td>
				                            	<td>Number of books and chapters in edited volumes published per teacher during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $total_books_mark;?></b><br>
				                            		<?php echo $total_books;?>
				                            	</td>
				                            	<td align="center">4<br>(>=8)</td>
				                            	<td align="center">
				                            		<?php
				                            			$total_books_deficiencies = 4 - $total_books_mark;
				                            			$total_books_deficiencies = $total_books_deficiencies * 25;
				                            			echo $total_books_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>
				                            <?php 

				                            $sql_10 = "SELECT COUNT(*) AS total_citation FROM cri_3_4_5_citation_index WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_10);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_citation = $data['total_citation'];
											    }
											}

											if ($total_citation >= 8) {
											    $citation_mark = 4;
											} elseif ($total_citation >= 6 && $total_citation < 8) {
											    $citation_mark = 3;
											} elseif ($total_citation >= 3 && $total_citation < 6) {
											    $citation_mark = 2;
											} elseif ($total_citation >= 1 && $total_citation < 3) {
											    $citation_mark = 1;
											} else {
											    $citation_mark = 0;
											}

				                            ?>
				                            <tr>
				                            	<td align="center"><b>3.3.5<br>Q<sub>n</sub>M<b></td>
				                            	<td>Bibliometrics of the publications during the year based on average Citation index in Scopus/ Web of Science </td>
				                            	<td align="center">
				                            		<b><?php echo $citation_mark;?></b><br>
				                            		<?php echo $total_citation;?>
				                            	</td>
				                            	<td align="center">4<br>(>=8)</td>
				                            	<td align="center">
				                            		<?php
				                            			$citation_deficiencies = 4 - $citation_mark;
				                            			$citation_deficiencies = $citation_deficiencies * 25;
				                            			echo $citation_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <?php

                        					$sql_11 = "SELECT COUNT(*) AS total_h FROM cri_3_4_6_h_index WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_11);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_h = $data['total_h'];
											    }
											} 

											if ($total_h >= 12) {
											    $h_mark = 4;
											} elseif ($total_h >= 10 && $total_h < 12) {
											    $h_mark = 3;
											} elseif ($total_h >= 5 && $total_h < 10) {
											    $h_mark = 2;
											} elseif ($total_h >= 1 && $total_h < 5) {
											    $h_mark = 1;
											} else {
											    $h_mark = 0;
											} 
                        					?>

				                            <tr>
				                            	<td align="center"><b>3.3.6<br>Q<sub>n</sub>M<b></td>
				                            	<td>Bibliometrics of the publications during the year based on Scopus/ Web of Science – h-index of the Institution</td>
				                            	<td align="center">
				                            		<b><?php echo $h_mark;?></b><br>
				                            		<?php echo $total_h;?>
				                            	</td>
				                            	<td align="center">4<br>(>=12)</td>
				                            	<td align="center">
				                            		<?php
				                            			$h_deficiencies = 4 - $h_mark;
				                            			$h_deficiencies = $h_deficiencies * 25;
				                            			echo $h_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <tr>
				                            	<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicators - 3.5 Consultancy</th>
				                            </tr>
				                            <?php 	
				                            $sql_12 = "SELECT SUM(revenue_generated) AS total_revenue_generated FROM cri_3_5_1_revenue_generated WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_12);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_revenue_generated = $data['total_revenue_generated'];
												    }
												}

												if ($total_revenue_generated >= 50) {
												    $revenue_generated_mark = 4;
												} elseif ($total_revenue_generated >= 40 && $total_revenue_generated < 50) {
												    $revenue_generated_mark = 3;
												} elseif ($total_revenue_generated >= 30 && $total_revenue_generated < 40) {
												    $revenue_generated_mark = 2;
												} elseif ($total_revenue_generated >= 10 && $total_revenue_generated < 30) {
												    $revenue_generated_mark = 1;
												} else{
												    $revenue_generated_mark = 0;
												}
				                            ?>
				                            <tr>
				                            	<td align="center"><b>3.5.1<br>Q<sub>n</sub>M<b></td>
				                            	<td>Revenue generated from consultancy and corporate training during the year (INR in Lakhs)</td>
				                            	<td align="center">
				                            		<b><?php echo $revenue_generated_mark;?></b><br>
				                            		<?php echo $total_revenue_generated;?>
				                            	</td>
				                            	<td align="center">4<br>(>=50)</td>
				                            	<td align="center">
				                            		<?php
				                            			$revenue_generated_mark_deficiencies = 4 - $revenue_generated_mark;
				                            			$revenue_generated_mark_deficiencies = $revenue_generated_mark_deficiencies * 25;
				                            			echo $revenue_generated_mark_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <tr>
				                            	<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicators - 3.6 Extension Activities</th>
				                            </tr>

				                            <?php

	                        					$total_extension_activities = 0;

	                        					$sql_13 = "SELECT COUNT(*) AS total_extension_activities FROM cri_3_6_3_extension_activities WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_13);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_extension_activities = $data['total_extension_activities'];
												    }
												} 

												if ($total_extension_activities >= 75) {
												    $activities_mark = 4;
												} elseif ($total_extension_activities >= 60 && $total_extension_activities < 75) {
												    $activities_mark = 3;
												} elseif ($total_extension_activities >= 40 && $total_extension_activities < 60) {
												    $activities_mark = 2;
												} elseif ($total_extension_activities >= 10 && $total_extension_activities < 40) {
												    $activities_mark = 1;
												} else{
												    $activities_mark = 0;
												} 
	                        					?>

				                            <tr>
				                            	<td align="center"><b>3.6.2<br>Q<sub>n</sub>M<b></td>
				                            	<td>Number of extension and outreach programs conducted by the institution through organized forums including NSS/NCC with involvement of community during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $activities_mark;?></b><br>
				                            		<?php echo $total_extension_activities;?>
				                            	</td>
				                            	<td align="center">4<br>(>=50)</td>
				                            	<td align="center">
				                            		<?php
				                            			$activities_mark_deficiencies = 4 - $activities_mark;
				                            			$activities_mark_deficiencies = $activities_mark_deficiencies * 25;
				                            			echo $activities_mark_deficiencies . " %";
				                            		?>
				                            	</td>
				                            </tr>

				                            <tr>
				                            	<th colspan="5" style="text-align:center; background-color:#057EC5; color:#FFF;">Key Indicator - 3.7 Collaboration</th>
				                            </tr>

				                            <?php

	                        					$total_mou = 0;

	                        					$sql_14 = "SELECT COUNT(*) AS total_mou FROM cri_3_7_2_mou_details WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_14);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_mou = $data['total_mou'];
												    }
												} 

												if ($total_mou >= 30) {
												    $mou_mark = 4;
												} elseif ($total_mou >= 20 && $total_mou < 30) {
												    $mou_mark = 3;
												} elseif ($total_mou >= 10 && $total_mou < 20) {
												    $mou_mark = 2;
												} elseif ($total_mou >= 5 && $total_mou < 10) {
												    $mou_mark = 1;
												} else{
												    $mou_mark = 0;
												}
	                        				?>

				                            <tr>
				                            	<td align="center"><b>3.7.1<br>Q<sub>n</sub>M<b></td>
				                            	<td>Number of functional MoUs/linkages/collaboration with institutions/ industries in India and abroad for internship, on-the-job training, project work, student / faculty exchange and collaborative research during the year</td>
				                            	<td align="center">
				                            		<b><?php echo $mou_mark;?></b><br>
				                            		<?php echo $total_mou;?>
				                            	</td>
				                            	<td align="center">4<br>(>=50)</td>
				                            	<td align="center">
				                            		<?php
				                            			$mou_mark_deficiencies = 4 - $mou_mark;
				                            			$mou_mark_deficiencies = $mou_mark_deficiencies * 25;
				                            			echo $mou_mark_deficiencies . " %";
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