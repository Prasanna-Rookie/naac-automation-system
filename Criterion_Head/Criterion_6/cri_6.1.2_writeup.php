<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$upload_by = $_SESSION['criterion'];
$academic_year = $academic_year_err = $writeup = $writeup_err = "";
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

	// Write Up Vaildation
	if(empty(trim($_POST["writeup"])))
	{
		$writeup_err = "Please Fill the Write Up.";
	}
	elseif(str_word_count(trim($_POST["writeup"])) > 200)
    {
        $writeup_err = "Present a write-up within a maximum of 200 words.";
    }
	else
	{
		$writeup = trim($_POST["writeup"]);
	}

	// Insert

	if(empty($academic_year_err) && empty($writeup_err))
	{
		$id = $_POST["id"];
		if($id == 0)
		{
			$criteria = "Metric 6.1.2";
			// Prepare the SQL statement
			$query = "INSERT INTO cri_6_write_up (academic_year, criteria, write_up) VALUES (?, ?, ?)";

			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "sss", $academic_year, $criteria, $writeup);

			// Execute the statement
			if (mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Write Up Updated Successfully."); location.href="cri_6.1.2_writeup.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Write Up Update Failed, Please Try Again."); location.href="cri_6.1.2_writeup.php"';
			    echo '</script>';
			}

			// Close the statement
			mysqli_stmt_close($stmt);
		}
		else
		{
			// Prepare the SQL statement
			$query = "UPDATE cri_6_write_up SET write_up = ? WHERE id = ?";

			// Prepare the statement
			$stmt = mysqli_prepare($con, $query);

			// Bind parameters
			mysqli_stmt_bind_param($stmt, "si", $writeup, $id);

			// Execute the statement
			if (mysqli_stmt_execute($stmt)) {
			    echo '<script language="javascript">';
			    echo 'alert("Write Up Updated Successfully."); location.href="cri_6.1.2_writeup.php"';
			    echo '</script>';
			} else {
			    echo '<script language="javascript">';
			    echo 'alert("Write Up Update Failed, Please Try Again."); location.href="cri_6.1.2_writeup.php"';
			    echo '</script>';
			}

			// Close the statement
			mysqli_stmt_close($stmt);
		}
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

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	<link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
	<title>Criterion - 6</title>
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 6.1</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-building-columns fa-lg"></i>
							<span>Criteria 6.1.2 - Effective leadership is reflected in various institutional practices such as decentralization and participative management.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_6.1.2_writeup.php" id="active">Write Up</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.1.2_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_6.1.2_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul><br>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off">
								<div class="mb-3 col-sm-4">
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

									<label class="form-label" for="write-up" style="font-size: 17px; color:dimgrey; font-weight: bold;"> <span style="color: red">* </span>Present a write-up within a maximum of 200 words</label>

									<textarea type = "text" class="form-control <?php echo (!empty($writeup_err)) ? 'is-invalid' : ''; ?>" name="writeup">

										<?php echo $writeup; ?>

									</textarea>

									<div class="invalid-feedback">
										<?php
										if(!empty($writeup_err))
										{
											echo $writeup_err;
											?>
											<style type="text/css">

												.tox .tox-edit-area iframe 
												{
													border: 1px solid #ff0000;
													border-radius: 10px;
												}
											</style>
											<?php
										}
										?>

									</div>

									<input type="hidden" name="id" value="0" id="id">

								</div>

								<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

							</form>
							
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

<script>
	tinymce.init({ 
		selector:'textarea'
	});
</script>
<style>
	.tox-statusbar {
	    display: none !important;
	}
</style>

<script>
	$(document).ready(function(){
		$('#academic_year').change(function(){
			var academic_year = $('#academic_year').val();
			var criteria = "Metric 6.1.2"; 

			$.ajax({
				type: 'POST',
				url: 'cri_6_writeup_fetch.php',
				data: {
					academic_year:academic_year,
					criteria:criteria
				},
				dataType: 'json',  
				success: function(data)  
				{
					var textareaValue = data.write_up;
					var id = data.id;
					tinymce.activeEditor.setContent(textareaValue);
					document.getElementById("id").value = id;
				}
			});
		});
	});
</script>

</body>

</html>