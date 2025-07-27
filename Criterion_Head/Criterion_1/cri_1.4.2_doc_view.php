<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
}

$upload_by = $_SESSION['criterion'];

require '../../config.php';
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
                        			<a class="nav-link active" href="cri_1.4.2_doc_view.php" id="active">View Document</a>
                        		</li>
	                                <li class="nav-item" role="presentation">
	                                    <a class="nav-link" href="cri_1.4.2_report.php" id="non-active">Report</a>
	                                </li>
	                        </ul><br>

	                        <div class="table-responsive">
                            	<table class="table table-bordered" id="table">
                            		<thead style="background-color:#057EC5; color:#FFF;">
                                        <tr>
                                            <th style="text-align:center;">Sl.No</th>
                                            <th style="text-align:center;">Uploaded By / Department</th>
                                            <th style="text-align:center;">Academic Year</th>
                                            <th style="text-align:center;">Document Type</th>
                                            <th style="text-align:center;">Student Feedback Sample</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            require '../../config.php';

                                            $sql = "SELECT pi.programme_name, du.academic_year, du.doc_name, du.doc_type, pi.programme_name, du.upload_by 
                                                FROM cri_1_4_2_doc_upload AS du
                                                LEFT JOIN programme_info AS pi
                                                ON du.upload_by = pi.programme_code 
                                                ORDER BY pi.id";
                                            $datas = $con->query($sql);
                                            if($datas->num_rows>0)
                                            {
                                                $i=0;
                                                while ($data = $datas->fetch_assoc()) 
                                                { 
                                                	$doc_name = "../../Uploaded Documents/Criteria - 1/".$data['doc_name'];
                                                	
                                                    $i++;
                                        			?>
                                        			<tr style="text-align:center;">
                                                        <td><?php echo $i ?></td>
                                                        <?php 
                                                        if($data['programme_name'])
                                                        {
                                                            ?> 
                                                                <td><?php echo $data['programme_name']; ?></td>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?> 
                                                                <td><?php echo $data['upload_by']; ?></td>
                                                            <?php
                                                        }
                                                        ?>
                                                        
                                                        <td><?php echo $data['academic_year']; ?></td>
                                                        <td><?php echo $data['doc_type']; ?></td>
                                                        <td>
                                                        	<a href="<?php echo $doc_name?>" class="btn btn-success" download><i class="fa-solid fa-download"></i></a>&nbsp;&nbsp;

                                                        	<a href="<?php echo $doc_name ?>" target = "_blank" class="btn btn-danger"><span id="warning_btn"><i class="fa-solid fa-eye"></i></span></a>&nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                }
                                            }
                                    	?>
                                    </tbody>     
                            	</table>
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

    <script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable({
            ordering:true,

        });
    });
    </script>

</body>
</html>