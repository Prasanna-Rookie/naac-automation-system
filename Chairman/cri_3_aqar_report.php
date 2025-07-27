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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3 - AQAR Report</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-square-poll-vertical fa-lg"></i>
							<span>Criterion III – Research, Innovations and Extension - AQAR Report.</span>
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
		                        					<span>Criterion III - AQAR Report.</span>
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
								$cri_3_1_1_writeup = $cri_3_3_1_writeup = $cri_3_6_1_writeup = "Please updated Write Up for this Metric.";

								$total_seed_money = $total_teachers = $total_fund = $total_research_projects = $total_research_guide = $total_departments = $total_seminars = $total_student = $care_Journals = $total_h = $total_awards = 0;

								?>
								<h3 class="card-title" id="card-title">Key Indicator - 3.1 Promotion of Research and Facilities</h3>

								<?php 

								$sql_1 = "SELECT write_up FROM cri_3_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 3.1.1'";
								$datas = $con->query($sql_1);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_3_1_1_writeup = $data['write_up'];
								    }
								}

								$sql_2 = "SELECT SUM(seed_money) AS total_seed_money FROM cri_3_1_2_seed_money WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_2);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_seed_money = $data['total_seed_money'];
								    }
								}

								$sql_3 = "SELECT COUNT(*) AS total_teachers FROM `cri_3_1_3_award_fellowship` WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_3);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_teachers = $data['total_teachers'];
								    }
								}

								?>

								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 3.1 Promotion of Research and Facilities</th>
				                            </tr>
                        				</thead>
                        				<tbody>
                        					<tr>
                        						<td align="center"><b>3.1.1<br>Q<sub>l</sub>M<b></td>
                        							<td>
                        								<p><b>The institution’s research facilities are frequently updated and there is a welldefined policy for promotion of research which is uploaded on the institutional website and implemented</b></p>

                        								<table class="table table-bordered table-hover">
		                                                	<tbody>
			                                                    <tr>
			                                                        <td><?php echo $cri_3_1_1_writeup; ?></td>
			                                                    </tr>
			                                                </tbody>
			                                            </table>
                        							</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>3.1.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>The institution provides seed money to its teachers for research</b></p>

                        							<p>Seed money provided by the institution to its teachers for research during the year (INR in lakhs) : 

						                            <b><?php echo $total_seed_money; ?></b></p>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>3.1.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of teachers who were awarded national / international fellowship(s) for advanced studies/research during the year</b></p>

                        							<p>Number of teachers : 

						                            <b><?php echo $total_teachers; ?></b></p>
                        						</td>
                        					</tr>
                        				</tbody>
									</table>
								</div>

								<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
								<h3 class="card-title" id="card-title">Key Indicator - 3.2 Resource Mobilization for Research</h3>

								<?php 

								$sql_4 = "SELECT SUM(fund) AS total_fund FROM cri_3_2_1_grants_received WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_4);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_fund = $data['total_fund'];
								    }
								}

								$sql_5 = "SELECT COUNT(*) AS total_research_projects FROM cri_3_2_1_grants_received WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_5);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_research_projects = $data['total_research_projects'];
								    }
								}

								$sql_6 = "SELECT COUNT(*) AS total_research_guide FROM cri_2_4_2_teachers WHERE academic_year = '$academic_year' AND research_guide = 'Yes'";

								$datas = $con->query($sql_6);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_research_guide = $data['total_research_guide'];
								    }
								}

								$sql_7 = "SELECT COUNT(DISTINCT principal_dept) AS total_departments
								FROM cri_3_2_1_grants_received WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_7);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_departments = $data['total_departments'];
								    }
								}

								?>

								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 3.2 Resource Mobilization for Research</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<tr>
                        						<td align="center"><b>3.2.1<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Grants received from Government and Non-Governmental agencies for research projects, endowments, Chairs during the year (INR in Lakhs)</b></p>

                        							<p>Grants received from Government and Non-Governmental agencies (INR in lakhs) : 

						                            <b><?php echo $total_fund; ?></b></p>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>3.2.2<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of teachers having research projects during the year</b></p>

                        							<p>Number of teachers having research projects : 

						                            <b><?php echo $total_research_projects; ?></b></p>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>3.2.3<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of teachers recognised as research guides</b></p>

                        							<p>Number of teachers recognised as research guides : 

						                            <b><?php echo $total_research_guide; ?></b></p>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>3.2.4<br>Q<sub>n</sub>M<b></td>
                        						<td>
                        							<p><b>Number of departments having research projects funded by Government and Non-Government agencies during the year</b></p>

                        							<p>Number of departments having research projects : 

						                            <b><?php echo $total_departments; ?></b></p>
                        						</td>
                        					</tr>
                        					
                        				</tbody>
                        			</table>
                        		</div>

                        		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
								<h3 class="card-title" id="card-title">Key Indicator - 3.3 Innovation Ecosystem</h3>

								<?php 

								$sql_8 = "SELECT write_up FROM cri_3_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 3.3.1'";
								$datas = $con->query($sql_8);
								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $cri_3_3_1_writeup = $data['write_up'];
								    }
								}

								$sql_9 = "SELECT COUNT(*) AS total_seminars FROM cri_3_3_2_workshops_seminars WHERE academic_year = '$academic_year'";

								$datas = $con->query($sql_9);

								if($datas->num_rows>0)
								{
								    while ($data = $datas->fetch_assoc())
								    {
								        $total_seminars = $data['total_seminars'];
								    }
								}
								?>

								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead style="background-color:#057EC5; color:#FFF;">
				                            <tr>
				                                <th style="text-align:center;" width="20">Metric No.</th>
				                                <th style="text-align:center;">Key Indicator - 3.3 Innovation Ecosystem</th>
				                            </tr>
                        				</thead>
                        				<tbody>

                        					<tr>
                        						<td align="center"><b>3.3.1<br>Q<sub>l</sub>M<b></td>
                        						<td>
                        							<p><b>Institution has created an ecosystem for innovations and creation and transfer of knowledge supported by dedicated centres for research, entrepreneurship, community orientation, incubation, etc</b></p>

                        							<table class="table table-bordered table-hover">
		                                                <tbody>
			                                                <tr>
			                                                    <td><?php echo $cri_3_3_1_writeup; ?></td>
			                                                </tr>
			                                            </tbody>
			                                        </table>
                        						</td>
                        					</tr>

                        					<tr>
                        						<td align="center"><b>3.3.2<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>Number of workshops/seminars conducted on Research Methodology, Intellectual Property Rights (IPR), Entrepreneurship and Skill Development during the year</b></p>

	                        						<p>Number of workshops/seminars conducted : 

							                        <b><?php echo $total_seminars; ?></b></p>
	                        					</td>
                        					</tr>

                        				</tbody>
                        			</table>
                        		</div>

                        		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
								<h3 class="card-title" id="card-title">Key Indicators - 3.4 Research Publications and Awards</h3>

								<table class="table table-bordered table-hover">
									<thead style="background-color:#057EC5; color:#FFF;">
				                        <tr>
				                            <th style="text-align:center;" width="20">Metric No.</th>
				                            <th style="text-align:center;">Key Indicators - 3.4 Research Publications and Awards</th>
				                        </tr>
                        			</thead>
                        				<tbody>
                        					<?php

                        					$sql_10 = "SELECT choice FROM cri_3_choice WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_10);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $dboption = $data['choice'];
											    }

											    if($dboption == "A")
											    {
											    	$option = "All of the above";
											    }
											    elseif($dboption == "B")
											    {
											    	$option = "Any 3 of the above";
											    }
											    elseif($dboption == "C")
											    {
											    	$option = "Any 2 of the above";
											    }
											    elseif($dboption == "D")
											    {
											    	$option = "Any 1 of the above";
											    }
											    else
											    {
											    	$option = "None of the above";
											    }
											}

                        					?>

                        					<tr>
                        						<td align="center"><b>3.4.1<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>The Institution ensures implementation of its Code of Ethics for Research uploaded in the website through the following</b><br>

	                        							1. Research Advisory Committee<br>
														2. Ethics Committee<br>
														3. Inclusion of Research Ethics in the research methodology course work<br>
														4. Plagiarism check through authenticated software<br>
	                        						</p>

	                        						<p>Options : 

							                        <b><?php echo $option; ?></b></p>
	                        					</td>
                        					</tr>

                        					<?php
                        					$sql_11 = "SELECT COUNT(*) AS total_student FROM cri_3_4_2_scholar WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_11);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_student = $data['total_student'];
											    }
											} 
                        					?>

                        					<tr>
                        						<td align="center"><b>3.4.2<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>Number of PhD candidates registered per teacher (as per the data given with regard to recognized PhD guides/ supervisors provided in Metric No. 3.2.3) during the year</b></p>

	                        						<p>Number of PhD students registered during the year : 

							                        <b><?php echo $total_student; ?></b></p>

							                        <p>Number of teachers recognised as research guides : 

						                            <b><?php echo $total_research_guide; ?></b></p>
	                        					</td>
                        					</tr>

                        					<?php

                        					$sql_12 = "SELECT COUNT(*) AS care_Journals FROM cri_3_4_3_research_paper WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_12);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $care_Journals = $data['care_Journals'];
											    }
											}  
                        					?>

                        					<tr>
                        						<td align="center"><b>3.4.3<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>Number of research papers per teacher in CARE Journals notified on UGC website during the year</b></p>

	                        						<p>Number of research papers : 

							                        <b><?php echo $care_Journals; ?></b></p>
	                        					</td>
                        					</tr>

                        					<?php

                        					$sql_13 = "SELECT COUNT(*) AS total_books FROM cri_3_4_4_edited_books WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_13);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_books = $data['total_books'];
											    }
											}  
                        					?>

                        					<tr>
                        						<td align="center"><b>3.4.4<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>Number of books and chapters in edited volumes / books published per teacher during the year</b></p>

	                        						<p>Number of books and chapters : 

							                        <b><?php echo $total_books; ?></b></p>
	                        					</td>
                        					</tr>

                        					<?php

                        					$sql_14 = "SELECT COUNT(*) AS total_citation FROM cri_3_4_5_citation_index WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_14);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_citation = $data['total_citation'];
											    }
											}  
                        					?>

                        					<tr>
                        						<td align="center"><b>3.4.5<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>Bibliometrics of the publications during the year based on average Citation Index in Scopus/ Web of Science/PubMed</b></p>

	                        						<p>Total number of Citations in Scopus and n Web of Science : 

							                        <b><?php echo $total_citation; ?></b></p>
	                        					</td>
                        					</tr>

                        					<?php

                        					$sql_15 = "SELECT COUNT(*) AS total_h FROM cri_3_4_6_h_index WHERE academic_year = '$academic_year'";

											$datas = $con->query($sql_15);

											if($datas->num_rows>0)
											{
											    while ($data = $datas->fetch_assoc())
											    {
											        $total_h = $data['total_h'];
											    }
											}  
                        					?>

                        					<tr>
                        						<td align="center"><b>3.4.6<br>Q<sub>n</sub>M<b></td>
	                        					<td>
	                        						<p><b>Bibliometrics of the publications during the year based on average Citation Index in Scopus/ Web of Science/PubMed</b></p>

	                        						<p>H-index of Scopus and Web of Science : 

							                        <b><?php echo $total_h; ?></b></p>
	                        					</td>
                        					</tr>
                        				</tbody>
                        			</table>

                        			<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
									<h3 class="card-title" id="card-title">Key Indicators - 3.5 Consultancy</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
					                            <tr>
					                                <th style="text-align:center;" width="20">Metric No.</th>
					                                <th style="text-align:center;">Key Indicators - 3.5 Consultancy</th>
					                            </tr>
	                        				</thead>
	                        				<tbody>

	                        					<?php

	                        					$sql_16 = "SELECT SUM(revenue_generated) AS total_revenue_generated FROM cri_3_5_1_revenue_generated WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_16);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_revenue_generated = $data['total_revenue_generated'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.5.1<br>Q<sub>n</sub>M<b></td>
		                        					<td>
		                        						<p><b>Bibliometrics of the publications during the year based on average Citation Index in Scopus/ Web of Science/PubMed</b></p>

		                        						<p>Total Revenue generated from consultancy and corporate training : 

								                        <b><?php echo $total_revenue_generated; ?></b></p>
		                        					</td>
	                        					</tr>

	                        					<?php

	                        					$sql_17 = "SELECT SUM(revenue_generated) AS total_spend FROM cri_3_5_2_revenue_generated WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_17);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_spend = $data['total_spend'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.5.2<br>Q<sub>n</sub>M<b></td>
		                        					<td>
		                        						<p><b>Total amount spent on developing facilities, training teachers and clerical/project staff for undertaking consultancy during the year</b></p>

		                        						<p>Total amount spent on developing facilities, training teachers and clerical/project staff : 

								                        <b><?php echo $total_spend; ?></b></p>
		                        					</td>
	                        					</tr>
	                        					
	                        				</tbody>
	                        			</table>
	                        		</div>

	                        		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
									<h3 class="card-title" id="card-title">Key Indicators - 3.6 Extension Activities</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
					                            <tr>
					                                <th style="text-align:center;" width="20">Metric No.</th>
					                                <th style="text-align:center;">Key Indicators - 3.6 Extension Activities</th>
					                            </tr>
	                        				</thead>
	                        				<tbody>

	                        					<?php 

												$sql_18 = "SELECT write_up FROM cri_3_write_up WHERE academic_year = '$academic_year' AND criteria = 'metric 3.6.1'";
												$datas = $con->query($sql_18);
												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $cri_3_6_1_writeup = $data['write_up'];
												    }
												}
												?>
	                        					<tr>
	                        						<td align="center"><b>3.6.1<br>Q<sub>l</sub>M<b></td>
	                        						<td>
	                        							<p><b>Extension activities carried out in the neighbourhood sensitising students to social issues for their holistic development, and the impact thereof during the year</b></p>

	                        							<table class="table table-bordered table-hover">
			                                                <tbody>
				                                                <tr>
				                                                    <td><?php echo $cri_3_6_1_writeup; ?></td>
				                                                </tr>
				                                            </tbody>
				                                        </table>
	                        						</td>
	                        					</tr>

	                        					<?php

	                        					$sql_19 = "SELECT COUNT(*) AS total_awards FROM cri_3_6_2_awards_received WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_19);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_awards = $data['total_awards'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.6.2<br>Q<sub>n</sub>M<b></td>
	                        						<td>
	                        							<p><b>Number of awards and recognition received by the Institution, its teachers and students for extension activities from Government / Government-recognised bodies during the year</b></p>

	                        							<p>Total number of awards and recognition received by the Institution : 

								                        <b><?php echo $total_awards; ?></b></p>
	                        						</td>
	                        					</tr>

	                        					<?php

	                        					$total_extension_activities = 0;

	                        					$sql_20 = "SELECT COUNT(*) AS total_extension_activities FROM cri_3_6_3_extension_activities WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_20);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_extension_activities = $data['total_extension_activities'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.6.3<br>Q<sub>n</sub>M<b></td>
	                        						<td>
	                        							<p><b>Number of extension and outreach programmes conducted by the institution through NSS/NCC during the year</b></p>

	                        							<p>Total number of extension and outreach programmes conducted : 

								                        <b><?php echo $total_extension_activities; ?></b></p>
	                        						</td>
	                        					</tr>

	                        					<?php

	                        					$total_no_of_students = 0;

	                        					$sql_21 = "SELECT SUM(no_of_students) AS total_no_of_students FROM cri_3_6_3_extension_activities WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_21);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_no_of_students = $data['total_no_of_students'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.6.4<br>Q<sub>n</sub>M<b></td>
	                        						<td>
	                        							<p><b>Number of students participating in extension activities listed in 3.6.3 during the year</b></p>

	                        							<p>Total number of students participating in extension activities : 

								                        <b><?php echo $total_no_of_students; ?></b></p>
	                        						</td>
	                        					</tr>

	                        				</tbody>
	                        			</table>
	                        		</div>

	                        		<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
									<h3 class="card-title" id="card-title">Key Indicator - 3.7 Collaboration</h3>

									<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead style="background-color:#057EC5; color:#FFF;">
					                            <tr>
					                                <th style="text-align:center;" width="20">Metric No.</th>
					                                <th style="text-align:center;">Key Indicator - 3.7 Collaboration</th>
					                            </tr>
	                        				</thead>
	                        				<tbody>
	                        					<?php

	                        					$total_collaborating_agency = 0;

	                        					$sql_22 = "SELECT COUNT(*) AS total_collaborating_agency FROM cri_3_7_1_collaborating_agency WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_22);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_collaborating_agency = $data['total_collaborating_agency'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.7.1<br>Q<sub>n</sub>M<b></td>
	                        						<td>
	                        							<p><b>Number of collaborative activities during the year for research/ faculty exchange/ student exchange/ internship/ on-the-job training/ project work</b></p>

	                        							<p>Total number of collaborative activities : 

								                        <b><?php echo $total_collaborating_agency; ?></b></p>
	                        						</td>
	                        					</tr>

	                        					<?php

	                        					$total_mou = 0;

	                        					$sql_23 = "SELECT COUNT(*) AS total_mou FROM cri_3_7_2_mou_details WHERE academic_year = '$academic_year'";

												$datas = $con->query($sql_23);

												if($datas->num_rows>0)
												{
												    while ($data = $datas->fetch_assoc())
												    {
												        $total_mou = $data['total_mou'];
												    }
												}  
	                        					?>

	                        					<tr>
	                        						<td align="center"><b>3.7.2<br>Q<sub>n</sub>M<b></td>
	                        						<td>
	                        							<p><b>Number of functional MoUs with institutions of national and/or international importance, other universities, industries, corporate houses, etc. during the year (only functional MoUs with ongoing activities to be considered)</b></p>

	                        							<p>Total number of functional MoUs : 

								                        <b><?php echo $total_mou; ?></b></p>
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