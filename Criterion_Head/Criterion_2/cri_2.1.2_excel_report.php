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

  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

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
                        <li class="breadcrumb-item active" aria-current="page">Criteria 2.1</li>
                    </ol>
                </nav>
            </div>

            <!-- Breadcrumb End -->

            <div class="container-fluid">
                <div class="card" style="border-top:2px solid #087ec2;">

                    <!-- Card Header -->

                    <div class="card-header" style="color:#087ec2; font-weight:bold;">
                        <i class="fa-solid fa-graduation-cap fa-lg"></i>
							<span>Criteria 2.1.2 - Number of seats filled against reserved categories (SC, ST, OBC, Divyangjan, etc.) as per the reservation policy during the year (exclusive of supernumerary seats).</span>
                    </div>

                    <!-- Card Header End -->

                    <!-- Card Body -->

                    <div class="card-body">
                        <ul class="nav nav-tabs">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_2.1.2_doc_upload.php" id="non-active">Document Upload</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_2.1.2_doc_view.php" id="non-active">View Document</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="cri_2.1.2_excel_report.php" id="active">Excel Report</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_2.1.2_pdf_report.php" id="non-active">PDF Report</a>
                                </li>
                            </ul>
                            
                            <div class = "card-body">
                                <div class="container-fluid"><br>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 2.1.1 - Report</span>
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
                                $sql_1 = "SELECT  
									SUM(sc_category) as sc_category,
									SUM(st_category) as st_category,
									SUM(obc_category) as obc_category,
									SUM(general_category) as general_category,
									SUM(others) as others
									FROM cri_2_1_2_reserved_categories AS cri
									WHERE academic_year = '$academic_year'";

								$sql_2 = "SELECT
									    SUM(CASE WHEN community = 'SC' THEN 1 ELSE 0 END) AS stu_sc,
									    SUM(CASE WHEN community = 'ST' THEN 1 ELSE 0 END) AS stu_st,
									    SUM(CASE WHEN community IN ('BC', 'MBC') THEN 1 ELSE 0 END) AS stu_obc,
                                        SUM(CASE WHEN community = 'OC' THEN 1 ELSE 0 END) AS stu_oc
										FROM cri_2_1_1_student_details
										WHERE academic_year = '$academic_year'";

                                $data_1 = $con->query($sql_1);
                                $data_2 = $con->query($sql_2);

                                if($data_1->num_rows>0 && $data_2->num_rows>0)
                                {
                                    ?>
                                    <div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

                                    <div class="col col-md-6 text-left">
                                    	<button type="button" id="export_button" class="btn btn-success"><i class="fa-solid fa-download"></i>&nbsp;&nbsp;Download Excel</button>
                                    
                                	</div><br>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table_dt">
                                            <thead style="background-color:#057EC5; color:#FFF;">
                                                <tr>
                                                    <th rowspan="2" width="10%">Year</th>
                                                    <th colspan="5" width="45%">Number of  seats earmarked for reserved category as per GOI or State Government rule</th>
                                                    <th colspan="5" width="45%">Number of students admitted from the reserved category</th>
                                                </tr>
                                                <tr>
                                                	<th>SC</th>
                                                	<th>ST</th>
                                                	<th>OBC</th>
                                                	<th>Gen</th>
                                                	<th>Others</th>

                                                	<th>SC</th>
                                                	<th>ST</th>
                                                	<th>OBC</th>
                                                	<th>Gen</th>
                                                	<th>Others</th>
                                                </tr>
                                            </thead>

                                            <tbody class="row_position">
                                                <?php 
                                                while ($data = $data_1->fetch_assoc()) 
                                                { 
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $academic_year; ?></th>
                                                        <td><?php echo $data['sc_category'];?></td>
                                                        <td><?php echo $data['st_category'];?></td>
                                                        <td><?php echo $data['obc_category'];?></td>
                                                        <td><?php echo $data['general_category'];?></td>
                                                        <td><?php echo $data['others'];?></td>

	                                                <?php
	                                                while ($data_s = $data_2->fetch_assoc()) 
	                                                {  
	                                                ?>
                                                        <td><?php echo $data_s['stu_sc'];?></td>
                                                        <td><?php echo $data_s['stu_st'];?></td>
                                                        <td><?php echo $data_s['stu_obc'];?></td>
                                                        <td><?php echo $data_s['stu_oc'];?></td>
                                                        <td><?php echo "0";?></td>
                                                    </tr>
                                                    
                                                    <?php
                                                	}

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
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>Community</th>
                                            </tr>
                                        </thead>

                                        <tbody class="row_position">
                                            <?php 
                                            require '../../config.php';

                                            $sql = "SELECT cri_sd.reg_no, cri_sd.name, cri_sd.community
                                            FROM cri_2_1_1_student_details AS cri_sd
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
                                                        <td><?php echo $data['reg_no']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['community']; ?></td>
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

<script>

    function html_table_to_excel(type)
    {
        var data = document.getElementById('table_dt');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'file.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>