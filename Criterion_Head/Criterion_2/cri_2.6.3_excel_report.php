<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
}
require '../../config.php';

$academic_year = $academic_year_err = $report_type = $report_type_err = "";
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

    // Report Type Validation

    if(empty(trim($_POST["report_type"])))
    {
        $report_type_err = "Please Select Report Type.";
    }
    else
    {
        $report_type = trim($_POST["report_type"]);
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

  <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.2.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.2.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script>

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
    th,td, tr
    {
     text-align:center; 
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
                        <li class="breadcrumb-item active" aria-current="page">Criteria 2.6</li>
                    </ol>
                </nav>
            </div>

            <!-- Breadcrumb End -->

            <div class="container-fluid">
                <div class="card" style="border-top:2px solid #087ec2;">

                    <!-- Card Header -->

                    <div class="card-header" style="color:#087ec2; font-weight:bold;">
                        <i class="fa-solid fa-school fa-lg"></i>
						<span>Criteria 2.6.3 - Pass Percentage of students.</span>
                    </div>

                    <!-- Card Header End -->

                    <!-- Card Body -->

                    <div class="card-body">
                        <ul class="nav nav-tabs">

                               <li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.6.3_doc_view.php" id="non-active">View Document</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_2.6.3_excel_report.php" id="active">Excel Report</a>
								</li>
                            </ul>
                            
                            <div class = "card-body">
                                <div class="container-fluid"><br>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 2.6.3 - Report</span>
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
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "report_type"> <span style="color: red">* </span>Report Type</label>

                                                            <select name="report_type" class="form-select <?php echo (!empty($report_type_err)) ? 'is-invalid' : ''; ?>" id="report_type">

                                                                <option value="">---Select Report Type---</option>

                                                                <option value="Data Template"
                                                                <?php
                                                                if($report_type == "Data Template")
                                                                {
                                                                    echo "selected";
                                                                } 
                                                                ?>
                                                                >Data Template</option>
                                                                <option value="Student List">
                                                                    Student List
                                                                </option>



                                                            </select>
                                                            <span class="invalid-feedback">
                                                                <?php echo $report_type_err; ?>
                                                            </span>
                                                        </div>

                                                        <button type="submit" class="btn btn-success" style="float: right;" name="insert"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Generate</button>

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php 
                            require '../../config.php';

                            if($report_type == "Data Template")
                            {
                                ?>
                                <div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table">
                                            <thead style="background-color:#057EC5; color:#FFF;">
                                                <tr>
                                                	<th>Programme Code</th>
                                                    <th>Programme Name</th>
                                                    <th>Number of students who appeared in the final year examinations</th>
                                                    <th>Number of students who passed in the final year examinations</th>
                                                </tr>
                                            </thead>
                                <?php
                                $sql = "SELECT 
									    p.programme_code,
									    p.programme_name,
									    COUNT(pp.reg_no) AS appeared,
									    SUM(CASE WHEN pp.result = 'PASS' THEN 1 ELSE 0 END) AS passed
									FROM 
									    programme_info p
									LEFT JOIN 
									    cri_2_6_3_pass_percentage pp ON p.programme_code = pp.programme_code
									                                    AND pp.academic_year = '$academic_year'
									GROUP BY 
									    p.programme_code, p.programme_name
									ORDER BY p.id
										";

                                $datas = $con->query($sql);
                                if($datas->num_rows>0)
                                {
                                    ?>
                                            <tbody class="row_position">
                                                <?php 
                                                $tot_appeared = 0;
                                                $tot_passed = 0;
                                                $i = 0;
                                                while ($data = $datas->fetch_assoc()) 
                                                { 
                                                    $i++;
                                                    $tot_appeared = $tot_appeared + $data['appeared'];
                                                    $tot_passed = $tot_passed + $data['passed'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $data['programme_code']; ?></td>
                                                        <td><?php echo $data['programme_name']; ?></td>
                                                        <td><?php echo $data['appeared']; ?></td>
                                                        <td><?php echo $data['passed']; ?></td>
                                                    </tr>
                                                    <?php
                                                    if($i == $datas->num_rows)
                                                    {
                                                    	$percentage = ($tot_passed / $tot_appeared) * 100;
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <th>Total</th>
                                                            <th><?php echo $tot_appeared; ?></th>
                                                            <th><?php echo $tot_passed; ?></th>
                                                        </tr>
                                                        <tr>
                                                        	<td></td>
                                                        	<td></td>
                                                        	<th>Percentage</th>
                                                        	<th><?php echo $percentage . " %"; ?></th>
                                                        </tr>
                                                        <?php

                                                    }
                                                    ?>
                                                    <?php

                                                }

                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            elseif($report_type == "Student List")
                            {
                                ?>
                                <div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead style="background-color:#057EC5; color:#FFF;">
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Programme</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>

                                        <tbody class="row_position">
                                            <?php 
                                            require '../../config.php';

                                            $sql = "SELECT cri_sd.reg_no, cri_sd.name, cri_sd.result, pi.programme_name 
                                            FROM cri_2_6_3_pass_percentage AS cri_sd
                                            INNER JOIN programme_info AS pi
                                            ON cri_sd.programme_code = pi.programme_code
                                            WHERE academic_year = '$academic_year'
                                            ORDER BY pi.id, cri_sd.reg_no";

                                            $datas = $con->query($sql);
                                            if($datas->num_rows>0)
                                            {
                                                $i = 0;
                                                while ($data = $datas->fetch_assoc()) 
                                                {  
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $data['programme_name']; ?></td>
                                                        <td><?php echo $data['reg_no']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['result']; ?></td>
                                                    </tr>
                                                    <?php

                                                }

                                            }
                                            ?>
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

    <script type="text/javascript">
     $(document).ready(function() {
         $('#table').DataTable( {
          ordering:false,
          dom: 'Bfrtip',
          buttons: [
              { extend: 'excel', text: '<i class="fa-solid fa-download"></i>&nbsp;&nbsp;Download Excel',className: 'btn btn-success' }
              ]
      });
     });
 </script>
</body>

</html>
