<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
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
                            <li class="breadcrumb-item active" aria-current="page">Programmes</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-building-columns"></i>
                            <span> Manage Programmes </span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
                        	<ul class="nav nav-tabs">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="manage_department.php" id="non-active">New Programmes</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="edit_department.php" id="active">Edit Programmes</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="ep_1.1_report.php" id="non-active">Report</a>
                                </li>
                               
                            </ul><br>

                            <div id="table"></div>
                        	   
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

    <script>
		$(document).ready(function(){
		 	$("#table").load("edit_department_table.php");
			});

		// $(document).on("click",".del",function(){
		// 	var del=$(this);
		// 	var id=$(this).attr("data-id");
		// 	if(confirm('Are you sure you want to delete!.'))
		// 	{
		// 		$.ajax({
		// 			url:"delete_criterion_head.php",
		// 			type:"post",
		// 			data:{id:id},
		// 			success:function()
		// 			{
		// 				del.closest("tr").hide();
		// 				$("#table").load("edit_criterion_head.php");
		// 			}
		// 		});
		// 	}
		// });
	</script>
	
</body>
</html>