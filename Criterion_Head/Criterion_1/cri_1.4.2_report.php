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

$academic_year = $academic_year_err = $doc_type_err = $doc_type = "";
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

    // Document Type Validation

    if(empty(trim($_POST["doc_type"])))
    {
        $doc_type_err = "Please Select Report Type.";
    }
    else
    {
       	$doc_type = trim($_POST["doc_type"]);
    }

    if(empty($academic_year_err) && empty($doc_type_err))
    {
        if($doc_type == "Feedback Policy")
        {

            $sql = "SELECT doc_name FROM cri_1_4_2_doc_upload WHERE academic_year = '$academic_year' AND doc_type = 'Feedback Policy'";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["doc_name"];
                    $file_path = "../../Uploaded Documents/Criteria - 1/".$file_name;

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
                $pdf->Output('D', '1.4.2 - '.$academic_year.' - Feedback Policy.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.2_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
        }
        elseif($doc_type == "Action Taken Report")
        {
            $sql = "SELECT doc_name FROM cri_1_4_2_doc_upload WHERE academic_year = '$academic_year' AND doc_type = 'Action Taken Report'";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["doc_name"];
                    $file_path = "../../Uploaded Documents/Criteria - 1/".$file_name;

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
                $pdf->Output('D', '1.4.2 - '.$academic_year.' - Action Taken Report.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.2_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
        }
        elseif($doc_type == "Feedback Analysis")
        {
            // $sql = "SELECT doc_name FROM cri_1_4_2_doc_upload WHERE doc_type = 'Feedback Analysis'";

            $sql = "SELECT du.doc_name
                    FROM cri_1_4_2_doc_upload AS du
                    INNER JOIN programme_info AS pi
                    ON du.upload_by = pi.programme_code
                    WHERE du.academic_year = '$academic_year' AND du.doc_type = 'Feedback Analysis'
                    ORDER BY pi.id";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["doc_name"];
                    $file_path = "../../Uploaded Documents/Criteria - 1/".$file_name;

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
                $pdf->Output('D', '1.4.2 - '.$academic_year.' - Feedback Analysis.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.2_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
        }
        else
        {
            // $sql = "SELECT doc_name FROM cri_1_4_2_doc_upload WHERE doc_type = 'Evidences'";

            $sql = "SELECT du.doc_name
                    FROM cri_1_4_2_doc_upload AS du
                    INNER JOIN programme_info AS pi
                    ON du.upload_by = pi.programme_code
                    WHERE du.academic_year = '$academic_year' AND du.doc_type = 'Evidences'
                    ORDER BY pi.id";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["doc_name"];
                    $file_path = "../../Uploaded Documents/Criteria - 1/".$file_name;

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
                $pdf->Output('D', '1.4.2 - '.$academic_year.' - Evidences.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.2_report.php"';
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

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
                            <li class="breadcrumb-item active" aria-current="page">Criteria 1.4.2</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-comments"></i>
                            <span>Criteria 1.4.2 - The feedback system of the Institution.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class = "card-body">
                        	<ul class="nav nav-tabs">
                        		<li class="nav-item" role="presentation">
                        			<a class="nav-link" href="cri_1.4.2_doc_upload.php" id="non-active">Document Upload</a>
                        		</li>

                        		<li class="nav-item" role="presentation">
                        			<a class="nav-link" href="cri_1.4.2_doc_view.php" id="non-active">View Document</a>
                        		</li>
	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link active" href="cri_1.4.2_report.php" id="active">Report</a>
	                                </li>
	                        </ul>

	                        <div class = "card-body">
                                <div class="container-fluid"><br>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 1.4.2 - Report</span>
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
                                                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="doc_type"><span style="color: red">* </span>Report Type</label>

                                                        <select name="doc_type" class="form-select <?php echo (!empty($doc_type_err)) ? 'is-invalid' : ''; ?>" id="doc_type">

                                                            <option value="">---Select Report Type---</option>

                                                            <option value="Feedback Policy" 
														
															<?php 
															if($doc_type == 'Feedback Policy') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Feedback Policy</option>

                                                            <option value="Action Taken Report" 
														
															<?php 
															if($doc_type == 'Action Taken Report') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Action Taken Report</option>

															<option value="Feedback Analysis" 
														
															<?php 
															if($doc_type == 'Feedback Analysis') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Feedback Analysis</option>

															<option value="Evidences" 
														
															<?php 
															if($doc_type == 'Evidences') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Evidences</option>
                                                            
                                                        </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $doc_type_err; ?>
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