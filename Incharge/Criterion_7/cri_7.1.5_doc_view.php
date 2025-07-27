<?php
session_start();
if(!isset($_SESSION['inc_id']))
{
	header("location: ../../index.php");
	exit;
}
$upload_by_id = $_SESSION['inc_id'];

require '../../config.php';

// Delete

if (isset($_GET['delete'])) 
{
    $id = $_GET['delete'];

    $sql = "SELECT * FROM cri_7_1_5_doc_upload WHERE doc_id = '$id'";
    $data = $con->query($sql);
    while ($res = $data->fetch_assoc()) 
    {
    	$upload_location = "../../Uploaded Documents/Criteria - 7/".$res['doc_name'];
    }
    if(unlink($upload_location))
    {
    	$sql = "DELETE FROM cri_7_1_5_doc_upload WHERE doc_id = '$id'";
    	if ($con->query($sql) === TRUE) 
	    {
	        echo '<script language="javascript">';
        	echo'alert("Document Deleted Successfully."); location.href="cri_7.1.5_doc_view.php"';
        	echo '</script>';
	    } 
    }
    else
    {
    	echo '<script language="javascript">';
        echo'alert("Document Deleted Failed, Please Try Again."); location.href="cri_7.1.5_doc_view.php"';
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

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.2.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.css" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.2.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script>

	<title>Criterion - 7</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 7.1</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-building-columns fa-lg"></i>
							<span>Criteria 7.1.5 - The institutional initiatives for greening the campus are as follows:</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

                            <li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_7.1.5_option.php" id="non-active">Options</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_7.1.5_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_7.1.5_doc_view.php" id="active">View Document</a>
								</li>

							</ul><br>

							<div class="table-responsive">
                            	<table class="table table-bordered" id="table">
                            		<thead style="background-color:#057EC5; color:#FFF;">
                                        <tr>
                                            <th style="text-align:center;">Sl.No</th>
                                            <th style="text-align:center;">Academic Year</th>
                                            <th style="text-align:center;">Upload By</th>
                                            <th style="text-align:center;">Description</th>
                                            <th style="text-align:center;">Document</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            require '../../config.php';

                                            $sql = "SELECT * FROM cri_7_1_5_doc_upload  WHERE upload_by_id = '$upload_by_id' ORDER BY doc_id";   

                                            $datas = $con->query($sql);
                                            if($datas->num_rows>0)
                                            {
                                                $i=0;
                                                while ($data = $datas->fetch_assoc()) 
                                                { 
                                                	$doc_name = "../../Uploaded Documents/Criteria - 7/".$data['doc_name'];
                                                    $i++;
                                        			?>
                                        			<tr style="text-align:center;">
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $data['academic_year']; ?></td>
                                                        <td><?php echo $data['upload_by_name']; ?></td>
                                                        <td><?php echo $data['description']; ?></td>
                                                        <td>
                                                        	<a href="<?php echo $doc_name?>" class="btn btn-warning" download><i class="fa-solid fa-download" style="color:white;"></i></a>&nbsp;&nbsp;

                                                        	<a href="<?php echo $doc_name ?>" target = "_blank" class="btn btn-success"><span id="warning_btn"><i class="fa-solid fa-eye"></i></span></a>&nbsp;&nbsp;
                                                        	<?php
                                                        		echo "
																	<a href='?delete={$data['doc_id']}' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></a>"; 

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
