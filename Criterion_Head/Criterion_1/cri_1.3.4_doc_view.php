<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$upload_by = $_SESSION['department'];

// Delete operation

if (isset($_GET['delete'])) 
{
    $id = $_GET['delete'];

    $sql = "SELECT * FROM cri_1_3_4_doc_upload WHERE id = '$id'";
    $data = $con->query($sql);
    while ($res = $data->fetch_assoc()) 
    {
    	$upload_location = "../../Uploaded Documents/Criteria - 1/".$res['doc_name'];
    }
    if(unlink($upload_location))
    {
    	$sql = "DELETE FROM cri_1_3_4_doc_upload WHERE id = '$id'";
    	if ($con->query($sql) === TRUE) 
	    {
	        echo '<script language="javascript">';
        	echo'alert("Document Deleted Successfully."); location.href="cri_1.3.4_doc_view.php"';
        	echo '</script>';
	    } 
    }
    else
    {
    	echo '<script language="javascript">';
        echo'alert("Document Deleted Failed, Please Try Again."); location.href="cri_1.3.4_doc_view.php"';
        echo '</script>';
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
                            <span> Criteria 1.3.4 - Percentage of students undertaking Field Projects / Internships / Student Projects.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class = "card-body">
							<ul class="nav nav-tabs">

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_1.3.4_doc_view.php" id="active">View Document</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.4_excel_report.php" id="non-active">Excel Report</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.4_pdf_report.php" id="non-active">PDF Report</a>
	                            </li>

                            </ul><br>
                            <div class="table-responsive">
                            	<table class="table table-bordered" id="table">
                            		<thead style="background-color:#057EC5; color:#FFF;">
                                        <tr>
                                            <th style="text-align:center;">Sl.No</th>
                                            <th style="text-align:center;">Academic Year</th>
                                            <th style="text-align:center;">Upload By / Department</th>
                                            <th style="text-align:center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php 
                                            require '../../config.php';
                                            $upload_by = $_SESSION['department'];
                                            $sql = "SELECT pi.programme_name, du.academic_year, du.doc_name, du.id 
                                                FROM cri_1_3_4_doc_upload AS du
                                                LEFT JOIN programme_info AS pi
                                                ON du.upload_by = pi.programme_code
                                                ORDER BY pi.id";
                                            $datas = $con->query($sql);
                                            if($datas->num_rows>0)
                                            {
                                                $i=0;
                                                while ($data = $datas->fetch_assoc()) 
                                                { 
                                                	$upload_location = "../../Uploaded Documents/Criteria - 1/".$data['doc_name'];
                                                    $i++;
                                        			?>
                                        			<tr style="text-align:center;">
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $data['academic_year']; ?></td>
                                                        <td><?php echo $data['programme_name']; ?></td>
                                                        
                                                        <td>
                                                        	<a href="<?php echo $upload_location ?>" class="btn btn-warning" download>
                                                        			<i class="fa-solid fa-download" style="color:white;"></i>
                                                        		</a>&nbsp;&nbsp;

                                                        		<a href="<?php echo $upload_location ?>" target = "_blank" class="btn btn-success">
                                                        			<i class="fa-solid fa-eye"></i>
                                                        		</a>&nbsp;&nbsp;

                                                        		<?php
                                                        		echo "
																	<a href='?delete={$data['id']}' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></a>"; 

                                                        		?>
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