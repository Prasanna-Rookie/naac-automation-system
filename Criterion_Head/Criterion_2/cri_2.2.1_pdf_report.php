<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
use setasign\Fpdi;
use setasign\fpdf;
require_once '../../Libraries/PDF Merger/autoload.php';
require_once '../../Libraries/PDF Merger/setasign/fpdf/fpdf.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(100);
date_default_timezone_set('UTC');
$start = microtime(true);

$pdf = new Fpdi\Fpdi();

if ($pdf instanceof \TCPDF) 
{
    $pdf->SetProtection(['print'], '', 'owner');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
}

// Array for file path
$files = [];
require '../../config.php';

$academic_year = $academic_year_err = $download = $download_err = "";
$upload_by = $_SESSION['criterion'];
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
    	if($download == 'Special Programmes List')
        {
        	require '../../Libraries/TCPDF/tcpdf.php';

            // create new PDF document
            $pdf = new TCPDF('P','mm','A4');

            //remove default header and footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            //add page
            $pdf->AddPage();

            $imageFile = '../../images/pdf_header.png';
            $pdf->Image($imageFile, 30, 6, 150, 25);

            $pdf->SetLineWidth(0.6);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Line(0, 32, 210, 32);
            $pdf->Ln(25);

$p = <<<EOD
    <p>Organises Special Programmes for both slow and advanced learners</p>
    <style>
    p
    {
    	text-align:center;
    }
    </style>
EOD;

            $pdf->SetFont('Helvetica','',14);
            $pdf->writeHTML($p,true,false,false,false,'');
            $pdf->Ln(5);
$tbl = <<<EOD
    <table>
        <tr>
            <th width = "7%">Sl.No</th>
            <th width = "18%">Type of Programme</th>
            <th width = "15%">Department</th>
            <th width = "22%">Resource Person</th>
            <th width = "14%">Topic</th>
            <th width = "10%">No.of Days</th>
            <th width = "14%">Date</th>
        </tr>
EOD;

        $query = "SELECT * FROM cri_2_2_1_spc_programmes WHERE academic_year = '$academic_year' ORDER BY sdate";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while ($row = $result -> fetch_assoc()) 
            {
                $i++;

                if($row["edate"] == "-")
                {
                	$tem_sdate = $row["sdate"];
                	$date = date("d-m-Y", strtotime($tem_sdate));
                }
                else
                {
                	$tem_sdate = $row["sdate"];
                	$sdate = date("d-m-Y", strtotime($tem_sdate));

                	$tem_edate = $row["edate"];
                	$edate = date("d-m-Y", strtotime($tem_edate));

                	$date = "$sdate to $edate";
                }       

$tbl .= <<<EOD
    <tr>
        <td>$i</td>
        <td>{$row["type"]}</td>
        <td>{$row["organizer"]}</td>
        <td>{$row["resource_person"]}</td>
        <td>{$row["topic"]}</td>
        <td>{$row["days"]}</td>
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


            $pdf->Output('1.3.1 Course List.pdf', 'D');
        }
        else
        {
        	$sql = "SELECT du.doc_name
				FROM cri_2_2_1_spc_programmes AS du
				LEFT JOIN programme_info AS pi
				ON du.department = pi.programme_code
				WHERE academic_year = '$academic_year' 
				ORDER BY pi.id, du.sdate";

		$result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["doc_name"];
                    $file_path = "../../Uploaded Documents/Criteria - 2/".$file_name;

                    array_push($files, $file_path);
                }
                foreach ($files as $file) 
                {
                    $pageCount = $pdf->setSourceFile($file);
                
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) 
                    {
                        $pdf->AddPage();
                        $pageId = $pdf->importPage($pageNo, '/MediaBox');
                        $s = $pdf->useTemplate($pageId, 10, 10, 200);
                    }
                }
                $file = uniqid().'.pdf';
                $pdf->Output('D', '2.2.1 - '.$academic_year.' - .pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_2.2.1_pdf_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
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

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 2</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 2.2</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-pen"></i>
							<span>Criteria 2.2.1 - The institution assesses students’ learning levels and organises special programmes for both slow and advanced learners.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_2.2.1_writeup.php" id="non-active">Write Up</a>
	                            </li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.1_doc_upload.php" id="non-active">Document Upload</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.1_spc_prog_doc_view.php" id="non-active">View Document (Special Programmes)</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.1_doc_view.php" id="non-active">View Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_2.2.1_pdf_report.php" id="active">PDF Report</a>
								</li>

							</ul>

							<div class = "card-body">
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
													<i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 2.2.1 - Report</span>
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

														<div class="mb-3">
                                                            <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="download"><span style="color: red">* </span>Download</label>

                                                            <select name="download" class="form-select <?php echo (!empty($download_err)) ? 'is-invalid' : ''; ?>" id="download">

                                                                <option value="">---Select Download---</option>

                                                                <option value="Special Programmes List" 
                                                                <?php 
                                                                    if($download == 'Special Programmes List') 
                                                                    { 
                                                                
                                                                        echo "selected"; 
                                                                    } 
                                                                ?>

                                                                >Special Programmes List</option>

                                                                <option value="Special Programmes Proof"

                                                                <?php 
                                                                    if($download == 'Special Programmes Proof')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Special Programmes Proof</option>
                                                            </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $download_err; ?>
                                                            </span>
                                                        </div>

														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Generate</button>
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
