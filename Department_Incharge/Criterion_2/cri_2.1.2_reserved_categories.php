<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
} 

require '../../config.php';
$academic_year = $academic_year_err = $sc = $sc_err = $st = $tc_err = $obc = $obc_err = $gen = $gen_err = $other = $other_err = "";

$department = $_SESSION['department'];

if(isset($_POST['insert']))        
{
// Academic Year Validation

    if(empty(trim($_POST["academic_year"])))
    {
        $academic_year_err = "Please Select Academic Year.";
    }
    else
    {
       $academic_year_t = $_POST["academic_year"];
       $query = "SELECT * FROM cri_2_1_2_reserved_categories WHERE academic_year = '$academic_year_t' AND programme_code = '$department'";
       $result = mysqli_query($con, $query);

       $count = mysqli_num_rows($result);
       if($count == 1)
        {
            echo '<script language="javascript">';
            echo'alert("Record Already Exists."); location.href="cri_2.1.2_reserved_categories.php"';
            echo '</script>';
        }
        else
        {
            $academic_year = trim($_POST["academic_year"]);
        }
    }

    // SC Caterogy
    if(trim($_POST["sc"]) == NULL)
    {
        $sc_err = "Please Enter SC Category Reserved Seats.";
    }
    else
    {
    	$sc = trim($_POST["sc"]);
    }

    // ST Caterogy
    if(trim($_POST["st"]) == NULL)
    {
        $st_err = "Please Enter ST Category Reserved Seats.";
    }
    else
    {
    	$st = trim($_POST["st"]);
    }

    // OBC Caterogy
    if(trim($_POST["obc"]) == NULL)
    {
        $obc_err = "Please Enter OBC Category Reserved Seats.";
    }
    else
    {
    	$obc = trim($_POST["obc"]);
    }

    // General Caterogy
    if(trim($_POST["gen"]) == NULL)
    {
        $gen_err = "Please Enter General Category Reserved Seats.";
    }
    else
    {
    	$gen = trim($_POST["gen"]);
    }

    // ST Caterogy
    if(trim($_POST["other"]) == NULL)
    {
        $other_err = "Please Enter Other Category Reserved Seats.";
    }
    else
    {
    	$other = trim($_POST["other"]);
    }

    // Insert Data

    if(empty($academic_year_err) && empty($sc_err) && empty($st_err) && empty($obc_err) && empty($gen_err) && empty($other_err))
    {
    	$query = "INSERT INTO cri_2_1_2_reserved_categories (academic_year, programme_code, sc_category, st_category, obc_category, general_category, others) VALUES ('$academic_year', '$department','$sc', '$st', '$obc', '$gen', '$other')";

	    if(mysqli_query($con, $query))
	    {
	        echo '<script language="javascript">';
	        echo'alert("Updated Successfully."); location.href="cri_2.1.2_reserved_categories.php"';
	        echo '</script>';
	    }
	    else
	    {
	        echo '<script language="javascript">';
	        echo'alert("Failed, Please Try Again."); location.href="cri_2.1.2_reserved_categories.php"';
	        echo '</script>';
	    }
	    mysqli_close($con);
	    }
	}

	if(isset($_POST['update']))
	{
		if(trim($_POST["sc"]) == NULL)
		{
			echo '<script language="javascript">';
			echo'alert("Please Enter SC Category Reserved Seats."); location.href="cri_2.1.2_reserved_categories.php"';
			echo '</script>';
		}
		elseif(trim($_POST["st"]) == NULL)
		{
			echo '<script language="javascript">';
			echo'alert("Please Enter ST Category Reserved Seats."); location.href="cri_2.1.2_reserved_categories.php"';
			echo '</script>';
		}
		elseif(trim($_POST["obc"]) == NULL)
		{
			echo '<script language="javascript">';
			echo'alert("Please Enter OBC Category Reserved Seats."); location.href="cri_2.1.2_reserved_categories.php"';
			echo '</script>';
		}
		elseif(trim($_POST["gen"]) == NULL)
		{
			echo '<script language="javascript">';
			echo'alert("Please Enter General Category Reserved Seats."); location.href="cri_2.1.2_reserved_categories.php"';
			echo '</script>';
		}
		elseif(trim($_POST["other"]) == NULL)
		{
			echo '<script language="javascript">';
			echo'alert("Please Enter Other Category Reserved Seats."); location.href="cri_2.1.2_reserved_categories.php"';
			echo '</script>';
		}
		else
		{
   			//Update
			$id = $_POST['id'];
			$sc = trim($_POST["sc"]);
			$st = trim($_POST["st"]);
			$obc = trim($_POST["obc"]);
			$gen = trim($_POST["gen"]);
			$other = trim($_POST["other"]);

			$query = "UPDATE cri_2_1_2_reserved_categories SET sc_category = '$sc',st_category = '$st',obc_category = '$obc',general_category = '$gen',others = '$other' WHERE id = '$id'";

			if(mysqli_query($con, $query))
			{
				echo '<script language="javascript">';
				echo'alert("Updated Successfully."); location.href="cri_2.1.2_reserved_categories.php"';
				echo '</script>';
			}
			else
			{
				echo '<script language="javascript">';
				echo'alert("Failed, Please Try Again."); location.href="cri_2.1.2_reserved_categories.php"';
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

    <!-- Model -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
        <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit Reserved categories seats.</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "sc"> <span style="color: red">* </span>SC Category</label>

                            <input type="number" name="sc" class="form-control " id="sc">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "st"> <span style="color: red">* </span>ST Category</label>

                            <input type="number" name="st" class="form-control " id="st">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "obc"> <span style="color: red">* </span>OBC Category</label>

                            <input type="number" name="obc" class="form-control " id="obc">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "general"> <span style="color: red">* </span>General Category</label>

                            <input type="number" name="gen" class="form-control " id="gen">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "other"> <span style="color: red">* </span>Other Category</label>

                            <input type="number" name="other" class="form-control " id="other">
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
                            <a class="nav-link active" href="cri_2.1.2_reserved_categories.php" id="active">Reserved Categories Seats</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="cri_2.1.2_student_community.php" id="non-active">Students</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="cri_2.1.2_doc_upload.php" id="non-active">Document Upload</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="cri_2.1.2_doc_view.php" id="non-active">View Document</a>
                        </li>
                    </ul>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

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
                                           
                                            <div class="mb-3">
                                                <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                                                <select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

                                                       <option value="">---Select Academic Year---</option>

                                                       <?php
                                                       $sql = "SELECT * FROM academic_year WHERE hide_status = 1 ORDER BY academic_year ";
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
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "sc"> <span style="color: red">* </span>SC Category</label>

                                            	<input type="number" name="sc" class="form-control <?php echo (!empty($sc_err)) ? 'is-invalid' : ''; ?>"	id = "sc" value = "<?php echo $sc; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $sc_err; ?>
	                                            </div>
                                        	</div>
                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "st"> <span style="color: red">* </span>ST Category</label>

                                            	<input type="number" name="st" class="form-control <?php echo (!empty($st_err)) ? 'is-invalid' : ''; ?>"	id = "st" value = "<?php echo $st; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $st_err; ?>
	                                            </div>
                                        	</div>
                                		</div>
                            		</div>
                        		</div>

		                        <div class="col-sm-6 col-sm-6">
			                        <div class="card" style="border-top:2px solid #087ec2;">
			                        	<div class="card-header" style="color:#087ec2; font-weight:bold;">
			                        		<i class="fa-solid fa-graduation-cap fa-lg"></i>
		                                            <span>Criteria 2.1.2 - Reserved Category</span>
			                        	</div>
			                        	<div class="card-body">

			                        		<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "obc"> <span style="color: red">* </span>OBC Category</label>

                                            	<input type="number" name="obc" class="form-control <?php echo (!empty($obc_err)) ? 'is-invalid' : ''; ?>"	id = "obc" value = "<?php echo $obc; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $obc_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "gen"> <span style="color: red">* </span>General Category</label>

                                            	<input type="number" name="gen" class="form-control <?php echo (!empty($gen_err)) ? 'is-invalid' : ''; ?>"	id = "gen" value = "<?php echo $gen; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $gen_err; ?>
	                                            </div>
                                        	</div>

                                        	<div class="mb-3">
                                           		<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "other"> <span style="color: red">* </span>Other Category</label>

                                            	<input type="number" name="other" class="form-control <?php echo (!empty($other_err)) ? 'is-invalid' : ''; ?>"	id = "other" value = "<?php echo $other; ?>">

	                                            <div class="invalid-feedback">
	                                                <?php echo $other_err; ?>
	                                            </div>
                                        	</div>

			                        		<button type="submit" class="btn btn-success" style="float: right;" name="insert"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

			                        	</div>
			                        </div>
			                    </div>
		                    </div>
		                </div>
		            </div>
		        </form>

            <?php 
            require '../../config.php';

            $sql = "SELECT * FROM cri_2_1_2_reserved_categories";
            $datas = $con->query($sql);

            if($datas->num_rows>0)
            {
                ?>
                <div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead style="background-color:#057EC5; color:#FFF;">
                            <tr align="center">
                                <th>Sl.No</th>
                                <th>Academic Year</th>
                                <th>SC Category</th>
                                <th>ST Category</th>
                                <th>OBC Category</th>
                                <th>General Category</th>
                                <th>Others Category</th>
                                <th>Update</th>
                            </tr>
                        </thead>

                        <tbody class="row_position">
                            <?php

                            $i=0;
                            while ($data = $datas->fetch_assoc()) 
                            { 
                                $i++;
                                ?>

                                <tr style="text-align:center;" id="<?php echo $data['id']?>">
                                    <th><?php echo $i ?></th>
                                    <td><?php echo $data['academic_year']; ?></td>
                                    <td><?php echo $data['sc_category']; ?></td>
                                    <td><?php echo $data['st_category']; ?></td>
                                    <td><?php echo $data['obc_category']; ?></td>
                                    <td><?php echo $data['general_category']; ?></td>
                                    <td><?php echo $data['others']; ?></td>

                                    <?php
                                    echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$data["id"]}><i class = 'fa fa-edit'></i></button></td>";

                                    ?>   
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
            $('#sc').val(data[1]);
            $('#st').val(data[2]);
            $('#obc').val(data[3]);
            $('#gen').val(data[4]);
            $('#other').val(data[5]);
        });
    });

</script>

</body>
</html>