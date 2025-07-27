<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
} 
require '../../config.php';
$academic_year = $academic_year_err = $sanctioned_posts = $sanctioned_posts_err = $student_admitted = $student_admitted_err = "";

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
       $query = "SELECT * FROM cri_2_4_1_sanctioned_posts WHERE academic_year = '$academic_year_t' AND programme_code = '$department'";
       $result = mysqli_query($con, $query);

       $count = mysqli_num_rows($result);
       if($count == 1)
        {
            echo '<script language="javascript">';
            echo'alert("Record Already Exists."); location.href="cri_2.4.1_sanctioned_posts.php"';
            echo '</script>';
        }
        else
        {
            $academic_year = trim($_POST["academic_year"]);
        }
    }

    // Sanctioned Seats
    if(empty(trim($_POST["sanctioned_posts"])))
    {
        $sanctioned_posts_err = "Please Enter Santioned Posts.";
    }
    else
    {
    	$sanctioned_posts = trim($_POST["sanctioned_posts"]);
    }

    // Insert Data

    if(empty($academic_year_err) && empty($sanctioned_posts_err) && empty($student_admitted_err))
    {
    	$query = "INSERT INTO cri_2_4_1_sanctioned_posts (academic_year, programme_code, sanctioned_posts) VALUES ('$academic_year', '$department','$sanctioned_posts')";

    if(mysqli_query($con, $query))
    {
        echo '<script language="javascript">';
        echo'alert("Updated Successfully."); location.href="cri_2.4.1_sanctioned_posts.php"';
        echo '</script>';
    }
    else
    {
        echo '<script language="javascript">';
        echo'alert("Failed, Please Try Again."); location.href="cri_2.4.1_sanctioned_posts.php"';
        echo '</script>';
    }
    mysqli_close($con);
    }
}

if(isset($_POST['update']))
{
    $id = $_POST['id'];

    if(empty(trim($_POST["sanctioned_posts"])))
    {
       echo '<script language="javascript">';
       echo'alert("Please Enter Santioned Seats."); location.href="cri_2.4.1_sanctioned_posts.php"';
       echo '</script>';
   }
   else
   {
   	//Update
       $sanctioned_posts = trim($_POST["sanctioned_posts"]);

       $query = "UPDATE cri_2_4_1_sanctioned_posts SET sanctioned_posts = '$sanctioned_posts' WHERE id = '$id'";

       if(mysqli_query($con, $query))
       {
          echo '<script language="javascript">';
          echo'alert("Updated Successfully."); location.href="cri_2.4.1_sanctioned_posts.php"';
          echo '</script>';
      }
      else
      {
          echo '<script language="javascript">';
          echo'alert("Failed, Please Try Again."); location.href="cri_2.4.1_sanctioned_posts.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit Enrolment of Students.</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                            <input type="text" name="academic_year" class="form-control " id="academic_year" disabled readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "sanctioned_posts"> <span style="color: red">* </span>Number of Sanctioned Posts</label>

                            <input type="number" name="sanctioned_posts" class="form-control " id="sanctioned_posts">
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
                       	<i class="fa-solid fa-person-chalkboard fa-lg"></i>
						<span>Criteria 2.4.1 - Number of full time teachers against sanctioned posts during the year.</span>
                    </div>

                    <!-- Card Header End -->

                    <!-- Card Body -->

                    <div class="card-body">
                       <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" href="cri_2.4.1_sanctioned_posts.php" id="active">Sanctioned Posts</a>
                        </li>

                        <li class="nav-item" role="presentation">
	                        <a class="nav-link" href="cri_2.4.1_doc_upload.php" id="non-active">Document Upload</a>
	                    </li>

	                    <li class="nav-item" role="presentation">
							<a class="nav-link" href="cri_2.4.1_doc_view.php" id="non-active">View Document</a>
						</li>
                    </ul>

                    <div class = "card-body">
                        <div class="container-fluid"><br>
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-sm-6">
                                    <div class="card" style="border-top:2px solid #087ec2;">
                                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                            <i class="fa-solid fa-person-chalkboard fa-lg"></i>
                                            <span>Criteria 2.4.1 - Sanctioned Posts</span>
                                        </div>

                                        <div class="card-body">
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">


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
                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "sanctioned_posts"> <span style="color: red">* </span>Number of Sanctioned Posts</label>

                                            <input type="number" name="sanctioned_posts" class="form-control <?php echo (!empty($sanctioned_posts_err)) ? 'is-invalid' : ''; ?>"
                                            id = "sanctioned_posts" value = "<?php echo $sanctioned_posts; ?>">

                                            <div class="invalid-feedback">
                                                <?php echo $sanctioned_posts_err; ?>
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

            <?php 
            require '../../config.php';

            $sql = "SELECT cri_sd.academic_year, cri.sanctioned_posts, cri.id, COUNT(*) as teacher_count 
            FROM cri_2_2_2_full_time_teacher AS cri_sd
            INNER JOIN cri_2_4_1_sanctioned_posts AS cri
            ON cri.programme_code = cri_sd.department AND cri.academic_year = cri_sd.academic_year
            WHERE cri_sd.department = '$department'
            GROUP BY cri_sd.department, cri_sd.academic_year";
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
                                <th>Number of Posts Sanctioned</th>
                                <th>Number of full-time Teacher</th>
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
                                    <td><?php echo $data['sanctioned_posts']; ?></td>
                                    <td><?php echo $data['teacher_count']; ?></td>

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
            $('#sanctioned_posts').val(data[1]);
        });
    });

</script>

</body>
</html>