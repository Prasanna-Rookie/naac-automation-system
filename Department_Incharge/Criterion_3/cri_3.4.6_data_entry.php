<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $paper_title = $paper_title_err = $author_name = $author_name_err = $journal_titile = $journal_titile_err = $month_year = $month_year_err = $h_index = $h_index_err = "";
$upload_by_name = $_SESSION['name'];
$upload_by_id = $_SESSION['dci_id'];

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

	if(empty(trim($_POST["paper_title"])))
	{
		$paper_title_err = "Please Enter Title of the paper.";
	}
	else
	{
		$paper_title = trim($_POST["paper_title"]);
	}

	if(empty(trim($_POST["author_name"])))
	{
		$author_name_err = "Please Enter Name of the author.";
	}
	else
	{
		$author_name = trim($_POST["author_name"]);
	}

	if(empty(trim($_POST["journal_titile"])))
	{
		$journal_titile_err = "Please Enter Title of the journal.";
	}
	else
	{
		$journal_titile = trim($_POST["journal_titile"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Year of publication.";
	}
	elseif(!is_numeric(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Valid Input.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	if(empty(trim($_POST["h_index"])))
	{
		$h_index_err = "Please Enter H - Index.";
	}
	else
	{
		$h_index = trim($_POST["h_index"]);
	}

	// Insert
	if(empty($academic_year_err) && empty($paper_title_err) && empty($author_name_err) && empty($journal_titile_err) && empty($month_year_err) && empty($h_index_err))
	{
		$query = "INSERT INTO cri_3_4_6_h_index (academic_year, upload_by_id, upload_by_name, paper_title, author_name, journal_titile, month_year, h_index) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$paper_title', '$author_name', '$journal_titile', '$month_year', '$h_index')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.4.6_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.4.6_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$paper_title = $title = $journal_titile = $month_year = $h_index = "";
	if(empty(trim($_POST["paper_title"])) || empty(trim($_POST["author_name"])) || !is_numeric(trim($_POST["month_year"])) || empty(trim($_POST["month_year"])) || empty(trim($_POST["journal_titile"])) || empty(trim($_POST['h_index'])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.4.6_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$paper_title = $_POST['paper_title'];
			$author_name = $_POST['author_name'];
			$journal_titile = $_POST['journal_titile'];
			$month_year = $_POST['month_year'];
			$h_index = $_POST['h_index'];

			$query = "UPDATE cri_3_4_6_h_index SET paper_title = ?, author_name = ?, journal_titile = ?, month_year = ?, h_index = ? WHERE hi_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "sssssi", $paper_title, $author_name, $journal_titile, $month_year,$h_index, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.4.6_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.4.6_data_entry.php"';
			    echo '</script>'; 
			}
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
		label
		{
			font-size: 17px; 
			color:dimgrey; 
			font-weight: bold;
		}
	</style>
</head>
<body>

<!-- Model -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
        <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>H - Index</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "paper_title"> <span style="color: red">* </span>Title of the paper</label>

                            <input type="text" name="paper_title" class="form-control " id="paper_title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "author_name"> <span style="color: red">* </span>Name of the author</label>

                            <input type="text" name="author_name" class="form-control " id="author_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "journal_titile"> <span style="color: red">* </span>Title of the journal</label>

                            <input type="text" name="journal_titile" class="form-control " id="journal_titile">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month_year"> <span style="color: red">* </span>Year of publication</label>

                            <input type="text" name="month_year" class="form-control " id="month_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "h_index"> <span style="color: red">* </span>H - Index</label>

                            <input type="number" name="h_index" class="form-control " id="h_index">
                        </div>

                        <input type="hidden" name="id" id="id" value="0">
                        <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>">

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="update"><i class = 'fa fa-edit'></i>&nbsp; Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<!-- Model End -->

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
							<li class="breadcrumb-item active" aria-current="page">Criteria 3.4</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-trophy fa-lg"></i>
							<span>Criteria 3.4.6 - Bibliometrics of the publications during the year based on Scopus/ Web of Science – H-Index of the University.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.4.6_data_entry.php" id="active">H - Index</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.4.6_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.4.6_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
								<div class = "card-body">
									<div class="container-fluid"><br>
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-trophy fa-lg"></i>
														<span>Criteria 3.4.6 - H - Index</span>
													</div>
													<div class="card-body">
														<div class="mb-3">
															<label class="form-label" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

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
															<label class="form-label" for = "paper_title"> <span style="color: red">* </span>Title of the paper</label>

															<input 
															type="text" 
															name="paper_title" 
															class="form-control <?php echo (!empty($paper_title_err)) ? 'is-invalid' : ''; ?>"
															id = "paper_title" 
															value = "<?php echo $paper_title; ?>">

															<div class="invalid-feedback">
																<?php echo $paper_title_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "author_name"> <span style="color: red">* </span>Name of the author</label>

															<input 
															type="text" 
															name="author_name" 
															class="form-control <?php echo (!empty($author_name_err)) ? 'is-invalid' : ''; ?>"
															id = "author_name" 
															value = "<?php echo $author_name; ?>">

															<div class="invalid-feedback">
																<?php echo $author_name_err; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-trophy fa-lg"></i>
														<span>Criteria 3.4.6 - H - Index</span>
													</div>
													<div class="card-body">
														
														<div class="mb-3">
															<label class="form-label" for = "journal_titile"> <span style="color: red">* </span>Title of the journal</label>

															<input 
															type="text" 
															name="journal_titile" 
															class="form-control <?php echo (!empty($journal_titile_err)) ? 'is-invalid' : ''; ?>"
															id = "journal_titile" 
															value = "<?php echo $journal_titile; ?>">

															<div class="invalid-feedback">
																<?php echo $journal_titile_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "month_year"> <span style="color: red">* </span>Year of publication</label>

															<input 
															type="text" 
															name="month_year" 
															class="form-control <?php echo (!empty($month_year_err)) ? 'is-invalid' : ''; ?>"
															id = "month_year" 
															value = "<?php echo $month_year; ?>">

															<div class="invalid-feedback">
																<?php echo $month_year_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "h_index"> <span style="color: red">* </span>H - Index</label>

															<input 
															type="number" 
															name="h_index" 
															class="form-control <?php echo (!empty($h_index_err)) ? 'is-invalid' : ''; ?>"
															id = "h_index" 
															value = "<?php echo $h_index; ?>">

															<div class="invalid-feedback">
																<?php echo $h_index_err; ?>
															</div>
														</div>
														<button type="submit" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>
													</div>		
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<?php
							$sql = "SELECT * FROM cri_3_4_6_h_index WHERE upload_by_id = '$upload_by_id'";
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
												<th>Title of the paper</th>
												<th>Name of the author</th>
												<th>Title of the journal</th>
												<th>Year of publication</th>
												<th>H - Index</th>
												<th>Update</th>
											</tr>
										</thead>
										<tbody class="row_position">
											<?php
											while ($data = $datas->fetch_assoc()) 
											{
												?>
												<tr style="text-align:center;">
													<td><?php echo $data['academic_year']; ?></td>
													<td><?php echo $data['paper_title']; ?></td>
													<td><?php echo $data['author_name']; ?></td>
													<td><?php echo $data['journal_titile']; ?></td>
													<td><?php echo $data['month_year']; ?></td>
													<td><?php echo $data['h_index']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["hi_id"]}><i class = 'fa fa-edit'></i></button></td>";
													?>
												</tr>
												<?php
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

	$(document).ready(function(){
		$('.edit').on('click',function(){
			$('#editpopup').modal('show');
			var row=$(this);
			var id=$(this).attr("data-id");
			$("#id").val(id);
			var name=row.closest('tr');
			var data = name.children("td").map(function(){
				return $(this).text();
			}).get();

			console.log(data);
			$('#academic_year').val(data[0]);
			$('#paper_title').val(data[1]);
			$('#author_name').val(data[2]);
			$('#journal_titile').val(data[3]);
			$('#month_year').val(data[4]);
			$('#h_index').val(data[5]);
		});
	});
</script>

</body>

</html>
