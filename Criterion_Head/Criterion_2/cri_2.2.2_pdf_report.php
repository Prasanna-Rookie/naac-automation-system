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
    	if($download == "Student List")
    	{
    		$sql = "SELECT du.student_list
			FROM cri_2_2_2_doc_upload AS du
			LEFT JOIN programme_info AS pi
			ON du.upload_by = pi.programme_code
			WHERE academic_year = '$academic_year' 
			ORDER BY pi.id";

			$result = mysqli_query($con, $sql);

	            if(mysqli_num_rows($result) > 0)
	            {
	                while ($row = $result -> fetch_assoc()) 
	                {
	                    $file_name = $row["student_list"];
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
	                $pdf->Output('D', '2.2.2 - '.$academic_year.' - .pdf');
	            }
	            else
	            {
	                echo '<script language="javascript">';
	                echo'alert("No Documents Founded."); location.href="cri_2.2.2_pdf_report.php"';
	                echo '</script>';
	            }
	            
	            mysqli_close($con);
    	}
    	else
    	{
    		$sql = "SELECT du.teacher_list
			FROM cri_2_2_2_doc_upload AS du
			LEFT JOIN programme_info AS pi
			ON du.upload_by = pi.programme_code
			WHERE academic_year = '$academic_year' 
			ORDER BY pi.id";

			$result = mysqli_query($con, $sql);

	            if(mysqli_num_rows($result) > 0)
	            {
	                while ($row = $result -> fetch_assoc()) 
	                {
	                    $file_name = $row["teacher_list"];
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
	                $pdf->Output('D', '2.2.2 - '.$academic_year.' - .pdf');
	            }
	            else
	            {
	                echo '<script language="javascript">';
	                echo'alert("No Documents Founded."); location.href="cri_2.2.2_pdf_report.php"';
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
							<span>Criteria 2.2.2 - Student – Teacher (full-time) ratio.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.2.2_doc_view.php" id="non-active">View Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_2.2.2_pdf_report.php" id="active">PDF Report</a>
								</li>

							</ul>

							<div class = "card-body">
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
													<i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 2.2.2 - Report</span>
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

                                                                <option value="Student List" 
                                                                <?php 
                                                                    if($download == 'Student List') 
                                                                    { 
                                                                
                                                                        echo "selected"; 
                                                                    } 
                                                                ?>

                                                                >Student List</option>

                                                                <option value="Teacher List"

                                                                <?php 
                                                                    if($download == 'Teacher List')
                                                                    {
                                                            
                                                                        echo "selected";
                                                                    }
                                                                ?>

                                                                >Teacher List</option>
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
