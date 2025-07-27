<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';

$academic_year = $academic_year_err = $download = $download_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST")    
{
    // Academic Year Validation

    if(empty(trim($_POST["academic_year"])))
    {            
        $academic_year_err = "Please Enter Academic Year.";
    }
    else
    {
        $academic_year = trim($_POST["academic_year"]);
    }

    // Download Validation

    if (empty(trim($_POST["download"]))) 
    {
        $download_err = " Please Select Download.";
    }
    else
    {
        $download=trim($_POST["download"]);     
    }

     // Insert Data

    if(empty($academic_year_err) && empty($download_err))
    {
    	if($download == 'Course List')
        {
            require '../../Libraries/TCPDF/tcpdf.php';

            // create new PDF document
            $pdf = new TCPDF('P','mm','A4');

            //remove default header and footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            //add page
            $pdf->AddPage();

            //title
            $pdf->SetFont('Helvetica','B',18);
            $pdf->Cell(190,10,"PSNA College of Engineering And Technology",0,1,'C');
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(190,5,"(An Autonomous Institution affiliated to Anna University, Chennai)",0,1,'C');
            $pdf->SetFont('Helvetica','B',12);
            $pdf->Cell(190,5,"NBA | AICTE | NAAC with A++",0,1,'C');
            $pdf->Ln(5);

$p = <<<EOD
    <p>List of courses related to Gender, Human Values, Environment and Sustainability and Professional Ethics.</p>
    <style>
    p
    {
    	text-align:center;
    }
    </style>
EOD;

			$pdf->SetFont('Helvetica','',14);
            $pdf->writeHTML($p,true,false,false,false,'');
            $pdf->Ln(1);

            $pdf->Ln(4);
            $pdf->SetFont('Helvetica','B',14);
            $pdf->Cell(190,5,'Academic Year: '.$academic_year,0,1,'C');

            $pdf->Ln(5);

$tbl = <<<EOD
    <table>
        <tr>
            <th width = "7%">Sl.No</th>
            <th width = "11%">Program Code</th>
            <th width = "25%">Program Name</th>
            <th width = "12%">Course Code</th>
            <th width = "28%">Name of the Course</th>
            <th >Name of the Topics</th>
        </tr>
EOD;

        $query = "SELECT d.programme_code, d.programme_name,c.academic_year, c.course_code, c.course_name, c.course_type FROM programme_info AS d LEFT JOIN cri_1_3_1_courses AS c ON c.programme_code = d.programme_code WHERE c.academic_year = '$academic_year' ORDER BY c.id ASC";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while ($row = $result -> fetch_assoc()) 
            {
                $i++;

$tbl .= <<<EOD
    <tr>
        <td>$i</td>
        <td>{$row["programme_code"]}</td>
        <td>{$row["programme_name"]}</td>
        <td>{$row["course_code"]}</td>
        <td>{$row["course_name"]}</td>
        <td>{$row["course_type"]}</td>
    </tr>
EOD;
            }
        }

$tbl .= <<<EOD
    </table>
        <style>
            table {
                border-collapse:collapse;
            }
            th,td {
                border:1px solid black;
            }
            table tr th {
                font-weight:bold;
                text-align:center;
                display:table-cell;
            }
            table tr td{
                text-align:center;
                display:table-cell;
            }
        </style>
EOD;

            $pdf->SetFont('Helvetica','',12);
            $pdf->writeHTML($tbl,true,false,false,false,'');

            $pdf->Output('1.3.1 Course List.pdf', 'D');
        }

        elseif($download == 'Event List')
        {
            require '../../Libraries/TCPDF/tcpdf.php';

            // create new PDF document
            $pdf = new TCPDF('P','mm','A4');

            //remove default header and footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            //add page
            $pdf->AddPage();

            //title
            $pdf->SetFont('Helvetica','B',18);
            $pdf->Cell(190,10,"PSNA College of Engineering And Technology",0,1,'C');
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(190,5,"(An Autonomous Institution affiliated to Anna University, Chennai)",0,1,'C');
            $pdf->SetFont('Helvetica','B',12);
            $pdf->Cell(190,5,"NBA | AICTE | NAAC with A++",0,1,'C');
            $pdf->Ln(5);

$p = <<<EOD
    <p>List of Events related to Gender, Human values, Environment and Sustainability and Professional Ethics.</p>
    <style>
    p
    {
    	text-align:center;
    }
    </style>
EOD;

            $pdf->SetFont('Helvetica','',14);
            $pdf->writeHTML($p,true,false,false,false,'');
            $pdf->Ln(1);

            $pdf->Ln(4);
            $pdf->SetFont('Helvetica','B',14);
            $pdf->Cell(190,5,'Academic Year: '.$academic_year,0,1,'C');

            $pdf->Ln(5);
$tbl = <<<EOD
    <table>
        <tr>
            <th width = "7%">Sl.No</th>
            <th width = "30%">Name of the Activity </th>
            <th>Organizing Unit / Agency / Collaborating Agency</th>
            <th width = "27%">Name of the Scheme</th>
            <th width = "14%">Date of the Activity</th>
        </tr>
EOD;

        $query = "SELECT activity_name, organizing_unit, relevant_event, activity_date FROM cri_1_3_1_events WHERE academic_year = '$academic_year' ORDER BY activity_date";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while ($row = $result -> fetch_assoc()) 
            {
                $i++;

                $tem_date = $row["activity_date"];
                $date = date("d-m-Y", strtotime($tem_date));
$tbl .= <<<EOD
    <tr>
        <td>$i</td>
        <td>{$row["activity_name"]}</td>
        <td>{$row["organizing_unit"]}</td>
        <td>{$row["relevant_event"]}</td>
        <td>$date</td>
    </tr>
EOD;
            }
        }

$tbl .= <<<EOD
    </table>
        <style>
            table {
                border-collapse:collapse;
            }
            th,td {
                border:1px solid black;
            }
            table tr th {
                font-weight:bold;
                text-align:center;
                display:table-cell;
            }
            table tr td{
                text-align:center;
                display:table-cell;
            }
        </style>
EOD;

            $pdf->SetFont('Helvetica','',12);
            $pdf->writeHTML($tbl,true,false,false,false,'');

            $pdf->Output('1.3.1 Event List.pdf', 'D');
        }
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

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criteria - 1</title>
	<style type="text/css">
		#active
		{
			font-weight: bold;
		}
		#non-active
		{
			color: dimgrey;
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 1.3</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-graduation-cap"></i>
							<span>Criteria 1.3.1 - Institution integrates crosscutting issues relevant to Professional Ethics ,Gender, Human Values ,Environment and Sustainability into the Curriculum.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.1_writeup.php" id="non-active">Write Up</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_courses_doc_view.php" id="non-active">View Document (Courses)</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_events.php" id="non-active">Relevant to Events</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_events_doc_view.php" id="non-active">View Document (Events)</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="cri_1.3.1_pdf_report.php" id="active">PDF Report</a>
                                </li>

							</ul><br>

	                            <div class = "card-body">

                                   <div class="container-fluid">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 1.3.1 - Download Report</span>
                                                </div>
                                                
                                                <div class="card-body">
                                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

                                                        <div class="mb-3">
															<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

															<select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

																<option value="">---Select Academic Year---</option>

																<?php
																$sql = "SELECT * FROM academic_year WHERE hide_status = 1 ORDER BY academic_year";
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

                                                        <div class="mb-3">
                                                            <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="download"><span style="color: red">* </span>Download</label>

                                                            <select name="download" class="form-select <?php echo (!empty($download_err)) ? 'is-invalid' : ''; ?>" id="download">

                                                                <option value="">---Select Download---</option>

                                                                <option value="Course List" 
                                                                <?php 
                                                                    if($download == 'Course List') 
                                                                    { 
                                                                
                                                                        echo "selected"; 
                                                                    } 
                                                                ?>

                                                                >Course List</option>

                                                                <option value="Course Proof"

                                                                <?php 
                                                                    if($download == 'Course Proof')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Course Proof</option>

                                                                <option value="Event List" 
                                                                <?php 
                                                                    if($download == 'Event List') 
                                                                    { 
                                                                
                                                                        echo "selected"; 
                                                                    } 
                                                                ?>

                                                                >Event List</option>

                                                                <option value="Event Proof"

                                                                <?php 
                                                                    if($download == 'Event Proof')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Event Proof</option>

                                                            </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $download_err; ?>
                                                            </span>
                                                        </div>

                                                        <button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-download"></i>&nbsp;&nbsp;Download</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                            </div>  
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
