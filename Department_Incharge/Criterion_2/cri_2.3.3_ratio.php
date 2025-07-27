<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
	header("location: ../../index.php");
	exit;
}
require '../../config.php';
$academic_year = $academic_year_err = $mentor = $mentor_err = "";
$upload_by = $_SESSION['department'];

if(isset($_POST['insert']))
{
    // Academic Year Validation

	if(empty(trim($_POST["academic_year"])))
	{
		$academic_year_err = "Please Select Academic Year.";
	}
	else
	{
		$academic_yeart = trim($_POST["academic_year"]);
        $query = "SELECT * FROM cri_2_3_3_ratio WHERE academic_year = '$academic_yeart' AND programme_code = '$upload_by'";

        $result = mysqli_query($con, $query);

        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            $academic_year_err = "Record Already Exists.";
        }
        else
        {
            $academic_year = trim($_POST["academic_year"]);
        }  
	}

	if(empty(trim($_POST["mentor"])))
	{
		$mentor_err = "Please Enter number of Mentor.";
	}
	else
	{
		$mentor = trim($_POST["mentor"]);
	}

	
	// Insert
	if(empty($academic_year_err) && empty($mentor_err))
	{
		
		$query = "INSERT INTO cri_2_3_3_ratio (programme_code, academic_year, no_of_mentor) VALUES ('$upload_by', '$academic_year', '$mentor')";

		if(mysqli_query($con, $query))
	    {
	        echo '<script language="javascript">';
	        echo'alert("Mentor Ratio added Successfully."); location.href="cri_2.3.3_ratio.php"';
	        echo '</script>';
	    }
	    else
	    {
	        echo '<script language="javascript">';
	        echo'alert("Failed, Please Try Again."); location.href="cri_2.3.3_ratio.php"';
	        echo '</script>';
	    }
	    mysqli_close($con);
	}
}

	if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        if (empty(trim($_POST["mentor"]))) 
        {
            echo '<script language="javascript">';
            echo'alert("Please Enter number of Mentor."); location.href="cri_2.3.3_ratio.php"';
            echo '</script>';
        }
        else
        {
            $mentor=trim($_POST["mentor"]); 

            $query = "UPDATE cri_2_3_3_ratio SET no_of_mentor = '$mentor' WHERE id = '$id'";

            if(mysqli_query($con, $query))
            {
                echo '<script language="javascript">';
                echo'alert("Mentor Ratio added Successfully."); location.href="cri_2.3.3_ratio.php"';
                echo '</script>';
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("Failed, Please Try Again."); location.href="cri_2.3.3_ratio.php"';
                echo '</script>';
            }
            mysqli_close($con);    
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../stylesheet/sidebar.css">

	<script src="https://cdn.tiny.cloud/1/twp80yioigf2md9cvgdxge0qftfnqaz7wr1fh7kli099idu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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

	    <!-- Model -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
        <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam>Edit Mentor</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                <div class="modal-body">
                
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Year of Revision</label>

                        <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "mentor"> <span style="color: red">* </span>Number of Mentors</label>

                        <input type="number" name="mentor" class="form-control " id="mentor">
                    </div>
                    <input type="hidden" name="id" id="id" value="0">
               
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
							<li class="breadcrumb-item active" aria-current="page">Criteria 2.2</li>
						</ol>
					</nav>
				</div>

				<!-- Breadcrumb End -->

				<div class="container-fluid">
					<div class="card" style="border-top:2px solid #087ec2;">

						<!-- Card Header -->

						<div class="card-header" style="color:#087ec2; font-weight:bold;">
							<i class="fa-solid fa-chalkboard-user fa-lg"></i>
							<span>Criteria 2.3.3 - Ratio of students to mentor for academic and other related issues.</span>
						</div>

						<!-- Card Header End -->

						<!-- Card Body -->

						<div class="card-body">
							<ul class="nav nav-tabs">

								<li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_2.3.3_ratio.php" id="active">Mentor Mentee Ratio</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_2.3.3_doc_upload.php" id="non-active">Document Upload</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
									<a class="nav-link" href="cri_2.3.3_doc_view.php" id="non-active">View Document</a>
								</li>

							</ul><br>

							<div class = "card-body">
								<div class="container-fluid"><br>
									<div class="row justify-content-center">
										<div class="col-sm-6 col-sm-6">
											<div class="card" style="border-top:2px solid #087ec2;">
												<div class="card-header" style="color:#087ec2; font-weight:bold;">
													<i class="fa-solid fa-chalkboard-user fa-lg"></i>
	                        						<span>Criteria 2.3.3 - Mentor Mentee Ratio</span>
												</div>

												<div class="card-body">
													<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

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
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "mentor"> <span style="color: red">* </span>Number of Mentors</label>

                                                            <input type="number" name="mentor" class="form-control <?php echo (!empty($mentor_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "mentor" value = "<?php echo $mentor; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $mentor_err; ?>
                                                            </div>
                                                        </div>

														<button type="submit" class="btn btn-success" style="float: right;" name="insert"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>
													</form>

												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

							<div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead style="background-color:#057EC5; color:#FFF;">
                                            <tr>
                                                <th style="text-align:center;">Sl.No</th>
                                                <th style="text-align:center;">Academic Year</th>
                                                <th style="text-align:center;">Number of Mentors</th>
                                                <th style="text-align:center;">Edit</th>
                                            </tr>
                                        </thead>

                                        <tbody class="row_position">
                                            <?php 
                                                require '../../config.php';
                                                $sql = "SELECT * FROM cri_2_3_3_ratio WHERE programme_code = '$upload_by' ORDER BY academic_year";
                                                $datas = $con->query($sql);

                                                if($datas->num_rows>0)
                                                {
                                                    $i=0;
                                                    while ($data = $datas->fetch_assoc()) 
                                                    { 
                                                        $i++;
                                                        ?>

                                                         <tr style="text-align:center;" id="<?php echo $data['id']?>">
                                                            <th><?php echo $i ?></th>
                                                            <td><?php echo $data['academic_year']; ?></td>
                                                            <td><?php echo $data['no_of_mentor']; ?></td>

                                                            <?php
                                                            echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["id"]}><i class = 'fa fa-edit'></i></button></td>";

                                                             ?>   
                                                        </tr>
                                                        <?php 
                                                    }
                                                }
                                                else
                                                {
                                                    echo"<tr>";
                                                    echo"<td colspan = '4' style = 'text-align:left;'>Data Not Founded...!</td>";
                                                    echo"</tr>";
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
                $('#mentor').val(data[1]);
            });
        });

    </script>

</body>

</html>
