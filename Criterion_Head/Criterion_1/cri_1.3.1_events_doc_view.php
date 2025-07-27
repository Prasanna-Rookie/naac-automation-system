<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';

// Delete Operation

if (isset($_GET['delete'])) 
{
    $id = $_GET['delete'];

    $sql = "SELECT * FROM  cri_1_3_1_events WHERE id = '$id'";
    $data = $con->query($sql);
    while ($res = $data->fetch_assoc()) 
    {
    	$upload_location = "../../Uploaded Documents/Criteria - 1/".$res['doc_name'];
    }
    if(unlink($upload_location))
    {
    	$sql = "DELETE FROM  cri_1_3_1_events WHERE id = '$id'";
    	if ($con->query($sql) === TRUE) 
	    {
	        echo '<script language="javascript">';
        	echo'alert("Document Deleted Successfully."); location.href="cri_1.3.1_events_doc_view.php"';
        	echo '</script>';
	    } 
    }
    else
    {
    	echo '<script language="javascript">';
        echo'alert("Document Deleted Failed, Please Try Again."); location.href="cri_1.3.1_events_doc_view.php"';
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

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

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
                                    <a class="nav-link active" href="cri_1.3.1_events_doc_view.php" id="active">View Document (Events)</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="cri_1.3.1_pdf_report.php" id="non-active">PDF Report</a>
                                </li>

							</ul><br>

	                            <div class="table-responsive">
                            	<table class="table table-bordered" id="table">
                            		<thead style="background-color:#057EC5; color:#FFF;">
                                        <tr>
                                            <th style="text-align:center;">Sl.No</th>
                                            <th style="text-align:center;">Academic Year</th>
                                            <th style="text-align:center;">Date</th>
                                            <th style="text-align:center;" width="25%">Name of the Activity </th>
                                            <th style="text-align:center;">Organizing Unit</th>
                                            <th style="text-align:center;">Relevant to Event</th>
                                            <th style="text-align:center;" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php 
                                            require '../../config.php';

                                            $sql = "SELECT * FROM cri_1_3_1_events ORDER BY activity_date";
                                            $datas = $con->query($sql);
                                            if($datas->num_rows>0)
                                            {
                                                $i=0;
                                                while ($data = $datas->fetch_assoc()) 
                                                { 
                                                	$upload_location = "../../Uploaded Documents/Criteria - 1/".$data['doc_name'];
                                                	$date = $data['activity_date'];
                                                	$dateObject = new DateTime($date);
                                                	$c_date = $dateObject->format('d-m-Y');
                                                	
                                                    $i++;
                                        			?>
                                        			<tr style="text-align:center;">
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $data['academic_year']; ?></td>
                                                        <td><?php echo $c_date; ?></td>
                                                        <td><?php echo $data['activity_name']; ?></td>
                                                        <td><?php echo $data['organizing_unit']; ?></td>
                                                        <td><?php echo $data['relevant_event']; ?></td>
                                                        
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
    $(document).ready(function(){
        $('table').DataTable({
            ordering:true,

        });
    });
    </script>

</body>

</html>
