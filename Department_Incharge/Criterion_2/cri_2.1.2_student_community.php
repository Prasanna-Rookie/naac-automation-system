<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
} 
require '../../config.php';

$academic_year = $academic_year_err = "";
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
	                                <a class="nav-link" href="cri_2.1.2_reserved_categories.php" id="non-active">Reserved Categories Seats</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_2.1.2_student_community.php" id="active">Students</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
		                            <a class="nav-link" href="cri_2.1.2_doc_upload.php" id="non-active">Document Upload</a>
		                        </li>

		                        <li class="nav-item" role="presentation">
		                            <a class="nav-link" href="cri_2.1.2_doc_view.php" id="non-active">View Document</a>
		                        </li>
	                        </ul>

	                        <div class = "card-body">
	                        	<div class="container-fluid"><br>
	                        		<div class="row justify-content-center">
	                        			<div class="col-sm-6 col-sm-6">
	                        				<div class="card" style="border-top:2px solid #087ec2;">
	                        					<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        						<i class="fa-solid fa-graduation-cap fa-lg"></i>
	                        						<span>Criteria 2.1.2 - Reserved Categories</span>
	                        					</div>

	                        					<div class="card-body">
	                        						<form method="post" action="cri_2.1.2_student_export.php" autocomplete = "off" enctype="multipart/form-data">

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

	                        						<button type="submit" name = "export" class="btn btn-danger" style="float: right;"><i class="fa-solid fa-download"></i>&nbsp;&nbsp;Export</button>
	                        					</form>
	                        					</div>
	                        				</div>
	                        			</div>

	                        			<div class="col-sm-6 col-sm-6">
	                        				<div class="card" style="border-top:2px solid #087ec2;">
	                        					<div class="card-header" style="color:#087ec2; font-weight:bold;">
	                        						<i class="fa-solid fa-graduation-cap fa-lg"></i>
	                        						<span>Criteria 2.1.2 - Reserved Categories</span>
	                        					</div>

	                        					<div class="card-body">
	                        						<form method="post" action="cri_2.1.2_student_import.php" autocomplete = "off" enctype="multipart/form-data">

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
	                        							<label for="csv_file" class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span> Upload</label>

	                        							<input name = "csv_file" class="form-control" type="file" id="csv_file">
	                        						</div>

	                        							<button type="submit" name = "import" class="btn btn-success" style="float: right;"><i class="fa-solid fa-upload"></i>&nbsp;&nbsp;Import</button>
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