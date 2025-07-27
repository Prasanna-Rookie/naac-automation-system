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

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 4</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 4.1</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-building-columns fa-lg"></i>
							<span>Criteria 4.1.1 - The Institution has adequate infrastructure and physical facilities for teachinglearning, viz., classrooms, laboratories, computing equipments, etc.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.1.1_writeup.php" id="non-active">Write Up</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_4.1.1_doc_upload.php" id="active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_4.1.1_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<div class = "card-body">
								
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

</body>

</html>

<?php 

$sql = "SELECT * FROM cri_4_3_3_options WHERE upload_by_id = '$upload_by_id'";
$datas = $con->query($sql);
if($datas->num_rows>0)
{
	?>
	<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
	<div class="table-responsive">
		<table class="table table-bordered" id="table">
			<thead style="background-color:#057EC5; color:#FFF;">
				<tr align="center">
					<th>Academic Year</th>
					<th>Option</th>
					<th>Bandwidth of internet connection</th>
					<th>Update</th>
				</tr>
			</thead>
			<tbody class="row_position">
				<?php
				while ($data = $datas->fetch_assoc()) 
				{
					if($data['option'] == "A")
					{
						$option = "≥50 Mbps";
					}
					elseif($data['option'] == "B")
					{
						$option = "35 Mbps - 50 Mbps";
					}
					elseif($data['option'] == "C")
					{
						$option = "20 Mbps - 35 Mbps";
					}
					elseif($data['option'] == "D")
					{
						$option = "5 Mbps - 20 Mbps";
					}
					else
					{
						$option = "<5 Mbps";
					}

					?>
					<tr style="text-align:center;">
						<td><?php echo $data['academic_year']; ?></td>
						<td><?php echo $data['option']; ?></td>
						<td><?php echo $option; ?></td>
						<?php
						echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["option_id"]}><i class = 'fa fa-edit'></i></button></td>";
						?>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<?php
}
?>
