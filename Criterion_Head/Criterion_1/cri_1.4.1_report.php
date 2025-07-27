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
        if($doc_type == "Student Feedback Sample")
        {
            $sql = "SELECT du.stu_sample
                    FROM cri_1_4_1_doc_upload AS du
                    INNER JOIN programme_info AS pi
                    ON du.upload_by = pi.programme_code
                    WHERE du.academic_year = '$academic_year' 
                    ORDER BY pi.id";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["stu_sample"];
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
                $pdf->Output('D', '1.4.1 - '.$academic_year.' - Student Feedback Sample.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.1_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
        }
        elseif($doc_type == "Teacher Feedback Sample")
        {
            $sql = "SELECT du.tea_sample
                    FROM cri_1_4_1_doc_upload AS du
                    INNER JOIN programme_info AS pi
                    ON du.upload_by = pi.programme_code
                    WHERE du.academic_year = '$academic_year' 
                    ORDER BY pi.id";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["tea_sample"];
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
                $pdf->Output('D', '1.4.1 - '.$academic_year.' - Teacher Feedback Sample.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.1_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
        }
        elseif($doc_type == "Employers Feedback Sample")
        {
            $sql = "SELECT du.emp_sample
                    FROM cri_1_4_1_doc_upload AS du
                    INNER JOIN programme_info AS pi
                    ON du.upload_by = pi.programme_code
                    WHERE du.academic_year = '$academic_year' 
                    ORDER BY pi.id";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["emp_sample"];
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
                $pdf->Output('D', '1.4.1 - '.$academic_year.' - Employers Feedback Sample.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.1_report.php"';
                echo '</script>';
            }
            
            mysqli_close($con);
        }
        else
        {
            $sql = "SELECT du.alu_sample
                    FROM cri_1_4_1_doc_upload AS du
                    INNER JOIN programme_info AS pi
                    ON du.upload_by = pi.programme_code
                    WHERE du.academic_year = '$academic_year' 
                    ORDER BY pi.id";
                    
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while ($row = $result -> fetch_assoc()) 
                {
                    $file_name = $row["alu_sample"];
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
                $pdf->Output('D', '1.4.1 - '.$academic_year.' - Alumni Feedback Sample.pdf');
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("No Documents Founded."); location.href="cri_1.4.1_report.php"';
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
                            <li class="breadcrumb-item active" aria-current="page">Criteria 1.4.1</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-comments"></i>
                            <span>Criteria 1.4.1 - Structured feedback and review of the syllabus (Semester-wise / Year-wise) is obtained from 1) Students 2) Teachers 3) Employers and 4) Alumni.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class = "card-body">
                        	<ul class="nav nav-tabs">

                        		<li class="nav-item" role="presentation">
                        			<a class="nav-link" href="cri_1.4.1_doc_view.php" id="non-active">View Document</a>
                        		</li>
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_1.4.1_report.php" id="active">Report</a>
	                            </li>
	                        </ul>

	                        <div class = "card-body">
                                <div class="container-fluid"><br>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 1.4.1 - Report</span>
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

                                                            <option value="Student Feedback Sample" 
														
															<?php 
															if($doc_type == 'Student Feedback Sample') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Student Feedback Sample</option>

                                                            <option value="Teacher Feedback Sample" 
														
															<?php 
															if($doc_type == 'Teacher Feedback Sample') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Teacher Feedback Sample</option>

															<option value="Employers Feedback Sample" 
														
															<?php 
															if($doc_type == 'Employers Feedback Sample') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Employers Feedback Sample</option>

															<option value="Alumni Feedback Sample" 
														
															<?php 
															if($doc_type == 'Alumni Feedback Sample') 
															{ 
																
																echo "selected"; 
															} 
															?>

															>Alumni Feedback Sample</option>
                                                            
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