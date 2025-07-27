<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $teacher_name = $teacher_name_err = $book_title = $book_title_err = $chapter_title = $chapter_title_err = $conference_title = $conference_title_err = $conference_name = $conference_name_err = $conference_type = $conference_type_err = $month_year = $month_year_err = $isbn = $isbn_err = $affiliating_institute = $affiliating_institute_err = $publisher_name = $publisher_name_err = "";
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

	if(empty(trim($_POST["teacher_name"])))
	{
		$teacher_name_err = "Please Enter Name of the Teacher.";
	}
	else
	{
		$teacher_name = trim($_POST["teacher_name"]);
	}

	if(empty(trim($_POST["book_title"])))
	{
		$book_title_err = "Please Enter Title of the Book published.";
	}
	else
	{
		$book_title = trim($_POST["book_title"]);
	}

	if(empty(trim($_POST["chapter_title"])))
	{
		$chapter_title_err = "Please Enter Title of the Chapter published.";
	}
	else
	{
		$chapter_title = trim($_POST["chapter_title"]);
	}

	if(empty(trim($_POST["conference_title"])))
	{
		$conference_title_err = "Please Enter Title of the proceedings of the conference.";
	}
	else
	{
		$conference_title = trim($_POST["conference_title"]);
	}

	if(empty(trim($_POST["conference_name"])))
	{
		$conference_name_err = "Please Enter Name of the conference.";
	}
	else
	{
		$conference_name = trim($_POST["conference_name"]);
	}

	if(empty(trim($_POST["conference_type"])))
	{
		$conference_type_err = "Please Enter National / International.";
	}
	else
	{
		$conference_type = trim($_POST["conference_type"]);
	}

	if(empty(trim($_POST["month_year"])))
	{
		$month_year_err = "Please Enter Year and month of publication.";
	}
	else
	{
		$month_year = trim($_POST["month_year"]);
	}

	if(empty(trim($_POST["isbn"])))
	{
		$isbn_err = "Please Enter ISBN of the Book/Conference Proceeding.";
	}
	else
	{
		$isbn = trim($_POST["isbn"]);
	}

	if(empty(trim($_POST["affiliating_institute"])))
	{
		$affiliating_institute_err = "Please Enter Affiliating Institute of the teacher at the time of publication .";
	}
	else
	{
		$affiliating_institute = trim($_POST["affiliating_institute"]);
	}

	if(empty(trim($_POST["publisher_name"])))
	{
		$publisher_name_err = "Please Enter Name of the Publisher.";
	}
	else
	{
		$publisher_name = trim($_POST["publisher_name"]);
	}

	// Insert

	if(empty($academic_year_err) && empty($teacher_name_err) && empty($book_title_err) && empty($chapter_title_err) && empty($conference_title_err) && empty($conference_name_err) && empty($conference_type_err) && empty($month_year_err) && empty($isbn_err) && empty($affiliating_institute_err) && empty($publisher_name_err))
	{
		$query = "INSERT INTO cri_3_4_4_edited_books (academic_year, upload_by_id, upload_by_name, teacher_name, book_title, chapter_title, conference_title, conference_name, conference_type, month_year, isbn, affiliating_institute, publisher_name) VALUES ('$academic_year', '$upload_by_id', '$upload_by_name','$teacher_name', '$book_title', '$chapter_title', '$conference_title', '$conference_name', '$conference_type', '$month_year', '$isbn', '$affiliating_institute', '$publisher_name')";
		if(mysqli_query($con, $query))
		{
			echo '<script language="javascript">';
			echo'alert("Uploaded Successfully."); location.href="cri_3.4.4_data_entry.php"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo'alert("Upload Failed, Please Try Again."); location.href="cri_3.4.4_data_entry.php"';
			echo '</script>';
		}
		
	}
}
if(isset($_POST['update']))
{
	$err = 0;
	$teacher_name = $book_title = $chapter_title = $conference_title = $conference_name = $conference_type = $month_year = $isbn = $publisher_name = "";

	if(empty(trim($_POST["teacher_name"])) || empty(trim($_POST["book_title"])) || empty(trim($_POST["chapter_title"])) || empty(trim($_POST["conference_title"])) || empty(trim($_POST["conference_name"])) || empty(trim($_POST["conference_type"])) || empty(trim($_POST["month_year"])) || empty(trim($_POST["isbn"])) || empty(trim($_POST["affiliating_institute"])) || empty(trim($_POST["publisher_name"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please Fill the all Fields."); location.href="cri_3.4.4_data_entry.php"';
        echo '</script>';
	}
	else
	{
		if($err == 0)
		{
			$id = $_POST['id'];
			$teacher_name = $_POST['teacher_name'];
			$book_title = $_POST['book_title'];
			$chapter_title = $_POST['chapter_title'];
			$conference_title = $_POST['conference_title'];
			$conference_name = $_POST['conference_name'];
			$conference_type = $_POST['conference_type'];
			$month_year = $_POST['month_year'];
			$isbn = $_POST['isbn'];
			$affiliating_institute = $_POST['affiliating_institute'];
			$publisher_name = $_POST['publisher_name'];

			$query = "UPDATE cri_3_4_4_edited_books SET teacher_name = ?, book_title = ?, chapter_title = ?, conference_title = ?, conference_name = ?, conference_type = ?, month_year = ?, isbn = ?, affiliating_institute = ?, publisher_name = ? WHERE eb_id = ?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "ssssssssssi", $teacher_name, $book_title, $chapter_title, $conference_title, $conference_name, $conference_type, $month_year, $isbn, $affiliating_institute, $publisher_name, $id);
			if(mysqli_stmt_execute($stmt)) 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Successfully."); location.href="cri_3.4.4_data_entry.php"';
			    echo '</script>';
			} 
			else 
			{
			    echo '<script language="javascript">';
			    echo 'alert("Update Failed, Please Try Again."); location.href="cri_3.4.4_data_entry.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Edited Volumes / Books</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                    	<div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "teacher_name"> <span style="color: red">* </span>Name of the Teacher</label>

                            <input type="text" name="teacher_name" class="form-control " id="teacher_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "book_title"> <span style="color: red">* </span>Title of the Book published</label>

                            <input type="text" name="book_title" class="form-control " id="book_title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "chapter_title"> <span style="color: red">* </span>Title of the Chapter published</label>

                            <input type="text" name="chapter_title" class="form-control " id="chapter_title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "conference_title"> <span style="color: red">* </span>Title of the proceedings of the conference</label>

                            <input type="text" name="conference_title" class="form-control " id="conference_title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "conference_name"> <span style="color: red">* </span>Name of the conference</label>

                            <input type="text" name="conference_name" class="form-control " id="conference_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "conference_type"> <span style="color: red">* </span>National / International</label>

                            <input type="text" name="conference_type" class="form-control " id="conference_type">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "month_year"> <span style="color: red">* </span>Year and month of publication</label>

                            <input type="text" name="month_year" class="form-control " id="month_year">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "isbn"> <span style="color: red">* </span>ISBN of the Book/Conference Proceeding</label>

                            <input type="text" name="isbn" class="form-control " id="isbn">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "affiliating_institute"> <span style="color: red">* </span>Affiliating Institute of the teacher at the time of publication</label>

                            <input type="text" name="affiliating_institute" class="form-control " id="affiliating_institute">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "publisher_name"> <span style="color: red">* </span>Name of the Publisher</label>

                            <input type="text" name="publisher_name" class="form-control " id="publisher_name">
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
							<span>Criteria 3.4.4 - Number of books and chapters in edited volumes / books published per teacher during the year.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
									<a class="nav-link active" href="cri_3.4.4_data_entry.php" id="active">Edited Volumes / Books</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.4.4_doc_upload.php" id="non-active">Upload Document</a>
								</li>

								<li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_3.4.4_doc_view.php" id="non-active">View Document</a>
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
														<span>Criteria 3.4.4 - Edited Volumes / Books</span>
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
															<label class="form-label" for = "teacher_name"> <span style="color: red">* </span>Name of the Teacher</label>

															<input 
															type="text" 
															name="teacher_name" 
															class="form-control <?php echo (!empty($teacher_name_err)) ? 'is-invalid' : ''; ?>"
															id = "teacher_name" 
															value = "<?php echo $teacher_name; ?>">

															<div class="invalid-feedback">
																<?php echo $teacher_name_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "book_title"> <span style="color: red">* </span>Title of the Book published</label>

															<input 
															type="text" 
															name="book_title" 
															class="form-control <?php echo (!empty($book_title_err)) ? 'is-invalid' : ''; ?>"
															id = "book_title" 
															value = "<?php echo $book_title; ?>">

															<div class="invalid-feedback">
																<?php echo $book_title_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "chapter_title"> <span style="color: red">* </span>Title of the Chapter published</label>

															<input 
															type="text" 
															name="chapter_title" 
															class="form-control <?php echo (!empty($chapter_title_err)) ? 'is-invalid' : ''; ?>"
															id = "chapter_title" 
															value = "<?php echo $chapter_title; ?>">

															<div class="invalid-feedback">
																<?php echo $chapter_title_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "conference_title"> <span style="color: red">* </span>Title of the proceedings of the conference</label>

															<input 
															type="text" 
															name="conference_title" 
															class="form-control <?php echo (!empty($conference_title_err)) ? 'is-invalid' : ''; ?>"
															id = "conference_title" 
															value = "<?php echo $conference_title; ?>">

															<div class="invalid-feedback">
																<?php echo $conference_title_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "conference_name"> <span style="color: red">* </span>Name of the conference</label>

															<input 
															type="text" 
															name="conference_name" 
															class="form-control <?php echo (!empty($conference_name_err)) ? 'is-invalid' : ''; ?>"
															id = "conference_name" 
															value = "<?php echo $conference_name; ?>">

															<div class="invalid-feedback">
																<?php echo $conference_name_err; ?>
															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-sm-6 col-sm-6">
												<div class="card" style="border-top:2px solid #087ec2;">
													<div class="card-header" style="color:#087ec2; font-weight:bold;">
														<i class="fa-solid fa-trophy fa-lg"></i>
														<span>Criteria 3.4.4 - Edited Volumes / Books</span>
													</div>
													<div class="card-body">

														<div class="mb-3">
															<label class="form-label" for = "conference_type"> <span style="color: red">* </span>National / International</label>

															<input 
															type="text" 
															name="conference_type" 
															class="form-control <?php echo (!empty($conference_type_err)) ? 'is-invalid' : ''; ?>"
															id = "conference_type" 
															value = "<?php echo $conference_type; ?>">

															<div class="invalid-feedback">
																<?php echo $conference_type_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "month_year"> <span style="color: red">* </span>Year and month of publication</label>

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
															<label class="form-label" for = "isbn"> <span style="color: red">* </span>ISBN of the Book/Conference Proceeding</label>

															<input 
															type="text" 
															name="isbn" 
															class="form-control <?php echo (!empty($isbn_err)) ? 'is-invalid' : ''; ?>"
															id = "isbn" 
															value = "<?php echo $isbn; ?>">

															<div class="invalid-feedback">
																<?php echo $isbn_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "affiliating_institute"> <span style="color: red">* </span>Affiliating Institute of the teacher at the time of publication</label>

															<input 
															type="text" 
															name="affiliating_institute" 
															class="form-control <?php echo (!empty($affiliating_institute_err)) ? 'is-invalid' : ''; ?>"
															id = "affiliating_institute" 
															value = "<?php echo $affiliating_institute; ?>">

															<div class="invalid-feedback">
																<?php echo $affiliating_institute_err; ?>
															</div>
														</div>

														<div class="mb-3">
															<label class="form-label" for = "publisher_name"> <span style="color: red">* </span>Name of the Publisher</label>

															<input 
															type="text" 
															name="publisher_name" 
															class="form-control <?php echo (!empty($publisher_name_err)) ? 'is-invalid' : ''; ?>"
															id = "publisher_name" 
															value = "<?php echo $publisher_name; ?>">

															<div class="invalid-feedback">
																<?php echo $publisher_name_err; ?>
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
							$sql = "SELECT * FROM cri_3_4_4_edited_books WHERE upload_by_id = '$upload_by_id'";
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
												<th>Name of the Teacher</th>
												<th>Title of the Book published</th>
												<th>Title of the Chapter published</th>
												<th>Title of the proceedings of the conference</th>
												<th>Name of the conference</th>
												<th>National / International</th>
												<th>Year and month of publication</th>
												<th>ISBN of the Book/Conference Proceeding</th>
												<th>Affiliating Institute of the teacher at the time of publication</th>
												<th>Name of the Publisher</th>
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
													<td><?php echo $data['teacher_name']; ?></td>
													<td><?php echo $data['book_title']; ?></td>
													<td><?php echo $data['chapter_title']; ?></td>
													<td><?php echo $data['conference_title']; ?></td>
													<td><?php echo $data['conference_name']; ?></td>
													<td><?php echo $data['conference_type']; ?></td>
													<td><?php echo $data['month_year']; ?></td>
													<td><?php echo $data['isbn']; ?></td>
													<td><?php echo $data['affiliating_institute']; ?></td>
													<td><?php echo $data['publisher_name']; ?></td>
													<?php
													echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["eb_id"]}><i class = 'fa fa-edit'></i></button></td>";
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
			$('#teacher_name').val(data[1]);
			$('#book_title').val(data[2]);
			$('#chapter_title').val(data[3]);
			$('#conference_title').val(data[4]);
			$('#conference_name').val(data[5]);
			$('#conference_type').val(data[6]);
			$('#month_year').val(data[7]);
			$('#isbn').val(data[8]);
			$('#affiliating_institute').val(data[9]);
			$('#publisher_name').val(data[10]);
		});
	});
</script>

</body>

</html>
