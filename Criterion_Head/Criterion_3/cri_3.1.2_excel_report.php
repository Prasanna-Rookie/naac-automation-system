<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';

$academic_year = $academic_year_err = "";
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
	<title>Criterion - 3</title>
	<style type="text/css">
		#active
		{
			font-weight: bold;
		}
		#non-active
		{
			color: dimgrey;
		}
		td,th 
		{
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.1</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-brands fa-searchengin fa-lg"></i>
							<span>Criteria 3.1.2 - The institution provides seed money to its teachers for research.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.1.2_excel_report.php" id="active">Excel Report</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.1.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.1.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<div class = "card-body">
                                <div class="container-fluid"><br>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-download fa-lg"></i>
                                                    <span>Criteria 3.1.2 - Report</span>
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

                                                        <button type="submit" class="btn btn-success" style="float: right;" name="insert"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Generate</button>

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if(!empty($academic_year))
                            {
                            	?>
                            	<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
                            	<div class="table-responsive">
                            		<table class="table table-bordered" id="table">
                            			<thead style="background-color:#057EC5; color:#FFF;">
                            				<tr>
                            					<th>Name of the teacher provided with seed money</th>
                            					<th>Amount of seed money</th>
                            					<th>Month and Year of receiving</th>
                            					
                            				</tr>
                            			</thead>
                            			<tbody class="row_position">
                            				<?php 
                            					$sql = "SELECT * FROM cri_3_1_2_seed_money WHERE academic_year = '$academic_year'";

                            					$datas = $con->query($sql);
	                                            if($datas->num_rows>0)
	                                            {
	                                                $i = 0;
	                                                while ($data = $datas->fetch_assoc()) 
	                                                {  
	                                                    $i++;
	                                                    ?>
	                                                    <tr>
	                                                        <td><?php echo $data['teacher_name']; ?></td>
	                                                        <td><?php echo $data['seed_money']; ?></td>
	                                                        <td><?php echo $data['month_year']; ?></td>
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
