<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
}
require '../../config.php';
$upload_by = $_SESSION['department'];

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
$department = $_SESSION['department'];


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

    if(empty(trim($_POST["download"])))
    {
        $download_err = "Please Select Download Format.";
    }
    else
    {
        $download = trim($_POST["download"]);
    }

    // Report

    if(empty($academic_year_err) && empty($download_err))
    {
        $query = "SELECT * FROM cri_1_3_2_value_added_courses WHERE academic_year = '$academic_year' ORDER BY id ASC";
        
        $result = mysqli_query($con, $query);

        if($download == "Course Proof")
        {
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
	            $pdf->Output('D', '1.3.2.pdf');
	        }

	        else
	        {
	            echo '<script language="javascript">';
	            echo'alert("No Documents Founded."); location.href="cri_1.3.2_pdf_report.php"';
	            echo '</script>';
	        }

        }
        else
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

            $sql = "SELECT programme_name FROM programme_info WHERE programme_code = '$department'";
			$result = mysqli_query($con, $sql);
			while($row = $result -> fetch_assoc())
			    {
			        $programme_name = $row["programme_name"];
			    }
            
            $pdf->SetFont('Helvetica','B',16);
            $pdf->Cell(190,5,$programme_name,0,1,'C');
            $pdf->Ln(3);

            $pdf->SetFont('Helvetica','B',14);
            $pdf->Cell(190,5,"Academic Year : " . $academic_year,0,1,'C');

            $pdf->Ln(5);

$tbl = <<<EOD
    <table>
        <tr>
            <th width = "10%">Sl.No</th>
            <th width = "35%">Course Code</th>
            <th width = "55%">Course Name</th>	    
        </tr>
EOD;
			$query = "SELECT * FROM cri_1_3_2_value_added_courses WHERE academic_year = '$academic_year' ORDER BY id ASC";
        
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
        <td>{$row["course_code"]}</td>
        <td>{$row["course_name"]}</td>
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
            $pdf->Output('1.3.2 Course List.pdf', 'D');
        }
        
        mysqli_close($con);

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
    <title>Criterion - 1</title>

    <style type="text/css">
        #active
        {
            font-weight: bold;
        }
        #non-active
        {
            color: dimgrey;
        }
        #warning_btn
        {
        	color: white;
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
                            <span> Criteria 1.3.2 - Number of value-added courses for imparting transferable and life skills offered during year.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class = "card-body">
							<ul class="nav nav-tabs">
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.2_doc_view.php" id="non-active">View Document</a>
	                            </li>
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.2_excel_report.php" id="non-active">Excel Report</a>
	                            </li>
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_1.3.2_pdf_report.php" id="active">PDF Report</a>
	                            </li>
	                        </ul><br>

	                        <div class = "card-body">
                                <div class="container-fluid">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 1.3.2 - Download Report</span>
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
                                                            <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="download"><span style="color: red">* </span>Download Format</label>

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